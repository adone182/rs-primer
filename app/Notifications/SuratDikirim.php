<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class SuratDikirim extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'title' => 'Pengajuan Surat Dikirim',
            'message' => 'Pengajuan surat Anda berhasil dikirim.',
            'sender' => 'Sistem',
        ]);
    }

    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //                 ->subject('Pengajuan Surat Berhasil Dikirim')
    //                 ->greeting('Halo!')
    //                 ->line('Pengajuan Surat Anda telah berhasil dikirim.')
    //                 ->line('Terima kasih telah menggunakan aplikasi kami!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
