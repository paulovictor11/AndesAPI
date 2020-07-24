<?php

namespace App\Events;

use App\Models\Fotos;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FotoCreating
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $model;

    public function __construct(Fotos $model)
    {
        $this->model = $model;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}