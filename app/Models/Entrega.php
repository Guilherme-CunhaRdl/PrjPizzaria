<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrega extends Model
{
    use HasFactory;

    protected $table = 'entregas';

    protected $fillable = ['idPedido', 'statusEntrega'];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'idPedido');
    }
}
