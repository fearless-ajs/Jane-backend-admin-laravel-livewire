<?php


namespace App\Traits;


use App\Mail\OrderPipelineChangeNoticeMail;
use App\Mail\RecurringChargeStatusEmailForContactMail;
use App\Mail\SampleMail;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

trait EmailProvider
{
    public function sendPipelineEmail($user, $item, $title, $message){
        $data = [
            'item'          => $item,
            'user'          => $user,
            'email_title'   => $title,
            'message'       => $message
        ];
        Mail::to($data['user']->email)->send(new OrderPipelineChangeNoticeMail($data));
    }

    public function sendRecurringBillingStatusToContactEmail($user, $item, $title, $message){
        $data = [
            'item'          => $item,
            'user'          => $user,
            'email_title'   => $title,
            'message'       => $message
        ];
        Mail::to($data['user']->email)->send(new RecurringChargeStatusEmailForContactMail($data));
    }

    public function sendSampleMail(){
        $user = User::first();
        $data = [
            'user'          => $user,
            'email_title'   => 'sample title',
            'message'       => 'Sample mail'
        ];

        Mail::to($user->email)->send(new SampleMail($data));

    }
}
