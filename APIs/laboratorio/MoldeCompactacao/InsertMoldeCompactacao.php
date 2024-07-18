<?php
session_start();
include_once('conexaoSH.php');

$postjson = json_decode(file_get_contents("php://input"), true);

// Verifica se todos os campos obrigatórios estão presentes
if (
    !empty($postjson['numeroMolde']) &&
    !empty($postjson['alturaEspacador']) &&
    !empty($postjson['pesoMoldeSemBase']) &&
    !empty($postjson['pesoMoldeComBase']) &&
    !empty($postjson['diametroMolde']) &&
    !empty($postjson['alturaMolde']) &&
    !empty($postjson['seccaoMolde']) &&
    !empty($postjson['volumeMolde'])   
) 
{
    $query = $pdo->prepare("INSERT INTO MoldeDeCompactacao SET 
        NumeroDoMolde = :NumeroDoMolde,
        AlturaEspacador = :AlturaEspacador,
        PesoMoldeSemBase = :PesoMoldeSemBase,
        PesoMoldeComBase = :PesoMoldeComBase,
        DiametroMolde = :DiametroMolde,
        AlturaMolde = :AlturaMolde,
        SeccaoMolde = :SeccaoMolde,
        VolumeMolde = :VolumeMolde
    ");
    $query->bindValue(":NumeroDoMolde", $postjson['numeroMolde']);
    $query->bindValue(":AlturaEspacador", $postjson['alturaEspacador']);
    $query->bindValue(":PesoMoldeSemBase", $postjson['pesoMoldeSemBase']);
    $query->bindValue(":PesoMoldeComBase", $postjson['pesoMoldeComBase']);
    $query->bindValue(":DiametroMolde", $postjson['diametroMolde']);
    $query->bindValue(":AlturaMolde", $postjson['alturaMolde']);
    $query->bindValue(":SeccaoMolde", $postjson['seccaoMolde']);
    $query->bindValue(":VolumeMolde", $postjson['volumeMolde']);
      
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