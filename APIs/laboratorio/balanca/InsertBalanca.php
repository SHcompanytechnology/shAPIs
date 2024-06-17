<?php
session_start();
include_once('conexaoSH.php');

$postjson = json_decode(file_get_contents("php://input"), true);


// Verifica se todos os campos obrigatórios estão presentes
if (
    !empty($postjson['balanca']) &&
    !empty($postjson['marca']) &&
    !empty($postjson['modelo']) &&
    !empty($postjson['classe']) &&
    !empty($postjson['fornecedor']) &&
    !empty($postjson['dataDeAquisicao']) &&
    !empty($postjson['gama']) &&
    !empty($postjson['unidade']) &&
    !empty($postjson['serie']) &&
    !empty($postjson['laboratorio']) &&
    !empty($postjson['resolucao']) &&
    !empty($postjson['periodoDeCalibracao']) &&
    !empty($postjson['periodoDeVerificacao']) &&
    !empty($postjson['dataCalibracao']) &&
    !empty($postjson['resposanvelCalibracao']) 

) 
{
    $query = $pdo->prepare("INSERT INTO Balanca SET 
        Balanca = :Balanca,
        Marca = :Marca,
        Modelo = :Modelo,
        Classe = :Classe,
        Fornecedor = :Fornecedor,
        DataDeAquisicao = :DataDeAquisicao,
        Gama = :Gama,
        Unidade = :Unidade,
        Serie = :Serie,
        Laboratorio = :Laboratorio,
        Resolucao = :Resolucao,
        PeriodoDeCalibracao = :PeriodoDeCalibracao,
        PeriodoDeVerificacao = :PeriodoDeVerificacao,
        DataCalibracao = :DataCalibracao,
        ResposanvelCalibracao = :ResposanvelCalibracao

    ");
    $query->bindValue(":Balanca", $postjson['balanca']);
    $query->bindValue(":Marca", $postjson['marca']);
    $query->bindValue(":Modelo", $postjson['modelo']);
    $query->bindValue(":Classe", $postjson['classe']);
    $query->bindValue(":Fornecedor", $postjson['fornecedor']);
    $query->bindValue(":DataDeAquisicao", $postjson['dataDeAquisicao']);
    $query->bindValue(":Gama", $postjson['gama']);
    $query->bindValue(":Unidade", $postjson['unidade']);
    $query->bindValue(":Serie", $postjson['serie']);
    $query->bindValue(":Laboratorio", $postjson['laboratorio']);
    $query->bindValue(":Resolucao", $postjson['resolucao']);
    $query->bindValue(":PeriodoDeCalibracao", $postjson['periodoDeCalibracao']);
    $query->bindValue(":PeriodoDeVerificacao", $postjson['periodoDeVerificacao']);
    $query->bindValue(":DataCalibracao", $postjson['dataCalibracao']);
    $query->bindValue(":ResposanvelCalibracao", $postjson['resposanvelCalibracao']);
 
    
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