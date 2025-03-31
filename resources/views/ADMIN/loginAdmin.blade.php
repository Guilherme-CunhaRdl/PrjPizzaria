<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - PizzaNight</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{url('css/style.css')}}">
    <link rel="stylesheet" href="{{url('css/admLogin.css')}}">
</head>
<body>
    <!-- Tela de Login Admin -->
    <section class="admin-login">
        <div class="login-container">
            <div class="login-header">
                <div class="logo">
                    <i class="fas fa-pizza-slice"></i>
                    <h1>PizzaNight <span>Admin</span></h1>
                </div>
                <h2>Acesso Restrito</h2>
                <p>Painel de administração</p>
            </div>
            
            <form method="POST" action="{{route('loginAdmin.submit')}}" class="login-form">
                @csrf
                <div class="input-group">
                    <label for="admin-email"><i class="fas fa-envelope"></i> E-mail Administrativo</label>
                    <input type="email" id="admin-email" name="email" placeholder="seu@email.com" required>
                </div>
                
                <div class="input-group">
                    <label for="admin-password"><i class="fas fa-lock"></i> Senha</label>
                    <input type="password" id="admin-password" name="senha" placeholder="••••••••" required>
                    <button type="button" class="toggle-password" aria-label="Mostrar senha">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                
                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" name="remember">
                        <span class="checkmark"></span>
                        Manter conectado
                    </label>
                    <a href="#" class="forgot-password">Esqueceu a senha?</a>
                </div>
                
                <button type="submit" class="login-button">
                    <i class="fas fa-sign-in-alt"></i> Acessar Painel
                </button>
                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </form>
            
            <div class="security-info">
                <p><i class="fas fa-shield-alt"></i> Área segura - Todos os dados são criptografados</p>
            </div>
        </div>
    </section>


    <script src="{{url('js/admin-login.js')}}"></script>
</body>
</html>