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
      padding: 60px 0;
      text-align: center;
    }

    .hero h1 {
      font-size: calc(1.5rem + 1vw);
    }

    .hero p {
      font-size: 1.1rem;
    }

    footer {
      background-color: #f5f5f5;
      padding: 20px;
      text-align: center;
      font-size: 14px;
      color: #666;
    }

    .carousel-box {
      position: relative;
      max-width: 100%;
      margin: auto;
      padding: 0 1rem;
      overflow: hidden;
    }

    .carousel-inner {
      display: flex;
      transition: transform 0.5s ease;
    }

    .carousel-slide {
      flex-shrink: 0;
      width: 100%;
      padding: 0 1rem;
      perspective: 1200px;
    }

    .mockup-3d img {
      transition: transform 0.4s ease, box-shadow 0.4s ease;
      transform-style: preserve-3d;
      border-radius: 1rem;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
      width: 100%;
      max-width: 100%;
      height: auto;
    }

    .mockup-3d:hover img {
      transform: rotateY(6deg) rotateX(3deg) scale(1.02);
      box-shadow: 0 20px 30px rgba(0, 0, 0, 0.25);
    }

    .dot {
      height: 10px;
      width: 10px;
      margin: 0 6px;
      background-color: #D3BDF0;
      border-radius: 50%;
      display: inline-block;
      transition: background-color 0.3s ease;
      cursor: pointer;
    }

    .dot.active {
      background-color: #7743DB;
    }


    .logo-hover {
      transition: transform 0.3s ease, filter 0.3s ease;
    }

    .logo-hover:hover {
      transform: scale(1.07);
      filter: brightness(1.1);
    }

    @media (max-width: 768px) {
      .hero h1 {
        font-size: 1.5rem;
      }

      .hero p {
        font-size: 1rem;
      }

      .carousel-inner {
        flex-direction: row;
      }

      .carousel-slide {
        padding: 0 0.5rem;
      }

      .btn-lg {
        width: 100%;
        margin-bottom: 10px;
      }

      .navbar .btn {
        margin-bottom: 5px;
      }

      .navbar .container {
        flex-direction: column;
        align-items: flex-start;
      }

      .navbar .container > div {
        width: 100%;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
      }
    }
  </style>
</head>
<body>
  <!-- Header -->
  <nav class="navbar navbar-light bg-white shadow-sm sticky-top">
    <div class="container d-flex justify-content-between align-items-center flex-wrap">
      <a class="navbar-brand d-flex align-items-center mb-2 mb-md-0" href="#">
        <img src="{{ asset('images/logo_evoplus_semfundo.png') }}" alt="Logo EvoPlus" class="logo-hover" style="height: 40px;">
      </a>
      <div class="d-flex gap-2">
        <a href="{{ route('login') }}" class="btn btn-evo-light">Entrar</a>
        <a href="{{ route('register') }}" class="btn btn-evo">Criar Conta</a>
      </div>
    </div>
  </nav>

  <!-- Hero -->
  <section class="hero animate__animated animate__fadeInDown">
    <div class="container">
      <h1 class="fw-bold" style="color:#7743DB">Evoluções para quem cuida de pessoas, com mais rapidez e organização</h1>
      <p class="lead mb-4">O <strong>EvoPlus</strong> é uma plataforma para todos os profissionais da <strong>Área de Saúde</strong> que desejam gerar, organizar e armazenar evoluções com praticidade e segurança.</p>
      <div class="d-flex flex-column flex-md-row justify-content-center gap-3">
        <a href="{{ route('register') }}" class="btn btn-evo btn-lg">✨ Criar Conta Grátis</a>
        <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-lg">Já tenho conta</a>
      </div>
    </div>
  </section>

  <!-- Benefícios -->
  <section class="py-5" style="background-color: #F3EEFF;">
    <div class="container text-center">
      <h3 class="mb-4" style="color: #7743DB">Por que usar o EvoPlus?</h3>
      <div class="row g-4">
        <div class="col-md-4 col-sm-12">
          <div class="p-4 bg-white rounded shadow-sm h-100">
            <h5>📄 Modelos Personalizados</h5>
            <p class="text-muted">Crie e edite modelos de evolução com campos dinâmicos e reutilizáveis.</p>
          </div>
        </div>
        <div class="col-md-4 col-sm-12">
          <div class="p-4 bg-white rounded shadow-sm h-100">
            <h5>⚙️ Geração Automática</h5>
            <p class="text-muted">Economize tempo gerando evoluções completas com poucos cliques.</p>
          </div>
        </div>
        <div class="col-md-4 col-sm-12">
          <div class="p-4 bg-white rounded shadow-sm h-100">
            <h5>🔐 Privacidade Garantida</h5>
            <p class="text-muted">Seus dados ficam seguros com criptografia e acesso individual.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Mockup EvoPlus -->
  <section class="my-5 text-center px-3">
    <h3 class="text-purple mb-3" style="color:#7743DB">🖥️ Veja como é o painel do <strong>EvoPlus</strong></h3>

    <div class="mx-auto" style="max-width: 800px;">
      <div class="carousel-tilt" id="carouselTilt" style="
          width: 100%;
          border-radius: 20px;
          overflow: hidden;
          box-shadow: 0 12px 25px rgba(0,0,0,0.2);
          transform-style: preserve-3d;
          transition: transform 0.4s ease;
      ">
        <img id="carouselImage" src="/images/painel-demo.png" alt="Mockup EvoPlus" style="
            width: 100%;
            display: block;
            transition: transform 0.4s ease;
        ">
      </div>

      <div id="carouselDots" style="margin-top: 10px; text-align: center;">
        <span class="dot active" data-index="0"></span>
        <span class="dot" data-index="1"></span>
        <span class="dot" data-index="2"></span>
      </div>
    </div>
  </section>


  <!-- Rodapé -->
  <footer>
    <p>&copy; {{ date('Y') }} EvoPlus — Feito com 💜 para quem evolui.</p>
  </footer>

<script>
  const images = [
    '/images/painel-demo.png',
    '/images/minhas-evolucoes.png',
    '/images/meus-modelos.png'
  ];

  let currentIndex = 0;
  const imageEl = document.getElementById('carouselImage');
  const dots = document.querySelectorAll('#carouselDots .dot');
  const tiltEl = document.getElementById('carouselTilt');

  function showImage(index) {
    currentIndex = index;
    imageEl.src = images[index];
    dots.forEach(dot => dot.classList.remove('active'));
    dots[index].classList.add('active');
  }

  dots.forEach(dot => {
    dot.addEventListener('click', () => {
      showImage(Number(dot.dataset.index));
    });
  });

  setInterval(() => {
    currentIndex = (currentIndex + 1) % images.length;
    showImage(currentIndex);
  }, 5000);

  if (tiltEl) {
    tiltEl.style.transition = 'transform 0.4s ease';
    tiltEl.style.transformStyle = 'preserve-3d';
    tiltEl.style.willChange = 'transform';
    tiltEl.style.backfaceVisibility = 'hidden';

    tiltEl.addEventListener('mouseenter', () => {
      tiltEl.style.transform = 'rotateX(4deg) rotateY(-16deg)';
    });

    tiltEl.addEventListener('mouseleave', () => {
      tiltEl.style.transform = 'rotateX(0deg) rotateY(0deg)';
    });
  }
</script>
</body>
</html>
