<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cardápio | PizzaNight Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{url('css/admCardapio.css')}}">
</head>
<body>
<div class="modal-conteudo">
        <span class="fechar-modal">&times;</span>
        <h2><i class="fas fa-pizza-slice"></i> <span id="modalTitulo">Adicionar Nova Pizza</span></h2>
        
        <form method="POST" action="{{ url('/admin/dbBosta') }}" enctype="multipart/form-data">
        @csrf
            <input type="hidden" id="pizzaId">
            
            <div class="form-group">
                <label for="nome">Nome da Pizza</label>
                <input type="text" id="nomePizza" name="nomePizza" placeholder="Ex: Margherita" required>
            </div>
            
            <div class="form-group">
                <label for="categoria">Categoria</label>
                <select name="categoriaPizza" id="pizzaCategoria">
                    <option value="salgada">Salgada</option>
                    <option value="doce">Doce</option>
                    <option value="especial">Especial</option>
                </select>
            </div>
            
            <!-- Nova seção para tamanhos e preços -->
            <div class="form-tamanhos">
                <h4>Tamanhos e Preços</h4>
                
                <div class="tamanho-item">
                    <label>Pequena (P)</label>
                    <div class="preco-input">
                        <span>R$</span>
                        <input type="number" id="precoPequena" name="valorPizza" step="0.01" placeholder="39.90" min="0">
                    </div>
                </div>
                
                <div class="tamanho-item">
                    <label>Média (M)</label>
                    <div class="preco-input">
                        <span>R$</span>
                        <input type="number" id="precoMedia" step="0.01" placeholder="49.90" min="0">
                    </div>
                </div>
                
                <div class="tamanho-item">
                    <label>Grande (G)</label>
                    <div class="preco-input">
                        <span>R$</span>
                        <input type="number" id="precoGrande" step="0.01" placeholder="59.90" min="0">
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="ingredientes">Ingredientes</label>
                <textarea id="pizzaIngredientes" name="ingredientesPizza" placeholder="Liste os ingredientes separados por vírgula"></textarea>
            </div>
            
            <div class="form-group">
        <label for="imagem">Imagem da Pizza</label>
        <input type="file" id="pizzaImagem" name="imgPizza" accept="image/*" required>
        <div id="imagemPreview" class="imagem-preview"></div>
    </div>
            
            <div class="form-options">
                <label class="checkbox-option">
                    <input type="checkbox" id="pizzaDestaque">
                    <span class="checkmark"></span>
                    Destacar no cardápio
                </label>
                
                <label class="checkbox-option">
                    <input type="checkbox" id="pizzaPromocao">
                    <span class="checkmark"></span>
                    Marcar como promoção
                </label>
                
                <label class="checkbox-option">
                    <input type="checkbox" id="pizzaDisponivel" checked>
                    <span class="checkmark"></span>
                    Disponível
                </label>
            </div>
            
            <div class="form-botoes">
                <button type="button" class="btn-secundario btn-cancelar">Cancelar</button>
                <button type="submit" class="btn-primario" id="btnSalvarPizza">Salvar Pizza</button>
            </div>
   
        </form>
      
    </div>
</body>