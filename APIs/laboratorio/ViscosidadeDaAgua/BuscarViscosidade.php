<?php

include_once('conexaoSH.php');

 $TEMPERATURA = $_GET['temperatura']; 

$query = $pdo->query("SELECT * from ViscosidadeDaAgua where Temperatura = '$TEMPERATURA' ");

$res = $query->fetchAll(PDO::FETCH_ASSOC);

for ($i = 0; $i < count($res); $i++) {
    foreach ($res[$i] as $key => $value) {
    }

   $id= $res[$i]['id'];
   $Viscosidade = $res[$i]['Viscosidade']; 
   $CorrecaoDensimetroSEMDefioculante = $res[$i]['CorrecaoDensimetroSEMDefioculante'];
   $CorrecaoDensimetroCOMDefioculante = $res[$i]['CorrecaoDensimetroCOMDefioculante'];
   $MarcaPrincipal = $res[$i]['MarcaPrincipal'];
   $Inicio = $res[$i]['Inicio'];
   $Fim = $res[$i]['Fim'];
   
    
}

if (count($res) > 0) {
   
    $result = json_encode(array('success' => true , 'id' => $id,'viscosidade' => $Viscosidade
    ,'correcaoDensimetroSEMDefioculante' => $CorrecaoDensimetroSEMDefioculante
    ,'correcaoDensimetroCOMDefioculante' => $CorrecaoDensimetroCOMDefioculante
    ,'marcaPrincipal' => $MarcaPrincipal
    ,'inicio' => $Inicio
    ,'fim' => $Fim  ));

    

} else {
    $result = json_encode(array('success' => false, 'result' => '0'));
}
echo $result;