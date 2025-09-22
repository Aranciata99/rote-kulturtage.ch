document.addEventListener("DOMContentLoaded", function () {
  const buttons = document.querySelectorAll("#filter-buttons button");
  const items = document.querySelectorAll(".programmPunkt");

  buttons.forEach(button => {
    button.addEventListener("click", () => {
      const filter = button.getAttribute("data-filter");

      items.forEach(item => {
        if (filter === "alle") {
          item.style.display = "block";
        } else {
          if (item.classList.contains(filter)) {
            item.style.display = "block";
          } else {
            item.style.display = "none";
          }
        }
      });
    });
  });

  document.querySelector('[data-filter="alle"]').click();
});
