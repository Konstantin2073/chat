<?php

namespace App\Broadcasting;

use Illuminate\Broadcasting\Broadcasters\Broadcaster;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Arr;

class ReverbBroadcaster extends Broadcaster
{
    protected $key;
    protected $host;
    protected $port;

    public function __construct()
    {
        $this->key = config('broadcasting.connections.reverb.key');
        $this->host = config('broadcasting.connections.reverb.host');
        $this->port = config('broadcasting.connections.reverb.port');
    }

    public function auth($request)
    {
        return ['auth' => $this->key];
    }

    public function validAuthenticationResponse($request, $result)
    {
        return $result;
    }

    public function broadcast(array $channels, $event, array $payload = [])
    {
        $data = json_encode([
            'channels' => $channels,
            'event' => $event,
            'payload' => $payload,
        ]);

        $fp = fsockopen($this->host, $this->port);
        fwrite($fp, $data);
        fclose($fp);
    }
}

