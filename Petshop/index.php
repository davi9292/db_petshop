<!-- Davi Fabricio - Vinicius Queiroz - Thomas Gabriel  -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>PetShop Admin</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

  <!-- Sidebar -->
  <aside class="sidebar">
    <h1>PetShop Mouse</h1>
    <a href="cliente/consulta_cliente.php">Gerenciar Clientes</a>
    <a href="animal/consulta_animal.php">Gerenciar Animais</a>
    <a href="agendamento/consulta_agenda.php">Agendamentos</a>
  </aside>

  <!-- Header -->
  <header>
    <h2>Painel Administrativo</h2>
  </header>

  <!-- Main -->
  <main>
    <div class="carousel-container">
      <div class="carousel">
        <img src="img/pet1.avif" alt="Pet 1" class="carousel-slide active">
        <img src="img/pet2.jpg" alt="Pet 2" class="carousel-slide">
        <img src="img/pet3.jpg" alt="Pet 3" class="carousel-slide">
        <img src="img/pet4.png" alt="Pet 4" class="carousel-slide">
        <img src="img/pet5.png" alt="Pet 5" class="carousel-slide">
        <img src="img/pet6.png" alt="Pet 6" class="carousel-slide">
      </div>
      <button class="prev">&#10094;</button>
      <button class="next">&#10095;</button>
    </div>
  </main>

  <!-- Script do Carrossel -->
  <script>
    const slides = document.querySelectorAll('.carousel-slide');
    const prev = document.querySelector('.prev');
    const next = document.querySelector('.next');
    let current = 0;

    function showSlide(index) {
      slides.forEach((slide, i) => {
        slide.classList.remove('active');
        if (i === index) slide.classList.add('active');
      });
    }

    prev.addEventListener('click', () => {
      current = (current === 0) ? slides.length - 1 : current - 1;
      showSlide(current);
    });

    next.addEventListener('click', () => {
      current = (current === slides.length - 1) ? 0 : current + 1;
      showSlide(current);
    });

    setInterval(() => {
      current = (current + 1) % slides.length;
      showSlide(current);
    }, 5000);
  </script>

</body>
</html>
