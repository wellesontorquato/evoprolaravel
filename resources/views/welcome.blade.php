<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>EvoPlus - Evoluções Sociais</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet"/>

  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #F8F6FF;
      color: #333;
    }

    .btn-evo {
      background-color: #A084DC;
      color: white;
    }

    .btn-evo:hover {
      background-color: #8a6dc3;
    }

    .btn-evo-light {
    color: #7743DB;
    border: 1px solid #A084DC;
    background-color: transparent;
    transition: background-color 0.3s, color 0.3s;
    }

    .btn-evo-light:hover {
    background-color: #E5D8FA;
    color: #7743DB;
    }

    .hero {
      background: linear-gradient(180deg, #F3EEFF 0%, #ffffff 100%);
      padding: 80px 0;
      text-align: center;
    }

    footer {
      background-color: #f5f5f5;
      padding: 20px;
      text-align: center;
      font-size: 14px;
      color: #666;
    }

    /* Carrossel */
    .carousel-box {
        position: relative;
        max-width: 960px;
        margin: auto;
        padding: 0 1rem; /* espaço para o efeito girar sem cortar */
        overflow: visible; /* permitir que o efeito ultrapasse */
    }

    .carousel-inner {
        display: flex;
        width: 300%;
        transition: transform 0.5s ease;
        overflow: visible;
    }

    .carousel-slide {
        flex-shrink: 0;
        width: 100%;
        max-width: 900px;
        padding: 0 1rem;
        perspective: 1200px; /* mais profundidade */
        overflow: visible;
    }

    .mockup-3d img {
        transition: transform 0.4s ease, box-shadow 0.4s ease;
        transform-style: preserve-3d;
        will-change: transform;
        border-radius: 1rem;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        width: 100%;
        overflow: visible;
    }

    .mockup-3d:hover img {
        transform: rotateY(6deg) rotateX(3deg) scale(1.02);
        box-shadow: 0 20px 30px rgba(0, 0, 0, 0.25);
    }

    .carousel-dot {
      width: 12px;
      height: 12px;
      border-radius: 50%;
      background-color: #D3BDF0;
      display: inline-block;
      transition: background-color 0.3s;
      cursor: pointer;
    }

    .carousel-dot.active {
      background-color: #7743DB;
    }

    .logo-hover {
        transition: transform 0.3s ease, filter 0.3s ease;
    }

    .logo-hover:hover {
        transform: scale(1.07);
        filter: brightness(1.1);
    }

  </style>
</head>
<body>
  <!-- Header -->
  <nav class="navbar navbar-light bg-white shadow-sm sticky-top">
    <div class="container d-flex justify-content-between align-items-center">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="{{ asset('images/logo_evoplus_semfundo.png') }}" alt="Logo EvoPlus" class="logo-hover" style="height: 40px;">
        </a>
      <div>
        <a href="{{ route('login') }}" class="btn btn-evo-light me-2">Entrar</a>
        <a href="{{ route('register') }}" class="btn btn-evo">Criar Conta</a>
      </div>
    </div>
  </nav>

  <!-- Hero -->
  <section class="hero animate__animated animate__fadeInDown">
    <div class="container">
      <h1 class="display-7 fw-bold" style="color:#7743DB">Evoluções para quem cuida de pessoas, com mais rapidez e organização</h1>
      <p class="lead mb-4">O <strong>EvoPlus</strong> é uma plataforma para todos os profissionais da <strong>Área de Saúde</strong> que desejam gerar, organizar e armazenar evoluções com praticidade e segurança.</p>
      <a href="{{ route('register') }}" class="btn btn-evo btn-lg me-2">✨ Criar Conta Grátis</a>
      <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-lg">Já tenho conta</a>
    </div>
  </section>

  <!-- Benefícios -->
  <section class="py-5" style="background-color: #F3EEFF;">
    <div class="container text-center">
      <h3 class="text-purple mb-4" style="color: #7743DB">Por que usar o EvoPlus?</h3>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="p-4 bg-white rounded shadow-sm h-100">
            <h5>📄 Modelos Personalizados</h5>
            <p class="text-muted">Crie e edite modelos de evolução com campos dinâmicos e reutilizáveis.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="p-4 bg-white rounded shadow-sm h-100">
            <h5>⚙️ Geração Automática</h5>
            <p class="text-muted">Economize tempo gerando evoluções completas com poucos cliques.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="p-4 bg-white rounded shadow-sm h-100">
            <h5>🔐 Privacidade Garantida</h5>
            <p class="text-muted">Seus dados ficam seguros com criptografia e acesso individual.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Painel com efeito 3D -->
  <section class="my-12 text-center">
    <h3 class="text-xl font-semibold text-purple-700 mb-4">🖥️ Veja como é o painel do EvoPlus</h3>

    <div class="carousel-box">
        <div class="carousel-inner" id="carouselInner">
            <div class="carousel-slide mockup-3d">
            <img src="{{ asset('images/painel-demo.png') }}" alt="Painel 1">
            </div>
            <div class="carousel-slide mockup-3d">
            <img src="{{ asset('images/minhas-evolucoes.png') }}" alt="Painel 2">
            </div>
            <div class="carousel-slide mockup-3d">
            <img src="{{ asset('images/meus-modelos.png') }}" alt="Painel 3">
            </div>
        </div>
        </div>


    <div id="carouselIndicators" class="d-flex justify-content-center gap-2 mt-3">
      <span class="carousel-dot active" onclick="goToSlide(0)"></span>
      <span class="carousel-dot" onclick="goToSlide(1)"></span>
      <span class="carousel-dot" onclick="goToSlide(2)"></span>
    </div>
  </section>

  <!-- Rodapé -->
  <footer>
    <p>&copy; {{ date('Y') }} EvoPlus — Feito com 💜 para quem evolui.</p>
  </footer>

  <script>
    const carouselInner = document.getElementById('carouselInner');
    const slides = document.querySelectorAll('.carousel-slide');
    const dots = document.querySelectorAll('.carousel-dot');
    let currentIndex = 0;

    function goToSlide(index) {
      const slideWidth = slides[0].offsetWidth;
      carouselInner.style.transform = `translateX(-${index * slideWidth}px)`;
      currentIndex = index;
      dots.forEach(dot => dot.classList.remove('active'));
      dots[index].classList.add('active');
    }

    setInterval(() => {
      currentIndex = (currentIndex + 1) % slides.length;
      goToSlide(currentIndex);
    }, 5000);

    window.addEventListener('load', () => goToSlide(currentIndex));
    window.addEventListener('resize', () => goToSlide(currentIndex));
  </script>
</body>
</html>
