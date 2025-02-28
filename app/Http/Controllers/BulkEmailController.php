<?php

namespace App\Http\Controllers;

use App\Mail\SendBulkEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;

class BulkEmailController extends Controller
{
    public function sendBulkEmail()
    {
        $emails = [
            'd.mkt@triumfo.de',
            'webdesigner@triumfo.de',
            'raju@triumfo.de',
            'nitin@triumfo.de',
            'seo@triumfo.de',
            'rahul@triumfo.de',
            'aditya@triumfo.de',
            'content1@triumfo.de',
            'data1@triumfo.de',
            'data2@triumfo.de',
            'kamal@triumfo.de',
            'data5@triumfo.de'
        ];

        foreach ($emails as $email) {
            // Dispatch the job to the queue to send email.
            Mail::to($email)->queue(new SendBulkEmail());
        }

        return response()->json(['message' => 'Emails have been queued.']);
    }
}
