<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $details  =  $this->details ;
        // return (new MailMessage)
        // ->view('emails.contact_us', [
        //     'details' => $details,
        // ])
        // ->subject('INTELLECT WORKS :: New Contact Request.');
        return (new MailMessage)
            ->subject('INTELLECT WORKSt Works:Contact Request')
            ->line('Hi, ' . $this->details['admin_name'])
            ->line('You have received a Contact request. Details are given below')
            ->line('Name : ' . $this->details['name'])
            ->line('Email : ' . $this->details['email'])
            ->line('Phone : ' . $this->details['phone'])
            ->line('Organization : ' . $this->details['organization'])
            ->line('Job : ' . $this->details['job'])
            ->line('Message : ' . $this->details['message'])
            ->line('Thank you!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
