<?php

namespace App\Jobs;

use App\Helper\Whatsapp;
use App\Helper\WhatsappComponent;
use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class SendReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $method;
    protected $event;
    protected $sendToOwner;

    /**
     * Create a new job instance.
     */
    public function __construct($method, $event, $sendToOwner = false)
    {
        $this->method = $method;
        $this->event = Event::find($event->id);
        $this->sendToOwner = $sendToOwner;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        logger("Sending reminder for event {$this->event->id} by {$this->method}");

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

        $event = $this->event;
        $eventType = $event->type;
        $eventDate = $event->date;
        $eventTime = $event->time;
        $eventAddress = $event->address;
        if ($event->employees->count() >= 1) {
            $eventCoordinator = $event->employees->first()->name;
        } else {
            $eventCoordinator = "No asignado";
        }
        $eventComments = $event->notes;
        if ($this->sendToOwner) {
            logger('Sending to owner');
            $user = Auth::user();
            logger($user);
            if ($user->phone == null) {
                logger('User has no phone');
                $phoneOwner = "3121034666";
                $phone = "52$phoneOwner";
                return;
            } else {
                $phoneOwner = Auth::user()->phone;
                $phone = "52$phoneOwner";
            }


            Whatsapp::templateMessage($phone)
                ->setName("pirotecnia_san_rafael_reminder")
                ->setLanguage("es")
                ->addComponent(WhatsappComponent::bodyComponent()
                    ->addParameter("text", $eventType, null)
                    ->addParameter("text", $eventDate, null)
                    ->addParameter("text", $eventTime, null)
                    ->addParameter("text", $eventAddress, null)
                    ->addParameter("text", $eventCoordinator, null)
                    ->addParameter("text", $eventComments, null))
                ->addComponent(WhatsappComponent::buttonComponent()
                    ->setSubType("url")
                    ->setIndex("0")
                    ->addParameter("text", "$event->id", null))
                ->send();
        } else {
            foreach ($event->employees as $employee) {
                $phoneEmployee = $employee->phone;
                $phone = "52$phoneEmployee";

                Whatsapp::templateMessage($phone)
                    ->setName("event_reminder")
                    ->setLanguage("es")
                    ->addComponent(WhatsappComponent::bodyComponent()
                        ->addParameter("text", $eventType, null)
                        ->addParameter("text", $eventDate, null)
                        ->addParameter("text", $eventTime, null)
                        ->addParameter("text", $eventAddress, null)
                        ->addParameter("text", $eventCoordinator, null)
                        ->addParameter("text", $eventComments, null))
                    ->addComponent(WhatsappComponent::buttonComponent()
                        ->setSubType("url")
                        ->setIndex("0")
                        ->addParameter("text", "$event->id", null))
                    ->send();
            }
        }
    }
}
