function mostrarCronica(botonLeer) {
    const cardContent = botonLeer.closest(".cronica-card__contenido");

    if (!cardContent) {
        console.error("No se encontró .cronica-card__contenido");
        return;
    }

    const accionesLeer = botonLeer.closest(".acciones-cronica");
    let contenidoDiv = cardContent.querySelector(".contenido-cronica");

    // Ocultar el botón Leer Crónica.
    if (accionesLeer) {
        accionesLeer.hidden = true;
    }

    // Crear el contenido únicamente la primera vez.
    if (!contenidoDiv) {
        contenidoDiv = document.createElement("div");
        contenidoDiv.className = "contenido-cronica";

        const textoLargo =
            botonLeer.dataset.contenido || "Contenido no disponible.";

        const parrafo = document.createElement("p");
        parrafo.className = "contenido-cronica__texto";
        parrafo.textContent = textoLargo;

        const accionesVolver = document.createElement("div");
        accionesVolver.className =
            "acciones-cronica acciones-cronica--cerrar";

        const botonVolver = document.createElement("button");
        botonVolver.type = "button";
        botonVolver.className = "btn-pill btn-cerrar-cronica";
        botonVolver.textContent = "← Volver";

        botonVolver.addEventListener("click", function () {
            cerrarCronica(this);
        });

        accionesVolver.appendChild(botonVolver);
        contenidoDiv.appendChild(parrafo);
        contenidoDiv.appendChild(accionesVolver);
        cardContent.appendChild(contenidoDiv);
    }

    // Mostrar el contenido completo.
    contenidoDiv.hidden = false;

    // Desplazar la vista hasta el texto completo.
    setTimeout(function () {
        contenidoDiv.scrollIntoView({
            behavior: "smooth",
            block: "center"
        });
    }, 100);
}

function cerrarCronica(botonVolver) {
    const contenidoDiv = botonVolver.closest(".contenido-cronica");

    if (!contenidoDiv) {
        return;
    }

    const cardContent = contenidoDiv.closest(
        ".cronica-card__contenido"
    );

    const card = contenidoDiv.closest(".cronica-card");

    // Ocultar texto completo.
    contenidoDiv.hidden = true;

    // Mostrar nuevamente Leer Crónica.
    if (cardContent) {
        const botonLeer =
            cardContent.querySelector(".btn-leer-cronica");

        const accionesLeer =
            botonLeer?.closest(".acciones-cronica");

        if (accionesLeer) {
            accionesLeer.hidden = false;
        }
    }

    // Regresar a la tarjeta.
    if (card) {
        setTimeout(function () {
            card.scrollIntoView({
                behavior: "smooth",
                block: "center"
            });
        }, 100);
    }
}