<?php
session_start();
include_once('conexaoSH.php');

$postjson = json_decode(file_get_contents("php://input"), true);

// Verifica se todos os campos obrigatórios estão presentes
if (
    !empty($postjson['serie']) &&
    !empty($postjson['laboratorio']) &&

    !empty($postjson['designacao1']) &&
    !empty($postjson['designacao2']) &&
    !empty($postjson['designacao3']) &&
    !empty($postjson['designacao4']) &&
    !empty($postjson['designacao5']) &&
    !empty($postjson['designacao6']) &&
    !empty($postjson['designacao7']) &&
    !empty($postjson['designacao8']) &&
    !empty($postjson['designacao9']) &&
    !empty($postjson['designacao10']) &&
    !empty($postjson['designacao11']) &&
    !empty($postjson['designacao12']) &&
    !empty($postjson['designacao13']) &&
    !empty($postjson['designacao14']) &&


    !empty($postjson['dimensao1']) &&
    !empty($postjson['dimensao2']) &&
    !empty($postjson['dimensao3']) &&
    !empty($postjson['dimensao4']) &&
    !empty($postjson['dimensao5']) &&
    !empty($postjson['dimensao6']) &&
    !empty($postjson['dimensao7']) &&
    !empty($postjson['dimensao8']) &&
    !empty($postjson['dimensao9']) &&
    !empty($postjson['dimensao10']) &&
    !empty($postjson['dimensao11']) &&
    !empty($postjson['dimensao12']) &&
    !empty($postjson['dimensao13']) &&
    !empty($postjson['dimensao14']) 


) 
{
    $query = $pdo->prepare("INSERT INTO Peneiras SET 
        Serie = :Serie
        ,Laboratorio = :Laboratorio
        ,Designacao1 = :Designacao1
        ,Designacao2 = :Designacao2
        ,Designacao3 = :Designacao3
        ,Designacao4 = :Designacao4
        ,Designacao5 = :Designacao5
        ,Designacao6 = :Designacao6
        ,Designacao7 = :Designacao7
        ,Designacao8 = :Designacao8
        ,Designacao9 = :Designacao9
        ,Designacao10 = :Designacao10
        ,Designacao11 = :Designacao11
        ,Designacao12 = :Designacao12
        ,Designacao13 = :Designacao13
        ,Designacao14 = :Designacao14


        ,Dimensao1 = :Dimensao1
        ,Dimensao2 = :Dimensao2
        ,Dimensao3 = :Dimensao3
        ,Dimensao4 = :Dimensao4
        ,Dimensao5 = :Dimensao5
        ,Dimensao6 = :Dimensao6
        ,Dimensao7 = :Dimensao7
        ,Dimensao8 = :Dimensao8
        ,Dimensao9 = :Dimensao9
        ,Dimensao10 = :Dimensao10
        ,Dimensao11 = :Dimensao11
        ,Dimensao12 = :Dimensao12
        ,Dimensao13 = :Dimensao13
        ,Dimensao14 = :Dimensao14


    ");
    $query->bindValue(":Serie", $postjson['serie']);
    $query->bindValue(":Laboratorio", $postjson['laboratorio']);
    $query->bindValue(":Designacao1", $postjson['designacao1']);
    $query->bindValue(":Designacao2", $postjson['designacao2']);
    $query->bindValue(":Designacao3", $postjson['designacao3']);
    $query->bindValue(":Designacao4", $postjson['designacao4']);
    $query->bindValue(":Designacao5", $postjson['designacao5']);
    $query->bindValue(":Designacao6", $postjson['designacao6']);
    $query->bindValue(":Designacao7", $postjson['designacao7']);
    $query->bindValue(":Designacao8", $postjson['designacao8']);
    $query->bindValue(":Designacao9", $postjson['designacao9']);
    $query->bindValue(":Designacao10", $postjson['designacao10']);
    $query->bindValue(":Designacao11", $postjson['designacao11']);
    $query->bindValue(":Designacao12", $postjson['designacao12']);
    $query->bindValue(":Designacao13", $postjson['designacao13']);
    $query->bindValue(":Designacao14", $postjson['designacao14']);
    

    $query->bindValue(":Dimensao1", $postjson['dimensao1']);
    $query->bindValue(":Dimensao2", $postjson['dimensao2']);
    $query->bindValue(":Dimensao3", $postjson['dimensao3']);
    $query->bindValue(":Dimensao4", $postjson['dimensao4']);
    $query->bindValue(":Dimensao5", $postjson['dimensao5']);
    $query->bindValue(":Dimensao6", $postjson['dimensao6']);
    $query->bindValue(":Dimensao7", $postjson['dimensao7']);
    $query->bindValue(":Dimensao8", $postjson['dimensao8']);
    $query->bindValue(":Dimensao9", $postjson['dimensao9']);
    $query->bindValue(":Dimensao10", $postjson['dimensao10']);
    $query->bindValue(":Dimensao11", $postjson['dimensao11']);
    $query->bindValue(":Dimensao12", $postjson['dimensao12']);
    $query->bindValue(":Dimensao13", $postjson['dimensao13']);
    $query->bindValue(":Dimensao14", $postjson['dimensao14']);
     

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