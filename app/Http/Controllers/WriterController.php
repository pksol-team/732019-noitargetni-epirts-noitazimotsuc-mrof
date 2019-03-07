<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\Bid;
use App\BidMapper;
use App\Repositories\EmailRepository;
use App\Repositories\FileSaverRepository;
use App\Repositories\WebsiteRepository;
use App\Repositories\WordRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Repositories\MenuRepository;
use App\Http\Requests;
use App\Order;
use App\Http\Controllers\Controller;
use App\Repositories\OrderRepository;
use Illuminate\Support\Facades\Auth;
use App\Assign;
use App\Repositories\AdaptivePayment;
use App\File;
class WriterController extends Controller
{
    protected $emailer;
    protected $orders;
    protected $user;
    protected $fileSaver;
    protected $active_status = 0;
    protected $available_status = 0;
    protected $revision_status = 2;
    protected $active_bids = 0;
    protected $completed_status = 4;
    protected $pending_status = 3;

    protected $client_active_status=1;
    protected $client_pending_status = 4;
    protected $client_closed_status = 6;
    protected $client_unassigned_status = 0;
    public function __construct(OrderRepository $orders, FileSaverRepository $fileSaverRepository,Request $request)
    {
        $this->fileSaver = $fileSaverRepository;
        $this->middleware('auth');
        $this->orders = $orders;
        $this->user = Auth::user();
        $this->emailer = new EmailRepository();
        new MenuRepository($request);
    }

    public function index(){
//        $bids = $this->user->bids()->where('status','=',$this->available_status)->select('order_id')->get();
//        $bidded_orders = [];
//        foreach($bids as $bid){
//            $bidded_orders[]=$bid->order_id;
//        }
//        $available = BidMapper::where('status','=',1)->whereNotIn('order_id',$bidded_orders)->count();
//        $revision = $this->user->assigns()->where('status','=',$this->revision_status)->count();
//        $completed = $this->user->assigns()->whereIn('status',[$this->pending_status,$this->completed_status])->count();
//        $active = $this->user->assigns()->where('status','=',$this->active_status)->count();
//        $bidded = $this->user->bids()->where('status','=',$this->active_bids)->count();
//        return View('writer.index',[
//            'active'=>$active,
//            'revision'=>$revision,
//            'completed'=>$completed,
//            'available'=>$available,
//            'bidded'=>$bidded
//        ]);
        $web_repo = new WebsiteRepository();
        $website = $web_repo->getWebsite();

        $profile = $this->user->profile;
        $styles = json_decode($profile->style_ids);
        $subjects = json_decode($profile->subject_ids);
        $bids = $this->user->bids()->where('status','=',$this->available_status)->select('order_id')->get();
        $bidded = [];
        foreach($bids as $bid){
            $bidded[]=$bid->order_id;
        }
        if($this->user->isDesigner()){
            $bidmappers =BidMapper::where([
                ['bid_mappers.status','=',1],
                ['bid_mappers.allowed','like',"%".$this->user->writer_category_id."%"]
            ])
                ->join('orders','orders.id','=','bid_mappers.order_id')
                ->orWhere([
                    ['orders.designer','=',1]
                ])

//            ->whereIn('orders.style_id',$styles)
//            ->whereIn('orders.subject_id',$subjects)
                ->whereNotIn('bid_mappers.order_id',$bidded)->orderBy('deadline','asc')
                ->select('bid_mappers.*')
                ->paginate(10);
        }else{
            $bidmappers =BidMapper::where([
                ['bid_mappers.status','=',1],
                ['bid_mappers.allowed','like',"%".$this->user->writer_category_id."%"]
            ])
                ->join('orders','orders.id','=','bid_mappers.order_id')
//            ->whereIn('orders.style_id',$styles)
//            ->whereIn('orders.subject_id',$subjects)
                ->whereNotIn('bid_mappers.order_id',$bidded)->orderBy('deadline','asc')
                ->select('bid_mappers.*')
                ->paginate(10);
        }

        return View('writer.available',[
            'bidmappers'=>$bidmappers
        ]);
    }

    /**
     * show active orders to writer
     */
    public function active(){
        $user = $this->user;
        $active =  $this->user->assigns()->where([
            ['status',$this->active_status]
        ])
            ->orderBy('order_id','desc')
            ->paginate(10);

        return View('writer.active',[
            'active'=>$active
        ]);
    }

