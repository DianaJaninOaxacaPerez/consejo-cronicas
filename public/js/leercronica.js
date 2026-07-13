function mostrarCronica(elemento) {
    // 1. Si el elemento es un número o texto (Caso de la tarjeta estática)
    if (typeof elemento === 'number' || typeof elemento === 'string') {
        const contenido = document.getElementById(`cronica-${elemento}`);
        if (contenido) {
            contenido.classList.toggle("mostrar");
        }
        return;
    }

    // 2. Si el elemento es el botón "this" (Caso de las tarjetas de la Base de Datos)
    const cardContent = elemento.parentElement;
    let contenidoDiv = cardContent.querySelector(".contenido-cronica");

    // Si no existe el contenedor del texto, lo creamos e inyectamos el contenido
    if (!contenidoDiv) {
        contenidoDiv = document.createElement("div");
        contenidoDiv.className = "contenido-cronica";

        // Jalamos el texto que guardaste en el 'data-contenido' de PHP
        const textoLargo = elemento.getAttribute("data-contenido");

        contenidoDiv.innerHTML = `
            <p>${textoLargo}</p>
            <div class="acciones-cronica acciones-cronica--cerrar">
                <button type="button" class="btn-pill btn-cerrar-cronica" onclick="cerrarCronica(this)">
                    ← Volver
                </button>
            </div>
        `;
        cardContent.appendChild(contenidoDiv);

        // Le damos un momento para que la animación de CSS funcione bien
        setTimeout(() => {
            contenidoDiv.classList.add("mostrar");
        }, 10);
    } else {
        // Si ya existía, solo lo esconde o lo muestra
        contenidoDiv.classList.toggle("mostrar");
    }
}

function cerrarCronica(boton) {
    const contenidoDiv = boton.closest(".contenido-cronica");
    if (!contenidoDiv) return;

    contenidoDiv.classList.remove("mostrar");

    // Regresa la vista al inicio de la tarjeta para que el usuario no quede
    // viendo un espacio vacío donde estaba el texto largo
    const card = contenidoDiv.closest(".cronica-card");
    if (card) {
        card.scrollIntoView({ behavior: "smooth", block: "start" });
    }
}