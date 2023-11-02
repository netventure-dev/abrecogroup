<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\SerializesModels;
class CareerAdminNotification extends Notification implements ShouldQueue
{
    use Queueable,SerializesModels;
    public $details;  
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
            ->subject('INTELLECT WORKS:Career Enquiry')
            ->line('Hi, ' . $this->details['admin_name'])
            ->line('You have received a career enquiry. Details are given below')
            ->line('Name : ' . $this->details['name'])
            ->line('Email : ' . $this->details['email'])
            ->line('Phone : ' . $this->details['phone'])
            ->line('Position : ' . $this->details['position'])
            ->line('Message : ' . $this->details['message'])
            ->line('Thank you!')
            ->attach(public_path('storage/'.$this->details['resume']));
            // ->attach($this->details['resume'], [
            //     'as' => 'CareerEnquiry.pdf',
            //     'mime' => 'application/pdf',
            // ]);
            
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
