<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RestaurantStatusNotification extends Notification
{
    use Queueable;

    protected $restaurant;
    protected $status;

    public function __construct($restaurant, $status)
    {
        $this->restaurant = $restaurant;
        $this->status = $status;
    }

    public function via($notifiable)
    {
        return ['mail']; 
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject("Mise à jour du statut de votre restaurant")
            ->greeting("Bonjour " . $notifiable->name . ",")
            ->line("Votre restaurant **{$this->restaurant->name}** a été **{$this->status}**.")
            ->action('Voir votre restaurant', url('/restaurants/' . $this->restaurant->id))
            ->line('Merci d’utiliser notre plateforme !');
    }
}
