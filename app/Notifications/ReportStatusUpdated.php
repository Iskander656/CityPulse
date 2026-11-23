<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReportStatusUpdated extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public string $reportTitle,
        public string $status,
        public string $message,
        public int|string $reportId
    ) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('CityPulse: Your report status has been updated')
            ->greeting('Hello!')
            ->line('There is an update regarding your report: ' . $this->reportTitle)
            ->line($this->message)
            ->line('New status: ' . ucfirst(str_replace('_', ' ', $this->status)))
            ->action('View Report', url('/reports/' . $this->reportId))
            ->line('Thank you for helping improve your city with CityPulse.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'report_id' => $this->reportId,
            'title' => $this->reportTitle,
            'status' => $this->status,
            'message' => $this->message,
        ];
    }
}