var about = false;
var contact = false;

//Programm
const pScroller = document.getElementById('programmScroller');
const pOpenBtn = document.getElementById('programmInbutton');
const pCloseBtn = document.getElementById('closeProgrammScroller');
const pGrid = document.querySelectorAll('.programmTag');
//About
const aScroller = document.getElementById('aboutScroller');
const aOpenBtn = document.getElementById('aboutInbutton');
const aCloseBtn = document.getElementById('closeAboutScroller');
//Contact
const cScroller = document.getElementById('contactScroller');
const cOpenBtn = document.getElementById('contactInButton');
const cCloseBtn = document.getElementById('closeContactScroller');
//footer
const footer = document.getElementById('footer');



//Programm

pOpenBtn.addEventListener('click', () => {
    pScroller.classList.add('open');
});

pCloseBtn.addEventListener('click', () => {
    pScroller.classList.remove('open');
});

//About

aOpenBtn.addEventListener('click', () => {
    about = true;
    aScroller.classList.add('open');
    if (contact == true) {
        pOpenBtn.classList.add('aboutContactOpen');
        pScroller.classList.add('aboutContactOpen');
        pGrid.forEach(el => el.classList.add('aboutContactOpen'));
    } else {
        pScroller.classList.add('contactOpen');
        pGrid.forEach(el => el.classList.add('contactOpen'));
    }
});

aCloseBtn.addEventListener('click', () => {
    about = false;
    aScroller.classList.remove('open');
    if (contact == true) {
        pScroller.classList.remove('aboutContactOpen');
        pGrid.forEach(el => el.classList.remove('aboutContactOpen'));
    } else {
        pScroller.classList.remove('contactOpen');
        pGrid.forEach(el => el.classList.remove('contactOpen'));
    }
});

//Contact

cOpenBtn.addEventListener('click', () => {
    contact = true;
    cScroller.classList.add('open');
    if (about == true) {
        pOpenBtn.classList.add('contactOpen');
        pScroller.classList.add('aboutContactOpen');
        pGrid.forEach(el => el.classList.add('aboutContactOpen'));
        aOpenBtn.classList.add('contactOpen');
        aScroller.classList.add('contactOpen');
        footer.classList.add('contactOpen');
    } else {
        pOpenBtn.classList.add('contactOpen');
        pScroller.classList.add('contactOpen');
        pGrid.forEach(el => el.classList.add('contactOpen'));
        aOpenBtn.classList.add('contactOpen');
        aScroller.classList.add('contactOpen');
        footer.classList.add('contactOpen');
    }
});

cCloseBtn.addEventListener('click', () => {
    contact = false;
    cScroller.classList.remove('open');
    if (about == true) {
        pOpenBtn.classList.remove('contactOpen');
        pScroller.classList.remove('aboutContactOpen');
        pGrid.forEach(el => el.classList.remove('aboutContactOpen'));
        aOpenBtn.classList.remove('contactOpen');
        aScroller.classList.remove('contactOpen');
        footer.classList.remove('contactOpen');
    } else {
        pOpenBtn.classList.remove('contactOpen');
        pScroller.classList.remove('contactOpen');
        pGrid.forEach(el => el.classList.remove('contactOpen'));
        aOpenBtn.classList.remove('contactOpen');
        aScroller.classList.remove('contactOpen');
        footer.classList.remove('contactOpen');
    }
});
