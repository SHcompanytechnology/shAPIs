<?php
require_once 'mainSheet.php';
include_once('configureteConnection.php');
class CaliforniaSupportIndexModel
{
    private $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function generateModel($codSample, $numberSample, $observation, $dataHeaderAndFooter, $pagina, $totalPaginas, $dataIndiceSuporteCalifornia, $logo, $dataFormatada)
    {
        $conexao = new ConfigureteConnection();
        $conexao->connect();

        $pdo = $conexao->getConnection();

        if ($pdo === null) {
            return null;
        }

        $executador = $dataIndiceSuporteCalifornia['Executado'];
        $aprovador = $dataIndiceSuporteCalifornia['Aprovado'];
        $verificador = $dataIndiceSuporteCalifornia['Verificado'];

        $query = "SELECT * FROM Login WHERE Nome = :executador";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':executador', $executador, PDO::PARAM_STR);
        $stmt->execute();
        $assinaturaExecutador = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $query = "SELECT * FROM Login WHERE Nome = :aprovador";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':aprovador', $aprovador, PDO::PARAM_STR);
        $stmt->execute();
        $assinaturaAprovador = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $query = "SELECT * FROM Login WHERE Nome = :verificador";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':verificador', $verificador, PDO::PARAM_STR);
        $stmt->execute();
        $assinaturaVerificador = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $html = '<html>
        <head>
            <style type="text/css">
                .tg-penetracao {
                    border-collapse: collapse;
                    border-spacing: 0;
                    margin: 0px auto;
                }
                .tg-penetracao td {
                    border-color: black;
                    border-style: solid;
                    border-width: 1px;
                    font-family: Arial, sans-serif;
                    font-size: 10px;
                    overflow: hidden;
                    padding: 2px 4px;
                    word-break: normal;
                }
                .tg-penetracao th {
                    border-color: black;
                    border-style: solid;
                    border-width: 1px;
                    font-family: Arial, sans-serif;
                    font-size: 10px;
                    font-weight: normal;
                    overflow: hidden;
                    padding: 2px 4px;
                    word-break: normal;
                }
                .tg-penetracao .tg-penetracao-78ff {
                    border-color: inherit;
                    font-size: 9px;
                    text-align: center;
                    vertical-align: top;
                }
                .tg-penetracao .tg-penetracao-6rs4 {
                    border-color: inherit;
                    font-size: xx-small;
                    text-align: center;
                    vertical-align: top;
                }
                .tg-penetracao .tg-penetracao-88oy {
                    font-size: xx-small;
                    text-align: center;
                    vertical-align: top;
                }
    
                .tg-expansao {
                    border-collapse: collapse;
                    border-spacing: 0;
                    margin: 0px auto;
                }
                .tg-expansao td {
                    border-color: black;
                    border-style: solid;
                    border-width: 1px;
                    font-family: Arial, sans-serif;
                    font-size: 14px;
                    overflow: hidden;
                    padding: 2px 2px;
                    word-break: normal;
                }
                .tg-expansao th {
                    border-color: black;
                    border-style: solid;
                    border-width: 1px;
                    font-family: Arial, sans-serif;
                    font-size: 14px;
                    font-weight: normal;
                    overflow: hidden;
                    padding: 2px 2px;
                    word-break: normal;
                }
                .tg-expansao .tg-expansao-88oy {
                    font-size: 9px;
                    text-align: center;
                    vertical-align: top;
                }
    
                .tg-moldagem {
                    border-collapse: collapse;
                    border-spacing: 0;
                    margin: 0px auto;
                }
                .tg-moldagem td {
                    border-color: black;
                    border-style: solid;
                    border-width: 1px;
                    font-family: Arial, sans-serif;
                    font-size: 14px;
                    overflow: hidden;
                    padding: 0px 2px;
                    word-break: normal;
                }
                .tg-moldagem th {
                    border-color: black;
                    border-style: solid;
                    border-width: 1px;
                    font-family: Arial, sans-serif;
                    font-size: 14px;
                    font-weight: normal;
                    overflow: hidden;
                    padding: 0px 2px;
                    word-break: normal;
                }
                .tg-moldagem .tg-moldagem-78ff {
                    border-color: inherit;
                    font-size: 9px;
                    text-align: center;
                    vertical-align: top;
                }
                .tg-moldagem .tg-moldagem-kd1j {
                    border-color: inherit;
                    font-size: xx-small;
                    text-align: left;
                    vertical-align: top;
                }
                .tg-moldagem .tg-moldagem-k23d {
                    background-color: #c0c0c0;
                    border-color: #000000;
                    font-size: xx-small;
                    text-align: center;
                    vertical-align: top;
                }
            </style>
        </head>
        <body>
        <header>
        
        </header>
        <main style="margin-top: 45px">
        <table class="tg-cabecalho" style="width: 100%;margin-bottom: 13px">
                <thead>
                    <tr>
                        <th class="tg-cabecalho-0pky col-1" colspan="2" rowspan="2"> CLIENTE: <br>
                            <img style="margin-left: 30%" src="data:image/jpeg;base64,' . base64_encode($logo) . '"  width="80px"">
                        </th>
                        <th class="tg-cabecalho-0pky col-3" colspan="2">RELATÓRIO ENSAIO: <div style="margin-left: 21%; font-size: 15px; margin-top: -6px">
                                ÍNDICE SUPORTE CALIFÓRNIA<div>
                        </th>
                    </tr>
                    <tr>
                        <th class="tg-cabecalho-0pky" colspan="1" style="padding: 0px !important">
                            <table class="tg-cabecalho" style="width: 100%">
                                <thead>
                                    <tr>
                                      <td class="tg-cabecalho-0pky" style="width: 160px !important;padding-bottom: 0px; border-top-color:#fff; border-bottom-color:#fff;white-space: nowrap; border-left-color:#fff"> 
                                            NORMA:
                                          <div style="font-size: 102x; margin-left: 10px; margin-top: 6px; margin-bottom: 5px" class="cabecalho-resultado-font">' . $dataIndiceSuporteCalifornia['Norma'] . '</div>
                                      </td>
                                      <td class="tg-cabecalho-0pky" style="padding-bottom: 0px; border-top-color:#fff; border-bottom-color:#fff; border-right-color:#fff"> 
                                            PROCESSO: / LOTE:
                                            <div style="font-size: 12px; margin-top: 6px; margin-left: 25px; margin-bottom: 5px" class="cabecalho-resultado-font"> ' . $dataHeaderAndFooter['Processo'] . ' / ' . $dataHeaderAndFooter['Lote'] . '</div>
                                      </td>
                                  </tr>
                                </thead>
                            </table>
                        </th>
                        <th class="tg-cabecalho-p1nr"">PROFUNDIDADE (m):
                            <div style="text-align: center; font-size: 12px; margin-top: 7px !important; margin-bottom: 4px !important" class="cabecalho-resultado-font">' . $dataHeaderAndFooter['Profundidade_Inicial'] . ' -- ' . $dataHeaderAndFooter['Profundidade_Final'] . ' </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="tg-cabecalho-0pky col-2" colspan="1" rowspan="4">DATA DO REGISTRO: <div style="margin-top: 15px">
                                <span class="cabecalho-resultado-font">' . $dataHeaderAndFooter['Data_Registro'] . '</span>
                            </div>
                        </td>
                        <td class="tg-cabecalho-0pky col-2" colspan="1" rowspan="4">DATA DE INICIO ENSAIO: <div style="margin-top: 2px">
                                  <span class="cabecalho-resultado-font">' . $dataIndiceSuporteCalifornia['DataInicio'] . '</span>
                              </div>
                          </td>
                        <td class="tg-cabecalho-0pky col-3" rowspan="4">SONDAGEM: <br>
                            <div style="text-align: center; font-size: 12px; margin-top: 9px;">
                                <b>
                                    <span class="cabecalho-resultado-font">' . $dataHeaderAndFooter['Sondagem'] . '</span>
                            </div>
                        </td>
                        <td class="tg-cabecalho-p1nr">**DATUM: ' . $dataHeaderAndFooter['Datum'] . '</td>
                    </tr>
                    <tr>
                        <td class="tg-cabecalho-p1nr">**COORDENADA X: <span class="cabecalho-resultado-font">' . $dataHeaderAndFooter['Coordenada_X'] . '</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="tg-cabecalho-p1nr">**COORDENADA Y: <span class="cabecalho-resultado-font">' . $dataHeaderAndFooter['Coordenada_Y'] . '</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="tg-cabecalho-ps66">**COORDENADA Z: <span class="cabecalho-resultado-font">' . $dataHeaderAndFooter['Coordenada_Z'] . '</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="tg-cabecalho-0pky" rowspan="2">DATA CONCLUSÃO: <div style="margin-top: 15px">
                                <span class="cabecalho-resultado-font">' . $dataIndiceSuporteCalifornia['DataFinal'] . '</span>
                            </div>
                            <br>
                        </td>
                        <td class="tg-cabecalho-0pky" rowspan="2">**APLICAÇÃO: <div style="margin-top: 15px">
                                <span class="cabecalho-resultado-font">' . $dataHeaderAndFooter['Aplicacao'] . '</span>
                            </div>
                        </td>
                        <td class="tg-cabecalho-0pky col-3">**OBRA: <br>
                            <div style="text-align: center; font-size: 12px; margin-top: 0px;">
                                <b>
                                    <span class="cabecalho-resultado-font">' . $dataHeaderAndFooter['Obra'] . '</span>
                            </div>
                        </td>
                        <td class="tg-cabecalho-p1nr" rowspan="2">**ESPECIFICAÇÃO TÉCNICA: <span class="cabecalho-resultado-font">' . $dataHeaderAndFooter['Especificacao_tecnica'] . '</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="tg-cabecalho-0pky">**LOCAL DA COLETA / ENDEREÇO: <br>
                            <div style="text-align: center; font-size: 12px">
                                <b><span class="cabecalho-resultado-font">' . $dataHeaderAndFooter['Localizacao'] . '
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
                <table class="tg">
                        <tr>
        <td class="tg-0pky" colspan="15" style="border-left: none !important; border-right: none !important; border-top-color: #fff; padding-left: 0px !important; padding-right: 0px !important; height: 675px;">                                <br />
                                <table class="tg-moldagem" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th class="tg-moldagem-78ff" style="text-align: left" colspan="2">MOLDAGEM</th>
                                            <th class="tg-moldagem-78ff" colspan="3">P1</th>
                                            <th class="tg-moldagem-78ff" colspan="3">P2</th>
                                            <th class="tg-moldagem-78ff" colspan="3">P3</th>
                                            <th class="tg-moldagem-78ff" colspan="3">P4</th>
                                            <th class="tg-moldagem-78ff" colspan="3">P5</th>
                                            <th class="tg-moldagem-78ff" colspan="3">P6</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="tg-moldagem-kd1j">Molde de compactação</td>
                                            <td class="tg-moldagem-78ff">nº</td>
                                            <td class="tg-moldagem-78ff" colspan="3">' . $dataIndiceSuporteCalifornia['MoldeCompactacao1'] . '</td>
                                            <td class="tg-moldagem-78ff" colspan="3">' . $dataIndiceSuporteCalifornia['MoldeCompactacao2'] . '</td>
                                            <td class="tg-moldagem-78ff" colspan="3">' . $dataIndiceSuporteCalifornia['MoldeCompactacao3'] . '</td>
                                            <td class="tg-moldagem-78ff" colspan="3">' . $dataIndiceSuporteCalifornia['MoldeCompactacao4'] . '</td>
                                            <td class="tg-moldagem-78ff" colspan="3">' . $dataIndiceSuporteCalifornia['MoldeCompactacao5'] . '</td>
                                            <td class="tg-moldagem-78ff" colspan="3">' . $dataIndiceSuporteCalifornia['MoldeCompactacao6'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-moldagem-kd1j">Massa do solo úmido + massa do molde</td>
                                            <td class="tg-moldagem-78ff">g</td>
                                            <td class="tg-moldagem-78ff" colspan="3">' . $dataIndiceSuporteCalifornia['MassaSoloUmiMassaMolde1'] . '</td>
                                            <td class="tg-moldagem-78ff" colspan="3">' . $dataIndiceSuporteCalifornia['MassaSoloUmiMassaMolde2'] . '</td>
                                            <td class="tg-moldagem-78ff" colspan="3">' . $dataIndiceSuporteCalifornia['MassaSoloUmiMassaMolde3'] . '</td>
                                            <td class="tg-moldagem-78ff" colspan="3">' . $dataIndiceSuporteCalifornia['MassaSoloUmiMassaMolde4'] . '</td>
                                            <td class="tg-moldagem-78ff" colspan="3">' . $dataIndiceSuporteCalifornia['MassaSoloUmiMassaMolde5'] . '</td>
                                            <td class="tg-moldagem-78ff" colspan="3">' . $dataIndiceSuporteCalifornia['MassaSoloUmiMassaMolde6'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-moldagem-kd1j">Massa do solo úmido</td>
                                            <td class="tg-moldagem-78ff">g</td>
                                            <td class="tg-moldagem-78ff" colspan="3">' . $dataIndiceSuporteCalifornia['MassaSoloUmida1'] . '</td>
                                            <td class="tg-moldagem-78ff" colspan="3">' . $dataIndiceSuporteCalifornia['MassaSoloUmida2'] . '</td>
                                            <td class="tg-moldagem-78ff" colspan="3">' . $dataIndiceSuporteCalifornia['MassaSoloUmida3'] . '</td>
                                            <td class="tg-moldagem-78ff" colspan="3">' . $dataIndiceSuporteCalifornia['MassaSoloUmida4'] . '</td>
                                            <td class="tg-moldagem-78ff" colspan="3">' . $dataIndiceSuporteCalifornia['MassaSoloUmida5'] . '</td>
                                            <td class="tg-moldagem-78ff" colspan="3">' . $dataIndiceSuporteCalifornia['MassaSoloUmida6'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-moldagem-kd1j">Volume do molde</td>
                                            <td class="tg-moldagem-78ff">cm³</td>
                                            <td class="tg-moldagem-78ff" colspan="3">' . $dataIndiceSuporteCalifornia['VolumeMolde1'] . '</td>
                                            <td class="tg-moldagem-78ff" colspan="3">' . $dataIndiceSuporteCalifornia['VolumeMolde2'] . '</td>
                                            <td class="tg-moldagem-78ff" colspan="3">' . $dataIndiceSuporteCalifornia['VolumeMolde3'] . '</td>
                                            <td class="tg-moldagem-78ff" colspan="3">' . $dataIndiceSuporteCalifornia['VolumeMolde4'] . '</td>
                                            <td class="tg-moldagem-78ff" colspan="3">' . $dataIndiceSuporteCalifornia['VolumeMolde5'] . '</td>
                                            <td class="tg-moldagem-78ff" colspan="3">' . $dataIndiceSuporteCalifornia['VolumeMolde6'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-moldagem-kd1j">Massa específica úmida</td>
                                            <td class="tg-moldagem-78ff">g/cm³</td>
                                            <td class="tg-moldagem-78ff" colspan="3">' . $dataIndiceSuporteCalifornia['Massa_EspUmd1'] . '</td>
                                            <td class="tg-moldagem-78ff" colspan="3">' . $dataIndiceSuporteCalifornia['Massa_EspUmd2'] . '</td>
                                            <td class="tg-moldagem-78ff" colspan="3">' . $dataIndiceSuporteCalifornia['Massa_EspUmd3'] . '</td>
                                            <td class="tg-moldagem-78ff" colspan="3">' . $dataIndiceSuporteCalifornia['Massa_EspUmd4'] . '</td>
                                            <td class="tg-moldagem-78ff" colspan="3">' . $dataIndiceSuporteCalifornia['Massa_EspUmd5'] . '</td>
                                            <td class="tg-moldagem-78ff" colspan="3">' . $dataIndiceSuporteCalifornia['Massa_EspUmd6'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-moldagem-kd1j">Cápsula</td>
                                            <td class="tg-moldagem-78ff">nº</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['Capsula1'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['Capsula2'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['Capsula3'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['Capsula4'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['Capsula5'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['Capsula6'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['Capsula7'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['Capsula8'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['Capsula9'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['Capsula10'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['Capsula11'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['Capsula12'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['Capsula13'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['Capsula14'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['Capsula15'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['Capsula16'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['Capsula17'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['Capsula18'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-moldagem-kd1j">Amostra úmida + cápsula</td>
                                            <td class="tg-moldagem-78ff">g</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['amtUmidaCapsula1'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['amtUmidaCapsula2'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['amtUmidaCapsula3'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['amtUmidaCapsula4'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['amtUmidaCapsula5'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['amtUmidaCapsula6'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['amtUmidaCapsula7'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['amtUmidaCapsula8'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['amtUmidaCapsula9'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['amtUmidaCapsula10'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['amtUmidaCapsula11'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['amtUmidaCapsula12'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['amtUmidaCapsula13'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['amtUmidaCapsula14'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['amtUmidaCapsula15'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['amtUmidaCapsula16'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['amtUmidaCapsula17'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['amtUmidaCapsula18'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-moldagem-kd1j">Amostra seca + cápsula</td>
                                            <td class="tg-moldagem-78ff">g</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['amtSecaCapsula1'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['amtSecaCapsula2'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['amtSecaCapsula3'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['amtSecaCapsula4'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['amtSecaCapsula5'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['amtSecaCapsula6'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['amtSecaCapsula7'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['amtSecaCapsula8'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['amtSecaCapsula9'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['amtSecaCapsula10'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['amtSecaCapsula11'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['amtSecaCapsula12'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['amtSecaCapsula13'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['amtSecaCapsula14'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['amtSecaCapsula15'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['amtSecaCapsula16'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['amtSecaCapsula17'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['amtSecaCapsula18'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-moldagem-kd1j">Massa da cápsula</td>
                                            <td class="tg-moldagem-78ff">g</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['Massa_Da_Capsula1'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['Massa_Da_Capsula2'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['Massa_Da_Capsula3'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['Massa_Da_Capsula4'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['Massa_Da_Capsula5'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['Massa_Da_Capsula6'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['Massa_Da_Capsula7'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['Massa_Da_Capsula8'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['Massa_Da_Capsula9'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['Massa_Da_Capsula10'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['Massa_Da_Capsula11'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['Massa_Da_Capsula12'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['Massa_Da_Capsula13'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['Massa_Da_Capsula14'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['Massa_Da_Capsula15'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['Massa_Da_Capsula16'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['Massa_Da_Capsula17'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['Massa_Da_Capsula18'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-moldagem-kd1j">Massa de água</td>
                                            <td class="tg-moldagem-78ff">g</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['MassaAgua1'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['MassaAgua2'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['MassaAgua3'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['MassaAgua4'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['MassaAgua5'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['MassaAgua6'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['MassaAgua7'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['MassaAgua8'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['MassaAgua9'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['MassaAgua10'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['MassaAgua11'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['MassaAgua12'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['MassaAgua13'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['MassaAgua14'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['MassaAgua15'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['MassaAgua16'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['MassaAgua17'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['MassaAgua18'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-moldagem-kd1j">Massa de solo seco</td>
                                            <td class="tg-moldagem-78ff">g</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['MassaSoloSeco1'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['MassaSoloSeco2'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['MassaSoloSeco3'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['MassaSoloSeco4'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['MassaSoloSeco5'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['MassaSoloSeco6'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['MassaSoloSeco7'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['MassaSoloSeco8'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['MassaSoloSeco9'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['MassaSoloSeco10'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['MassaSoloSeco11'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['MassaSoloSeco12'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['MassaSoloSeco13'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['MassaSoloSeco14'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['MassaSoloSeco15'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['MassaSoloSeco16'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['MassaSoloSeco17'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['MassaSoloSeco18'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-moldagem-kd1j">Teor de umidade</td>
                                            <td class="tg-moldagem-78ff">%</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['TeorUmidade1'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['TeorUmidade2'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['TeorUmidade3'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['TeorUmidade4'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['TeorUmidade5'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['TeorUmidade6'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['TeorUmidade7'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['TeorUmidade8'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['TeorUmidade9'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['TeorUmidade10'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['TeorUmidade11'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['TeorUmidade12'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['TeorUmidade13'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['TeorUmidade14'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['TeorUmidade15'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['TeorUmidade16'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['TeorUmidade17'] . '</td>
                                            <td class="tg-moldagem-78ff">' . $dataIndiceSuporteCalifornia['TeorUmidade18'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-moldagem-kd1j">Teor de umidade médio</td>
                                            <td class="tg-moldagem-78ff">%</td>
                                            <td class="tg-moldagem-k23d" colspan="3"><b>' . $dataIndiceSuporteCalifornia['UmidadeMedia1'] . '</b></td>
                                            <td class="tg-moldagem-k23d" colspan="3"><b>' . $dataIndiceSuporteCalifornia['UmidadeMedia2'] . '</b></td>
                                            <td class="tg-moldagem-k23d" colspan="3"><b>' . $dataIndiceSuporteCalifornia['UmidadeMedia3'] . '</b></td>
                                            <td class="tg-moldagem-k23d" colspan="3"><b>' . $dataIndiceSuporteCalifornia['UmidadeMedia4'] . '</b></td>
                                            <td class="tg-moldagem-k23d" colspan="3"><b>' . $dataIndiceSuporteCalifornia['UmidadeMedia5'] . '</b></td>
                                            <td class="tg-moldagem-k23d" colspan="3"><b>' . $dataIndiceSuporteCalifornia['UmidadeMedia6'] . '</b></td>
                                        </tr>
                                        <tr>
                                            <td class="tg-moldagem-kd1j">Massa específica seca</td>
                                            <td class="tg-moldagem-78ff">g/cm³</td>
                                            <td class="tg-moldagem-k23d" colspan="3"><b>' . $dataIndiceSuporteCalifornia['MassaEspSeca1'] . '</b></td>
                                            <td class="tg-moldagem-k23d" colspan="3"><b>' . $dataIndiceSuporteCalifornia['MassaEspSeca2'] . '</b></td>
                                            <td class="tg-moldagem-k23d" colspan="3"><b>' . $dataIndiceSuporteCalifornia['MassaEspSeca3'] . '</b></td>
                                            <td class="tg-moldagem-k23d" colspan="3"><b>' . $dataIndiceSuporteCalifornia['MassaEspSeca4'] . '</b></td>
                                            <td class="tg-moldagem-k23d" colspan="3"><b>' . $dataIndiceSuporteCalifornia['MassaEspSeca5'] . '</b></td>
                                            <td class="tg-moldagem-k23d" colspan="3"><b>' . $dataIndiceSuporteCalifornia['MassaEspSeca6'] . '</b></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br />
                                <br />
                                <table class="tg-expansao" style="width: 100%">
                                    <colgroup>
                                        <col style="width: 125.2px;" />
                                        <col style="width: 125.2px;" />
                                        <col style="width: 32.2px;" />
                                        <col style="width: 45.2px;" />
                                        <col style="width: 32.2px;" />
                                        <col style="width: 45.2px;" />
                                        <col style="width: 32.2px;" />
                                        <col style="width: 45.2px;" />
                                        <col style="width: 32.2px;" />
                                        <col style="width: 45.2px;" />
                                        <col style="width: 32.2px;" />
                                        <col style="width: 45.2px;" />
                                        <col style="width: 32.2px;" />
                                        <col style="width: 45.2px;" />
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th class="tg-expansao-88oy" colspan="2" style="text-align: left">EXPANSÃO</th>
                                            <th class="tg-expansao-88oy" colspan="2">P1</th>
                                            <th class="tg-expansao-88oy" colspan="2">P2</th>
                                            <th class="tg-expansao-88oy" colspan="2">P3</th>
                                            <th class="tg-expansao-88oy" colspan="2">P4</th>
                                            <th class="tg-expansao-88oy" colspan="2">P5</th>
                                            <th class="tg-expansao-88oy" colspan="2">P6</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="tg-expansao-88oy" colspan="2">Altura do corpo-de-prova</td>
                                            <td class="tg-expansao-88oy" colspan="2">' . $dataIndiceSuporteCalifornia['AlturaDoMolde1'] . '</td>
                                            <td class="tg-expansao-88oy" colspan="2">' . $dataIndiceSuporteCalifornia['AlturaDoMolde2'] . '</td>
                                            <td class="tg-expansao-88oy" colspan="2">' . $dataIndiceSuporteCalifornia['AlturaDoMolde3'] . '</td>
                                            <td class="tg-expansao-88oy" colspan="2">' . $dataIndiceSuporteCalifornia['AlturaDoMolde4'] . '</td>
                                            <td class="tg-expansao-88oy" colspan="2">' . $dataIndiceSuporteCalifornia['AlturaDoMolde5'] . '1</td>
                                            <td class="tg-expansao-88oy" colspan="2">' . $dataIndiceSuporteCalifornia['AlturaDoMolde6'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-expansao-88oy">Data</td>
                                            <td class="tg-expansao-88oy">Hora</td>
                                            <td class="tg-expansao-88oy">Leitura</td>
                                            <td class="tg-expansao-88oy">Expansão</td>
                                            <td class="tg-expansao-88oy">Leitura</td>
                                            <td class="tg-expansao-88oy">Expansão</td>
                                            <td class="tg-expansao-88oy">Leitura</td>
                                            <td class="tg-expansao-88oy">Expansão</td>
                                            <td class="tg-expansao-88oy">Leitura</td>
                                            <td class="tg-expansao-88oy">Expansão</td>
                                            <td class="tg-expansao-88oy">Leitura</td>
                                            <td class="tg-expansao-88oy">Expansão</td>
                                            <td class="tg-expansao-88oy">Leitura</td>
                                            <td class="tg-expansao-88oy">Expansão</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['DataExpansao1'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['HoraExpansao1'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['LeituraExpansao1'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['Expansao1'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['LeituraExpansao2'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['Expansao2'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['LeituraExpansao3'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['Expansao3'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['LeituraExpansao4'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['Expansao4'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['LeituraExpansao5'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['Expansao5'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['LeituraExpansao6'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['Expansao6'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['DataExpansao2'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['HoraExpansao2'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['LeituraExpansao7'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['Expansao7'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['LeituraExpansao8'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['Expansao8'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['LeituraExpansao9'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['Expansao9'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['LeituraExpansao10'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['Expansao10'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['LeituraExpansao11'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['Expansao11'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['LeituraExpansao12'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['Expansao12'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['DataExpansao3'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['HoraExpansao3'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['LeituraExpansao13'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['Expansao13'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['LeituraExpansao14'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['Expansao14'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['LeituraExpansao15'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['Expansao15'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['LeituraExpansao16'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['Expansao16'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['LeituraExpansao17'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['Expansao17'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['LeituraExpansao17'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['Expansao17'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['DataExpansao4'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['HoraExpansao4'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['LeituraExpansao18'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['Expansao18'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['LeituraExpansao19'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['Expansao19'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['LeituraExpansao20'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['Expansao20'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['LeituraExpansao21'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['Expansao21'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['LeituraExpansao22'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['Expansao22'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['LeituraExpansao23'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['Expansao23'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['DataExpansao5'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['HoraExpansao5'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['LeituraExpansao24'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['Expansao24'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['LeituraExpansao25'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['Expansao25'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['LeituraExpansao26'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['Expansao26'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['LeituraExpansao27'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['Expansao27'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['LeituraExpansao28'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['Expansao28'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['LeituraExpansao29'] . '</td>
                                            <td class="tg-expansao-88oy">' . $dataIndiceSuporteCalifornia['Expansao29'] . '</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br />
                                <br />
                                <table class="tg-penetracao" style="width: 100%">
                                    <colgroup>
                                        <col style="width: 200.2px;" />
                                        <col style="width: 120.2px;" />
                                        <col style="width: 34.2px;" />
                                        <col style="width: 44.2px;" />
                                        <col style="width: 34.2px;" />
                                        <col style="width: 44.2px;" />
                                        <col style="width: 34.2px;" />
                                        <col style="width: 44.2px;" />
                                        <col style="width: 34.2px;" />
                                        <col style="width: 44.2px;" />
                                        <col style="width: 34.2px;" />
                                        <col style="width: 44.2px;" />
                                        <col style="width: 34.2px;" />
                                        <col style="width: 44.2px;" />
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th class="tg-penetracao-6rs4">Penetração</th>
                                            <th class="tg-penetracao-6rs4">Corpo de prova</th>
                                            <th class="tg-penetracao-6rs4" colspan="2">P1</th>
                                            <th class="tg-penetracao-6rs4" colspan="2">P2</th>
                                            <th class="tg-penetracao-6rs4" colspan="2">P3</th>
                                            <th class="tg-penetracao-6rs4" colspan="2">P4</th>
                                            <th class="tg-penetracao-6rs4" colspan="2">P5</th>
                                            <th class="tg-penetracao-6rs4" colspan="2">P6</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="tg-penetracao-6rs4">
                                                Tempo<br />
                                                (Min)
                                            </td>
                                            <td class="tg-penetracao-6rs4">
                                                Penetração<br />
                                                (mm)
                                            </td>
                                            <td class="tg-penetracao-6rs4">
                                                Carga<br />
                                                (Div)
                                            </td>
                                            <td class="tg-penetracao-6rs4">
                                                Pressão<br />
                                                (MPa)
                                            </td>
                                            <td class="tg-penetracao-6rs4">
                                                Carga<br />
                                                (Div)
                                            </td>
                                            <td class="tg-penetracao-6rs4">
                                                Pressão<br />
                                                (MPa)
                                            </td>
                                            <td class="tg-penetracao-6rs4">
                                                Carga<br />
                                                (Div)
                                            </td>
                                            <td class="tg-penetracao-6rs4">
                                                Pressão<br />
                                                (MPa)
                                            </td>
                                            <td class="tg-penetracao-6rs4">
                                                Carga<br />
                                                (Div)
                                            </td>
                                            <td class="tg-penetracao-6rs4">
                                                Pressão<br />
                                                (MPa)
                                            </td>
                                            <td class="tg-penetracao-6rs4">
                                                Carga<br />
                                                (Div)
                                            </td>
                                            <td class="tg-penetracao-6rs4">
                                                Pressão<br />
                                                (MPa)
                                            </td>
                                            <td class="tg-penetracao-6rs4">
                                                Carga<br />
                                                (Div)
                                            </td>
                                            <td class="tg-penetracao-6rs4">
                                                Pressão<br />
                                                (MPa)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Tempo1'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Penetracao1'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga1'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao1'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga2'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao2'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga3'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao3'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga4'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao4'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga5'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao5'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga6'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao6'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Tempo2'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Penetracao2'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga7'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao7'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga8'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao8'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga9'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao9'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga10'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao10'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga11'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao11'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga12'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao12'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Tempo3'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Penetracao3'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga13'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao13'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga14'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao14'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga15'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao15'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga16'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao16'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga17'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao17'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga18'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao18'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Tempo4'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Penetracao4'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga19'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao19'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga20'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao20'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga21'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao21'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga22'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao22'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga23'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao23'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga24'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao24'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Tempo5'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Penetracao5'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga25'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao25'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga26'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao26'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga27'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao27'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga28'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao28'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga29'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao29'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga30'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao30'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Tempo6'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Penetracao6'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga31'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao31'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga32'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao32'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga33'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao33'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga34'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao34'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga35'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao35'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga36'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao36'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Tempo7'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Penetracao7'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga37'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao37'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga38'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao38'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga39'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao39'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga40'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao41'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga41'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao42'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga42'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao42'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Tempo8'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Penetracao8'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga43'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao43'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga44'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao44'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga45'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao45'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga46'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao46'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga47'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao47'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga48'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao48'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Tempo9'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Penetracao9'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga49'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao49'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga50'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao50'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga51'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao51'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga52'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao52'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga53'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao53'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga54'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao54'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Tempo10'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Penetracao10'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga55'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao55'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga56'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao56'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga57'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao57'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga58'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao58'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga59'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao59'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga60'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao60'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Tempo11'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Penetracao11'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga61'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao61'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga62'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao62'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga63'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao63'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga64'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao64'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga65'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao65'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga66'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao66'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Tempo12'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Penetracao12'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga67'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao67'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga68'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao68'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga69'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao69'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga70'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao70'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga71'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao71'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Carga72'] . '</td>
                                            <td class="tg-penetracao-78ff">' . $dataIndiceSuporteCalifornia['Pressao72'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-penetracao-88oy">' . $dataIndiceSuporteCalifornia['Tempo13'] . '</td>
                                            <td class="tg-penetracao-88oy">' . $dataIndiceSuporteCalifornia['Penetracao13'] . '</td>
                                            <td class="tg-penetracao-88oy">' . $dataIndiceSuporteCalifornia['Carga73'] . '</td>
                                            <td class="tg-penetracao-88oy">' . $dataIndiceSuporteCalifornia['Pressao73'] . '</td>
                                            <td class="tg-penetracao-88oy">' . $dataIndiceSuporteCalifornia['Carga74'] . '</td>
                                            <td class="tg-penetracao-88oy">' . $dataIndiceSuporteCalifornia['Pressao74'] . '</td>
                                            <td class="tg-penetracao-88oy">' . $dataIndiceSuporteCalifornia['Carga75'] . '</td>
                                            <td class="tg-penetracao-88oy">' . $dataIndiceSuporteCalifornia['Pressao75'] . '</td>
                                            <td class="tg-penetracao-88oy">' . $dataIndiceSuporteCalifornia['Carga76'] . '</td>
                                            <td class="tg-penetracao-88oy">' . $dataIndiceSuporteCalifornia['Pressao76'] . '</td>
                                            <td class="tg-penetracao-88oy">' . $dataIndiceSuporteCalifornia['Carga77'] . '</td>
                                            <td class="tg-penetracao-88oy">' . $dataIndiceSuporteCalifornia['Pressao77'] . '</td>
                                            <td class="tg-penetracao-88oy">' . $dataIndiceSuporteCalifornia['Carga78'] . '</td>
                                            <td class="tg-penetracao-88oy">' . $dataIndiceSuporteCalifornia['Pressao78'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-penetracao-88oy">' . $dataIndiceSuporteCalifornia['Tempo14'] . '</td>
                                            <td class="tg-penetracao-88oy">' . $dataIndiceSuporteCalifornia['Penetracao14'] . '</td>
                                            <td class="tg-penetracao-88oy">' . $dataIndiceSuporteCalifornia['Carga79'] . '</td>
                                            <td class="tg-penetracao-88oy">' . $dataIndiceSuporteCalifornia['Pressao79'] . '</td>
                                            <td class="tg-penetracao-88oy">' . $dataIndiceSuporteCalifornia['Carga80'] . '</td>
                                            <td class="tg-penetracao-88oy">' . $dataIndiceSuporteCalifornia['Pressao80'] . '</td>
                                            <td class="tg-penetracao-88oy">' . $dataIndiceSuporteCalifornia['Carga81'] . '</td>
                                            <td class="tg-penetracao-88oy">' . $dataIndiceSuporteCalifornia['Pressao81'] . '</td>
                                            <td class="tg-penetracao-88oy">' . $dataIndiceSuporteCalifornia['Carga82'] . '</td>
                                            <td class="tg-penetracao-88oy">' . $dataIndiceSuporteCalifornia['Pressao82'] . '</td>
                                            <td class="tg-penetracao-88oy">' . $dataIndiceSuporteCalifornia['Carga83'] . '</td>
                                            <td class="tg-penetracao-88oy">' . $dataIndiceSuporteCalifornia['Pressao83'] . '</td>
                                            <td class="tg-penetracao-88oy">' . $dataIndiceSuporteCalifornia['Carga84'] . '</td>
                                            <td class="tg-penetracao-88oy">' . $dataIndiceSuporteCalifornia['Pressao84'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-penetracao-88oy">' . $dataIndiceSuporteCalifornia['Tempo15'] . '</td>
                                            <td class="tg-penetracao-88oy">' . $dataIndiceSuporteCalifornia['Penetracao15'] . '</td>
                                            <td class="tg-penetracao-88oy">' . $dataIndiceSuporteCalifornia['Carga85'] . '</td>
                                            <td class="tg-penetracao-88oy">' . $dataIndiceSuporteCalifornia['Pressao85'] . '</td>
                                            <td class="tg-penetracao-88oy">' . $dataIndiceSuporteCalifornia['Carga86'] . '</td>
                                            <td class="tg-penetracao-88oy">' . $dataIndiceSuporteCalifornia['Pressao86'] . '</td>
                                            <td class="tg-penetracao-88oy">' . $dataIndiceSuporteCalifornia['Carga87'] . '</td>
                                            <td class="tg-penetracao-88oy">' . $dataIndiceSuporteCalifornia['Pressao87'] . '</td>
                                            <td class="tg-penetracao-88oy">' . $dataIndiceSuporteCalifornia['Carga88'] . '</td>
                                            <td class="tg-penetracao-88oy">' . $dataIndiceSuporteCalifornia['Pressao88'] . '</td>
                                            <td class="tg-penetracao-88oy">' . $dataIndiceSuporteCalifornia['Carga89'] . '</td>
                                            <td class="tg-penetracao-88oy">' . $dataIndiceSuporteCalifornia['Pressao89'] . '</td>
                                            <td class="tg-penetracao-88oy">' . $dataIndiceSuporteCalifornia['Carga90'] . '</td>
                                            <td class="tg-penetracao-88oy">' . $dataIndiceSuporteCalifornia['Pressao90'] . '</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br>
                            </td>
                        </tr>
                        <tr>
          <td class="tg-0pky" colspan="15">
              <p class="title">Observação:</p>
              <div style="height: 35px;"> ' . $dataIndiceSuporteCalifornia['Observacao'] . ' <div>
          </td>
          </tr>
          <tr>
              <td class="tg-0pky" colspan="5">
                  <p class="title" style="top: 0 !important">Execução: </p> ' . (!empty($assinaturaExecutador) ? ' <img style="margin: 1px 0px 0px 50px" src="data:image/jpeg;base64,' . base64_encode($assinaturaExecutador[0]['Assinatura']) . '" alt="Imagem" height="10px" width="80px">
                  <p class="title"> ' . $assinaturaExecutador[0]['Nome'] . '</p>' : ' <br />
                  <div style="height: 10px"></div>
                  ') . '
              </td>
              <td class="tg-0pky" colspan="5">
                  <p class="title" style="top: 0 !important">Verificação: </p> ' . (!empty($assinaturaVerificador) ? ' <img style="margin: 1px 0px 0px 50px" src="data:image/jpeg;base64,' . base64_encode($assinaturaVerificador[0]['Assinatura']) . '" alt="Imagem" height="10px" width="80px">
                  <p class="title"> ' . $assinaturaVerificador[0]['Nome'] . '</p>' : ' <br />
                  <div style="height: 10px"></div>
                  ') . '
              </td>
              <td class="tg-0pky" colspan="5" style="overflow: hidden;">
                  <p class="title" style="top: 0 !important">Aprovação: </p> ' . (!empty($assinaturaAprovador) ? ' <img style="margin: 1px 0px 0px 50px" src="data:image/jpeg;base64,' . base64_encode($assinaturaAprovador[0]['Assinatura']) . '" alt="Imagem" height="10px" width="80px">
                  <p class="title"> ' . $assinaturaAprovador[0]['Nome'] . '</p>' : ' <br />
                  <div style="height: 10px"></div>
                  ') . '
              </td>
          </tr>
          <tr>
                      <td class="tg-0pky" colspan="15" style="padding: 4px 0px 0px 5px;">
                          <div style="width: 245px; display: inline-block">
                              <p class="title"> Código laboratório: ' . $dataHeaderAndFooter['Codigo_Laboratorio'] . ' </p>
                          </div>
                          <div style="width: 447px; display: inline-block;">
                              <p class="title"> DATA EMISSÃO: ' . $dataFormatada . ' </p>
                          </div>
                          <div style="display: inline-block">
                              <p class="title">Pág: ' . $pagina . '/' . $totalPaginas . ' </p>
                          </div>
                      </td>
                  </tr>
                    </tbody>
                </table>
            </main>
            <footer>
                <div style="text-align: center;">
                    <p style="font-size: 10px; font-weight: bold; margin: 0; font-family: Arial, sans-serif; !important">
                        Este relatório de ensaio só pode ser copiado integralmente ou parcialmente com autorização da Geocontrole
                    </p>
                    <p style="font-size: 10px; font-weight: bold; margin: 0; font-family: Arial, sans-serif; !important">
                        Av.Canadá,Nº 159 - Jardim Canadá Nova Lima - Minas Gerais - Brasil - CEP: 34007-654 Tel.: +55 31 3517-9011
                    </p>
                    <div style="width: 100%; background-color: green; color: #fff; font-family: Arial, sans-serif; !important">
                        www.geocontrole.com - e-mail: mail.br@geocontrole.com
                    </div>
                </div>
            </footer>
        </body>
    </html>';
        return $html;
    }
}
