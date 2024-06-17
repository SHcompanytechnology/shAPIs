<?php
session_start();
include_once('conexaoSH.php');

$postjson = json_decode(file_get_contents("php://input"), true);

// Adiciona um log simples para verificar quantas vezes o código está sendo chamado
error_log('API chamada em: ' . date('Y-m-d H:i:s'));

// Verifica se todos os campos obrigatórios estão presentes
if (
    !empty($postjson['numeroProcesso']) &&
    !empty($postjson['cliente']) &&
    !empty($postjson['endereco']) &&
    !empty($postjson['cnpj']) &&
    !empty($postjson['localDaObra']) &&
    !empty($postjson['pontoEspecifico']) &&
    !empty($postjson['designacaoDaObra']) &&
    !empty($postjson['laboratorio']) 
) {
    $query = $pdo->prepare("INSERT INTO Processos SET 
        Processo = :PROCESSO, 
        Cliente = :cliente,
        Endereco = :endereco,
        Cnpj = :cnpj,
        LocalDaObra = :localDaObra,
        PontoEspecifico = :pontoEspecifico,
        DesignacaoDaObra = :designacaoDaObra,
        Laboratorio = :laboratorio
    ");

    $query->bindValue(":PROCESSO", $postjson['numeroProcesso']);
    $query->bindValue(":cliente", $postjson['cliente']);
    $query->bindValue(":endereco", $postjson['endereco']);
    $query->bindValue(":cnpj", $postjson['cnpj']);
    $query->bindValue(":localDaObra", $postjson['localDaObra']);
    $query->bindValue(":pontoEspecifico", $postjson['pontoEspecifico']);
    $query->bindValue(":designacaoDaObra", $postjson['designacaoDaObra']);
    $query->bindValue(":laboratorio", $postjson['laboratorio']);


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
