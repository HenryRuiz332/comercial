<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class Caducidad extends Mailable
{
    use Queueable, SerializesModels;

    public $service;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($service)
    {
        $this->$service = $service;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       


        // $data = ['service' => $this->service];
        // echo(json_encode($this->service));
        // Mail::send('emails.caducidad', $data, function ($message) use ($data)
        // {
           
        //     $message->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME')); //From correo de la app
        //     $message->to("henryruiz332@gmail.com")->subject('Aviso ' .  env('APP_NAME'));
           
        // }); 
          
    }
}
