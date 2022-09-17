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
    const darkModePreference = window.matchMedia('(prefers-color-scheme: dark)');

    darkModePreference.addEventListener('change', setDarkModePreference(darkModePreference.matches));

    setDarkModePreference(darkModePreference.matches)

    function setDarkModePreference(isSystemDark){
        if (isSystemDark) {
            document.body.classList.add('dark');
        } else {
            document.body.classList.remove('dark');
        }
    }

    buttonDarkMode.addEventListener('click', function () {
        document.body.classList.toggle('dark');
    });
}