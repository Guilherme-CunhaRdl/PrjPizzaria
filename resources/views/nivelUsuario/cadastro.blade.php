<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{url('css/style.css')}}">
    <link rel="stylesheet" href="{{url('css/cadastro.css')}}">
    <title>Cadastro - PizzaNight</title>
</head>
<body>
    
  
    <!-- Tela de Cadastro -->
    <section class="cadastro">
        <div class="container">
            <div class="formulario-cadastro">
                <h2>Crie sua conta</h2>
                <p>Junte-se à PizzaNight e aproveite descontos exclusivos!</p>
                <form action="{{ url('/nivelUsuario/cadastro') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="text" id="nome" name="nome" placeholder="Nome completo" required>
                    </div>
                    <div class="input-group">
                        <input type="email" id="email" name="email" placeholder="E-mail" required>
                    </div>
                    <div class="input-group">
                        <input type="password" id="senha" name="senha" placeholder="Senha" required>
                    </div>
                    <div class="input-group">
                    <input type="password" id="confirmar-senha" name="senha_confirmation" placeholder="Confirmar senha" required>

                    </div>
                    <button type="submit" class="botao-cadastro">Cadastrar</button>

                                    @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                </form>
                <p class="login-link">Já tem uma conta? <a href="/login">Faça login aqui</a>.</p>
            </div>
        </div>
    </section>

    <footer class="rodape">
        <div class="conteudo-rodape">
            <p class="texto-rodape">&copy; 2023 PizzaNight - A Pizzaria Temática de Terror. Todos os direitos reservados.</p>
        </div>
    </footer>

</body>
</html>