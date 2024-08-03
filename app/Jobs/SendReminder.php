<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $method;
    protected $event;

    /**
     * Create a new job instance.
     */
    public function __construct($method, $event)
    {
        $this->method = $method;
        $this->event = $event;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        switch ($this->method) {
            case 'sms':
                $this->sendSms();
                break;
            case 'email':
                $this->sendEmail();
                break;
            case 'whatsapp':
                $this->sendWhatsapp();
                break;
            default:
                break;
        }
    }

    private function sendSms()
    {
        //Send SMS
        logger('SMS sent');
    }

    private function sendEmail()
    {
        //Send Email
        logger('Email sent');
    }

    private function sendWhatsapp()
    {
        //Send Whatsapp
        logger('Whatsapp sent');
        
    }


}
