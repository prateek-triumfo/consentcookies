<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendBulkEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Test Subject";
    public $content = "Test content here.";

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Any initialization if needed.
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.bulkEmail')
                    ->subject($this->subject);
    }
}
