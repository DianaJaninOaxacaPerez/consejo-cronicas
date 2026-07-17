document.addEventListener("DOMContentLoaded", function () {
    const buscador = document.getElementById("buscadorMenu");

    if (!buscador) {
        return;
    }

    const opcionesMenu = document.querySelectorAll(".opcion-menu");
    const tarjetasInicio = document.querySelectorAll(
        ".tarjeta-inicio-buscable"
    );

    function normalizar(texto) {
        return String(texto || "")
            .toLowerCase()
            .normalize("NFD")
            .replace(/[\u0300-\u036f]/g, "")
            .trim();
    }

    function restaurarMenu() {
        opcionesMenu.forEach(function (opcion) {
            const item = opcion.closest(".nav-item") || opcion;
            item.style.display = "";
        });
    }

    function restaurarTarjetas() {
        tarjetasInicio.forEach(function (tarjeta) {
            tarjeta.style.removeProperty("display");
            tarjeta.classList.remove("tarjeta-encontrada");
        });
    }

    buscador.addEventListener("input", function () {
        const filtro = normalizar(this.value);

        restaurarTarjetas();

        if (filtro === "") {
            restaurarMenu();
            return;
        }

        /*
         * Buscar en Inicio, Historia, Crónicas,
         * Galería, Eventos, etc.
         */
        const coincidenciasMenu = Array.from(opcionesMenu).filter(
            function (opcion) {
                return normalizar(opcion.textContent).includes(filtro);
            }
        );

        if (coincidenciasMenu.length > 0) {
            opcionesMenu.forEach(function (opcion) {
                const item = opcion.closest(".nav-item") || opcion;
                const coincide = coincidenciasMenu.includes(opcion);

                item.style.display = coincide ? "" : "none";
            });
        } else {
            restaurarMenu();
        }

        /*
         * Buscar en Misión, Visión,
         * Propósito y Nuestra Identidad.
         */
        const coincidenciasTarjetas = Array.from(tarjetasInicio).filter(
            function (tarjeta) {
                const titulo = tarjeta.querySelector("h3");

                return normalizar(
                    titulo ? titulo.textContent : ""
                ).includes(filtro);
            }
        );

        if (coincidenciasTarjetas.length === 0) {
            return;
        }

        tarjetasInicio.forEach(function (tarjeta) {
            const coincide = coincidenciasTarjetas.includes(tarjeta);

            if (coincide) {
                tarjeta.style.removeProperty("display");
                tarjeta.classList.add("tarjeta-encontrada");
            } else {
                tarjeta.style.setProperty(
                    "display",
                    "none",
                    "important"
                );
            }
        });

        const primeraCoincidencia = coincidenciasTarjetas[0];

        setTimeout(function () {
            primeraCoincidencia.scrollIntoView({
                behavior: "smooth",
                block: "center"
            });
        }, 150);
    });
});