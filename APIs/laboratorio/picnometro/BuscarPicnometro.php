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
   $Temperatura1= $res[$i]['Temperatura1'];
   $Temperatura2= $res[$i]['Temperatura2'];
   $PesoPicnometroATemperatura1= $res[$i]['PesoPicnometroATemperatura1'];
   $PesoPicnometroATemperatura2= $res[$i]['PesoPicnometroATemperatura2'];
}

if (count($res) > 0) {
   
    $result = json_encode(array('success' => true , 'id' => $id, 'pesoDoPicnometro' => $PesoDoPicnometro, 'pesoPicnometroMaisAgua' => $PesoPicnometroMaisAgua
    , 'temperatura1' => $Temperatura1
    , 'temperatura2' => $Temperatura2
    , 'pesoPicnometroATemperatura1' => $PesoPicnometroATemperatura1
    , 'pesoPicnometroATemperatura2' => $PesoPicnometroATemperatura2  ));
    

} else {
    $result = json_encode(array('success' => false, 'result' => '0'));
}
echo $result;