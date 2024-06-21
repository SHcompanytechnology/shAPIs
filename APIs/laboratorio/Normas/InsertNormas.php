<?php
session_start();
include_once('conexaoSH.php');

$postjson = json_decode(file_get_contents("php://input"), true);

// Verifica se todos os campos obrigatórios estão presentes
if (
    !empty($postjson['orgao']) &&
    !empty($postjson['designacao']) &&

    !empty($postjson['numero']) &&
    !empty($postjson['descricao']) 

) 
{
    $query = $pdo->prepare("INSERT INTO Normas SET 
         Orgao = :Orgao
        ,Designacao = :Designacao
        ,Numero = :Numero
        ,Descricao = :Descricao
    ");
    $query->bindValue(":Orgao", $postjson['orgao']);
    $query->bindValue(":Designacao", $postjson['designacao']);
    $query->bindValue(":Numero", $postjson['numero']);
    $query->bindValue(":Descricao", $postjson['descricao']);
 

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