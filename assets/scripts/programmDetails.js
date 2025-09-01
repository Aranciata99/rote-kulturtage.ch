document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.programmPunkt').forEach(punkt => {
    const infoContainer = punkt.querySelector('.programmInfoContainer');
    const closeBtn = punkt.querySelector('.programmInfoContainer');

    punkt.addEventListener('click', () => {
      infoContainer.style.display = 'block';
    });

    if (closeBtn) {
      closeBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        infoContainer.style.display = 'none';
      });
    }
  });
});
