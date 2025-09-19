// Base URL for API – default to current origin to avoid CORS issues
const devEnv = window?.config?.apiUrl || window.location.origin;
const foundingContainer = document.getElementById('foundingCampagneContainer');

// Get campaign status and update page elements
async function getCampaignStatus() {
  try {
    const response = await fetch(`${devEnv}/api/campaign-status`);
    return await response.json();
  } catch (err) {
    console.error('Error fetching campaign status:', err);
    return null;
  }
}

// Get goodies and display them on the page
async function getGoodies() {
  try {
    const response = await fetch(`${devEnv}/api/goodies`);
    return await response.json();
  } catch (err) {
    console.error('Error fetching goodies:', err);
    return [];
  }
}

async function main() {
  const [status, goodiesList] = await Promise.all([
    getCampaignStatus(),
    getGoodies(),
  ]);

  if (status) {
    updateCampaignStatus(status);
  }

  const goodiesContainer = document.getElementById("goodies-container");
  if (Array.isArray(goodiesList)) {
    goodiesList.forEach((goodie) => {
      const goodieElement = createGoodieElement(goodie);
      goodiesContainer.appendChild(goodieElement);
    });
  }
  // Add event listener to close the modal
  const modalClose = document.getElementById("modal-close");
  if (modalClose) {
    modalClose.addEventListener("click", () => {
      document.getElementById("payment-modal").style.display = "none";
      refreshPageContent(); // Refresh content when the modal is closed
      window.scrollTo(0, 0);
    });
  }

  // Set up automatic refresh every 30 seconds
  startAutoRefresh();
}

// Wait for DOM ready before initialising listeners and fetching data
document.addEventListener("DOMContentLoaded", () => {
  const donateForm = document.getElementById("donate-form");
  if (donateForm) {
    console.log('Donate form found, adding event listener');
    donateForm.addEventListener("submit", (event) => {
      console.log('Form submitted!');
      event.preventDefault();
      const amountInput = document.getElementById("amount");
      const amount = parseInt(amountInput.value);
      console.log('Amount entered:', amount);

      if (!amount || amount < 1) {
        alert("Bitte geben Sie einen gültigen Betrag ein (mindestens CHF 1).");
        amountInput.focus();
        return;
      }

      donateAmount(amount, "Spende");
    });
  } else {
    console.error('Donate form not found!');
  }

  main();
});

function donateAmount(amount, purpose) {
  console.log('donateAmount called with:', amount, purpose);

  const paymentUrl = `https://rotekulturtage.payrexx.com/de/vpos?amount=${amount}&purpose=${purpose}&currency=CHF`;
  console.log('Payment URL:', paymentUrl);

  // Open the payment page in the iframe and show the modal
  const iframe = document.getElementById("payment-iframe");
  const modal = document.getElementById("payment-modal");

  if (!iframe) {
    console.error('Payment iframe not found!');
    return;
  }

  if (!modal) {
    console.error('Payment modal not found!');
    return;
  }

  iframe.src = paymentUrl;
  modal.style.display = "block";
  console.log('Modal should now be visible');
}
function updateCampaignStatus(status) {
  // Update progress bar
  const progressBar = document.getElementById("progress");
  // const progressText = document.getElementById("progress-text");
  if (!status) return;
  const progressPercentage = (status.amountRaised / status.goal) * 100;
  // progressText.textContent = `${progressPercentage.toFixed(2)}%`;
  progressBar.style.height = `${progressPercentage}%`;

  const remainingDays = document.getElementById("remaining-days");

  const today = new Date();
  const endDate = new Date(status.endDate);
  const remainingTime = endDate.getTime() - today.getTime();
  const remainingDaysCount = Math.ceil(remainingTime / (1000 * 3600 * 24));
  remainingDays.textContent = `${remainingDaysCount}`;
  //console.log("End date from API:", endDate);

  // Update amount raised
  const amountRaisedElement = document.getElementById("amount-raised");
  amountRaisedElement.textContent = `${status.amountRaised} CHF`;

  // Update goal amount dynamically
  const goalAmountElement = document.querySelector('.goal-amount');
  if (goalAmountElement) {
    goalAmountElement.innerHTML = `
      <span id="progress-text">${progressPercentage.toFixed(1)}%</span> von CHF ${status.goal.toLocaleString('de-CH')}
      <br>
      <span id="supporters-count">${status.supportersCount}</span> Unterstützer:innen
    `;
  }

  // Update other elements if needed
}
function refreshPageContent() {
  console.log('Refreshing campaign status...');
  fetch(`${devEnv}/api/campaign-status`)
    .then(response => response.json())
    .then(status => {
      console.log('Updated campaign status:', status);
      updateCampaignStatus(status);
    })
    .catch(err => {
      console.error('Error refreshing campaign status:', err);
    });
}

