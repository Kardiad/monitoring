
document.addEventListener("DOMContentLoaded", evt => {

    const dropIcon = document.querySelector("#navbarDropdown");

    const dropMenu = document.querySelector('.dropdown-menu');

    dropIcon.addEventListener('click', function() {

        dropMenu.classList.toggle('show');

    });

    document.addEventListener('click', function(event) {

        if (event.target != dropIcon) {

            dropMenu.classList.remove('show');

        }

    });

});