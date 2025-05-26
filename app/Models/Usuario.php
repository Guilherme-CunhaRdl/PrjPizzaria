<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use HasFactory;

    protected $table = 'usuarios';

    protected $fillable = [
        'nomeUsuario',
        'emailUsuario',
        'senhaUsuario',
        'dataNasc',
        'cpfUsuario',
        'rgUsuario',
        'imgUsuario',
        'logradouroUsuario',
        'numeroUsuario',
        'complementoUsuario',
        'bairroUsuario',
        'cidadeUsuario',
        'estadoUsuario',
        'cepUsuario'
    ];

    protected $hidden = ['senhaUsuario'];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'idUsuario');
    }
}
