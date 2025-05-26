<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil - PizzaNight</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{url('css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
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
                <li><a href="/"><i class="fa-solid fa-house"></i>Home</a></li>
                    <li><a href="/menu"><i class="fas fa-utensils"></i> Cardápio</a></li>

                    <li><a href="/historia"><i class="fa-solid fa-building"></i>Nossa historia</a></li>
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
            <div class="perfil-header">
                <h1><i class="fas fa-clipboard-list"></i> Meus Pedidos</h1>
                <div class="decoracao-horror">
                    <div class="risco-left"></div>
                    <i class="fas fa-pizza-slice icone-pizza"></i>
                    <div class="risco-right"></div>
                </div>
            </div>
        </div>

        <div class="perfil-container">
            @forelse ($pedidos as $pedido)
            <div class="pedido-card">
                <a class="btn-toggle-itens" type="button" data-target="#itens-{{ $pedido->id }}">
                    <div style="flex-direction: row; justify-content: space-between; align-items: center; display: flex;">
                        <h3> Pedido #{{ $pedido->id }} </h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </a>
                <p><strong>Data:</strong> {{ $pedido->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Status:</strong> {{ ucfirst($pedido->status) }}</p>
                <p><strong>Pagamento:</strong> {{ ucfirst($pedido->metodo_pagamento) }}</p>
                <p><strong>Total:</strong> R$ {{ number_format($pedido->total, 2, ',', '.') }}</p>

                <div id="itens-{{ $pedido->id }}" class="itens-pedido" style="display: none;">
                    @foreach ($pedido->itens as $item)
                    <p>
                        {{ $item->quantidade }}x {{ $item->pizza->nomePizza ?? '[Pizza removida]' }} -
                        Tamanho: {{ ucfirst($item->tamanho) }} -
                        R$ {{ number_format($item->preco_unitario, 2, ',', '.') }}
                    </p>
                    @endforeach
                </div>
            </div>
            @empty
            <p>Você ainda não fez nenhum pedido.</p>
            @endforelse

        </div>

        
    </main>

    

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
    <script>
        $(document).ready(function() {
            $('.btn-toggle-itens').on('click', function() {
                let target = $(this).data('target');
                $(target).slideToggle(200);
                $(this).find('i').toggleClass('fa-chevron-down fa-chevron-up');
            });
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="{{ asset('js/perfil.js') }}"></script>
    <script src="{{ asset('js/tema.js') }}"></script>
    <script src="{{url('js/tema.js')}}"></script>
    <script src="{{url('js/saboresHome.js')}}"></script>
    <script src="{{url('js/animationHome.js')}}"></script>
    <script src="{{url('js/script.js')}}"></script>
</body>

</html>