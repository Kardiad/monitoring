
/**
 * -----------------------
 * Navegacion de pesatañas
 * -----------------------
 * 
 * Este documento te permite cambiar de pestañas. De momento solamente
 * esta preparado para la navegacion principal.
 */
document.addEventListener('DOMContentLoaded', event => {

    let tabs = document.querySelectorAll("[role='tab']");

    tabs[0].classList.toggle("active", true);

    //openContent("page-main-content", tabs[0].id);

    for (let i = 0; i < tabs.length; i++) {
        
        tabs[i].addEventListener('click', function() {

            for (let j = 0; j < tabs.length; j++) {

                tabs[j].classList.remove("active");

            }

            tabs[i].classList.toggle("active", true);

            let idTab = tabs[i].id;

            //openContent("page-main-content", idTab);

        });

    }

    /**
     * ---------------------------
     * Abrir pestañas con Ajax
     * --------------------------
     * 
     * @param {string} viewFolder
     * @param {string} idTab
     * @param {string} idPanel
     */
    function openContent(viewFolder, idTab) {

        fetch("app/Views/" + viewFolder + "/" + idTab + ".php").then(response => response.text()).then(data => {

            let panel = document.querySelector("#js-page-content");

            panel.innerHTML = data;

        });

    }

});