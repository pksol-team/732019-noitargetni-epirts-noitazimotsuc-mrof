<?php

namespace App\Http\Controllers;

use App\Assign;
use App\Message;
use App\Order;
use App\OrderMessage;
use App\Repositories\ChatRepository;
use App\Repositories\EmailRepository;
use App\Repositories\SmsRepository;
use Response;
use App\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Repositories\OrderRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use App\Bid;

class MessagesController extends Controller
{
    //
    protected $user;
    protected $emailer;

    /**
     * MessagesController constructor.
     * Allow only logged in users
     */
    public function __construct()
    {
        $this->middleware('auth');
        $user = Auth::user();
        $mail_repo = new EmailRepository();
        $this->emailer = $mail_repo;
        $this->user = $user;
    }

    public function sendMessage(Request $request,Order $order,Assign $assign){
        $to_user = 'writer';
        if($request->to != 0){
            $to_user = 'admin';
        }
        if($request->sent_to == 'client')
            $to_user = 'client';
        $message = $assign->messages()->create([
            'message'=>nl2br($request->message),
            'user_id'=>$this->user->id,
            'client_id'=>$assign->user_id,
            'sender'=>$request->sender,
            'to_user'=>$to_user
        ]);
        if($request->to || $request->sent_to == 'client'){
            if($request->to){
                $message->from_user = $request->to;
                $message->update();
            }
            if(strtolower($request->to)=='client' || $request->sent_to == 'client'){
                $chat_repo = new ChatRepository();
                $filtered = $chat_repo->checkFiltered($request->message);
                if($filtered && Auth::user()->role == 'writer'){
                    $message->message = "<I STYLE='COLOR:RED;'>FILTERED TO ADMIN! </I><BR/>".$message->message;
                    $message->from_user = 'Support';
                    $message->update();
                }else{
                    $order = $assign->order;
                    $omessage = $order->messages()->create([
                        'user_id'=>$this->user->id,
                        'message'=>nl2br($request->message),
                        'client_id'=>$order->user_id,
                        'sender'=>1,
                        'seen'=>0
                    ]);
                    $omessage->destination = 'writer';
                    $omessage->update();
                    $this->emailer->sendOrderMessage($order->user,$order,nl2br($request->message));
                    if($request->copy_sms){

                        try {
                            $sms = new SmsRepository();
                            $sms->sendSms($order->user,$request->message);
                            $omessage->sms = 1;
                            $omessage->update();
                        } catch (Exception $e) {
                            return response($e->getMessage(),500);
                        }

                    }
                }
            }
        }
        if($request->sender==0 && $request->sent_to != 'client'){
            $this->emailer->sendRoomEmail($assign->user,$assign,$order,nl2br($request->message));
            if($request->copy_sms){
            try {
                $sms = new SmsRepository();
                $sms->sendSms($assign->user,$request->message);
                $message->sms = 1;
                $message->update();
            } catch (Exception $e) {

            }
        }

        }else{
            if(Auth::user()->role != 'admin'){
                $user = $this->user;
            $mail = 'Hello Admin,<br/> You have a new message from '.$user->name.'<br/>
            <strong><i>'.$request->message.'</i></strong>
             <br/>please check and reply accordingly';
            $this->emailer->sendAdminNote($mail); 
            }
           
        }
        return ['reload'=>true];
        die();
    }

    public function getMessages(Request $request,Order $order,Assign $assign){
        $messages = $assign->messages()->get();
        echo json_encode($messages);
    }

    public function markRead(Order $order,Request $request){
        if($request->sender==1){
            $sender = 0;
        }else{
            $sender = 1;
        }
        $order->messages()->where('sender','=',$sender)->update([
            'seen'=>1
        ]);
    }

    public function getUnread(){
        if($this->user->role=='writer'){
            $messages = Message::where([
                ['client_id','=',$this->user->id],
                ['sender','=',0],
                ['seen','=',0]
            ])->get();
            $all = ['order'=>[],'messages'=>$messages,'bid_messages'=>[]];
            echo json_encode($all);
        }elseif($this->user->role=='admin'){
            $messages = Message::where([
                ['sender','=',1],
                ['seen','=',0]
            ])->get();
            $order_message = OrderMessage::where([
                ['sender','=',0],
                ['seen','=',0]
            ])->get();
            $all = ['order'=>$order_message,'messages'=>$messages,'bid_messages'=>[]];
            echo json_encode($all);
        }elseif($this->user->role=='client'){
            $order_message = OrderMessage::where([
                ['client_id','=',$this->user->id],
                ['seen','=',0],
                ['sender','=',1]
            ])->get();
            $all = ['order'=>$order_message,'messages'=>[],'bid_messages'=>[]];
            echo json_encode($all);
        }

    }
    public function findRoom(Message $message){
        $message->seen = 1;
        $message->update();
        $assign = $message->assign;
//        var_dump($assign);
        if($this->user->role=='writer'){
            return redirect("writer/order/$assign->order_id/room/$assign->id");
        }elseif($this->user->role=='admin'){
            return redirect("order/$assign->order_id/room/$assign->id");
        }

    }

    public function orderMessages(Order $order,Request $request){
        $method = $request->method();
        $user = $this->user;
        if($method=='POST'){
            $message = $order->messages()->create([
                'user_id'=>$this->user->id,
                'message'=>nl2br($request->message),
                'client_id'=>$request->client_id,
                'sender'=>$request->sender
            ]);
            $message->destination = $request->destination;
            $message->update();
            if($request->destination =='writer'){
                $chat_repo = new ChatRepository();
                $filtered = $chat_repo->checkFiltered($request->message);
                if($filtered){
                    $message->destination = 'Support';
                    $message->message = "<I STYLE='COLOR:RED;'>FILTERED TO ADMIN! </I><BR/>".$message->message;
                    $message->update();
                }else{
                    $assign = $order->assigns()->whereIn('status',[0,1,2,3])->first();
                    if(!$assign){
                        $assign = $order->assigns()->first();
                    }
                    if($assign){
                        $assign->messages()->create([
                            'message'=>nl2br($request->message),
                            'user_id'=>$this->user->id,
                            'client_id'=>$this->user->id,
                            'sender'=>3
                        ]);
                        $this->emailer->sendRoomEmail($assign->user,$assign,$order,nl2br($request->message));
                    }
                }
            }
            if($request->sender==1){
                if($request->copy_sms){

                    try {
                        $sms = new SmsRepository();
                        $sms->sendSms($order->user,$request->message);
                        $message->sms = 1;
                        $message->update();
                    } catch (Exception $e) {

                    }

                }
                $this->emailer->sendOrderMessage($order->user,$order,nl2br($request->message));
            }else{
                $mail = 'Hello Admin,<br/> You have a new message from '.$user->name.'<br/>
            <strong><i>'.$request->message.'</i></strong>
             <br/>please check and reply accordingly';
                $this->emailer->sendAdminNote($mail);
            }
            return ['reload'=>true];
        }
        return $order->messages;


    }

}
