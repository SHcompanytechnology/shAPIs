<?php

include_once('conexaoSH.php');


$query = $pdo->query("SELECT * from Normas ");

$res = $query->fetchAll(PDO::FETCH_ASSOC);

for ($i = 0; $i < count($res); $i++) {
    foreach ($res[$i] as $key => $value) {
    }
    $dados[] = array(
                  
        'orgao' => $res[$i]['Orgao'],
        'designacao' => $res[$i]['Designacao'],
        'numero' => $res[$i]['Numero'],
        'descricao' => $res[$i]['Descricao'],

    );
}

if (count($res) > 0) {
    $result = json_encode(array('success' => true, 'result' => $dados));
} else {
    $result = json_encode(array('success' => false, 'result' => '0'));
}
echo $result;