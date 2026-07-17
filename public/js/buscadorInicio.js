document.addEventListener("DOMContentLoaded", function () {

    const buscador = document.getElementById("buscadorMenu");

    if (!buscador) return;

    const opciones = document.querySelectorAll(".opcion-menu");

    function limpiar(texto){
        return texto
            .toLowerCase()
            .normalize("NFD")
            .replace(/[\u0300-\u036f]/g,"");
    }

    buscador.addEventListener("input", function(){

        const filtro = limpiar(this.value);

        opciones.forEach(opcion=>{

            const texto = limpiar(opcion.textContent);

            const mostrar =
                filtro === "" || texto.includes(filtro);

            opcion.closest(".nav-item").style.display =
                mostrar ? "" : "none";

        });

    });

});