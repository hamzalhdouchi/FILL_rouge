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
            ->line("Votre restaurant **{$this->restaurant->nom_Restaurant}** a été **{$this->status}**.")
            ->line("Voici quelques détails supplémentaires concernant votre mise à jour :")
            ->line("✔ **Nom du restaurant :** {$this->restaurant->nom_Restaurant}")
            ->line("✔ **Statut actuel :** {$this->status}")
            ->line("✔ **Date de mise à jour :** " . now()->format('d/m/Y'))
            ->line("ℹ️ Nous vous recommandons de consulter votre tableau de bord pour plus d'informations.")
            ->line("✉️ Si vous avez des questions, vous pouvez nous contacter à : support@votreplateforme.com")
            ->line("Merci d'utiliser notre plateforme !")
            ->line("Cordialement, l'équipe de support");
    }
    
}
