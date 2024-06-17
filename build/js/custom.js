document.addEventListener('DOMContentLoaded', (event) => {
    document.getElementById("btn_menu").addEventListener("click", mostrar_menu);
    document.getElementById("back_menu").addEventListener("click", ocultar_menu);

    const nav = document.getElementById("menu1");
    const background_menu = document.getElementById("back_menu");

    function mostrar_menu() {
        nav.style.right = "0px";
        background_menu.style.display = "block";
    }

    function ocultar_menu() {
        nav.style.right = "-250px";
        background_menu.style.display = "none";
    }
});





