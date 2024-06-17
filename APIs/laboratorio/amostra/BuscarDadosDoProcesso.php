<?php

include_once('conexaoSH.php');

$PROCESSO= $_GET['numeroProcesso'];

$query = $pdo->query("SELECT * from Processos where Processo = '$PROCESSO'");

$res = $query->fetchAll(PDO::FETCH_ASSOC);

for ($i = 0; $i < count($res); $i++) {
    foreach ($res[$i] as $key => $value) {
    }
    $localdaobra = $res[$i]['LocalDaObra'];
    $pontoespecifico = $res[$i]['PontoEspecifico'];
    $designacaodaObra = $res[$i]['DesignacaoDaObra'];
    $cliente = $res[$i]['Cliente'];

       
}

if (count($res) > 0) {
   
    $result = json_encode(array('success' => true, 'localDaObra' => $localdaobra,
                                                    'pontoEspecifico' => $pontoespecifico ,
                                                    'designacaoDaObra' => $designacaodaObra ,
                                                    'cliente' => $cliente ));
    

} else {
    $result = json_encode(array('success' => false, 'result' => '0'));
}
echo $result;

?>