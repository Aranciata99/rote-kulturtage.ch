document.addEventListener("DOMContentLoaded", function () {
  //FilterButton Menue Initialised
  const buttons = document.querySelectorAll("#filter-buttons button");
  const items = document.querySelectorAll(".programmPunkt");

  //Filter Menue Initialised
  const toggleButton = document.getElementById("toggleFilterMenue");
  const closeButton = document.getElementById("closeFilterMenue");
  const filterContainer = document.querySelector(".filterButtonsContainer");

  if (window.innerWidth >= 900) {

    //Toggle Filter Menue
    toggleButton.addEventListener("click", function () {
      filterContainer.style.display = "block";
    });

    //Close Filter Menue
    closeButton.addEventListener("click", function () {
      filterContainer.style.display = "none";
      items.forEach(item => {
        item.style.display = "block";
      });
    });
  }

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
