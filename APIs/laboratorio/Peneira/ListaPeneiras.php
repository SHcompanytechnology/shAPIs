<?php

include_once('conexaoSH.php');


$query = $pdo->query("SELECT * from Peneiras ");

$res = $query->fetchAll(PDO::FETCH_ASSOC);

for ($i = 0; $i < count($res); $i++) {
    foreach ($res[$i] as $key => $value) {
    }
    $dados[] = array(
                  
        'id' => $res[$i]['id'],
        'serie' => $res[$i]['Serie'],
        'laboratorio' => $res[$i]['Laboratorio'],

        'designacao1' => $res[$i]['Designacao1'],
        'designacao2' => $res[$i]['Designacao2'],
        'designacao3' => $res[$i]['Designacao3'],
        'designacao4' => $res[$i]['Designacao4'],
        'designacao5' => $res[$i]['Designacao5'],
        'designacao6' => $res[$i]['Designacao6'],
        'designacao7' => $res[$i]['Designacao7'],
        'designacao8' => $res[$i]['Designacao8'],
        'designacao9' => $res[$i]['Designacao9'],
        'designacao10' => $res[$i]['Designacao10'],
        'designacao11' => $res[$i]['Designacao11'],
        'designacao12' => $res[$i]['Designacao12'],
        'designacao13' => $res[$i]['Designacao13'],
        'designacao14' => $res[$i]['Designacao14'],    
        'dimensao1' => $res[$i]['Dimensao1'],
        'dimensao2' => $res[$i]['Dimensao2'],
        'dimensao3' => $res[$i]['Dimensao3'],
        'dimensao4' => $res[$i]['Dimensao4'],
        'dimensao5' => $res[$i]['Dimensao5'],
        'dimensao6' => $res[$i]['Dimensao6'],
        'dimensao7' => $res[$i]['Dimensao7'],
        'dimensao8' => $res[$i]['Dimensao8'],
        'dimensao9' => $res[$i]['Dimensao9'],
        'dimensao10' => $res[$i]['Dimensao10'],
        'dimensao11' => $res[$i]['Dimensao11'],
        'dimensao12' => $res[$i]['Dimensao12'],
        'dimensao13' => $res[$i]['Dimensao13'],
        'dimensao14' => $res[$i]['Dimensao14'],    
    );
}

if (count($res) > 0) {
    $result = json_encode(array('success' => true, 'result' => $dados));
} else {
    $result = json_encode(array('success' => false, 'result' => '0'));
}
echo $result;