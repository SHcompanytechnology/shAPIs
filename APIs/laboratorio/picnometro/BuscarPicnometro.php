<?php

include_once('conexaoSH.php');

 $PICNOMETRO= $_GET['picnometro']; 

$query = $pdo->query("SELECT * from Picnometro where Picnometro = '$PICNOMETRO' ");

$res = $query->fetchAll(PDO::FETCH_ASSOC);

for ($i = 0; $i < count($res); $i++) {
    foreach ($res[$i] as $key => $value) {
    }

   $id= $res[$i]['id'];
   $PesoDoPicnometro= $res[$i]['PesoDoPicnometro'];
   $PesoPicnometroMaisAgua= $res[$i]['PesoPicnometroMaisAgua'];
    
  
    
}

if (count($res) > 0) {
   
    $result = json_encode(array('success' => true , 'id' => $id, 'pesoDoPicnometro' => $PesoDoPicnometro, 'pesoPicnometroMaisAgua' => $PesoPicnometroMaisAgua));
    

} else {
    $result = json_encode(array('success' => false, 'result' => '0'));
}
echo $result;