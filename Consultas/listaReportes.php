<?php
$conexion=mysqli_connect("localhost","root","","regalatodo");

$query = "SELECT * FROM Reporte ";

$result = mysqli_query($conexion, $query);


while   ($row = mysqli_fetch_array($result)) {
    echo '<div class="mb-4 w-100" style="border: 1px solid;">';
    echo '<div class="px-3 py-3">';
    echo '<p><strong>idReporte:</strong> ' . $row['idReporte'] . '</p>';
    echo '<p><strong>fecha_entrega:</strong> ' . $row['fecha_entrega'] . '</p>';
    echo '<p><strong>id_Solicitud:</strong> ' . $row['id_Solicitud'] . '</p>';
    echo '<a href="../Admin/verReporte.php?idReporte=' . $row['idReporte'] . '" class="btn btn-primary">Ver Reporte</a>';
    echo '</div>';
    echo '</div>';
}
