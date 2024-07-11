<?php

include_once('conexaoSH.php');

 $AMOSTRA = $_GET['amostra']; 
 $LOTE = $_GET['lote'];
 $PROCESSO = $_GET['processo'];
 $CLIENTE = $_GET['cliente'];


$query = $pdo->query("SELECT * from MassaEspecificaRealEmGraos where Amostra LIKE '$AMOSTRA' and Lote LIKE '$LOTE' 
                                                         and Processo LIKE '$PROCESSO' and Cliente LIKE '$CLIENTE'   ");

$res = $query->fetchAll(PDO::FETCH_ASSOC);

for ($i = 0; $i < count($res); $i++) {
    foreach ($res[$i] as $key => $value) {
    }
   
   $id= $res[$i]['id'];
   $Estufa = $res[$i]['Estufa']; 
   $Balanca = $res[$i]['Balanca']; 
   $Norma = $res[$i]['Norma']; 
   $Laboratorio = $res[$i]['Laboratorio']; 
   $Picnometro1 = $res[$i]['Picnometro1']; 
   $Picnometro2 = $res[$i]['Picnometro2']; 
   $MassaUmidaCorpoDeProva1 = $res[$i]['MassaUmidaCorpoDeProva1']; 
   $MassaUmidaCorpoDeProva2 = $res[$i]['MassaUmidaCorpoDeProva2']; 
   $Capsula1 = $res[$i]['Capsula1']; 
   $Capsula2 = $res[$i]['Capsula2']; 
   $Capsula3 = $res[$i]['Capsula3']; 
   $Capsula4 = $res[$i]['Capsula4']; 
   $Capsula5 = $res[$i]['Capsula5']; 
   $Capsula6 = $res[$i]['Capsula6']; 
   $MassaSoloUmdMaisCapsula1 = $res[$i]['MassaSoloUmdMaisCapsula1']; 
   $MassaSoloUmdMaisCapsula2 = $res[$i]['MassaSoloUmdMaisCapsula2']; 
   $MassaSoloUmdMaisCapsula3 = $res[$i]['MassaSoloUmdMaisCapsula3']; 
   $MassaSoloUmdMaisCapsula4 = $res[$i]['MassaSoloUmdMaisCapsula4']; 
   $MassaSoloUmdMaisCapsula5 = $res[$i]['MassaSoloUmdMaisCapsula5']; 
   $MassaSoloUmdMaisCapsula6 = $res[$i]['MassaSoloUmdMaisCapsula6']; 
   $MassaSoloSecoMaisCapsula1 = $res[$i]['MassaSoloSecoMaisCapsula1']; 
   $MassaSoloSecoMaisCapsula2 = $res[$i]['MassaSoloSecoMaisCapsula2']; 
   $MassaSoloSecoMaisCapsula3 = $res[$i]['MassaSoloSecoMaisCapsula3']; 
   $MassaSoloSecoMaisCapsula4 = $res[$i]['MassaSoloSecoMaisCapsula4']; 
   $MassaSoloSecoMaisCapsula5 = $res[$i]['MassaSoloSecoMaisCapsula5']; 
   $MassaSoloSecoMaisCapsula6 = $res[$i]['MassaSoloSecoMaisCapsula6']; 
   $MassaDaCapsula1 = $res[$i]['MassaDaCapsula1']; 
   $MassaDaCapsula2 = $res[$i]['MassaDaCapsula2']; 
   $MassaDaCapsula3 = $res[$i]['MassaDaCapsula3']; 
   $MassaDaCapsula4 = $res[$i]['MassaDaCapsula4']; 
   $MassaDaCapsula5 = $res[$i]['MassaDaCapsula5']; 
   $MassaDaCapsula6 = $res[$i]['MassaDaCapsula6']; 
   $TeorDeUmidade1 = $res[$i]['TeorDeUmidade1']; 
   $TeorDeUmidade2 = $res[$i]['TeorDeUmidade2']; 
   $TeorDeUmidade3 = $res[$i]['TeorDeUmidade3']; 
   $TeorDeUmidade4 = $res[$i]['TeorDeUmidade4']; 
   $TeorDeUmidade5 = $res[$i]['TeorDeUmidade5']; 
   $TeorDeUmidade6 = $res[$i]['TeorDeUmidade6']; 
   $TeorDeUmidadeMedio1 = $res[$i]['TeorDeUmidadeMedio1']; 
   $TeorDeUmidadeMedio2 = $res[$i]['TeorDeUmidadeMedio2']; 
   $MassaDoPicnometroMaisAguaDestilada1 = $res[$i]['MassaDoPicnometroMaisAguaDestilada1']; 
   $MassaDoPicnometroMaisAguaDestilada2 = $res[$i]['MassaDoPicnometroMaisAguaDestilada2']; 
   $AguaAteOTraco1 = $res[$i]['AguaAteOTraco1']; 
   $AguaAteOTraco2 = $res[$i]['AguaAteOTraco2']; 
   $TemperaturaDoEnsaio1 = $res[$i]['TemperaturaDoEnsaio1']; 
   $TemperaturaDoEnsaio2 = $res[$i]['TemperaturaDoEnsaio2']; 
   $MassaDaAguaATemperaturaT1 = $res[$i]['MassaDaAguaATemperaturaT1']; 
   $MassaDaAguaATemperaturaT2 = $res[$i]['MassaDaAguaATemperaturaT2']; 
   $MassaEspecificaDoCorpoDeProva1 = $res[$i]['MassaEspecificaDoCorpoDeProva1']; 
   $MassaEspecificaDoCorpoDeProva2 = $res[$i]['MassaEspecificaDoCorpoDeProva2']; 
   $MassaEspecificaMedia = $res[$i]['MassaEspecificaMedia']; 
   $Observacao = $res[$i]['Observacao']; 
   $ExecutadoPor = $res[$i]['ExecutadoPor']; 
   $DataExecucao = $res[$i]['DataExecucao']; 
   $AprovadoPor = $res[$i]['AprovadoPor']; 
   $DataAprovacao = $res[$i]['DataAprovacao']; 
   
    
}

if (count($res) > 0) {
   
    $result = json_encode(array('success' => true , 'id' => $id,'estufa' => $Estufa
    ,'balanca' => $Balanca ,
    'norma' => $Norma ,
    'laboratorio' => $Laboratorio 
    ,'picnometro1' => $Picnometro1 ,
    'picnometro2' => $Picnometro2 ,
    'massaUmidacorpodeprova1' => $MassaUmidaCorpoDeProva1
    ,'massaUmidacorpodeprova2' => $MassaUmidaCorpoDeProva2 ,
    'capsula1' => $Capsula1 ,
    'capsula2' => $Capsula2
    ,'capsula3' => $Capsula3 ,
    'capsula4' => $Capsula4 ,
    'capsula5' => $Capsula5
    ,'capsula6' => $Capsula6 ,
    'massaSoloUmdmaiscapsula1' => $MassaSoloUmdMaisCapsula1 ,
    'massaSoloUmdmaiscapsula2' => $MassaSoloUmdMaisCapsula2
    ,'massaSoloUmdmaiscapsula3' => $MassaSoloUmdMaisCapsula3 ,
    'massaSoloUmdmaiscapsula4' => $MassaSoloUmdMaisCapsula4 ,
    'massaSoloUmdmaiscapsula5' => $MassaSoloUmdMaisCapsula5
    ,'massaSoloUmdmaiscapsula6' => $MassaSoloUmdMaisCapsula6 ,
    'massaSoloSecomaiscapsula1' => $MassaSoloSecoMaisCapsula1 ,
    'massaSoloSecomaiscapsula2' => $MassaSoloSecoMaisCapsula2
    ,'massaSoloSecomaiscapsula3' => $MassaSoloSecoMaisCapsula3 
    ,'massaSoloSecomaiscapsula4' => $MassaSoloSecoMaisCapsula4
     ,'massaSoloSecomaiscapsula5' => $MassaSoloSecoMaisCapsula5
    ,'massaSoloSecomaiscapsula6' => $MassaSoloSecoMaisCapsula6
     ,'massadacapsula1' => $MassaDaCapsula1
      ,'massadacapsula2' => $MassaDaCapsula2
    ,'massadacapsula3' => $MassaDaCapsula3 
    ,'massadacapsula4' => $MassaDaCapsula4
     ,'massadacapsula5' => $MassaDaCapsula5
    ,'massadacapsula6' => $MassaDaCapsula6
     ,'teordeUmidade1' => $TeorDeUmidade1
      ,'teordeUmidade2' => $TeorDeUmidade2
    ,'teordeUmidade3' => $TeorDeUmidade3 
    ,'teordeUmidade4' => $TeorDeUmidade4 
    ,'teordeUmidade5' => $TeorDeUmidade5
    ,'teordeUmidade6' => $TeorDeUmidade6 
    ,'teordeUmidademedio1' => $TeorDeUmidadeMedio1
     ,'teordeUmidademedio2' => $TeorDeUmidadeMedio2
    ,'massadopicnometromaisaguadestilada1' => $MassaDoPicnometroMaisAguaDestilada1
     ,'massadopicnometromaisaguadestilada2' => $MassaDoPicnometroMaisAguaDestilada2
      ,'aguaateotraco1' => $AguaAteOTraco1
    ,'aguaateotraco2' => $AguaAteOTraco2 
    ,'temperaturadoensaio1' => $TemperaturaDoEnsaio1 
    ,'temperaturadoensaio2' => $TemperaturaDoEnsaio2
    ,'massadaaguaatemperaturat1' => $MassaDaAguaATemperaturaT1
     ,'massadaaguaatemperaturat2' => $MassaDaAguaATemperaturaT2
      ,'massaespecificadocorpodeprova1' => $MassaEspecificaDoCorpoDeProva1
    ,'massaespecificadocorpodeprova2' => $MassaEspecificaDoCorpoDeProva2
     ,'massaespecificamedia' => $MassaEspecificaMedia 
     ,'observacao' => $Observacao
    ,'executadopor' => $ExecutadoPor
     ,'dataexecucao' => $DataExecucao
      ,'aprovadopor' => $AprovadoPor
    ,'dataaprovacao' => $DataAprovacao 


));
    

} else {
    $result = json_encode(array('success' => false, 'result' => '0'));
}
echo $result;





