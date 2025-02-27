document.addEventListener("DOMContentLoaded", () => {
    window.filtrarPeliculas = function () {
        const director = document.getElementById("buscadorDirector").value.trim();
        const actor = document.getElementById("buscadorActor").value.trim();
        const genero = document.getElementById("buscadorGenero").value.trim();
        const nombrePelicula = document.getElementById("buscadorPelicula").value.trim();
        const resultadosDiv = document.getElementById("resultados_filtro");
        const contenidoNormalDiv = document.getElementById("contenido_normal");
        const filtrosDiv = document.getElementById("filtros_aplicados");

        // Si no hay filtros, mostrar el contenido normal y limpiar resultados
        if (!nombrePelicula && !director && !actor && !genero) {
            contenidoNormalDiv.style.display = "block";
            resultadosDiv.innerHTML = "";
            filtrosDiv.innerHTML = "";
            return;
        }

        // Si hay filtros, realizar la búsqueda
        fetch("filtro_peliculas.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `director=${encodeURIComponent(director)}&actor=${encodeURIComponent(actor)}&genero=${encodeURIComponent(genero)}&pelicula=${encodeURIComponent(nombrePelicula)}`
        })

        .then(response => response.text())
        .then(data => {
            // Ocultar contenido original y mostrar solo resultados filtrados
            contenidoNormalDiv.style.display = "none";
            resultadosDiv.innerHTML = data;

            // Mostrar filtros aplicados
            filtrosDiv.innerHTML = `
                <p><strong>Filtros aplicados:</strong></p>
                <ul>
                    <li><strong>Nombre de la pelicula:</strong> ${nombrePelicula || "No especificado"}</li>    
                    <li><strong>Director:</strong> ${director || "No especificado"}</li>
                    <li><strong>Actor:</strong> ${actor || "No especificado"}</li>
                    <li><strong>Género:</strong> ${genero || "No especificado"}</li>
                </ul>
            `;

            // Si no hay resultados
            if (!data.trim()) {
                resultadosDiv.innerHTML = "<p>No se encontraron resultados.</p>";
            }
        })
        .catch(error => {
            console.error("Error al filtrar:", error);
        });
    };
});
