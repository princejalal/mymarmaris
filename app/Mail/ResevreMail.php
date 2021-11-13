<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResevreMail extends Mailable {
    use Queueable, SerializesModels;

    protected $reserve;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reserve) {
        $this->reserve = $reserve;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        $reserve = $this->reserve;

        return $this->subject('info')->from('info@mymarmaristours.com','My Marmaris')->view('email', compact('reserve'));
    }
}