    /**
     *  show orders on revisions
     */
    public function revision(){
        $user = $this->user;
       $revision =  $this->user->assigns()->where([
            ['status',$this->revision_status]
        ])
            ->orderBy('id','desc')
            ->paginate(15);
        return View('writer.revision',[
            'revision'=>$revision
        ]);
    }

    /**
     * Show pending completed orders
     */
    public function pending(){
        return View('writer.pending',[

        ]);
    }

    /**
     * show completed orders
     */
    public function completed(){
        $assigns =  $this->user->assigns()
            ->join('orders','orders.id','=','assigns.order_id')
            ->whereIn('assigns.status',[$this->pending_status,$this->completed_status])
            ->select('assigns.*','orders.status as order_status','orders.topic','orders.pages')
            ->orderBy('assigns.id','desc')
            ->paginate(10);
        return View('writer.completed',[
            'assigns'=>$assigns
        ]);
    }
    /**
     * Show writer bids
     */
    public function bids(){
        $bids = $this->user->bids()->where('status','=',$this->active_bids)->orderBy('id','desc')->paginate(10);
//        dd($bids);
        return View('writer.bids',[
            'bids'=>$bids
        ]);
    }
    /**
     * Show writer payments
     */
    public function payment(){
        $assigns =  $this->user->assigns()
            ->join('orders','orders.id','=','assigns.order_id')
            ->whereIn('assigns.status',[$this->pending_status,$this->completed_status])
            ->select('assigns.*','orders.status as order_status','orders.topic','orders.pages')
            ->orderBy('assigns.id','desc')
            ->paginate(10);
        return View('writer.payment',[
            'assigns'=>$assigns
        ]);
    }

    /**
     * Show available orders to writer
     */
    public function available(){
        $profile = $this->user->profile;
        $styles = json_decode($profile->style_ids);
        $subjects = json_decode($profile->subject_ids);
        $bids = $this->user->bids()->where('status','=',$this->available_status)->select('order_id')->get();
        $bidded = [];
        foreach($bids as $bid){
            $bidded[]=$bid->order_id;
        }
        $bidmappers =BidMapper::where('bid_mappers.status','=',1)
            ->join('orders','orders.id','=','bid_mappers.order_id')
//            ->whereIn('orders.style_id',$styles)
//            ->whereIn('orders.subject_id',$subjects)
            ->whereNotIn('bid_mappers.order_id',$bidded)->orderBy('deadline','asc')
            ->select('bid_mappers.*')
            ->paginate(10);
        return View('writer.available',[
            'bidmappers'=>$bidmappers
        ]);
    }

    /**
     * Show a single order
     */

    public function viewOrder(Order $order){
        $files = $this->orders->getOrderFiles($order->id);
        if($order->designer == 1){
            return View('writer.designer_view',[
                'order'=>$order
            ]);
        }
        return View('writer.order',[
            'order'=>$order
        ]);
    }
    /**
     * writer can bid/edit bid here
     */
    public function bid($bidMapperid){
        $bidMapper = BidMapper::findOrFail($bidMapperid);
        $order = $bidMapper->order;
        $mybid = @$order->bids()->where('user_id',$this->user->id)->first();
        if($order->designer == 1){
            return View('writer.designer_bid',[
                'order'=>$order,
                'mybid'=>$mybid,
                'bidmapper'=>$bidMapper
            ]);
        }
        return View('writer.bid',[
            'order'=>$order,
            'mybid'=>$mybid,
            'bidmapper'=>$bidMapper
        ]);

    }


