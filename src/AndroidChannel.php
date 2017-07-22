<?php

namespace Freyo\Xinge;

use Freyo\Xinge\Exceptions\CouldNotSendNotification;
use Illuminate\Notifications\Notification;

class AndroidChannel
{
    /** @var Client */
    protected $client;

    /**
     * @param Client $Client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Send the given notification.
     *
     * @param mixed        $notifiable
     * @param Notification $notification
     *
     * @throws CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification)
    {
        $parameters = $notification->toXinge($notifiable, $notification);

        call_user_func_array([$this->client, 'send'], $parameters);
    }
}
