document.addEventListener("DOMContentLoaded", function () {
    const inputBusqueda = document.getElementById("inputBusqueda");

    // Evita errores en páginas que no contienen buscador.
    if (!inputBusqueda) {
        return;
    }

    inputBusqueda.addEventListener("input", function () {
        const filtro = inputBusqueda.value.toLowerCase().trim();

        // Elimina el mensaje anterior.
        const mensajeAnterior = document.getElementById(
            "sin-resultados-busqueda"
        );

        if (mensajeAnterior) {
            mensajeAnterior.remove();
        }

        /*
         * CASO 1: tablas administrativas, como Crónicas.
         */
        const filasTabla = document.querySelectorAll(
            ".admin-table tbody tr.fila-cronica"
        );

        if (filasTabla.length > 0) {
            let encontrados = 0;

            filasTabla.forEach(function (fila) {
                const texto = fila.textContent.toLowerCase().trim();
                const coincide =
                    filtro === "" || texto.includes(filtro);

                fila.style.display = coincide ? "" : "none";

                if (coincide && filtro !== "") {
                    encontrados++;
                }
            });

            if (filtro !== "" && encontrados === 0) {
                mostrarMensajeEnTabla();
            }

            return;
        }

        /*
         * CASO 2: tarjetas de Historia y otros módulos.
         */
        const tarjetas = document.querySelectorAll(
    ".historia-card, " +
    ".historia-item, " +
    ".cronica-card, " +
    ".feed-card, " +
    ".opcion-card, " +
    ".tarjeta-entrevista, " +
    ".gallery-item-container, " +
    ".gallery img"
);

        let encontrados = 0;

        tarjetas.forEach(function (tarjeta) {
    let texto = tarjeta.textContent.toLowerCase().trim();

    // Lee datos directamente del elemento.
    const tituloData =
        tarjeta.dataset.title?.toLowerCase().trim() || "";

    const descripcionData =
        tarjeta.dataset.description?.toLowerCase().trim() || "";

    // Si es un contenedor, busca también la imagen interna.
    const imagenInterna = tarjeta.querySelector
        ? tarjeta.querySelector("img")
        : null;

    const tituloImagen =
        imagenInterna?.dataset.title?.toLowerCase().trim() || "";

    const descripcionImagen =
        imagenInterna?.dataset.description?.toLowerCase().trim() || "";

    texto = `
        ${texto}
        ${tituloData}
        ${descripcionData}
        ${tituloImagen}
        ${descripcionImagen}
    `.toLowerCase().trim();

    const coincide =
        filtro === "" || texto.includes(filtro);

    // Las imágenes públicas deben regresar como block.
    let displayVisible = "";

    if (tarjeta.matches(".gallery img")) {
        displayVisible = "block";
    } else if (tarjeta.matches(".gallery-item-container")) {
        displayVisible = "flex";
    }

    tarjeta.style.setProperty(
        "display",
        coincide ? displayVisible : "none",
        "important"
    );

    if (coincide && filtro !== "") {
        encontrados++;
    }
});

        if (
            filtro !== "" &&
            encontrados === 0 &&
            tarjetas.length > 0
        ) {
            mostrarMensajeEnTarjetas();
        }
    });
});

function mostrarMensajeEnTabla() {
    const tbody = document.querySelector(".admin-table tbody");

    if (!tbody) {
        return;
    }

    const fila = document.createElement("tr");
    fila.id = "sin-resultados-busqueda";

    fila.innerHTML = `
        <td colspan="5"
            style="
                text-align:center;
                padding:30px;
                color:#666;
                font-family:'Poppins', sans-serif;
            ">
            No se encontraron resultados para la búsqueda.
        </td>
    `;

    tbody.appendChild(fila);
}

function mostrarMensajeEnTarjetas() {
    const contenedor = document.querySelector(
        ".cards, .cards-cronicas, .feed-container, .gallery"
    );

    if (!contenedor) {
        return;
    }

    const mensaje = document.createElement("p");
    mensaje.id = "sin-resultados-busqueda";
    mensaje.textContent =
        "No se encontraron resultados para la búsqueda.";

    mensaje.style.cssText = `
        grid-column: 1 / -1;
        width: 100%;
        text-align: center;
        padding: 40px 10px;
        color: #666;
        font-family: 'Poppins', sans-serif;
    `;

    contenedor.appendChild(mensaje);
}