<?php
/**
 * Created by PhpStorm.
 * User: iankibet
 * Date: 2016/04/22
 * Time: 2:49 PM
 */

namespace App\Repositories;


use App\Email;
use App\Order;
use App\Website;
use Carbon\Carbon;
use App\Assign;
use App\Fine;
//use ClassPreloader\Config;
use URL;
use App\User;
use Mail;
use Storage;
use Config;
class EmailRepository
{
    protected $user;
    protected $order;
    protected $website;
    protected $assign;
    protected $fine;
    public $message;
    public $action;
    public function __construct($user=null)
    {


        $webRepo = new WebsiteRepository();
       $this->website = $webRepo->getWebsite();
        $website = $this->website;
        
        Config::set('mail.host', $website->host);
        Config::set('mail.username', $website->email);
        Config::set('mail.password', $website->password);
        Config::set('mail.post', $website->port);
        Config::set('mail.encryption', $website->encryption);
    }

    public function getEmails(){
        return new Email();
    }

    public function getUser(){
        $user = User::find($this->user->id);
        return $user;
    }
    public function sendResetEmail($user,$token){
        $this->user = $user;
        $user = $this->getUser();
        $url = URL::to("forgot/reset?token=$token");
        $message = 'Hello '.$user->name.'<br/>
            Please click on the link below to reset your password. <br/>
            <a href="'.$url.'">'.$url.'</a>
';
        $subject = "Password Reset Request";
        $website = $user->website;
        Mail::send('layouts.'.$website->layout,['email_message'=>$message],function ($m) use ($user,$website,$subject) {
            $m->from($website->email, $website->name);
            $m->to($user->email, $user->name)->subject($subject);
        });
    }
    public function sendEmailNote($user,$subject,$message,$files=null){
        $this->user = $user;
        $user = $this->getUser();
        $message = $this->doReplacements($message);
        $website = $user->website;
        Mail::send('layouts.'.$website->layout,['email_message'=>$message],function ($m) use ($user,$website,$subject,$files) {
            $m->from($website->email, $website->name);
            $m->to($user->email, $user->name)->subject($subject);
//            if($files){
//                foreach($files as $file){
//                    $path = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix().$file->path;
//                    $m->attach($path,['as'=>$file->filename]);
//                }
//            }
        });
    }

    public function sendAdminNote($message,$subject='Admin Notice',$copy=null){
        $email = env('ADMIN_EMAIL');
        if($copy){
            $email.=','.$copy;
        }
        $website = $this->website;
        Mail::send('layouts.'.$website->layout,['email_message'=>$message],function ($m) use ($email,$website,$subject) {
            $m->from($website->email, $website->name);
            foreach(explode(',',$email) as $email){
                $m->to($email)->subject($subject);
            }

        });
    }
    public function sendMail($email,$subject,$message){
        $website = $this->website;
        Mail::send('layouts.'.$website->layout,['email_message'=>$message],function ($m) use ($email,$website,$subject) {
            $m->from($website->email, $website->name);
            $m->to($email)->subject($subject);
        });
    }
    public function sendGeneralEmail($action,$subject,$user,Order $order=null,Assign $assign=null){
        $this->user = $user;
        $user = $this->getUser();
        $this->action = $action;
        if(isset($user)){
            $this->user = $user;
        }
        if(isset($order)){
            $this->order = $order;
        }
        if(isset($assign)){
            $this->assign = $assign;
        }
        $website = $user->website;
        if($website){
            $template = $this->getEmails()->where('action','like',$action)->get()[0]->template;
            $message = $this->doReplacements($template);
            Mail::send('layouts.'.$website->layout,['email_message'=>$message],function ($m) use ($user,$website,$subject) {
                $m->from($website->email, $website->name);
                $m->to($user->email, $user->name)->subject($subject);
            });
        }
    }
    /**
     * @param User $user
     * @param string $action
     * @param string $subject
     * send newly user created a welcome message :)
     */
    public function sendRegistrationEmail($user,$subject="Welcome", $action="register_email"){
        $this->user = $user;
        $user = $this->getUser();
        $website = $user->website;
        if($website){
            $template = $this->getEmails()->where('action','like',$action)->get()[0]->template;
            $message = $this->doReplacements($template);
            Mail::send('layouts.'.$website->layout,['email_message'=>$message],function ($m) use ($user,$website,$subject) {
                $m->from($website->email, $website->name);
                $m->to($user->email, $user->name)->subject($subject);
            });
        }
    }