    /**
     * place bid on order
     */
    public function addBid(Request $request, $bidMapperid){
        $emailer = new EmailRepository();
            $bidMapper = BidMapper::findOrFail($bidMapperid);
        $order = $bidMapper->order;
        $mybid = @$order->bids()->where('user_id',$this->user->id)->get()[0];
        $amount = number_format($request->amount,2);
        if($mybid){
            $mybid->amount = $amount;
            $mybid->message = $request->message;
            $mybid->save();
            if($order->designer == 1){

                $mail = 'Hello '.$order->user->name.', <br/>
                Writer#'.$this->user->id.' Has updated his/her bid on order#<strong>'.$order->id.'</strong>
                Please check
';
                $emailer->sendEmailNote($order->user,'Bid Notice',$mail);
            }else{

                $mail = 'Hello Admin, <br/>
                '.$this->user->name.' Has updated his/her bid on order#<strong>'.$order->id.'</strong>
                Please check
';
                $emailer->sendAdminNote($mail);
            }

        }else{
            $order->bids()->create([
                'user_id'=>$this->user->id,
                'amount'=>$amount,
                'message'=>$request->message
            ]);
            if($order->designer == 1){
                $mail = 'Hello '.$order->user->name.', <br/>
                Writer#'.$this->user->id.' Has placed a bid on order#<strong>'.$order->id.'</strong>
                <br/>Kindly login to your account and  check
';
                $emailer->sendEmailNote($order->user,'Bid Notice',$mail);
            }else{

                $mail = 'Hello Admin, <br/>
                '.$this->user->name.' Has placed a bid on order#<strong>'.$order->id.'</strong>
                Please check
';
                $emailer->sendAdminNote($mail);
            }



        }
        return redirect("/writer/available")->with('notice',['class'=>'success','message'=>'your bid has been placed. Please wait admin to assign ']);
    }
    /**
     * Chat room for assigned order
     */
    public function orderRoom(Order $order, Assign $assign, Request $request)
    {
       $assign->messages()->where([
           ['user_id','!=',$this->user->id]
       ])->update([
            'seen'=>1
        ]);
        $method = $request->method();
        if($method=='POST'){
            $type = $request->type;
            $paths = $this->fileSaver->saveAssignFiles($request,$assign,$type);
            if($request->type=='Final Copy'){
                $now = Carbon::now();
                $deadline = Carbon::createFromTimestamp(strtotime($assign->deadline));
                if($now>$deadline){
                    $rate = $this->user->writerCategory->fine_percent/100;
                    $fine = number_format($rate*$assign->amount,2);
                    $assign->fines()->create([
                        'amount'=>$fine,
                        'reason'=>'Late Order, Auto 15% fine'
                    ]);
                    $request->session()->flash('notice',['class'=>'success','message'=>"You have been fined $fine"]);
                }
//
                $assign->status = 3;
                $assign->update();
            }

        }
        $files = File::where([
            ['assign_id','=',0],
            ['order_id','=',$order->id]
        ])->orWhere([
            ['assign_id','=',$assign->id]
        ])->orderBy('id','asc')->get();
        return View('writer.room',[
            'order'=>$order,
            'assign'=>$assign,
            'files'=>$files
        ]);
    }
    /**
     * get order counts
     */

    public function getOrderCounts(){
        $return = [];
        if($this->user->role=='writer'){
            $active = $active =  $this->user->assigns()->where([
                ['status',$this->active_status]
            ])
                ->orderBy('deadline','asc')
                ->count();
            $available = $this->getAvailableCount();
            $revision = $this->user->assigns()->where([
                ['status',$this->revision_status]
            ])
                ->orderBy('id','desc')
                ->count();
            $bids = $this->user->bids()->where('status','=',$this->active_bids)->orderBy('id','desc')->count();
            $closed = $this->user->assigns()->whereIn('status',[$this->pending_status,$this->completed_status])->count();
            $return[] =  ['data_count'=>$available,'target'=>'writer_dashboard'];
            $return[] =  ['data_count'=>$active,'target'=>'writer_active'];
            $return[] = ['data_count'=>$bids,'target'=>'writer_bids'];
            $return[] = ['data_count'=>$revision,'target'=>'writer_revision'];
            $return[] = ['data_count'=>$closed,'target'=>'writer_completed'];
        }elseif($this->user->role=='client'){
            $active = $this->user->orders()->where('paid','=',1)->whereIn('status',[$this->client_active_status,$this->client_unassigned_status])->count();
            $unpaid = $this->user->orders()->where('paid','=',0)->count();
            $disputes = $this->user->disputes()->where('status','=',0)->orderBy('id','asc')->count();
            $completed = $this->user->orders()->whereIn('status',[$this->client_closed_status,$this->client_pending_status])->count();
            $return[] = ['data_count'=>$active,'target'=>'client_active'];
            $return[] = ['data_count'=>$unpaid,'target'=>'client_un_payment'];
            $return[] = ['data_count'=>$completed,'target'=>'client_completed'];
            $return[] = ['data_count'=>$disputes,'target'=>'client_disputes'];
        }
        echo json_encode($return);

    }

