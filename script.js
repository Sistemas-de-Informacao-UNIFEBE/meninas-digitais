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

function toggleMenu() {
  const links = document.querySelector('.nav-links');
  links.classList.toggle('mobile-hidden');
}
