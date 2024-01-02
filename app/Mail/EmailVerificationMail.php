<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerificationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $subject, $app_name, $useremail, $otp;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject,$app_name,$useremail,$otp)
    {
        
        $this->subject = $subject;
        $this->app_name = $app_name;
        $this->useremail = $useremail;
        $this->otp = $otp;
         
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    // public function envelope()
    // {
    //     return new Envelope(
    //         subject: 'Email Verification Mail',
    //     );
    // }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    // public function content()
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    // public function attachments()
    // {
    //     return [];
    // }
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))->subject('('.$this->app_name.')'.$this->subject)
        ->view('emailverification')->with([
            'otp' => $this->otp,
            'app_name' => $this->app_name
        ]);
    }
}
