<?php 

use Illuminate\Database\Seeder;
use App\Models\Usuario;

class UsuarioSeeder extends Seeder
{
    public function run()
    {
        Usuario::create([
            'nomeUsuario' => 'Admin',
            'emailUsuario' => 'admin@email.com',
            'senhaUsuario' => bcrypt('123456')
        ]);
    }
}
