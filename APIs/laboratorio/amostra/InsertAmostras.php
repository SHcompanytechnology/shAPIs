<?php
session_start();
include_once('conexaoSH.php');

$postjson = json_decode(file_get_contents("php://input"), true);


// Verifica se todos os campos obrigatórios estão presentes
if (
    !empty($postjson['numeroProcesso']) &&
    !empty($postjson['amostra']) &&
    !empty($postjson['lote']) &&
    !empty($postjson['coordenadaX']) &&
    !empty($postjson['coordenadaY']) &&
    !empty($postjson['coordenadaZ']) &&
    !empty($postjson['tipoDeAmostra']) &&
    !empty($postjson['sondagem']) &&
    !empty($postjson['profundidaInicial']) &&
    !empty($postjson['profundidadeFinal']) &&
    !empty($postjson['dataDeRegistro']) &&
    !empty($postjson['previsaoSaidaLote']) &&
    !empty($postjson['aplicacao']) &&
    !empty($postjson['responsabilidadeDeAmostragem']) &&
    !empty($postjson['cliente'])
  
)
 {
    $query = $pdo->prepare("INSERT INTO Amostras SET 
        Processo = :PROCESSO, 
        Amostra = :AMOSTRA , 
        Lote = :LOTE , 
        CoordenadaX = :COORDENADAX , 
        CoordenadaY = :COORDENADAY , 
        CoordenadaZ = :COORDENADAZ , 
        TipoDeAmostra = :TIPODEAMOSTRA , 
        Sondagem = :SONDAGEM , 
        ProfundidaInicial = :PROFUNDIDADEINICIAL , 
        ProfundidadeFinal = :PROFUNDIDADEFINAL , 
        DataDeRegistro = :DATADEREGISTRO , 
        PrevisaoSaidaLote = :PREVISAOSAIDALOTE , 
        Aplicacao = :APLICACAO , 
        ResponsabilidadeDeAmostragem = :RESPONSABILIDADE ,
        Cliente = :CLIENTE 

    ");

    $query->bindValue(":PROCESSO", $postjson['numeroProcesso']);
    $query->bindValue(":AMOSTRA", $postjson['amostra']);
    $query->bindValue(":LOTE", $postjson['lote']);
    $query->bindValue(":COORDENADAX", $postjson['coordenadaX']);
    $query->bindValue(":COORDENADAY", $postjson['coordenadaY']);
    $query->bindValue(":COORDENADAZ", $postjson['coordenadaZ']);
    $query->bindValue(":TIPODEAMOSTRA", $postjson['tipoDeAmostra']);
    $query->bindValue(":SONDAGEM", $postjson['sondagem']);
    $query->bindValue(":PROFUNDIDADEINICIAL", $postjson['profundidaInicial']);
    $query->bindValue(":PROFUNDIDADEFINAL", $postjson['profundidadeFinal']);
    $query->bindValue(":DATADEREGISTRO", $postjson['dataDeRegistro']);
    $query->bindValue(":PREVISAOSAIDALOTE", $postjson['previsaoSaidaLote']);
    $query->bindValue(":APLICACAO", $postjson['aplicacao']);
    $query->bindValue(":RESPONSABILIDADE", $postjson['responsabilidadeDeAmostragem']);
    $query->bindValue(":CLIENTE", $postjson['cliente']);


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
