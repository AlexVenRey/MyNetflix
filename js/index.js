// Funcion para pasar los datos de la pelicula seleccionada
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
    video.src = './video/'+videoSrc;
    // Pasamos la ruta de la portada de la película seleccionada
    video.poster = './img/'+posterSrc;
    // Recargamos el video (se aplican los cambios)
    video.load();
    // Reproducimos el nuevo vídeo
    video.play();
    // Pasamos la ruta de la portada de la película seleccionada
    backgroundImg.src = './img/'+posterSrc;
    // Pasamos la ruta del logo de la película seleccionada
    logoImg.src = './img/'+logoSrc;
    // Pasamos todos los detalles de la película seleccionada
    detallesText.textContent = detallesSrc;
    generoText.textContent = generoSrc;
    directorText.textContent = directorSrc;
    actoresText.textContent = actoresSrc;

    // Pasamos la id de la película al botón de Like
    var likeContainer = document.querySelector(".like-container");
    likeContainer.setAttribute("pelicula-id", idPelicula);

    // Pasamos la id de la película al botón de Like
    var dislikeContainer = document.querySelector(".dislike-container");
    dislikeContainer.setAttribute("pelicula-id", idPelicula);
}
function darLike(accion) {
    var likeContainer = document.querySelector(".like-container");
    var peliculaId = likeContainer.getAttribute("pelicula-id");
    var usuarioId = likeContainer.getAttribute("usuario-id");

    var url = "./DarLike.php?peliculaId=" + peliculaId + "&usuarioId=" + usuarioId + "&accion=" + accion;
    // Redirecciona a la URL
    window.location.href = url;

    mostrarLikeBlanco(likeContainer);
}

function darDislike(accion) {
    var dislikeContainer = document.querySelector(".dislike-container");
    var peliculaId = dislikeContainer.getAttribute("pelicula-id");
    var usuarioId = dislikeContainer.getAttribute("usuario-id");

    var url = "./DarLike.php?peliculaId=" + peliculaId + "&usuarioId=" + usuarioId + "&accion=" + accion;

    // Redirecciona a la URL
    window.location.href = url;
            
    mostrarDislikeBlanco(dislikeContainer);
}

function mostrarLikeBlanco(element) {
    // Seleccionamos el contenedor del like
    var likeContainer = element.parentElement; 
    var likeBlancoButton = likeContainer.querySelector(".like-blanco-button");
    // Mostramos el like en blanco
    likeBlancoButton.style.display = "inline-block";
}

function ocultarLikeBlanco(element) {
    // Seleccionamos el contenedor del like
    var likeContainer = element.parentElement;
    var likeBlancoButton = likeContainer.querySelector(".like-blanco-button");
    // Ocultamos el like en blanco
    likeBlancoButton.style.display = "none"; 
}

function mostrarDislikeBlanco(element) {
    // Seleccionamos el contenedor del dislike
    var dislikeContainer = element.parentElement;
    var dislikeBlancoButton = dislikeContainer.querySelector(".dislike-blanco-button");
    // Mostramos el dislike en blanco
    dislikeBlancoButton.style.display = "inline-block";
}

function ocultarDislikeBlanco(element) {
    // Seleccionamos el contenedor del dislike
    var dislikeContainer = element.parentElement;
    var dislikeBlancoButton = dislikeContainer.querySelector(".dislike-blanco-button");
    // Ocultamos el dislike en blanco
    dislikeBlancoButton.style.display = "none";
}
// Funcion para pasar los datos de la pelicula seleccionada
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
    video.src = './video/'+videoSrc;
    // Pasamos la ruta de la portada de la película seleccionada
    video.poster = './img/'+posterSrc;
    // Recargamos el video (se aplican los cambios)
    video.load();
    // Reproducimos el nuevo vídeo
    video.play();
    // Pasamos la ruta de la portada de la película seleccionada
    backgroundImg.src = './img/'+posterSrc;
    // Pasamos la ruta del logo de la película seleccionada
    logoImg.src = './img/'+logoSrc;
    // Pasamos todos los detalles de la película seleccionada
    detallesText.textContent = detallesSrc;
    generoText.textContent = generoSrc;
    directorText.textContent = directorSrc;
    actoresText.textContent = actoresSrc;

    // Pasamos la id de la película al botón de Like
    var likeContainer = document.querySelector(".like-container");
    likeContainer.setAttribute("pelicula-id", idPelicula);

    // Pasamos la id de la película al botón de Like
    var dislikeContainer = document.querySelector(".dislike-container");
    dislikeContainer.setAttribute("pelicula-id", idPelicula);
}
function darLike(accion) {
    var likeContainer = document.querySelector(".like-container");
    var peliculaId = likeContainer.getAttribute("pelicula-id");
    var usuarioId = likeContainer.getAttribute("usuario-id");

    var url = "./DarLike.php?peliculaId=" + peliculaId + "&usuarioId=" + usuarioId + "&accion=" + accion;
    // Redirecciona a la URL
    window.location.href = url;

    mostrarLikeBlanco(likeContainer);
}

function darDislike(accion) {
    var dislikeContainer = document.querySelector(".dislike-container");
    var peliculaId = dislikeContainer.getAttribute("pelicula-id");
    var usuarioId = dislikeContainer.getAttribute("usuario-id");

    var url = "./DarLike.php?peliculaId=" + peliculaId + "&usuarioId=" + usuarioId + "&accion=" + accion;

    // Redirecciona a la URL
    window.location.href = url;
            
    mostrarDislikeBlanco(dislikeContainer);
}

function mostrarLikeBlanco(element) {
    // Seleccionamos el contenedor del like
    var likeContainer = element.parentElement; 
    var likeBlancoButton = likeContainer.querySelector(".like-blanco-button");
    // Mostramos el like en blanco
    likeBlancoButton.style.display = "inline-block";
}

function ocultarLikeBlanco(element) {
    // Seleccionamos el contenedor del like
    var likeContainer = element.parentElement;
    var likeBlancoButton = likeContainer.querySelector(".like-blanco-button");
    // Ocultamos el like en blanco
    likeBlancoButton.style.display = "none"; 
}

function mostrarDislikeBlanco(element) {
    // Seleccionamos el contenedor del dislike
    var dislikeContainer = element.parentElement;
    var dislikeBlancoButton = dislikeContainer.querySelector(".dislike-blanco-button");
    // Mostramos el dislike en blanco
    dislikeBlancoButton.style.display = "inline-block";
}

function ocultarDislikeBlanco(element) {
    // Seleccionamos el contenedor del dislike
    var dislikeContainer = element.parentElement;
    var dislikeBlancoButton = dislikeContainer.querySelector(".dislike-blanco-button");
    // Ocultamos el dislike en blanco
    dislikeBlancoButton.style.display = "none";
}