    public function notifyAdmin($action,Order $order=null,Assign $assign=null,$message=null){
        $email = env('ADMIN_EMAIL');
        $subject = "Admin Notice";
        $website = $this->website;
        $this->order = $order;
        $this->assign = $assign;
        if($website){
            $template = $this->getEmails()->where('action','like',$action)->get()[0]->template;
            $template = str_replace("{".$action."}",$message,$template);
            $message = $this->doReplacements($template);
            Mail::send('layouts.'.$website->layout,['email_message'=>$message],function ($m) use ($email,$website,$subject) {
                $m->from($website->email, $website->name);
                $m->to($email)->subject($subject);
            });
        }
    }

    /**
     * @param User $user
     * @param Order $order
     * @param $order_message
     * @param string $action
     * @param String $subject
     * send order message to client
     */
    public function sendOrderMessage($user,Order $order,$order_message,$subject="New Message",$action="order_message"){
        $this->order = $order;
        $this->user = $user;
        $user = $this->getUser();
        $website = $user->website;
        if($website){
            $template = $this->getEmails()->where('action','like',$action)->get()[0]->template;
            $message = $this->doReplacements($template);
            $message = str_replace("{".$action."}",$order_message,$message);
            Mail::send('layouts.'.$website->layout,['email_message'=>$message],function ($m) use ($user,$website,$subject) {
                $m->from($website->email, $website->name);
                $m->to($user->email, $user->name)->subject($subject);
            });
        }
    }

    /**
     * @param $user
     * @param $order
     * @param string $subject
     * @param string $action
     * Send new order placement email to client
     */
    public function sendOrderplacedEmail($user,$order,$subject="Order Successfully Placed",$action="new_order_mail"){
        $this->order = $order;
        $this->user = $user;
        $user = $this->getUser();
        $website = $user->website;
        $template = $this->getEmails()->where('action','like',$action)->get()[0]->template;
        $message = $this->doReplacements($template);
        Mail::send('layouts.'.$website->layout,['email_message'=>$message],function ($m) use ($user,$website,$subject) {
            $m->from($website->email, $website->name);
            $m->to($user->email, $user->name)->subject($subject);
        });
    }

    public function sendCompletedOrderNotice($user, Assign $assign, $subject="Order Completed",$action="order_completion"){
        $order = $assign->order;
        $this->assign = $assign;
        $this->order = $order;
        $this->user = $user;
        $user = $this->getUser();
        $website = $user->website;
        $template = $user->website->emails()->where('action','like',$action)->get()[0]->template;
        $message = $this->doReplacements($template);
        Mail::send('layouts.'.$website->layout,['email_message'=>$message],function ($m) use ($user,$website,$subject,$assign) {
            foreach($assign->files as $file){
                $m->attach($file->path);
            }
            $m->from($website->email, $website->name);
            $m->to($user->email, $user->name)->subject($subject);
        });
    }
    /**
     * @param User $user
     * @param Assign $assign
     * @param Order $order
     * @param string $subject
     * @param string $action
     * Send message to order assigned to writer
     */
    public function sendAssignEmail($user, Assign $assign, Order $order, $subject="New Order Assigned",$action="writer_assigned"){
        $this->order = $order;
        $this->user = $user;
        $user = $this->getUser();
        $this->assign = $assign;
        $website = $user->website;
        $template = $this->getEmails()->where('action','like',$action)->get()[0]->template;
        $message = $this->doReplacements($template);
       Mail::send('layouts.'.$website->layout,['email_message'=>$message],function ($m) use ($user,$website,$subject) {
            $m->from($website->email, $website->name);
            $m->to($user->email, $user->name)->subject($subject);
        });
    }

    public function sendRoomEmail($user, Assign $assign=null, Order $order=null,$room_message,$subject="New Message",$action="writer_room_message"){
        $this->order = $order;
        $this->user = $user;
        $user = $this->getUser();
        $this->assign = $assign;
        $website = $user->website;
        $template = $this->getEmails()->where('action','like',$action)->get()[0]->template;
        $message = $this->doReplacements($template);
        $message = str_replace("{".$action."}",$room_message,$message);
        Mail::send('layouts.'.$website->layout,['email_message'=>$message],function ($m) use ($user,$website,$subject) {
            $m->from($website->email, $website->name);
            $m->to($user->email, $user->name)->subject($subject);
        });
    }

