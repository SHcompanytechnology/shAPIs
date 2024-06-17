<?php

include_once('conexaoSH.php');

$Amostra= $_GET['amostra'];

$query = $pdo->query("SELECT * from MassaEspecificaRealEmGraos where Amostra = '$Amostra' ");

$res = $query->fetchAll(PDO::FETCH_ASSOC);

for ($i = 0; $i < count($res); $i++) {
    foreach ($res[$i] as $key => $value) {
    }
    $dados[] = array(
                  
        'id' => $res[$i]['id'],
        'cliente' => $res[$i]['Cliente'],

   
       
    );
}

if (count($res) > 0) {
    $result = json_encode(array('success' => true, 'result' => $dados));
} else {
    $result = json_encode(array('success' => false, 'result' => '0'));
}
echo $result;