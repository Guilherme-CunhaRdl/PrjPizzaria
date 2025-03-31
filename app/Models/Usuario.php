<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Authenticatable
{
    use HasFactory;

    protected $table = 'usuarios';

    protected $fillable = ['nomeUsuario', 'emailUsuario', 'senhaUsuario'];

    protected $hidden = ['senhaUsuario'];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'idUsuario');
    }
}
