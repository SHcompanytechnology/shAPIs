<?php
session_start();
include_once('conexaoSH.php');

$postjson = json_decode(file_get_contents("php://input"), true);


// Verifica se todos os campos obrigatórios estão presentes
if (
    !empty($postjson['amostra']) &&
    !empty($postjson['lote']) &&
    !empty($postjson['processo']) &&
    !empty($postjson['cliente']) 

) 
{
    $query = $pdo->prepare("INSERT INTO AnaliseGranulometrica SET 
        Amostra = :Amostra,
        Lote = :Lote,
        Cliente = :Cliente,
        Processo = :Processo


    ");
    $query->bindValue(":Amostra", $postjson['amostra']);
    $query->bindValue(":Lote", $postjson['lote']);
    $query->bindValue(":Cliente", $postjson['cliente']);
    $query->bindValue(":Processo", $postjson['processo']);

 
    
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