    /**
     * @param User $user
     * @param Assign $assign
     * @param $comments
     * @param string $subject
     * @param string $action
     * Send order cancelled email to writer
     */
    public function sendOrderCancelledEmail($user, Assign $assign,Fine $fine, $comments, $subject="Order Reassigned",$action="order_cancelled"){
        $this->order = $assign->order;
        $this->user = $user;
        $user = $this->getUser();
        $this->assign = $assign;
        $website = $user->website;
        $this->fine = $fine;
        $template = $this->getEmails()->where('action','like',$action)->get()[0]->template;
        $message = $this->doReplacements($template);
        $message = str_replace("{".$action."}",$comments,$message);
        Mail::send('layouts.'.$website->layout,['email_message'=>$message],function ($m) use ($user,$website,$subject) {
            $m->from($website->email, $website->name);
            $m->to($user->email, $user->name)->subject($subject);
        });
    }

    public function sendOrderFinedEmail(Assign $assign,Fine $fine, $subject="Order Fined",$action="writer_fined"){
       $order = $assign->order;
        $user = $assign->user;
        $this->order = $order;
        $this->user = $user;
        $user = $this->getUser();
        $this->fine = $fine;
        $website = $user->website;
        $template = $this->getEmails()->where('action','like',$action)->get()[0]->template;
        $message = $this->doReplacements($template);
        Mail::send('layouts.'.$website->layout,['email_message'=>$message],function ($m) use ($user,$website,$subject) {
            $m->from($website->email, $website->name);
            $m->to($user->email, $user->name)->subject($subject);
        });
    }

    /**
     * @param $message
     * @return mixed
     * replace variables in message template
     */
    public function doReplacements($message){
        if(isset($this->user)){
            $message = $this->replaceUserVars($message);
        }
        if(isset($this->order)){
            $message = $this->replaceOrderVars($message);
        }
        if(isset($this->assign)){
            $message =
                $this->replaceAssignVars($message);
        }
        if(isset($this->fine)){
            $message = $this->replaceFineVars($message);
        }
        if(isset($this->message)){
            $message = str_replace("{".$this->action."}",$this->message,$message);
        }
        return $message;
    }

    /**
     * @param $message
     * @return mixed
     * Replace user variables in template
     */
    public function replaceUserVars($message){
        $user = $this->user;
        $vars = [
            'name'=>$user->name,
            'email'=>$user->email,
            'phone'=>$user->phone,
            'country'=>$user->country,
        ];
        foreach($vars as $key=>$value){
            $message = str_replace("{".$key."}",$value,$message);
        }
        return $message;
    }
    /**
     * @param $message
     * @return mixed
     * replace order variables in message template
     */
    public function replaceOrderVars($message){
        $order = $this->order;
        $vars = [
        'topic' => $order->topic,
        'order_id' => $order->id,
        'academic' => @$order->academic->label,
        'amount' => $order->amount,
        'deadline' => Carbon::createFromTimestamp(strtotime($order->deadline))->diffForHumans(),
        'login_link'=>'<a href="http://'.$this->order->user->website->name.'/orders">http://'.$this->order->user->website->name.'/orders</a>'
        ];

        foreach($vars as $key=>$value){
            $message = str_replace("{".$key."}",$value,$message);
        }
        return $message;
    }

    public function replaceFineVars($message){
        $fine = $this->fine;
        $vars = [
            'fine_amount'=>number_format($fine->amount,2),
            'fine_reason'=>$fine->reason
        ];
        foreach($vars as $key=>$value){
            $message = str_replace("{".$key."}",$value,$message);
        }
        return $message;
    }
    /**
     * @param $message
     * @return mixed
     * Replace variables in assignment details
     */
    public function replaceAssignVars($message){
        $assign = $this->assign;
        $vars = [
            'assign_amount'=>'$'.@number_format(round($assign->amount,2),2),
            'assign_deadline'=>Carbon::createFromTimestamp(strtotime($assign->deadline))->diffForHumans(),
            'assign_bonus'=>'$'.@number_format(round($assign->bonus,2),2)
        ];
        foreach($vars as $key=>$value){
            $message = str_replace("{".$key."}",$value,$message);
        }
        return $message;
    }
}
