document.addEventListener('DOMContentLoaded', function () {
  document.getElementById('filtroAno').addEventListener('change', function () {
    const valorSelecionado = this.value;
    const cards = document.querySelectorAll('.card');

    cards.forEach(card => {
      const ano = card.getAttribute('data-ano');
      if (valorSelecionado === '') {
        card.style.display = 'block';
      } else {
        card.style.display = (ano === valorSelecionado) ? 'block' : 'none';
      }
    });
  });
});

document.addEventListener('DOMContentLoaded', function() {
  const hamburger = document.querySelector('.hamburger');
  const nav_list = document.getElementById('mobile-menu');

  hamburger.addEventListener('click', function() {
    hamburger.classList.toggle('active');
    nav_list.classList.toggle('active');
  });

  // Fecha o menu ao clicar em um link (mobile)
  const nav_links = nav_list.querySelectorAll('a');
  nav_links.forEach(link => {
    link.addEventListener('click', function() {
      if (window.innerWidth <= 768) {
        hamburger.classList.remove('active');
        nav_list.classList.remove('active');
      }
    });
  });
});