// Auto-refresh functionality
let autoRefreshInterval;

function startAutoRefresh() {
  // Refresh every 30 seconds
  autoRefreshInterval = setInterval(() => {
    refreshPageContent();
  }, 30000);
  console.log('Auto-refresh started (every 30 seconds)');
}

function stopAutoRefresh() {
  if (autoRefreshInterval) {
    clearInterval(autoRefreshInterval);
    autoRefreshInterval = null;
    console.log('Auto-refresh stopped');
  }
}

// Refresh immediately when page becomes visible again (user returns to tab)
document.addEventListener('visibilitychange', () => {
  if (!document.hidden) {
    console.log('Page became visible, refreshing content...');
    refreshPageContent();
  }
});

// Suggested amounts
function setAmount(value) {
  const amountInput = document.getElementById("amount");
  const listItems = document.querySelectorAll(".suggested-amounts ul li");
  var selectedItem;

  listItems.forEach(function (item) {
    if (parseInt(item.textContent.replace("CHF ", "")) === value) {
      selectedItem = item;
    }
  });

  if (selectedItem.classList.contains("selected")) {
    amountInput.value = "";
    selectedItem.classList.remove("selected");
  } else {
    amountInput.value = value;

    listItems.forEach(function (item) {
      if (item === selectedItem) {
        item.classList.add("selected");
      } else {
        item.classList.remove("selected");
      }
    });
  }

  // On key up of amount input, remove selected class from suggested amounts
  amountInput.addEventListener("keyup", function () {
    listItems.forEach(function (item) {
      item.classList.remove("selected");
    });
  });
}

