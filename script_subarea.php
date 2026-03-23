<?php
if (isset($_GET['areas'])) {
    $sql = new mysqli('localhost', 'root', '', 'satc');
	
    if ($sql->connect_error) {
        die('Erro na conexão: ' . $sql->connect_error);
    }

    $areas = mysqli_real_escape_string($sql, $_GET['areas']);
    $query = "SELECT id, subarea FROM tabsubareaconhec WHERE area = '$areas'";
    $ret = $sql->query($query);

    if (!$ret) {
        die('Erro na query: ' . $sql->error . ' | Query: ' . $query);
    }

    $result = array();
    while ($row = $ret->fetch_assoc()) {
        $result[] = array(
            'value' => $row['id'],
            'name'  => $row['subarea']
        );
    }

    header('Content-Type: application/json');
    echo json_encode($result);
}
?>