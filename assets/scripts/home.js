var black = true;

const homeContainer = document.getElementById('homeContainer');
const homeBlackPic = document.getElementById('homeBlackPic');
const homeText = document.getElementById('homeText');

homeContainer.addEventListener('click', () => {
    if (window.innerWidth >= 900) {
        if (black == true) {
            homeBlackPic.classList.add('clicked');
            homeText.classList.add('clicked');
            black = false;
        } else {
            homeBlackPic.classList.remove('clicked');
            homeText.classList.remove('clicked');
            black = true;
        }
    }
});