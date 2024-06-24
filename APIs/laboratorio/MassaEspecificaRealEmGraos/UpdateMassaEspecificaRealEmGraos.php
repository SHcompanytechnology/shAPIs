<?php
session_start();
include_once('conexaoSH.php');

$postjson = json_decode(file_get_contents("php://input"), true);



    $query = $pdo->prepare("UPDATE MassaEspecificaRealEmGraos SET 
          Estufa = :Estufa
        , Balanca = :Balanca
        , Norma = :Norma
        , Laboratorio = :Laboratorio
        , Picnometro1 = :Picnometro1
        , Picnometro2 = :Picnometro2
        , MassaUmidaCorpoDeProva1 = :MassaUmidaCorpoDeProva1
        , MassaUmidaCorpoDeProva2 = :MassaUmidaCorpoDeProva2
        , Capsula1 = :Capsula1
        , Capsula2 = :Capsula2
        , Capsula3 = :Capsula3
        , Capsula4 = :Capsula4
        , Capsula5 = :Capsula5
        , Capsula6 = :Capsula6
        , MassaSoloUmdMaisCapsula1 = :MassaSoloUmdMaisCapsula1
        , MassaSoloUmdMaisCapsula2 = :MassaSoloUmdMaisCapsula2
        , MassaSoloUmdMaisCapsula3 = :MassaSoloUmdMaisCapsula3
        , MassaSoloUmdMaisCapsula4 = :MassaSoloUmdMaisCapsula4
        , MassaSoloUmdMaisCapsula5 = :MassaSoloUmdMaisCapsula5
        , MassaSoloUmdMaisCapsula6 = :MassaSoloUmdMaisCapsula6
        , MassaSoloSecoMaisCapsula1 = :MassaSoloSecoMaisCapsula1
        , MassaSoloSecoMaisCapsula2 = :MassaSoloSecoMaisCapsula2
        , MassaSoloSecoMaisCapsula3 = :MassaSoloSecoMaisCapsula3
        , MassaSoloSecoMaisCapsula4 = :MassaSoloSecoMaisCapsula4
        , MassaSoloSecoMaisCapsula5 = :MassaSoloSecoMaisCapsula5
        , MassaSoloSecoMaisCapsula6 = :MassaSoloSecoMaisCapsula6
        , MassaDaCapsula1 = :MassaDaCapsula1
        , MassaDaCapsula2 = :MassaDaCapsula2
        , MassaDaCapsula3 = :MassaDaCapsula3
        , MassaDaCapsula4 = :MassaDaCapsula4
        , MassaDaCapsula5 = :MassaDaCapsula5
        , MassaDaCapsula6 = :MassaDaCapsula6
        , TeorDeUmidade1 = :TeorDeUmidade1
        , TeorDeUmidade2 = :TeorDeUmidade2
        , TeorDeUmidade3 = :TeorDeUmidade3
        , TeorDeUmidade4 = :TeorDeUmidade4
        , TeorDeUmidade5 = :TeorDeUmidade5
        , TeorDeUmidade6 = :TeorDeUmidade6
        , TeorDeUmidadeMedio1 = :TeorDeUmidadeMedio1
        , TeorDeUmidadeMedio2 = :TeorDeUmidadeMedio2
        , MassaDoPicnometroMaisAguaDestilada1 = :MassaDoPicnometroMaisAguaDestilada1
        , MassaDoPicnometroMaisAguaDestilada2 = :MassaDoPicnometroMaisAguaDestilada2
        , AguaAteOTraco1 = :AguaAteOTraco1
        , AguaAteOTraco2 = :AguaAteOTraco2
        , TemperaturaDoEnsaio1 = :TemperaturaDoEnsaio1
        , TemperaturaDoEnsaio2 = :TemperaturaDoEnsaio2
        , MassaDaAguaATemperaturaT1 = :MassaDaAguaATemperaturaT1
        , MassaDaAguaATemperaturaT2 = :MassaDaAguaATemperaturaT2
        , MassaEspecificaDoCorpoDeProva1 = :MassaEspecificaDoCorpoDeProva1
        , MassaEspecificaDoCorpoDeProva2 = :MassaEspecificaDoCorpoDeProva2
        , MassaEspecificaMedia = :MassaEspecificaMedia
        , Observacao = :Observacao
        , ExecutadoPor = :ExecutadoPor
        , DataExecucao = :DataExecucao
        , AprovadoPor = :AprovadoPor
        , DataAprovacao = :DataAprovacao 
 

        where Amostra =:Amostra and Lote = :Lote 

    ");


    $query->bindValue(":Amostra", $postjson['amostra']);
    $query->bindValue(":Lote", $postjson['lote']);
    
    $query->bindValue(":Estufa", $postjson['estufa']);
    $query->bindValue(":Balanca", $postjson['balanca']);
    $query->bindValue(":Norma", $postjson['norma']);
    $query->bindValue(":Laboratorio", $postjson['laboratorio']);
    $query->bindValue(":Picnometro1", $postjson['picnometro1']);
    $query->bindValue(":Picnometro2", $postjson['picnometro2']);
    $query->bindValue(":MassaUmidaCorpoDeProva1", $postjson['massaUmidacorpodeprova1']);
    $query->bindValue(":MassaUmidaCorpoDeProva2", $postjson['massaUmidacorpodeprova2']);
    $query->bindValue(":Capsula1", $postjson['capsula1']);
    $query->bindValue(":Capsula2", $postjson['capsula2']);
    $query->bindValue(":Capsula3", $postjson['capsula3']);
    $query->bindValue(":Capsula4", $postjson['capsula4']);
    $query->bindValue(":Capsula5", $postjson['capsula5']);
    $query->bindValue(":Capsula6", $postjson['capsula6']);
    $query->bindValue(":MassaSoloUmdMaisCapsula1", $postjson['massaSoloUmdmaiscapsula1']);
    $query->bindValue(":MassaSoloUmdMaisCapsula2", $postjson['massaSoloUmdmaiscapsula2']);
    $query->bindValue(":MassaSoloUmdMaisCapsula3", $postjson['massaSoloUmdmaiscapsula3']);
    $query->bindValue(":MassaSoloUmdMaisCapsula4", $postjson['massaSoloUmdmaiscapsula4']);
    $query->bindValue(":MassaSoloUmdMaisCapsula5", $postjson['massaSoloUmdmaiscapsula5']);
    $query->bindValue(":MassaSoloUmdMaisCapsula6", $postjson['massaSoloUmdmaiscapsula6']); 
    $query->bindValue(":MassaSoloSecoMaisCapsula1", $postjson['massaSoloSecomaiscapsula1']);
    $query->bindValue(":MassaSoloSecoMaisCapsula2", $postjson['massaSoloSecomaiscapsula2']);
    $query->bindValue(":MassaSoloSecoMaisCapsula3", $postjson['massaSoloSecomaiscapsula3']);
    $query->bindValue(":MassaSoloSecoMaisCapsula4", $postjson['massaSoloSecomaiscapsula4']);
    $query->bindValue(":MassaSoloSecoMaisCapsula5", $postjson['massaSoloSecomaiscapsula5']);
    $query->bindValue(":MassaSoloSecoMaisCapsula6", $postjson['massaSoloSecomaiscapsula6']);
    $query->bindValue(":MassaDaCapsula1", $postjson['massadacapsula1']);
    $query->bindValue(":MassaDaCapsula2", $postjson['massadacapsula2']);
    $query->bindValue(":MassaDaCapsula3", $postjson['massadacapsula3']);
    $query->bindValue(":MassaDaCapsula4", $postjson['massadacapsula4']);
    $query->bindValue(":MassaDaCapsula5", $postjson['massadacapsula5']);
    $query->bindValue(":MassaDaCapsula6", $postjson['massadacapsula6']);
    $query->bindValue(":TeorDeUmidade1", $postjson['teordeUmidade1']);
    $query->bindValue(":TeorDeUmidade2", $postjson['teordeUmidade2']);
    $query->bindValue(":TeorDeUmidade3", $postjson['teordeUmidade3']);
    $query->bindValue(":TeorDeUmidade4", $postjson['teordeUmidade4']);
    $query->bindValue(":TeorDeUmidade5", $postjson['teordeUmidade5']);
    $query->bindValue(":TeorDeUmidade6", $postjson['teordeUmidade6']);
    $query->bindValue(":TeorDeUmidadeMedio1", $postjson['teordeUmidademedio1']);
    $query->bindValue(":TeorDeUmidadeMedio2", $postjson['teordeUmidademedio2']);
    $query->bindValue(":MassaDoPicnometroMaisAguaDestilada1", $postjson['massadopicnometromaisaguadestilada1']);
    $query->bindValue(":MassaDoPicnometroMaisAguaDestilada2", $postjson['massadopicnometromaisaguadestilada2']);
    $query->bindValue(":AguaAteOTraco1", $postjson['aguaateotraco1']);
    $query->bindValue(":AguaAteOTraco2", $postjson['aguaateotraco2']);
    $query->bindValue(":TemperaturaDoEnsaio1", $postjson['temperaturadoensaio1']);
    $query->bindValue(":TemperaturaDoEnsaio2", $postjson['temperaturadoensaio2']);
    $query->bindValue(":MassaDaAguaATemperaturaT1", $postjson['massadaaguaatemperaturat1']);
    $query->bindValue(":MassaDaAguaATemperaturaT2", $postjson['massadaaguaatemperaturat2']);
    $query->bindValue(":MassaEspecificaDoCorpoDeProva1", $postjson['massaespecificadocorpodeprova1']);
    $query->bindValue(":MassaEspecificaDoCorpoDeProva2", $postjson['massaespecificadocorpodeprova2']);
    $query->bindValue(":MassaEspecificaMedia", $postjson['massaespecificamedia']);
    $query->bindValue(":Observacao", $postjson['observacao']);
    $query->bindValue(":ExecutadoPor", $postjson['executadopor']);
    $query->bindValue(":DataExecucao", $postjson['dataexecucao']);
    $query->bindValue(":AprovadoPor", $postjson['aprovadopor']);
    $query->bindValue(":DataAprovacao", $postjson['dataaprovacao']); 

    
    $execute = $query->execute();

    if ($execute) {
        $result = json_encode(array('success' => true));
    } else {
        $result = json_encode(array('success' => false));
    }


echo $result;
exit();
?>