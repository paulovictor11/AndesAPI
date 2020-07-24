<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    protected $fillable = ['usuario_id', 'cpf', 'telefone', 'cep', 'rua', 'bairro', 'numero', 'cidade', 'estado'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function compra()
    {
        return $this->hasMany(Compra::class);
    }
}
