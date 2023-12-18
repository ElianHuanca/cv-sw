document.addEventListener("DOMContentLoaded", function () {
    console.log("Intentanto cargar el script de area.js");
    const areaSelect = document.getElementById("areaSelect");
    const listaTrabajo = document.getElementById("listaTrabajo");

    areaSelect.addEventListener("change", function () {
        const selectedArea = areaSelect.value;

        // Mostrar todos los productos si se selecciona "Todas las categorías"
        if (selectedArea === "todas") {
            listaTrabajo.querySelectorAll(".trabajo").forEach(function (trabajo) {
                trabajo.style.display = "block";
            });
            return;
        }

        // Ocultar todos los productos y mostrar solo los de la categoría seleccionada
        listaTrabajo.querySelectorAll(".trabajo").forEach(function (trabajo) {
            const trabajoArea = trabajo.getAttribute("data-area");
            if (trabajoArea === selectedArea) {
                trabajo.style.display = "block";
            } else {
                trabajo.style.display = "none";
            }
        });

        var rows = Array.from(listaTrabajo.querySelectorAll(".trabajo"));
        rows.sort(function (a, b) {
            return a.dataset.area.localeCompare(b.dataset.area);
        });

        listaTrabajo.innerHTML = "";
        rows.forEach(function (row) {
            listaTrabajo.appendChild(row);
        });
    });
});