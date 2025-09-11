document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.programmPunkt').forEach(punkt => {
    const infoButton = punkt.querySelector('button');
    const infoContainer = punkt.querySelector('.programmInfoContainer');
    const closeBtn = punkt.querySelector('.programmInfoContainer');

    if (infoButton && infoContainer) {
      infoButton.addEventListener('click', (e) => {
        e.stopPropagation();
        infoContainer.style.display = 'block';
      });
    }

    if (closeBtn && infoContainer) {
      closeBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        infoContainer.style.display = 'none';
      });
    }
  });
});
