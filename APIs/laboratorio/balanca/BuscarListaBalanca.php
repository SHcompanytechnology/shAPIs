<?php

include_once('conexaoSH.php');

$LABORATORIO= $_GET['laboratorio'];
$query = $pdo->query("SELECT * from Balanca where Laboratorio = '$LABORATORIO'");

$res = $query->fetchAll(PDO::FETCH_ASSOC);

for ($i = 0; $i < count($res); $i++) {
    foreach ($res[$i] as $key => $value) {
    }
    $dados[] = array(
                  
        'id' => $res[$i]['id'],
        'balanca' => $res[$i]['Balanca'],
        'marca' => $res[$i]['Marca'],
        'modelo' => $res[$i]['Modelo'],
        'classe' => $res[$i]['Classe'],
        'fornecedor' => $res[$i]['Fornecedor'],
        'dataDeAquisicao' => $res[$i]['DataDeAquisicao'],
        'gama' => $res[$i]['Gama'],
        'unidade' => $res[$i]['Unidade'],
        'serie' => $res[$i]['Serie'],
        'laboratorio' => $res[$i]['Laboratorio'],
        'resolucao' => $res[$i]['Resolucao'],
        'periodoDeCalibracao' => $res[$i]['PeriodoDeCalibracao'],
        'periodoDeVerificacao' => $res[$i]['PeriodoDeVerificacao'],
        'dataCalibracao' => $res[$i]['DataCalibracao'],
        'resposanvelCalibracao' => $res[$i]['ResposanvelCalibracao'],
   
       
    );
}

if (count($res) > 0) {
    $result = json_encode(array('success' => true, 'result' => $dados));
} else {
    $result = json_encode(array('success' => false, 'result' => '0'));
}
echo $result;