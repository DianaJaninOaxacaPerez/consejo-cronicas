document.addEventListener("DOMContentLoaded", function () {
    const buscador = document.getElementById("buscadorMenu");

    if (!buscador) {
        return;
    }

    const opcionesMenu = document.querySelectorAll(".opcion-menu");
    const tarjetasInicio = document.querySelectorAll(
        ".tarjeta-inicio-buscable"
    );

    let temporizador = null;

    function normalizar(texto) {
        return String(texto || "")
            .toLowerCase()
            .normalize("NFD")
            .replace(/[\u0300-\u036f]/g, "")
            .trim();
    }

    function limpiarResaltados() {
        tarjetasInicio.forEach(function (tarjeta) {
            tarjeta.classList.remove("tarjeta-encontrada");
        });
    }

    function mostrarTodoElMenu() {
        opcionesMenu.forEach(function (opcion) {
            const item = opcion.closest(".nav-item") || opcion;
            item.style.display = "";
        });
    }

    buscador.addEventListener("input", function () {
        const filtro = normalizar(this.value);

        clearTimeout(temporizador);
        limpiarResaltados();

        if (filtro === "") {
            mostrarTodoElMenu();
            return;
        }

        // Buscar dentro de las opciones del menú
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
            mostrarTodoElMenu();
        }

        // Buscar dentro de Misión, Visión, Propósito e Identidad
        const coincidenciasTarjetas = Array.from(tarjetasInicio).filter(
            function (tarjeta) {
                const titulo = tarjeta.querySelector("h3");

                return normalizar(
                    titulo ? titulo.textContent : ""
                ).includes(filtro);
            }
        );

        // No se oculta ninguna tarjeta
        if (coincidenciasTarjetas.length > 0) {
            const tarjetaEncontrada = coincidenciasTarjetas[0];

            temporizador = setTimeout(function () {
                tarjetaEncontrada.classList.add(
                    "tarjeta-encontrada"
                );

                tarjetaEncontrada.scrollIntoView({
                    behavior: "smooth",
                    block: "center"
                });
            }, 200);
        }
    });
});