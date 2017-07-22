<?php

namespace App\Notifications;

use Freyo\Xinge\AndroidChannel;
use Freyo\Xinge\Client\ClickAction;
use Freyo\Xinge\Client\Message;
use Freyo\Xinge\Client\Style;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class Android extends Notification implements ShouldQueue
{
    use Queueable;

    protected $content, $title, $custom;

    /**
     * Create a new notification instance.
     */
    public function __construct($content, $title = '', $custom = null)
    {
        $this->title   = $title;
        $this->content = $content;
        $this->custom = $custom;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return [AndroidChannel::class];
    }

    public function toXGPush($notifiable, Notification $notification)
    {
        $account = $notifiable instanceof Model
            ? $notifiable->routeNotificationFor('XGPush') : $notifiable;

        $message = new Message();
        $message->setTitle($this->title);
        $message->setContent($this->content);
        $message->setType(Message::TYPE_MESSAGE);
        $message->setStyle(new Style(0, 1, 1, 1, 0));

        $action = new ClickAction();
        $action->setActionType(ClickAction::TYPE_ACTIVITY);
        $message->setAction($action);
        
        $message->setCustom($this->custom);

        return ['PushSingleAccount', 0, (string)$account, $message];
    }
}
