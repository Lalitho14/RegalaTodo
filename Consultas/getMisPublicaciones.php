<?php
$conexion = mysqli_connect("localhost", "root", "", "regalatodo");
$idCliente = $_SESSION['id_cliente'];
$query = "SELECT * FROM articulo WHERE id_Cliente = " . $idCliente;

$result = mysqli_query($conexion, $query);

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_array($result)) {

    $idArticulo = $row['idArticulo'];
    $queryImagenes = "SELECT * FROM imagenesarticulo WHERE id_Articulo = $idArticulo";
    $resultImagenes = mysqli_query($conexion, $queryImagenes);

    echo '<div class="mb-4 w-100">';

    echo '<div id="carouselArticulo' . $row['idArticulo'] . '" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">';

    $isActive = true;

    while ($rowImagenes = mysqli_fetch_array($resultImagenes)) {
      echo '<div class="carousel-item' . ($isActive ? ' active' : '') . '">
                    <img src="../imagenes/' . $rowImagenes['ruta'] . '" class="d-block mx-auto w-50" style="max-height: 300px; object-fit: cover;" alt="Imagen del artículo">
                  </div>';
      $isActive = false;
    }

    // Cerramos el carrusel
    echo '</div>';

    // Controles del carrusel
    echo '<button class="carousel-control-prev" type="button" data-bs-target="#carouselArticulo' . $row['idArticulo'] . '" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselArticulo' . $row['idArticulo'] . '" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>';  // Fin del carrusel

    echo '<div class="px-3 py-3">
                <h5 class="mb-3">' . $row['nombre'] . '</h5>
                <p class="mb-3">' . $row['descripcion'] . '</p>
                <p><strong>Publicación:</strong> ' . $row['publicacion'] . '</p>
                <p><strong>Localidad:</strong> ' . $row['localidad'] . '</p>
                <a href="../controllers/eliminar.php?id=' . $row['idArticulo'] . '&tipo=cliente" class="btn btn-danger">Eliminar</a>
                <a href="../Cliente/editarPublicacion.php?id=' . $row['idArticulo'] . '" class="btn btn-success">Editar</a>
                </div>';
    // Cerramos el div del artículo
    echo '</div>';
  }
} else {
  echo '
		<div class="container text-center">
			<div class="row mb-3">
				<div class="alert alert-danger" role="alert">
					No has realizado publicaciones.
				</div>
			</div>
		</div>
	';
}