function createGoodieElement(goodie) {
  const goodieDiv = document.createElement("div");
  goodieDiv.className = "goodie";

  const goodieName = document.createElement("small");
  goodieName.textContent = goodie.name;
  goodieDiv.appendChild(goodieName);

  const goodieDescription = document.createElement("p");
  goodieDescription.textContent = goodie.description;
  goodieDiv.appendChild(goodieDescription);

  const goodiePrice = document.createElement("div");
  goodiePrice.className = "price";
  goodiePrice.textContent = `${goodie.price} CHF`;
  goodieDiv.appendChild(goodiePrice);

  //When creating element id 3, show two select pickers for the size and color
  if (goodie.id === 3) {
    const goodieSize = document.createElement("select");
    goodieSize.className = "goodie-size";
    goodieSize.id = `goodie-size-${goodie.id}`;
    goodieSize.name = "goodie-size";
    goodieSize.required = true;
    goodieSize.innerHTML = `
      <option value="" disabled selected>Grösse und Art</option>
      <option value="LangM">Langarm M</option>
      <option value="LangL">Langarm L</option>
      <option value="KurzS">Kurzarm S</option>
      <option value="KurzM">Kurzarm M</option>
      <option value="KurzXL">Kurzarm XL</option>
      `;
    goodieDiv.appendChild(goodieSize);

    /* const goodieColor = document.createElement("select");
    goodieColor.className = "goodie-color";
    goodieColor.id = `goodie-color-${goodie.id}`;
    goodieColor.name = "goodie-color";
    goodieColor.required = true;
    goodieColor.innerHTML = `
      <option value="" disabled selected>Kurzarm</option>
      <option value="White">White</option>
      <option value="Lime">Lime</option>
      <option value="Radiant Purple">Radiant Purple</option>
      <option value="Burgundy">Burgundy</option>`;
    goodieDiv.appendChild(goodieColor); */
  }

  //When creating element id 4, show two select pickers for the size and color

  if (goodie.id === 4) {
    const goodieSize = document.createElement("select");
    goodieSize.className = "goodie-size";
    goodieSize.id = `goodie-size-${goodie.id}`;
    goodieSize.name = "goodie-size";
    goodieSize.required = true;
    goodieSize.innerHTML = `
      <option value="" disabled selected>Grösse und Art</option>
      <option value="LangarmS">Langarm S</option>
      <option value="LangarmM">Langarm M</option>
      <option value="KurzS">Kurzarm S</option>
      <option value="KurzM">Kurzarm M</option>
      <option value="KurzXL">Kurzarm XL</option>
      `;
    goodieDiv.appendChild(goodieSize);

    /* const goodieColor = document.createElement("select");
    goodieColor.className = "goodie-color";
    goodieColor.id = `goodie-color-${goodie.id}`;
    goodieColor.name = "goodie-color";
    goodieColor.required = true;
    goodieColor.innerHTML = `
      <option value="" disabled selected>Langarm</option>
      <option value="White">White</option>
      <option value="Lime">Lime</option>
      <option value="Radiant Purple">Radiant Purple</option>
      <option value="Burgundy">Burgundy</option>`;
    goodieDiv.appendChild(goodieColor); */
  }

  function onBuyButtonClick(goodie) {
    if (goodie.id === 3 || goodie.id === 4) {
      const goodieSize = document.getElementById(`goodie-size-${goodie.id}`);
      //const goodieColor = document.getElementById(`goodie-color-${goodie.id}`);

      // goodieSize and goodieColor are required fields, we need to check if they are selected
      if (!goodieSize.value /*|| !goodieColor.value*/) {
        const existingErrorMessage = goodieDiv.querySelector(".error-message");
        if (!existingErrorMessage) {
          // Create error message
          const errorMessage = document.createElement("small");
          errorMessage.className = "error-message";
          errorMessage.id = `error-message-${goodie.id}`;
          errorMessage.textContent = "Bitte wähle eine Grösse und Art des Shirts aus";
          goodieDiv.appendChild(errorMessage);

          // Remove error message when user selects a size
          goodieSize.addEventListener("change", () => {
            errorMessage.remove();
          });
          /*goodieColor.addEventListener("change", () => {
            errorMessage.remove();
          });*/
        }
        return; // Add this return statement to stop code execution if the required fields are not filled
      }
      const goodieSizeValue =
        goodieSize.options[goodieSize.selectedIndex].value;
      /*const goodieColorValue =
        goodieColor.options[goodieColor.selectedIndex].value;*/
      const goodieName = `${goodie.name} - ${goodieSizeValue}`; //- ${goodieColorValue}
      donateAmount(goodie.price, goodieName);
    } else {
      donateAmount(goodie.price, goodie.name);
      foundingContainer.scrollIntoView({ behavior: 'smooth' });
      //console.log('ScrollToTop');
    }
  }

  const buyButton = document.createElement("button");
  buyButton.className = "goodie-button";
  buyButton.textContent = "Auswählen und spenden";
  // Use the 'onBuyButtonClick' function with the current 'goodie' object as an argument
  buyButton.addEventListener("click", () => onBuyButtonClick(goodie));
  goodieDiv.appendChild(buyButton);
  return goodieDiv;
}

// showRewards function collapses and expands the goodies-container div, when the rewards button is clicked
function showRewards() {
  var rewardsButton = document.getElementById("rewards");
  var rewardsContainer = document.getElementById("goodies-container");
  var currentDisplay = window.getComputedStyle(rewardsContainer).display;

  if (
    currentDisplay === "none" ||
    (window.innerWidth >= 1000 && currentDisplay !== "block")
  ) {
    rewardsContainer.style.display = "block";
    rewardsButton.textContent = "Goodies ausblenden";
  } else {
    rewardsContainer.style.display = "none";
    rewardsButton.textContent = "Goodies anzeigen";
  }
}

// "Jetzt spenden" button scrolls to donation form and focuses the amount input
document.getElementById('goto-top').addEventListener('click', function () {
  foundingContainer.scrollIntoView({ behavior: 'smooth' });

  // Focus on the amount input after scrolling
  setTimeout(() => {
    const amountInput = document.getElementById('amount');
    if (amountInput) {
      amountInput.focus();
    }
  }, 500); // Wait for smooth scroll to complete
});

// Add manual refresh functionality for testing
document.addEventListener('keydown', (e) => {
  // Press Ctrl+R or Cmd+R to manually refresh campaign data
  if ((e.ctrlKey || e.metaKey) && e.key === 'r' && e.shiftKey) {
    e.preventDefault();
    console.log('Manual refresh triggered');
    refreshPageContent();
  }
});