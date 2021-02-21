<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendZoomInvite extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $conference;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$conference)
    {
        $this->data = $data;
        $this->conference = $conference;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@weplay.kz')
            ->subject('Приглашение на сдачу Zoom Конференцию:' . $this->conference->title)
            ->markdown("mail.invite");
    }
}
