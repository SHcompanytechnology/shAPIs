<?php

include_once('conexaoSH.php');

$CAPSULA= $_GET['capsula'];

$query = $pdo->query("SELECT * from Capsulas where Capsula = '$CAPSULA'");

$res = $query->fetchAll(PDO::FETCH_ASSOC);

for ($i = 0; $i < count($res); $i++) {
    foreach ($res[$i] as $key => $value) {
    }
    $id = $res[$i]['id'];
    $MASSADACAPSULA = $res[$i]['MassaDaCapsula'];       
}

if (count($res) > 0) {
   
    $result = json_encode(array('success' => true, 'id' => $id,
                                                   'massadacapsula' => $MASSADACAPSULA 
                                                   ))
} else {
    $result = json_encode(array('success' => false, 'result' => '0'));
}
echo $result;

?>