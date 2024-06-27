<?php

include_once('conexaoSH.php');


$query = $pdo->query("SELECT * from Amostras ");

$res = $query->fetchAll(PDO::FETCH_ASSOC);

for ($i = 0; $i < count($res); $i++) {
    foreach ($res[$i] as $key => $value) {
    }
    $dados[] = array(
        'id' => $res[$i]['id'],    
        'processo' => $res[$i]['Processo'],
        'amostra' => $res[$i]['Amostra'],
        'lote' => $res[$i]['Lote'],
        'coordenadaX' => $res[$i]['CoordenadaX'],
        'coordenadaY' => $res[$i]['CoordenadaY'],
        'coordenadaZ' => $res[$i]['CoordenadaZ'],
        'tipoDeAmostra' => $res[$i]['TipoDeAmostra'],
        'sondagem' => $res[$i]['Sondagem'],
        'profundidaInicial' => $res[$i]['ProfundidaInicial'],
        'profundidadeFinal' => $res[$i]['ProfundidadeFinal'],
        'dataDeRegistro' => $res[$i]['DataDeRegistro'],
        'previsaoSaidaLote' => $res[$i]['PrevisaoSaidaLote'],
        'aplicacao' => $res[$i]['Aplicacao'],
        'responsabilidadeDeAmostragem' => $res[$i]['ResponsabilidadeDeAmostragem'],
        'cliente' => $res[$i]['Cliente'],        
    );
}

if (count($res) > 0) {
    $result = json_encode(array('success' => true, 'result' => $dados));
} else {
    $result = json_encode(array('success' => false, 'result' => '0'));
}
echo $result;