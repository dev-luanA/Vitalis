<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="stylesheet" href="home.css">
</head>

<body>
<header class="hero-section">
        <nav>
            <img src="img/logo.png" alt="Logo Vitalis" />
            <ul>
                <li><a href="inicio.php">Início</a></li>
                <li><a href="sobrenos.php">Quem somos</a></li>
                <li><a href="servicos.php">Serviços</a></li>
                <li><a href="entretenimento.php">Entretenimento</a></li>
                <li><a href="saudeidoso.php">Saúde</a></li>
                <li><a href="calculoprevidencia.php">Calculo de Previdencia</a></li>
            </ul>
        </nav>
    </header>


  <div class="hero">
    <div class="conteudo">
      <p class="primeirafrase" style="color: #968EEB;">Cuidando e inspirando a Melhor Idade</p>
      <h1>Planeje hoje, aproveite <br> o amanhã com segurança e <br> tranquilidade.</h1>
      <p>A Vitalis é uma plataforma dedicada a melhorar a qualidade de vida da pessoa idosa, <br> oferecendo soluções integradas em saúde, entretenimento e mentoria. Nossa missão <br> é promover o bem-estar e a inclusão da terceira idade, conectando serviços <br> essenciais e informações de forma acessível e intuitiva.</p>
      <button class="cta-button" onclick="window.location.href='cadastro.php'">Faça parte agora!</button>
    </div>
    <div class="imagem-hero">
      <img class="hero-image" src="img/idosocasal.jpg" alt="Imagem Hero"> <!-- Adicione essa linha -->
    </div>
  </div>

  <section class="novas-oportunidades" id="quemsomos">
    <h1 class="center-text">Novas Oportunidades</h1>
    <p class="center-text">Somos uma plataforma que busca e permite que pessoas idosas continuem <br> vivendo suas vidas sem problemas.</p>
    <div class="middle-images-container">
      <img class="middle-image" src="img/imagemmeio.png" alt="Imagem Meio 1">
      <img class="middle-image small-image" src="img/imagemmeio2.png" alt="Imagem Meio 2" style="height: 180px; width: auto; margin-top: 90px;">
    </div>
  </section>

  <section class="cards-section" id="servicos">
    <h1>Somos referência</h1>
    <br>
    <div class="card-container">
      <div class="card card-1">
        <h3>Cuidados especiais</h3>
        <p>O serviço de cuidado da Vitalis conecta idosos a cuidadores qualificados.</p>
        <a href="saudeidoso.php">→</a>
      </div>
      <div class="card card-2">
        <h3>Alternativas de entretenimento</h3>
        <p>A Vitalis oferece alternativas de entretenimento para idosos, incentivando o engajamento e a socialização de maneira divertida e inclusiva.</p>
        <a href="entretenimento.php">→</a>
      </div>
      <div class="card card-3">
        <h3>Know How</h3>
        <p>A Vitalis disponibiliza um espaço de mentoria "Know How", onde idosos podem compartilhar sua vasta experiência profissional com jovens e iniciantes.</p>
        <a href="knowhow.php">→</a>
      </div>
      <div class="card card-4">
        <h3>Previdência</h3>
        <p>A Vitalis oferece um recurso de cálculo previdenciário, onde os usuários podem entender de forma simples como funciona o sistema atual de aposentadoria.</p>
        <a href="calculoprevidencia.php">→</a>
      </div>
    </div>
  </section>

  <section class="reference" id="feedbacks">
    <h1>O que os usuários relatam.</h1>
    <div class="reference-grid">
      <div class="reference-item">
        <h3>Márcio Ramos</h3>
        <p><strong>Cuidador de idosos</strong></p>
        <p>A equipe é extremamente profissional e atenciosa, e me senti acolhido desde o primeiro contato. Recomendo a todos que procuram.</p>
      </div>
      <div class="reference-item">
        <h3>Caio Pedro</h3>
        <p><strong>Psico-terapeuta</strong></p>
        <p>A Vitalis foi essencial para encontrar um cuidador de confiança para minha mãe. A plataforma é fácil de usar e as informações são muito claras. Recomendo demais!</p>
      </div>
      <div class="reference-item">
        <h3>Ana Luiza</h3>
        <p><strong>Estudante</strong></p>
        <p>Adorei a iniciativa da mentoria Know How. Meu avô se cadastrou e está super empolgado em compartilhar sua experiência com os mais jovens!</p>
      </div>
    </div>
  </section>

  <footer>
    <div class="container">
      <div class="footer-section">
        <img src="img/logo.png" alt="Logo" class="footer-logo">
        <p>Vitalis é uma plataforma dedicada a melhorar a qualidade de vida da pessoa idosa, oferecendo soluções integradas em saúde, entretenimento e mentoria.</p>
        <a href="#"><img src="img/facebook.png" alt="Facebook"></a>
        <a href="#"><img src="img/instagram.png" alt="Instagram"></a>
        <a href="#"><img src="img/twitter.png" alt="Twitter"></a>
      </div>
      <div class="footer-section">
        <h3>Links</h3>
        <ul>
          <li><a href="#">Home</a></li>
          <li><a href="#">Serviços</a></li>
          <li><a href="#">Feedback</a></li>
          <li><a href="#">Entrar</a></li>
        </ul>
      </div>
      <div class="footer-section">
        <h3>Legal</h3>
        <p>Termos de uso</p>
      </div>
    </div>
  </footer>
</body>

</html>