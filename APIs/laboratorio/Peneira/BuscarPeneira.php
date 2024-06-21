<?php

include_once('conexaoSH.php');

 $SERIE= $_GET['serie']; 

$query = $pdo->query("SELECT * from Peneiras where Serie = '$SERIE' ");

$res = $query->fetchAll(PDO::FETCH_ASSOC);

for ($i = 0; $i < count($res); $i++) {
    foreach ($res[$i] as $key => $value) {
    }

$id= $res[$i]['id'];
$Designacao1 = $res[$i]['Designacao1'];
$Designacao2 = $res[$i]['Designacao2'];
$Designacao3 = $res[$i]['Designacao3'];
$Designacao4 = $res[$i]['Designacao4'];
$Designacao5 = $res[$i]['Designacao5'];
$Designacao6 = $res[$i]['Designacao6'];
$Designacao7 = $res[$i]['Designacao7'];
$Designacao8 = $res[$i]['Designacao8'];
$Designacao9 = $res[$i]['Designacao9'];
$Designacao10 = $res[$i]['Designacao10'];
$Designacao11 = $res[$i]['Designacao11'];
$Designacao12 = $res[$i]['Designacao12'];
$Designacao13 = $res[$i]['Designacao13'];
$Designacao14 = $res[$i]['Designacao14'];
$Dimensao1 = $res[$i]['Dimensao1'];
$Dimensao2 = $res[$i]['Dimensao2'];
$Dimensao3 = $res[$i]['Dimensao3'];
$Dimensao4 = $res[$i]['Dimensao4'];
$Dimensao5 = $res[$i]['Dimensao5'];
$Dimensao6 = $res[$i]['Dimensao6'];
$Dimensao7 = $res[$i]['Dimensao7'];
$Dimensao8 = $res[$i]['Dimensao8'];
$Dimensao9 = $res[$i]['Dimensao9'];
$Dimensao10 = $res[$i]['Dimensao10'];
$Dimensao11 = $res[$i]['Dimensao11'];
$Dimensao12 = $res[$i]['Dimensao12'];
$Dimensao13 = $res[$i]['Dimensao13'];
$Dimensao14 = $res[$i]['Dimensao14'];

}

if (count($res) > 0) {
   
    $result = json_encode(array('success' => true , 'id' => $id, 'designacao1' => $Designacao1
    , 'designacao2' => $Designacao2
    , 'designacao3' => $Designacao3
    , 'designacao4' => $Designacao4
    , 'designacao5' => $Designacao5
    , 'designacao6' => $Designacao6
    , 'designacao7' => $Designacao7
    , 'designacao8' => $Designacao8
    , 'designacao9' => $Designacao9
    , 'designacao10' => $Designacao10
    , 'designacao11' => $Designacao11
    , 'designacao12' => $Designacao12
    , 'designacao13' => $Designacao13
    , 'designacao14' => $Designacao14
    , 'dimensao1' => $Dimensao1
    , 'dimensao2' => $Dimensao2
    , 'dimensao3' => $Dimensao3
    , 'dimensao4' => $Dimensao4
    , 'dimensao5' => $Dimensao5
    , 'dimensao6' => $Dimensao6
    , 'dimensao7' => $Dimensao7
    , 'dimensao8' => $Dimensao8
    , 'dimensao9' => $Dimensao9
    , 'dimensao10' => $Dimensao10
    , 'dimensao11' => $Dimensao11
    , 'dimensao12' => $Dimensao12
    , 'dimensao13' => $Dimensao13
    , 'dimensao14' => $Dimensao14

));
    

} else {
    $result = json_encode(array('success' => false, 'result' => '0'));
}
echo $result;