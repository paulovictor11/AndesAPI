<?php

namespace App\Models;

use App\Events\ThumbnailCreating;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produtos';
    protected $fillable = ['categoria_id', 'thumbnail', 'nome', 'descricao', 'quantidade', 'cor', 'genero_id', 'marca', 'preco'];
    protected $dispatchesEvents = ['created' => ThumbnailCreating::class];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function genero()
    {
        return $this->belongsTo(Genero::class);
    }

    public function foto()
    {
        return $this->hasMany(Foto::class);
    }

    public function compra()
    {
        return $this->hasMany(Compra::class);   
    }
}
