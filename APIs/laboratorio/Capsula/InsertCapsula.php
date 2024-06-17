<?php
session_start();
include_once('conexaoSH.php');

$postjson = json_decode(file_get_contents("php://input"), true);


// Verifica se todos os campos obrigatórios estão presentes
if (
    !empty($postjson['capsula']) &&
    !empty($postjson['massaDaCapsula']) &&
    !empty($postjson['laboratorio']) &&
    !empty($postjson['dataDeVerificacao']) &&
    !empty($postjson['uso']) &&
    !empty($postjson['balancaDeVerificacao']) &&
    !empty($postjson['ensaio']) 

) 
{
    $query = $pdo->prepare("INSERT INTO Capsulas SET 
        Capsula = :Capsula,
        MassaDaCapsula = :MassaDaCapsula,
        Laboratorio = :Laboratorio,
        DataDeVerificacao = :DataDeVerificacao,
        Uso = :Uso,
        BalancaDeVerificacao = :BalancaDeVerificacao,
        Ensaio = :Ensaio

    ");

    $query->bindValue(":Capsula", $postjson['capsula']);
    $query->bindValue(":MassaDaCapsula", $postjson['massaDaCapsula']);
    $query->bindValue(":Laboratorio", $postjson['laboratorio']);
    $query->bindValue(":DataDeVerificacao", $postjson['dataDeVerificacao']);
    $query->bindValue(":Uso", $postjson['uso']);
    $query->bindValue(":BalancaDeVerificacao", $postjson['balancaDeVerificacao']);
    $query->bindValue(":Ensaio", $postjson['ensaio']);




    $execute = $query->execute();

    if ($execute) {
        $result = json_encode(array('success' => true));
    } else {
        $result = json_encode(array('success' => false));
    }
} else {
    // Se algum campo obrigatório estiver vazio, retorna um erro
    $result = json_encode(array('success' => false, 'message' => 'Todos os campos são obrigatórios.'));
}

echo $result;
exit();
?>