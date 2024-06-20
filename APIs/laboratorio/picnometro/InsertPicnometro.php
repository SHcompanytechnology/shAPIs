<?php
session_start();
include_once('conexaoSH.php');

$postjson = json_decode(file_get_contents("php://input"), true);


// Verifica se todos os campos obrigatórios estão presentes
if (
    !empty($postjson['picnometro']) &&
    !empty($postjson['pesoDoPicnometro']) &&
    !empty($postjson['pesoPicnometroMaisAgua']) &&
    !empty($postjson['dataVerificacao']) &&
    !empty($postjson['laboratorio']) 

) 
{
    $query = $pdo->prepare("INSERT INTO Picnometro SET 
        Laboratorio = :Laboratorio,
        Picnometro = :Picnometro,
        PesoDoPicnometro = :PesoDoPicnometro,
        PesoPicnometroMaisAgua = :PesoPicnometroMaisAgua,
        DataVerificacao = :DataVerificacao
        ,Temperatura1 = :Temperatura1
        ,Temperatura2 = :Temperatura2
        ,PesoPicnometroATemperatura1 = :PesoPicnometroATemperatura1
        ,PesoPicnometroATemperatura2 = :PesoPicnometroATemperatura2

    ");
    $query->bindValue(":Laboratorio", $postjson['laboratorio']);
    $query->bindValue(":Picnometro", $postjson['picnometro']);
    $query->bindValue(":PesoDoPicnometro", $postjson['pesoDoPicnometro']);
    $query->bindValue(":PesoPicnometroMaisAgua", $postjson['pesoPicnometroMaisAgua']);
    $query->bindValue(":DataVerificacao", $postjson['dataVerificacao']);
    $query->bindValue(":Temperatura1", $postjson['temperatura1']);
    $query->bindValue(":Temperatura2", $postjson['temperatura2']);
    $query->bindValue(":PesoPicnometroATemperatura1", $postjson['pesoPicnometroATemperatura1']);
    $query->bindValue(":PesoPicnometroATemperatura2", $postjson['pesoPicnometroATemperatura2']);


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