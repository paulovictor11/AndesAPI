<?php

namespace App\Models;

use App\Events\FotoCreating;
use Illuminate\Database\Eloquent\Model;

class Fotos extends Model
{
    protected $table = 'fotos';
    protected $fillable = ['produto_id', 'foto'];
    protected $dispatchesEvents = ['created' => FotoCreating::class];

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produto_id');
    }
}
