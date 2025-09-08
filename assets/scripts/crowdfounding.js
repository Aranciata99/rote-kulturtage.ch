//const devEnv = "https://d1ca-82-220-89-185.ngrok-free.app";
const devEnv = "http://localhost:3000";

// Get campaign status and update page elements
async function getCampaignStatus() {
  try {
    const response = await axios.get(`${devEnv}/api/campaign-status`);
    return response.data;
  } catch (err) {}
}

// Get goodies and display them on the page
async function getGoodies() {
  try {
    const response = await axios.get(`${devEnv}/api/goodies`);
    return response.data;
  } catch (err) {}
}

async function main() {
  const [status, goodiesList] = await Promise.all([
    getCampaignStatus(),
    getGoodies(),
  ]);

  updateCampaignStatus(status);

  const goodiesContainer = document.getElementById("goodies-container");
  goodiesList.forEach((goodie) => {
    const goodieElement = createGoodieElement(goodie);
    goodiesContainer.appendChild(goodieElement);
  });
  // Add event listener to close the modal
  document.getElementById("modal-close").addEventListener("click", () => {
    document.getElementById("payment-modal").style.display = "none";
    refreshPageContent(); // Refresh content when the modal is closed
    // Come beginning of the page
    window.scrollTo(0, 0);
  });
}

document.getElementById("donate-form").addEventListener("submit", (event) => {
  event.preventDefault();

  const amount = parseInt(document.getElementById("amount").value);
  donateAmount(amount, "Spende");
});

main();

function donateAmount(amount, purpose) {
  const paymentUrl = `https://crowdfundinglora.payrexx.com/de/vpos?amount=${amount}&purpose=${purpose}&currency=CHF`;

  // Open the payment page in the iframe and show the modal
  const iframe = document.getElementById("payment-iframe");
  iframe.src = paymentUrl;
  document.getElementById("payment-modal").style.display = "block";
}
function updateCampaignStatus(status) {
  // Update progress bar
  const progressBar = document.getElementById("progress");
  // const progressText = document.getElementById("progress-text");
  const progressPercentage = (status.amountRaised / status.goal) * 100;
  // progressText.textContent = `${progressPercentage.toFixed(2)}%`;
  progressBar.style.height = `${progressPercentage}%`;

  /* const remainingDays = document.getElementById("remaining-days");

  // Update remaining days
  const today = new Date();
  const endDate = new Date(status.endDate);
  const remainingTime = endDate.getTime() - today.getTime();
  const remainingDaysCount = Math.ceil(remainingTime / (1000 * 3600 * 24));
 remainingDays.textContent = `${remainingDaysCount}`;
*/
  // Update supporters count
  // const supportersCount = document.getElementById("supporters-count");
  // supportersCount.textContent = `${status.supportersCount}`;

  // Update amount raised
  const amountRaisedElement = document.getElementById("amount-raised");
  amountRaisedElement.textContent = `${status.amountRaised} CHF`;

  // Update other elements if needed
}
function refreshPageContent() {
  axios.get(`${devEnv}/api/campaign-status`).then((response) => {
    const status = response.data;
    updateCampaignStatus(status);
  });
}

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

  const goodieDescription = document.createElement("p");
  goodieDescription.textContent = goodie.description;
  goodieDiv.appendChild(goodieDescription);

  const goodiePrice = document.createElement("div");
  goodiePrice.className = "price";
  goodiePrice.textContent = `${goodie.price} CHF`;
  goodieDiv.appendChild(goodiePrice);

  //When creating element id 6 and 7, show two select pickers for the size and color
  if (goodie.id === 6 || goodie.id === 7) {
    const goodieSize = document.createElement("select");
    goodieSize.className = "goodie-size";
    goodieSize.id = `goodie-size-${goodie.id}`;
    goodieSize.name = "goodie-size";
    goodieSize.required = true;
    goodieSize.innerHTML = `
      <option value="" disabled selected>Grösse</option>
      <option value="S">S</option>
      <option value="M">M</option>
      <option value="L">L</option>
      <option value="XL">XL</option>
      <option value="XXL">XXL</option>
      `;
    goodieDiv.appendChild(goodieSize);

    const goodieColor = document.createElement("select");
    goodieColor.className = "goodie-color";
    goodieColor.id = `goodie-color-${goodie.id}`;
    goodieColor.name = "goodie-color";
    goodieColor.required = true;
    goodieColor.innerHTML = `
      <option value="" disabled selected>Farbe</option>
      <option value="White">White</option>
      <option value="Lime">Lime</option>
      <option value="Radiant Purple">Radiant Purple</option>
      <option value="Burgundy">Burgundy</option>`;
    goodieDiv.appendChild(goodieColor);
  }

  function onBuyButtonClick(goodie) {
    if (goodie.id === 6 || goodie.id === 7) {
      const goodieSize = document.getElementById(`goodie-size-${goodie.id}`);
      const goodieColor = document.getElementById(`goodie-color-${goodie.id}`);

      // goodieSize and goodieColor are required fields, we need to check if they are selected
      if (!goodieSize.value || !goodieColor.value) {
        const existingErrorMessage = goodieDiv.querySelector(".error-message");
        if (!existingErrorMessage) {
          // Create error message
          const errorMessage = document.createElement("p");
          errorMessage.className = "error-message";
          errorMessage.id = `error-message-${goodie.id}`;
          errorMessage.textContent = "Bitte wähle eine Grösse und Farbe aus";
          goodieDiv.appendChild(errorMessage);

          // Remove error message when user selects a size and color
          goodieSize.addEventListener("change", () => {
            errorMessage.remove();
          });
          goodieColor.addEventListener("change", () => {
            errorMessage.remove();
          });
        }
        return; // Add this return statement to stop code execution if the required fields are not filled
      }
      const goodieSizeValue =
        goodieSize.options[goodieSize.selectedIndex].value;
      const goodieColorValue =
        goodieColor.options[goodieColor.selectedIndex].value;
      const goodieName = `${goodie.name} - ${goodieSizeValue} - ${goodieColorValue}`;
      donateAmount(goodie.price, goodieName);
    } else {
      donateAmount(goodie.price, goodie.name);
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

// topFunction function scrolls to the top of the page, when the button is clicked
document.getElementById('goto-top').addEventListener('click', function() {
  {const foundingContainer = document.getElementById('foundingCampagneContainer');
    foundingContainer.scrollIntoView({ behavior: 'smooth' });
  }
});
