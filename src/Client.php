<?php

namespace Freyo\Xinge;

use Freyo\Xinge\Client\XingeApp;
use Freyo\Xinge\Exceptions\CouldNotSendNotification;
use Illuminate\Support\Facades\Log;

class Client
{
    const SUCCESSFUL_SEND = 0;

    /**
     * @var XingeApp
     */
    private $app;

    /**
     * @param XingeApp $app
     */
    public function __construct(XingeApp $app)
    {
        $this->app = $app;
    }

    /**
     * @param       $method
     * @param array ...$parameters
     */
    public function send($method, ...$parameters)
    {
        try {
            Log::debug(func_get_args());
            $response = $this->app->{$method}(...$parameters);
            Log::debug($response);
            $this->handleProviderResponses($response);
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    /**
     * @param array $response
     *
     * @throws CouldNotSendNotification
     */
    protected function handleProviderResponses($response)
    {
        $errorCode = (int) array_get($response, 'ret_code');

        if ($errorCode !== self::SUCCESSFUL_SEND) {
            throw CouldNotSendNotification::serviceRespondedWithAnError(
                (string) array_get($response, 'err_msg'),
                $errorCode
            );
        }
    }
}
