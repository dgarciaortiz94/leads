<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;

class LeadsMailer
{
    public static function basic_email($lead) {
        $response = Mail::send(['text'=>'El lead '. $lead->id .' con título '. $lead->title .' ha sido cerrado.'], $lead, function($message, $lead) {
        //    $message->to('desarrollo@we-accom.com')->subject
           $message->to('diegodenavas@gmail.com')->subject
              ($lead->id . "-" . $lead->title);
           $message->from(env('MAIL_FROM_ADDRESS'),'DIEGOGARCIA@pruebawe-accom.com');
        });

        return $response;
    }
}