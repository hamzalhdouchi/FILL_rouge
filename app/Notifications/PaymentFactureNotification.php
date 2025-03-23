<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Storage;

class PaymentFactureNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $facturePath;
    protected $commandeId;

    public function __construct($facturePath, $commandeId)
    {
        $this->facturePath = $facturePath;
        $this->commandeId = $commandeId;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Votre Facture de Commande #' . $this->commandeId)
            ->greeting('Bonjour ' . $notifiable->name . ',')
            ->line('Veuillez trouver ci-joint la facture de votre commande.')
            ->line('Merci pour votre confiance.')
            ->attach(Storage::path($this->facturePath), [
                'as' => 'facture_' . $this->commandeId . '.pdf',
                'mime' => 'application/pdf',
            ])
            ->salutation('Cordialement, L\'équipe');
    }
}