    function getAvailableCount(){
        $profile = $this->user->profile;
        $styles = json_decode($profile->style_ids);
        $subjects = json_decode($profile->subject_ids);
        $bids = $this->user->bids()->where('status','=',$this->available_status)->select('order_id')->get();
        $bidded = [];
        foreach($bids as $bid){
            $bidded[]=$bid->order_id;
        }
        $web_repo = new WebsiteRepository();
        $website = $web_repo->getWebsite();
        if($this->user->isDesigner()){
            $bidmappers =BidMapper::where([
                ['bid_mappers.status','=',1],
                ['bid_mappers.allowed','like',"%".$this->user->writer_category_id."%"]
            ])
                ->join('orders','orders.id','=','bid_mappers.order_id')
                ->orWhere([
                    ['orders.designer','=',1]
                ])

//            ->whereIn('orders.style_id',$styles)
//            ->whereIn('orders.subject_id',$subjects)
                ->whereNotIn('bid_mappers.order_id',$bidded)
                ->select('bid_mappers.*')
                ->count();
        }else{
            $bidmappers =BidMapper::where([
                ['bid_mappers.status','=',1],
                ['bid_mappers.allowed','like',"%".$this->user->writer_category_id."%"]
            ])
                ->join('orders','orders.id','=','bid_mappers.order_id')
//            ->whereIn('orders.style_id',$styles)
//            ->whereIn('orders.subject_id',$subjects)
                ->whereNotIn('bid_mappers.order_id',$bidded)
                ->select('bid_mappers.*')
                ->count();
        }

        return $bidmappers;
    }

    public function takeOrder($bidMapper_id,Request $request){
        $bidMapper = BidMapper::findOrFail($bidMapper_id);
        $order = $bidMapper->order;
        if($request->method()=='POST'){
            //ASSIGN ORDER
            if($order->status == 1){
                return redirect("/writer/take/$bidMapper_id")->with('notice',['class'=>'error','message'=>'has already been assigned']);
            }
            $assign = $order->assigns()->create([
                'deadline'=>$request->deadline,
                'fine'=>'0.00',
                'bonus'=>'0.00',
                'user_id'=>$this->user->id,
                'amount'=>$request->amount,
                'bonus'=>'0.00',
            ]);
            $bidmapper = $order->bidMapper;
            $bidmapper->status=2;
            $bidmapper->update();
            $order->status = 1;
            $order->update();
            $mail = 'Hello Admin, <br/>
                '.$this->user->name.' Has taken order#<strong>'.$order->id.'</strong>
                Please check
';
            $this->emailer->sendAdminNote($mail);
            $this->emailer->sendAssignEmail($this->user,$assign,$order);
            return redirect("writer/order/$order->id/room/$assign->id")->with('notice',['class'=>'success','message'=>'Order has been assigned to you']);

        }

        return View('writer.take',[
            'order'=>$order,
            'bidmapper'=>$bidMapper
        ]);
    }

    public function deleteBid(Bid $bid){
        $bid->delete();
        return ['reload'=>true];
    }

    public function announcements(){
        $announcements = Announcement::where([
            ['published','=',1],
            ['target','=',str_plural(Auth::user()->role)]
        ])->orderBy('id','desc')->paginate(10);
        return view('writer.announcements',[
            'announcements'=>$announcements
        ]);
    }

    public function withdraw(Request $request){
        $user = $this->user;
        $total_worked = $user->totalWorked();
        $withdrawn = $user->totalWithdrawn();
        $pending = $user->totalPending();
        $fines = $user->totalFines();
        $available = $total_worked-($withdrawn+$pending+$fines);
        $paypal = new AdaptivePayment();
        $paypal->request = $request;
        $pay_acc= $user->paymentAccounts()->where([
            ['website','like',$request->via]
        ])->first();
        if($request->via == 'paypal' && $pay_acc == null){
            return redirect()->back()->with('notice',['class'=>'danger','message'=>'Please add at least one payment account for '.$request->via]);
        }elseif($request->via == 'paypal'){
            $email = $pay_acc->email;
        }else{
            $user->payments()->create([
                'method'=>'manual',
                'amount'=>$available,
                'state'=>'PENDING'
            ]);
            return redirect("writer/payment")->with('notice',['class'=>'info','message'=>'Payment completed with status PENDING']);
        }
        $status = $paypal->payWriter($user,round($available,2),$email,$_SERVER['HTTP_HOST'].' Account balance Widthrawal');
        return redirect("writer/payment")->with('notice',['class'=>'info','message'=>'Payment completed with status '.$status]);
    }


    public function addPayment(Request $request){
        $payment_info = $request->all();
        $this->user->paymentAccounts()->updateOrCreate([
            'website'=>$request->website
        ],$payment_info);
        return redirect("writer/payment")->with('notice',['class'=>'success','message'=>'Account added']);
    }

    public function executeFines(){

    }

}
