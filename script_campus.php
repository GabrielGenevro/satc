<?php
if (isset($_GET['ifes'])) {
    $sql = new mysqli('localhost', 'root', '', 'satc');
	
    if ($sql->connect_error) {
        die('Erro na conexão: ' . $sql->connect_error);
    }

    $ifes = mysqli_real_escape_string($sql, $_GET['ifes']);
    $query = "SELECT id, campus FROM tabcampus WHERE instituto = '$ifes'";
    $ret = $sql->query($query);

    if (!$ret) {
        die('Erro na query: ' . $sql->error . ' | Query: ' . $query);
    }

    $result = array();
    while ($row = $ret->fetch_assoc()) {
        $result[] = array(
            'value' => $row['id'],
            'name'  => $row['campus']
        );
    }

    header('Content-Type: application/json');
    echo json_encode($result);
}

?>