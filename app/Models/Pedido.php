<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';

    protected $fillable = ['idUsuario', 'descPedido', 'statusPedido'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'idUsuario');
    }

    public function itens()
    {
        return $this->hasMany(ItemPedido::class, 'idPedido');
    }

    public function entrega()
    {
        return $this->hasOne(Entrega::class, 'idPedido');
    }
}
