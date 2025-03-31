<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{url('css/style.css')}}">
    <link rel="stylesheet" href="{{url('css/login.css')}}">
    <title>Login - PizzaNight</title>
</head>
<body>
    
  
    <!-- Tela de Login -->
    <section class="login">
        <div class="container">
            <div class="formulario-login">
                <h2>Faça login</h2>
                <p>Entre na sua conta para continuar.</p>
                <form action="{{ route('login.submit') }}" method="POST" >
                    @csrf
                    <div class="input-group">
                        <input type="email" id="email" name="email" placeholder="E-mail" required>
                     
                    </div>
                    <div class="input-group">
                        <input type="password" id="senha" name="senha" placeholder="Senha" required>
                    
                    </div>
                    <button type="submit" class="botao-login">Entrar</button>
                </form>
                                    @if ($errors->any())
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                <p class="cadastro-link">Não tem uma conta? <a href="/nivelUsuario/cadastro">Cadastre-se aqui</a>.</p>
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