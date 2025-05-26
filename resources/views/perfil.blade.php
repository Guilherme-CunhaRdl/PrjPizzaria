<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil - PizzaNight</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
    <link rel="stylesheet" href="{{url('css/style.css')}}">
</head>
<body class="perfil-body">
    <!-- Header -->
    <header>
        <div class="interface">
            <div class="logo">
                <a href="/">
                    <i class="fas fa-pizza-slice"></i>
                    <p>PizzaNight</p>
                </a>
            </div>
            <nav class="menu-desktop">
                <ul>
                    <li><a href="/cardapio"><i class="fas fa-utensils"></i> Cardápio</a></li>
                    <li><a href="/pedidos"><i class="fas fa-clipboard-list"></i> Meus Pedidos</a></li>
                    <li><a href="/perfil" class="active"><i class="fas fa-user"></i> Perfil</a></li>
                </ul>
            </nav>
            <div class="btn-contato">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"><i class="fas fa-sign-out-alt"></i> Sair</button>
                </form>
            </div>
        </div>
    </header>

    <!-- Conteúdo Principal -->
    <main class="container-perfil">
        <div class="perfil-header">
            <h1><i class="fas fa-user"></i> Meu Perfil</h1>
            <div class="decoracao-horror">
                <div class="risco-left"></div>
                <i class="fas fa-pizza-slice icone-pizza"></i>
                <div class="risco-right"></div>
            </div>
        </div>

        <div class="perfil-container">
            <!-- Seção de Informações -->
            <div class="perfil-info">
                <div class="foto-perfil-container">
                    <div class="foto-perfil-wrapper">
                        <img src="{{ auth()->user()->imgUsuario ? asset('uploads/'.auth()->user()->imgUsuario) : asset('images/default-user.png') }}" 
                             alt="Foto de perfil" class="foto-perfil">
                        <div class="foto-perfil-glow"></div>
                    </div>
                    <form id="form-foto" action="{{ route('perfil.atualizar-foto') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" id="foto-input" name="foto" accept="image/*" style="display: none;">
                        <button type="button" class="btn-alterar-foto" onclick="document.getElementById('foto-input').click()">
                            <i class="fas fa-camera"></i> Alterar Foto
                        </button>
                    </form>
                </div>

                <div class="info-basica">
                    <h2>{{ auth()->user()->nomeUsuario }}</h2>
                    <p><i class="fas fa-envelope"></i> {{ auth()->user()->emailUsuario }}</p>
                    @if(auth()->user()->cpfUsuario)
                        <p><i class="fas fa-id-card"></i> {{ auth()->user()->cpfUsuario }}</p>
                    @endif
                    @if(auth()->user()->dataNasc)
                        <p><i class="fas fa-birthday-cake"></i> {{ \Carbon\Carbon::parse(auth()->user()->dataNasc)->format('d/m/Y') }}</p>
                    @endif
                </div>
            </div>
            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $erro)
                <li>{{ $erro }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif



            <!-- Formulário de Edição -->
            <form class="form-perfil" action="{{ route('perfil.atualizar') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-grid">
                    <div class="form-group">
                        <label for="nome"><i class="fas fa-user"></i> Nome Completo</label>
                        <input type="text" id="nome" name="nome" value="{{ old('nome', auth()->user()->nomeUsuario) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="email"><i class="fas fa-envelope"></i> E-mail</label>
                        <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->emailUsuario) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="data_nascimento"><i class="fas fa-calendar"></i> Data de Nascimento</label>
                        <input type="date" id="data_nascimento" name="data_nascimento" 
                               value="{{ old('data_nascimento', auth()->user()->dataNasc ? \Carbon\Carbon::parse(auth()->user()->dataNasc)->format('Y-m-d') : '') }}">
                    </div>

                    <div class="form-group">
                        <label for="cpf"><i class="fas fa-id-card"></i> CPF</label>
                        <input type="text" id="cpf" name="cpf" value="{{ old('cpf', auth()->user()->cpfUsuario) }}"
                               placeholder="Opcional" data-mask="000.000.000-00">
                    </div>
                </div>

                <h3 class="titulo-endereco"><i class="fas fa-map-marker-alt"></i> Endereço</h3>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="cep">CEP</label>
                        <input type="text" id="cep" name="cep" value="{{ old('cep', auth()->user()->cepUsuario) }}"
                               data-mask="00000-000" placeholder="00000-000">
                    </div>

                    <div class="form-group">
                        <label for="logradouro">Logradouro</label>
                        <input type="text" id="logradouro" name="logradouro" 
                               value="{{ old('logradouro', auth()->user()->logradouroUsuario) }}">
                    </div>

                    <div class="form-group">
                        <label for="numero">Número</label>
                        <input type="text" id="numero" name="numero" 
                               value="{{ old('numero', auth()->user()->numeroUsuario) }}">
                    </div>

                    <div class="form-group">
                        <label for="complemento">Complemento</label>
                        <input type="text" id="complemento" name="complemento" 
                               value="{{ old('complemento', auth()->user()->complementoUsuario) }}">
                    </div>

                    <div class="form-group">
                        <label for="bairro">Bairro</label>
                        <input type="text" id="bairro" name="bairro" 
                               value="{{ old('bairro', auth()->user()->bairroUsuario) }}">
                    </div>

                    <div class="form-group">
                        <label for="cidade">Cidade</label>
                        <input type="text" id="cidade" name="cidade" 
                               value="{{ old('cidade', auth()->user()->cidadeUsuario) }}">
                    </div>

                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select id="estado" name="estado">
                            <option value="">Selecione</option>
                            @foreach(['AC','AL','AP','AM','BA','CE','DF','ES','GO','MA','MT','MS','MG','PA','PB','PR','PE','PI','RJ','RN','RS','RO','RR','SC','SP','SE','TO'] as $uf)
                                <option value="{{ $uf }}" {{ old('estado', auth()->user()->estadoUsuario) == $uf ? 'selected' : '' }}>{{ $uf }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn-alterar-senha" id="btn-alterar-senha">
                        <i class="fas fa-key"></i> Alterar Senha
                    </button>
                    <button type="submit" class="btn-salvar">
                        <i class="fas fa-save"></i> Salvar Alterações
                    </button>
                </div>
            </form>

            <!-- Modal Alterar Senha -->
            <div class="modal-senha" id="modal-senha">
                <div class="modal-conteudo">
                    <span class="fechar-modal">&times;</span>
                    <h2><i class="fas fa-key"></i> Alterar Senha</h2>
                    <form action="{{ route('perfil.alterar-senha') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="senha_atual">Senha Atual</label>
                            <input type="password" id="senha_atual" name="senha_atual" required>
                        </div>
                        <div class="form-group">
                            <label for="nova_senha">Nova Senha</label>
                            <input type="password" id="nova_senha" name="nova_senha" required>
                        </div>
                        <div class="form-group">
                            <label for="confirmar_senha">Confirmar Nova Senha</label>
                            <input type="password" id="confirmar_senha" name="nova_senha_confirmation" required>
                        </div>
                        <button type="submit" class="btn-salvar">
                            <i class="fas fa-save"></i> Alterar Senha
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="rodape">
        <div class="texto-rodape">
            PizzaNight &copy; {{ date('Y') }} - Todos os direitos reservados
        </div>
    </footer>

    <!-- Elementos de Tema -->
    <div class="theme-toggle">
        <button id="themeButton" aria-label="Alternar tema FNAF 3">
            <i class="fas fa-ghost"></i>
        </button>
    </div>

    <div id="springtrapOverlay" class="springtrap-overlay">
        <img src="{{ asset('images/springtrap-jumpscare2.gif') }}" alt="Springtrap Jumpscare">
        <audio id="jumpscareSound" preload="auto">
            <source src="{{ asset('sounds/jumpscare.mp3') }}" type="audio/mpeg">
        </audio>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="{{ asset('js/perfil.js') }}"></script>
    <script src="{{ asset('js/tema.js') }}"></script>
    <script src="{{url('js/tema.js')}}"></script>
<script src="{{url('js/saboresHome.js')}}" ></script>
<script  src="{{url('js/animationHome.js')}}"></script>
<script src="{{url('js/script.js')}}"></script>
</body>
</html>