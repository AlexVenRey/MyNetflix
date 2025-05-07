// Función para pasar los datos de la película seleccionada
function cambiarVideo(videoSrc, posterSrc, logoSrc, detallesSrc, generoSrc, directorSrc, actoresSrc, idPelicula) {
    // Pasamos el video (trailer)
    var video = document.getElementById('backgroundVideo');
    // Pasamos la imagen de fondo
    var backgroundImg = document.getElementById('backgroundImage');
    // Pasamos el logo
    var logoImg = document.getElementById('logoImage');
    // Pasamos la descripción
    var detallesText = document.getElementById('detallesText');
    // Pasamos el genero
    var generoText = document.getElementById('generoText');
    // Pasamos el director
    var directorText = document.getElementById('directorText');
    // Pasamos los actores (concatenados)
    var actoresText = document.getElementById('actoresText');
    // Pasamos la ruta de la película seleccionada
    video.src = '../video/' + videoSrc;
    // Pasamos la ruta de la portada de la película seleccionada
    video.poster = '../img/' + posterSrc;
    // Recargamos el video (se aplican los cambios)
    video.load();
    // Reproducimos el nuevo vídeo
    video.play();
    // Pasamos la ruta de la portada de la película seleccionada
    backgroundImg.src = '../img/' + posterSrc;
    // Pasamos la ruta del logo de la película seleccionada
    logoImg.src = '../img/' + logoSrc;
    // Pasamos todos los detalles de la película seleccionada
    detallesText.textContent = detallesSrc;
    generoText.textContent = generoSrc;
    directorText.textContent = directorSrc;
    actoresText.textContent = actoresSrc;

    // Actualizar ID de película en el botón like
    var likeContainer = document.querySelector(".like-container");
    likeContainer.setAttribute("pelicula-id", idPelicula);
    var videoContainer = document.querySelector(".ver-video")
    videoContainer.setAttribute("pelicula-id", idPelicula);

    // Resetear estado visual del like
    comprobarEstadoLike(idPelicula, likeContainer.getAttribute("usuario-id"), likeContainer.querySelector("img"));

    // Eliminar clase 'liked' si estaba puesta (por si se cambió antes)
    likeContainer.classList.remove("liked");
}

function darLike(buttonElement) {
    const likeContainer = buttonElement.closest(".like-container");
    const peliculaId = likeContainer.getAttribute("pelicula-id");
    const usuarioId = likeContainer.getAttribute("usuario-id");
    const img = buttonElement.querySelector("img");

    fetch(`./darLike.php?peliculaId=${peliculaId}&usuarioId=${usuarioId}`)
        .then(response => response.text())
        .then(respuesta => {
            console.log(respuesta);

            // Alternar estado visual del like (imagen + clase)
            if (likeContainer.classList.contains("liked")) {
                likeContainer.classList.remove("liked");
                img.src = "../img/like.jpg";
                likeEstado = false;
            } else {
                likeContainer.classList.add("liked");
                img.src = "../img/like_blanco.jpg";
                likeEstado = true;
            }
        })
        .catch(error => console.error("Error al dar/retirar like:", error));
}



// Variable global para almacenar el estado del like
var likeEstado = false;

function comprobarEstadoLike(peliculaId, usuarioId, elementoImg) {
    fetch('./comprobarLike.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            usuarioId: usuarioId,
            peliculaId: peliculaId
        })
    })
    .then(res => res.json())
    .then(datosJson => {
        // Guardar el estado del like en la variable global
        likeEstado = datosJson.likeEstado;

        // Ahora puedes usar likeEstado para actualizar la imagen
        if (likeEstado) {
            elementoImg.src = "../img/like_blanco.jpg";
            elementoImg.closest(".like-container").classList.add("liked"); // Marcar como "liked"
        } else {
            elementoImg.src = "../img/like.jpg";
            elementoImg.closest(".like-container").classList.remove("liked"); // Eliminar "liked"
        }
    })
    .catch(error => console.error("Error al comprobar el like:", error));
}

function mostrarLikeBlanco(element) {
    const likeContainer = element.closest(".like-container");
    // Si el like ya ha sido dado, no cambiar la imagen
    if (likeContainer.classList.contains("liked")) {
        return; // Si ya tiene la clase "liked", no hacer nada
    }
    
    const img = element.querySelector("img");
    if (img) {
        img.src = "../img/like_blanco.jpg";
    }
}

function ocultarLikeBlanco(element) {
    const likeContainer = element.closest(".like-container");
    // Si el like ya ha sido dado, no cambiar la imagen
    if (likeContainer.classList.contains("liked")) {
        return; // Si ya tiene la clase "liked", no hacer nada
    }
    
    const img = element.querySelector("img");
    if (img) {
        img.src = "../img/like.jpg";
    }
}

function verPelicula(buttonElement) {
    const peliculaId = buttonElement.getAttribute("pelicula-id");
    window.location.href = `verPelicula.php?peliculaId=${peliculaId}`;
}
