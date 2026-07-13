function mostrarCronica(botonLeer) {
    // Compatibilidad con crónicas estáticas, si todavía las utilizas.
    if (
        typeof botonLeer === "number" ||
        typeof botonLeer === "string"
    ) {
        const contenido = document.getElementById(`cronica-${botonLeer}`);

        if (contenido) {
            contenido.classList.toggle("mostrar");
        }

        return;
    }

    // Busca el contenido completo de la tarjeta.
    const cardContent = botonLeer.closest(".card-content");

    if (!cardContent) {
        return;
    }

    let contenidoDiv = cardContent.querySelector(".contenido-cronica");

    // Oculta el botón Leer Crónica.
    botonLeer.style.display = "none";

    // Si todavía no existe el texto largo, se crea.
    if (!contenidoDiv) {
        contenidoDiv = document.createElement("div");
        contenidoDiv.className = "contenido-cronica";

        const textoLargo =
            botonLeer.getAttribute("data-contenido") ||
            "Contenido no disponible.";

        contenidoDiv.innerHTML = `
            <p>${textoLargo}</p>

            <div class="acciones-cronica acciones-cronica--cerrar">
                <button
                    type="button"
                    class="btn-pill btn-cerrar-cronica"
                    onclick="cerrarCronica(this)"
                >
                    ← Volver
                </button>
            </div>
        `;

        cardContent.appendChild(contenidoDiv);
    }

    // Muestra el texto largo.
    contenidoDiv.classList.add("mostrar");
}

function cerrarCronica(botonVolver) {
    const contenidoDiv = botonVolver.closest(".contenido-cronica");

    if (!contenidoDiv) {
        return;
    }

    const cardContent = contenidoDiv.closest(".card-content");
    const card = contenidoDiv.closest(".cronica-card");

    // Oculta el texto completo.
    contenidoDiv.classList.remove("mostrar");

    // Vuelve a mostrar el botón Leer Crónica.
    if (cardContent) {
        const botonLeer = cardContent.querySelector(".btn-leer-cronica");

        if (botonLeer) {
            botonLeer.style.display = "inline-block";
        }
    }

    // Regresa suavemente al inicio de la tarjeta.
    if (card) {
        card.scrollIntoView({
            behavior: "smooth",
            block: "start"
        });
    }
}