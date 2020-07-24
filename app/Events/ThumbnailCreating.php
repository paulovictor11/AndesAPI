<?php

namespace App\Events;

use App\Models\Produto;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ThumbnailCreating
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $model;

    public function __construct(Produto $model)
    {
        $this->model = $model;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}