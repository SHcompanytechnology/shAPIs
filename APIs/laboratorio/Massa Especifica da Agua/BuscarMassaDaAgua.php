<?php

include_once('conexaoSH.php');

 $TEMPERATURA = $_GET['temperaturaDoEnsaio']; 

$query = $pdo->query("SELECT * from MassaDaAgua where Temperatura = '$TEMPERATURA' ");

$res = $query->fetchAll(PDO::FETCH_ASSOC);

for ($i = 0; $i < count($res); $i++) {
    foreach ($res[$i] as $key => $value) {
    }

   $id= $res[$i]['id'];
    $gcm = $res[$i]['gcm3']; 
    

   
    
}

if (count($res) > 0) {
   
    $result = json_encode(array('success' => true , 'id' => $id,'gcm3' => $gcm ));
    

} else {
    $result = json_encode(array('success' => false, 'result' => '0'));
}
echo $result;