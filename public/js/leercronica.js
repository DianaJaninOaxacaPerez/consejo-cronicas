function mostrarCronica(botonLeer) {
    const tarjetaActual = botonLeer.closest(".cronica-card");
    const cardContent = botonLeer.closest(".cronica-card__contenido");
    const contenedor = botonLeer.closest(".cronicas-grid");

    if (!tarjetaActual || !cardContent || !contenedor) {
        console.error("No se encontró la estructura de la crónica.");
        return;
    }

    const todasLasTarjetas =
        contenedor.querySelectorAll(".cronica-card");

    let contenidoDiv =
        cardContent.querySelector(".contenido-cronica");

    const accionesLeer =
        botonLeer.closest(".acciones-cronica");

    // Oculta las demás tarjetas.
    todasLasTarjetas.forEach(function (tarjeta) {
        if (tarjeta !== tarjetaActual) {
            tarjeta.style.setProperty(
                "display",
                "none",
                "important"
            );
        }
    });

    // Expande la tarjeta seleccionada.
    tarjetaActual.classList.add("cronica-card--abierta");

    const imagenContenedor =
    tarjetaActual.querySelector(".cronica-card__imagen-contenedor");

const autor =
    cardContent.querySelector("h4");

if (imagenContenedor && autor) {
    autor.insertAdjacentElement(
        "afterend",
        imagenContenedor
    );
}
    // Oculta el botón Leer Crónica.
    if (accionesLeer) {
        accionesLeer.hidden = true;
    }

    // Crea el contenido solo la primera vez.
    if (!contenidoDiv) {
        contenidoDiv = document.createElement("div");
        contenidoDiv.className = "contenido-cronica";

        const textoLargo =
            botonLeer.dataset.contenido ||
            "Contenido no disponible.";

        const parrafo = document.createElement("p");
        parrafo.className = "contenido-cronica__texto";
        parrafo.textContent = textoLargo;

        const accionesVolver = document.createElement("div");
        accionesVolver.className =
            "acciones-cronica acciones-cronica--cerrar";

        const botonVolver = document.createElement("button");
        botonVolver.type = "button";
        botonVolver.className =
            "btn-pill btn-cerrar-cronica";
        botonVolver.textContent = "← Volver";

        botonVolver.addEventListener("click", function () {
            cerrarCronica(this);
        });

        accionesVolver.appendChild(botonVolver);
        contenidoDiv.appendChild(parrafo);
        contenidoDiv.appendChild(accionesVolver);
        cardContent.appendChild(contenidoDiv);
    }

    contenidoDiv.hidden = false;

    setTimeout(function () {
        tarjetaActual.scrollIntoView({
            behavior: "smooth",
            block: "start"
        });
    }, 100);
}

function cerrarCronica(botonVolver) {
    const contenidoDiv =
        botonVolver.closest(".contenido-cronica");

    const tarjetaActual =
        botonVolver.closest(".cronica-card");

    const contenedor =
        botonVolver.closest(".cronicas-grid");

    if (!contenidoDiv || !tarjetaActual || !contenedor) {
        return;
    }

    const todasLasTarjetas =
        contenedor.querySelectorAll(".cronica-card");

    // Oculta el contenido largo.
    contenidoDiv.hidden = true;

    // Quita el ancho completo.
    tarjetaActual.classList.remove("cronica-card--abierta");
    const imagenContenedor =
    tarjetaActual.querySelector(".cronica-card__imagen-contenedor");

if (imagenContenedor) {
    tarjetaActual.insertBefore(
        imagenContenedor,
        tarjetaActual.firstChild
    );
}

    // Muestra nuevamente todas las tarjetas.
    todasLasTarjetas.forEach(function (tarjeta) {
        tarjeta.style.removeProperty("display");
    });

    // Muestra otra vez el botón Leer Crónica.
    const cardContent =
        tarjetaActual.querySelector(".cronica-card__contenido");

    if (cardContent) {
        const botonLeer =
            cardContent.querySelector(".btn-leer-cronica");

        const accionesLeer =
            botonLeer?.closest(".acciones-cronica");

        if (accionesLeer) {
            accionesLeer.hidden = false;
        }
    }

    setTimeout(function () {
        tarjetaActual.scrollIntoView({
            behavior: "smooth",
            block: "center"
        });
    }, 100);
}