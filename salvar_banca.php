<?php

include "cabecalho.php";
include "menu.php";

$link = fnConectaBancoDados();

$dados = json_decode($_POST['dados'], true);

$interno = $dados['interno'];
$presidente = $dados['presidente'];
$ext1 = $dados['ext1'];
$ext2 = $dados['ext2'];
$ifes_interno = $_POST['ifes_interno'] ?? null;

$ids_array = [$interno, $presidente, $ext1, $ext2];
$ids = implode(",", $ids_array);

// INÍCIO DA TRANSAÇÃO
mysqli_begin_transaction($link);

try {

    // 🔒 trava apenas esses avaliadores
    $query_lock = "SELECT id FROM tabavaliador WHERE id IN ($ids) FOR UPDATE";
    mysqli_query($link, $query_lock);

    // (opcional, mas recomendado)
    $check = mysqli_query($link, "
        SELECT COUNT(*) as total 
        FROM tabavaliador 
        WHERE id IN ($ids) AND ((situacao IS NULL) OR (situacao IS Disponivel))
    ");

    $row = mysqli_fetch_assoc($check);

    if ($row['total'] < 4) {
        throw new Exception("Algum avaliador já foi utilizado");
    }

    // INSERT BANCA
    $sql = "INSERT INTO tabbanca 
    (avaliador_interno, avaliador1, avaliador2, avaliador3, estado, resultado, instituto)
    VALUES 
    ('$interno', '$presidente', '$ext1', '$ext2', 'Confirmada', 'apresentar', '$ifes_interno')";

    mysqli_query($link, $sql);

    // UPDATE AVALIADORES
    mysqli_query($link, "
        UPDATE tabavaliador 
        SET situacao = 'Sorteado' 
        WHERE id IN ($ids)
    ");

    // FINALIZA
    mysqli_commit($link);

    echo "Banca salva com sucesso!";

} catch (Exception $e) {

    mysqli_rollback($link);

    echo "Erro: " . $e->getMessage();
}

?>
