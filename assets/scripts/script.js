document.getElementById('menuLabel').addEventListener('click', function(event) {
    event.preventDefault(); // Mencegah checkbox berubah keadaan
});

var toggleMenu = document.getElementById('toggleMenu');
toggleMenu.addEventListener('change', function() {
    localStorage.setItem('menuOpen', this.checked);
});

window.addEventListener('DOMContentLoaded', function() {
    var menuOpen = localStorage.getItem('menuOpen');
    if (menuOpen === 'true') {
        toggleMenu.checked = true;
    } else {
        toggleMenu.checked = false;
    }
});
