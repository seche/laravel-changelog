<?php

namespace Seche\LaravelChangelog\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Seche\LaravelChangelog\Models\Changelog;

class NewFeatureNotification extends Notification {

    public $changelog;

    public function __construct(Changelog $changelog){
        $this->changelog = $changelog;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    function via($notifiable)
    {
        return config('changelog.notifications.channels');
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting(__('changelog::mail.greeting', ['name' => 'bob', 'version' => $this->changelog->major, 'app' => getenv('APP_NAME')]))
            ->subject(__('changelog::mail.subject', ['version' => $this->changelog->major, 'app' => getenv('APP_NAME')]))
            ->line(__('changelog::mail.line-1'))
            ->action(__('changelog::mail.action'), url("/" . __('changelog::routes.changelog') . "/{$this->changelog->id}"))
            ->line('Thank you for using our application!')
            ->salutation(__('changelog::mail.salutation', ['app' => getenv('APP_NAME')]));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'en' => __('changelog::notification.newFeature', [], 'en'),
            'icon' => 'fas fa-sparkles',
        ];
    }
}
