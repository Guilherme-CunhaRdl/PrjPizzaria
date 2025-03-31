<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'admins'; // Nome da tabela no banco de dados

    protected $fillable = ['nomeAdmin', 'emailAdmin', 'senhaAdmin']; // Campos que podem ser preenchidos

    protected $hidden = ['senhaAdmin']; // Oculta a senha ao transformar em JSON

    public function getAuthPassword()
    {
        return $this->senhaAdmin; // Define a senha correta para autenticação
    }
}
