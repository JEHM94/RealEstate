document.addEventListener('DOMContentLoaded', function () {
    eventListeners();
    darkMode();
});
function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', responsiveNavigation);
}

function responsiveNavigation() {
    const navigation = document.querySelector('.navigation');
    const right = document.querySelector('.right');

    navigation.classList.toggle('show');
    right.classList.toggle('show');
}

function darkMode() {
    const buttonDarkMode = document.querySelector('.dark-mode-btn');
    buttonDarkMode.addEventListener('click', function(){
        document.body.classList.toggle('dark');
    });
}