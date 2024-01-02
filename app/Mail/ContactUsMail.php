<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUsMail extends Mailable
{
    use Queueable, SerializesModels;
    public $content, $subject ,$app_name, $useremail;  
    /**
     * Create a new message instance.
     *
     * @return void
     */
   

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    // public function envelope()
    // {
    //     return new Envelope(
    //         subject: 'Contact Us Mail',
    //     );
    // }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function __construct($content,$subject,$app_name,$useremail)
    {
        $this->content = $content;
        $this->subject = $subject;
        $this->app_name = $app_name;
        $this->useremail = $useremail;
    }
    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))->subject('('.$this->app_name.')'.$this->subject)
        ->view('contactus')->with([
            'content' => $this->content,
        ]);
    }
}
