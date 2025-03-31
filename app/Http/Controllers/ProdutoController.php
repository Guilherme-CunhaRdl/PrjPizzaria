<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pizza;

use function Ramsey\Uuid\v1;

class ProdutoController extends Controller
{
    public function index()
    {
        $pizzas = Pizza::all();
        return view('/admin/dbAdminCardapio', compact('pizzas'));
    }


    public function verTodasPizzas()
    {
        $pizzas = Pizza::all();
        return view('/menu', compact('pizzas'));
    }

    public function verPizzaEspecifica ($id) {
        $pizza = Pizza::findOrFail($id);
        return view('/pedido', compact('pizza'));
    }

public function deletarPizza ($id) {
    $pizza = Pizza::destroy($id);
    return $this->index();
}

    public function inserirPizza(Request $request)
    {


        // Validação dos dados do formulário
        $validatedData = $request->validate([
            'nomePizza' => 'required|max:255',
            'valorPequenaPizza' => 'required|numeric',
            'valorMediaPizza' => 'required|numeric',
            'valorGrandePizza' => 'required|numeric',
            'ingredientesPizza' => 'required',
            'categoriaPizza' => 'required',
            'imgPizza' => 'required'
            //na imagem, posso colocar|image|mimes:jpeg,png,jpg,gif para validar o conteudo, soq por algum motivo bugou em uma imagem jpeg, ent me estressei e tirei
        ]);
    
        // Criação de uma nova pizza
        $pizza = new Pizza();
        $pizza->nomePizza = $validatedData['nomePizza'];
        $pizza->valorPequenaPizza = $validatedData['valorPequenaPizza'];       
        $pizza->valorMediaPizza = $validatedData['valorMediaPizza'];
        $pizza->valorGrandePizza = $validatedData['valorGrandePizza'];
        $pizza->ingredientesPizza = $validatedData['ingredientesPizza'];
        $pizza->categoriaPizza = $validatedData['categoriaPizza'];
    
        // Verifica se foi enviado um arquivo de imagem
        if ($request->hasFile('imgPizza')) {
            // Armazena a imagem na pasta 'images' e salva o caminho no banco
            $imagePath = $request->file('imgPizza')->store('images', 'public');
            $pizza->imgPizza = $imagePath;
        }
    
        // Salva a pizza no banco de dados
        $pizza->save();
    
        // Redireciona de volta para o cardápio com uma mensagem de sucesso
        return redirect()->back()->with('success', 'Pizza adicionada com sucesso!');
    }
    
}
