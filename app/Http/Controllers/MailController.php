<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //发送邮件
    public function send(){
        Mail::raw('恭喜注册成功',function($message){
            $message->subject('提醒激活邮件');
            $message->to('2224779700@qq.com');
        });
}
}
