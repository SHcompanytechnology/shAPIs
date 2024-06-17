<?php
require_once 'mainSheet.php';
include_once('configureteConnection.php');
class GranulometricAnalysisWithSedimentation
{
    private $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function generateModel($codSample, $numberSample, $observation, $dataHeaderAndFooter, $pagina, $totalPaginas, $dataAnaliseGranulometricaSedimentacao, $logo, $dataFormatada)
    {

        $conexao = new ConfigureteConnection();
        $conexao->connect();

        $pdo = $conexao->getConnection();

        if ($pdo === null) {
            return null;
        }

        $executador = $dataAnaliseGranulometricaSedimentacao['Executado'];
        $aprovador = $dataAnaliseGranulometricaSedimentacao['Aprovado'];
        $verificador = $dataAnaliseGranulometricaSedimentacao['Verificado'];

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
            .tg-corrections-table {
                border-collapse: collapse;
                border-spacing: 0;
                margin: 0px auto;
            }
            .tg-corrections-table td {
                border-color: black;
                border-style: solid;
                border-width: 1px;
                font-family: Arial, sans-serif;
                font-size: 10px;
                overflow: hidden;
                padding: 10px 5px;
                word-break: normal;
            }
            .tg-corrections-table th {
                border-color: black;
                border-style: solid;
                border-width: 1px;
                font-family: Arial, sans-serif;
                font-size: 10px;
                font-weight: normal;
                overflow: hidden;
                padding: 10px 5px;
                word-break: normal;
            }
            .tg-corrections-table .tg-corrections-table-amwm {
                font-weight: normal;
                text-align: start;
                vertical-align: top;
            }
            .tg-corrections-table .tg-corrections-table-0lax {
                text-align: left;
                vertical-align: top;
            }
            @media screen and (max-width: 767px) {
                .tg-corrections-table {
                    width: auto !important;
                }
                .tg-corrections-table col {
                    width: auto !important;
                }
                .tg-corrections-table-wrap {
                    overflow-x: auto;
                    -webkit-overflow-scrolling: touch;
                    margin: auto 0px;
                }
            }

            .tg-secund-table {
                border-collapse: collapse;
                border-spacing: 0;
                margin: 0px auto;
            }
            .tg-secund-table td {
                border-color: black;
                border-style: solid;
                border-width: 1px;
                font-family: Arial, sans-serif;
                font-size: 14px;
                overflow: hidden;
                padding: 5px 5px;
                word-break: normal;
            }
            .tg-secund-table th {
                border-color: black;
                border-style: solid;
                border-width: 1px;
                font-family: Arial, sans-serif;
                font-size: 14px;
                font-weight: normal;
                overflow: hidden;
                padding: 10px 5px;
                word-break: normal;
            }
            .tg-secund-table .tg-secund-table-91w8 {
                border-color: inherit;
                font-size: 10px;
                text-align: center;
                vertical-align: top;
            }
            @media screen and (max-width: 767px) {
                .tg-secund-table {
                    width: auto !important;
                }
                .tg-secund-table col {
                    width: auto !important;
                }
                .tg-secund-table-wrap {
                    overflow-x: auto;
                    -webkit-overflow-scrolling: touch;
                    margin: auto 0px;
                }
            }

            .tg-primary-table {
                border-collapse: collapse;
                border-spacing: 0;
                margin: 0px auto;
            }
            .tg-primary-table td {
                border-color: black;
                border-style: solid;
                border-width: 1px;
                font-family: Arial, sans-serif;
                font-size: 10px;
                overflow: hidden;
                padding: 5px 5px;
                word-break: normal;
            }
            .tg-primary-table th {
                border-color: black;
                border-style: solid;
                border-width: 1px;
                font-family: Arial, sans-serif;
                font-size: 10px;
                font-weight: normal;
                overflow: hidden;
                padding: 10px 5px;
                word-break: normal;
            }
            .tg-primary-table .tg-primary-table-fymr {
                border-color: inherit;
                font-weight: bold;
                text-align: left;
                vertical-align: top;
            }
            .tg-primary-table .tg-primary-table-0pky {
                border-color: inherit;
                text-align: center;
                vertical-align: top;
            }
            @media screen and (max-width: 767px) {
                .tg-primary-table {
                    width: auto !important;
                }
                .tg-primary-table col {
                    width: auto !important;
                }
                .tg-primary-table-wrap {
                    overflow-x: auto;
                    -webkit-overflow-scrolling: touch;
                    margin: auto 0px;
                }
            }

            .tg-densimetro-table {
                border-collapse: collapse;
                border-spacing: 0;
                margin: 0px auto;
            }
            .tg-densimetro-table td {
                border-color: black;
                border-style: solid;
                border-width: 1px;
                font-family: Arial, sans-serif;
                font-size: 10px;
                overflow: hidden;
                padding: 5px 5px;
                word-break: normal;
            }
            .tg-densimetro-table th {
                border-color: black;
                border-style: solid;
                border-width: 1px;
                font-family: Arial, sans-serif;
                font-size: 10px;
                font-weight: normal;
                overflow: hidden;
                padding: 5px 5px;
                word-break: normal;
            }
            .tg-densimetro-table .tg-densimetro-table-1wig {
                text-align: left;
                vertical-align: middle;
            }
            .tg-densimetro-table .tg-densimetro-table-0lax {
                text-align: left;
                vertical-align: middle;
            }
            @media screen and (max-width: 767px) {
                .tg-densimetro-table {
                    width: auto !important;
                }
                .tg-densimetro-table col {
                    width: auto !important;
                }
                .tg-densimetro-table-wrap {
                    overflow-x: auto;
                    -webkit-overflow-scrolling: touch;
                    margin: auto 0px;
                }
            }

            .tg-density {
                border-collapse: collapse;
                border-spacing: 0;
                margin: 0px auto;
            }
            .tg-density td {
                border-color: black;
                border-style: solid;
                border-width: 1px;
                font-family: Arial, sans-serif;
                font-size: 10px;
                overflow: hidden;
                padding: 5px 5px;
                word-break: normal;
            }
            .tg-density th {
                border-color: black;
                border-style: solid;
                border-width: 1px;
                font-family: Arial, sans-serif;
                font-size: 10px;
                font-weight: normal;
                overflow: hidden;
                padding: 5px 0px 5px 5px !important;
                word-break: normal;
            }
            .tg-density .tg-density-1wig {
                font-weight: normal;
                text-align: left !important;
                vertical-align: middle;
            }
            .tg-density .tg-density-0lax {
                text-align: center;
                vertical-align: middle;
            }
            @media screen and (max-width: 767px) {
                .tg-density {
                    width: auto !important;
                }
                .tg-density col {
                    width: auto !important;
                }
                .tg-density-wrap {
                    overflow-x: auto;
                    -webkit-overflow-scrolling: touch;
                    margin: auto 0px;
                }
            }

            .tg-density-table {
                border-collapse: collapse;
                border-spacing: 0;
                margin: 0px auto;
            }
            .tg-density-table td {
                border-color: black;
                border-style: solid;
                border-width: 1px;
                font-family: Arial, sans-serif;
                font-size: 10px;
                overflow: hidden;
                padding: 5px 5px;
                word-break: normal;
            }
            .tg-density-table th {
                border-color: black;
                border-style: solid;
                border-width: 1px;
                font-family: Arial, sans-serif;
                font-size: 10px;
                font-weight: normal;
                overflow: hidden;
                padding: 5px 5px;
                word-break: normal;
            }
            .tg-density-table .tg-density-table-1wig {
                font-weight: bold;
                text-align: left;
                vertical-align: middle;
            }
            .tg-density-table .tg-density-table-0lax {
                text-align: left;
                vertical-align: middle;
            }
            @media screen and (max-width: 767px) {
                .tg-density-table {
                    width: auto !important;
                }
                .tg-density-table col {
                    width: auto !important;
                }
                .tg-density-table-wrap {
                    overflow-x: auto;
                    -webkit-overflow-scrolling: touch;
                    margin: auto 0px;
                }
            }

            .tg-pedregulho {
                border-collapse: collapse;
                border-spacing: 0;
                margin: 0px auto;
            }
            .tg-pedregulho td {
                border-color: black;
                border-style: solid;
                border-width: 1px;
                font-size: 10px;
                overflow: hidden;
                padding: 5px 0px 5px 3px !important;
                word-break: normal;
            }
            .tg-pedregulho th {
                border-color: black;
                border-style: solid;
                border-width: 1px;
                font-family: Arial, sans-serif;
                font-size: 10px;
                font-weight: normal;
                overflow: hidden;
                padding: 5px 0px 5px 3px;
                word-break: normal;
            }
            .tg-pedregulho .tg-pedregulho-0lax {
                text-align: left;
                vertical-align: middle;
            }
            @media screen and (max-width: 767px) {
                .tg-pedregulho {
                    width: auto !important;
                }
                .tg-pedregulho col {
                    width: auto !important;
                }
                .tg-pedregulho-wrap {
                    overflow-x: auto;
                    -webkit-overflow-scrolling: touch;
                    margin: auto 0px;
                }
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
                                ANÁLISE GRANULOMÉTRICA<div>
                        </th>
                    </tr>
                    <tr>
                        <th class="tg-cabecalho-0pky" colspan="1" style="padding: 0px !important">
                            <table class="tg-cabecalho" style="width: 100%">
                                <thead>
                                    <tr>
                                      <td class="tg-cabecalho-0pky" style="width: 160px !important;padding-bottom: 0px; border-top-color:#fff; border-bottom-color:#fff;white-space: nowrap; border-left-color:#fff"> 
                                            NORMA:
                                          <div style="font-size: 102x; margin-left: 10px; margin-top: 6px; margin-bottom: 5px" class="cabecalho-resultado-font">' . $dataAnaliseGranulometricaSedimentacao['Norma'] . '</div>
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
                                  <span class="cabecalho-resultado-font">' . $dataAnaliseGranulometricaSedimentacao['DataInicio'] . '</span>
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
                                <span class="cabecalho-resultado-font">' . $dataAnaliseGranulometricaSedimentacao['DataFinal'] . '</span>
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
<td class="tg-0pky" colspan="15" style="border-left: none !important; border-right: none !important; border-top-color: #fff; padding-left: 0px !important; padding-right: 0px !important; height: 675px;">                            <div class="tg-primary-table-wrap">
                                <div style="border: 1px solid #000; margin-bottom: 4px;padding:3px 3px; margin-right: 308px; width: 205px; display: inline-block; font-size: 10px">ELEMENTOS GROSSEIROS</div>
                                <style type="text/css">
                                    .tg-tabela-totalmente-a-direita  {border-collapse:collapse;border-spacing:0;}
                                    .tg-tabela-totalmente-a-direita td{border-color:black;border-style:solid;border-width:1px;font-size:10px;
                                    overflow:hidden;padding:3px 3px;word-break:normal;}
                                    .tg-tabela-totalmente-a-direita th{border-color:black;border-style:solid;border-width:1px;font-size:10px;
                                    font-weight:normal;overflow:hidden;padding:3px 3px;word-break:normal;}
                                    .tg-tabela-totalmente-a-direita .tg-tabela-totalmente-a-direita-baqh{text-align:center;vertical-align:top}
                                    .tg-tabela-totalmente-a-direita .tg-tabela-totalmente-a-direita-0lax{text-align:left;vertical-align:top}
                                </style>

                                <div style="display: inline-block; margin-bottom: 4px">
                                    <table class="tg-tabela-totalmente-a-direita">
                                        <tr>
                                            <td class="tg-tabela-totalmente-a-direita-baqh" style="width: 142px">Massa total da amostra seca</td>
                                            <td class="tg-tabela-totalmente-a-direita-0lax" style="width: 75px; text-align: center">' . $dataAnaliseGranulometricaSedimentacao['Massaseca'] . ' g</td>
                                        </tr>
                                    </table>
                                </div>
                                
                                <table class="tg-primary-table" style="width: 100%">
                                    <tbody>
                                        <tr>
                                            <td class="tg-primary-table-0pky" style="width: 200px">Designação da peneira (Malha mm)</td>
                                            <td class="tg-primary-table-0pky">' . $dataAnaliseGranulometricaSedimentacao['Dimensao1'] . '</td>
                                            <td class="tg-primary-table-0pky">' . $dataAnaliseGranulometricaSedimentacao['Dimensao2'] . '</td>
                                            <td class="tg-primary-table-0pky">' . $dataAnaliseGranulometricaSedimentacao['Dimensao3'] . '</td>
                                            <td class="tg-primary-table-0pky">' . $dataAnaliseGranulometricaSedimentacao['Dimensao4'] . '</td>
                                            <td class="tg-primary-table-0pky">' . $dataAnaliseGranulometricaSedimentacao['Dimensao5'] . '</td>
                                            <td class="tg-primary-table-0pky">' . $dataAnaliseGranulometricaSedimentacao['Dimensao6'] . '</td>
                                            <td class="tg-primary-table-0pky">' . $dataAnaliseGranulometricaSedimentacao['Dimensao7'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-primary-table-0pky">Massa retida acumulada (g)</td>
                                            <td class="tg-primary-table-0pky">' . $dataAnaliseGranulometricaSedimentacao['Retidos1'] . '</td>
                                            <td class="tg-primary-table-0pky">' . $dataAnaliseGranulometricaSedimentacao['Retidos2'] . '</td>
                                            <td class="tg-primary-table-0pky">' . $dataAnaliseGranulometricaSedimentacao['Retidos3'] . '</td>
                                            <td class="tg-primary-table-0pky">' . $dataAnaliseGranulometricaSedimentacao['Retidos4'] . '</td>
                                            <td class="tg-primary-table-0pky">' . $dataAnaliseGranulometricaSedimentacao['Retidos5'] . '</td>
                                            <td class="tg-primary-table-0pky">' . $dataAnaliseGranulometricaSedimentacao['Retidos6'] . '</td>
                                            <td class="tg-primary-table-0pky">' . $dataAnaliseGranulometricaSedimentacao['Retidos7'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-primary-table-0pky">% Acumulada</td>
                                            <td class="tg-primary-table-0pky">' . $dataAnaliseGranulometricaSedimentacao['acumulados1'] . '</td>
                                            <td class="tg-primary-table-0pky">' . $dataAnaliseGranulometricaSedimentacao['acumulados2'] . '</td>
                                            <td class="tg-primary-table-0pky">' . $dataAnaliseGranulometricaSedimentacao['acumulados3'] . '</td>
                                            <td class="tg-primary-table-0pky">' . $dataAnaliseGranulometricaSedimentacao['acumulados4'] . '</td>
                                            <td class="tg-primary-table-0pky">' . $dataAnaliseGranulometricaSedimentacao['acumulados5'] . '</td>
                                            <td class="tg-primary-table-0pky">' . $dataAnaliseGranulometricaSedimentacao['acumulados6'] . '</td>
                                            <td class="tg-primary-table-0pky">' . $dataAnaliseGranulometricaSedimentacao['acumulados7'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-primary-table-0pky">% Passada</td>
                                            <td class="tg-primary-table-0pky" style="background-color:#c8c8c8; font-weight: bold; font-size: 12px">' . $dataAnaliseGranulometricaSedimentacao['Passados1'] . '</td>
                                            <td class="tg-primary-table-0pky" style="background-color:#c8c8c8; font-weight: bold; font-size: 12px">' . $dataAnaliseGranulometricaSedimentacao['Passados2'] . '</td>
                                            <td class="tg-primary-table-0pky" style="background-color:#c8c8c8; font-weight: bold; font-size: 12px">' . $dataAnaliseGranulometricaSedimentacao['Passados3'] . '</td>
                                            <td class="tg-primary-table-0pky" style="background-color:#c8c8c8; font-weight: bold; font-size: 12px">' . $dataAnaliseGranulometricaSedimentacao['Passados4'] . '</td>
                                            <td class="tg-primary-table-0pky" style="background-color:#c8c8c8; font-weight: bold; font-size: 12px">' . $dataAnaliseGranulometricaSedimentacao['Passados5'] . '</td>
                                            <td class="tg-primary-table-0pky" style="background-color:#c8c8c8; font-weight: bold; font-size: 12px">' . $dataAnaliseGranulometricaSedimentacao['Passados6'] . '</td>
                                            <td class="tg-primary-table-0pky" style="background-color:#c8c8c8; font-weight: bold; font-size: 12px">' . $dataAnaliseGranulometricaSedimentacao['Passados7'] . '</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <br />
                            <br />

                            <div class="tg-primary-table-wrap" style="width: 100%">
                                <div style="border: 1px solid #000; margin-bottom: 4px;padding:3px 3px; margin-right: 302px; width: 205px; display: inline-block; font-size: 10px">ELEMENTOS FINOS</div>
                                    <style type="text/css">
                                        .tg-tabela-totalmente-a-direita  {border-collapse:collapse;border-spacing:0;}
                                        .tg-tabela-totalmente-a-direita td{border-color:black;border-style:solid;border-width:1px;font-size:10px;
                                        overflow:hidden;padding:3px 3px;word-break:normal;}
                                        .tg-tabela-totalmente-a-direita th{border-color:black;border-style:solid;border-width:1px;font-size:10px;
                                        font-weight:normal;overflow:hidden;padding:3px 3px;word-break:normal;}
                                        .tg-tabela-totalmente-a-direita .tg-tabela-totalmente-a-direita-baqh{text-align:center;vertical-align:top}
                                        .tg-tabela-totalmente-a-direita .tg-tabela-totalmente-a-direita-0lax{text-align:left;vertical-align:top}
                                    </style>

                                    <div style="display: inline-block; margin-bottom: 4px">
                                        <table class="tg-tabela-totalmente-a-direita">
                                            <tr>
                                                <td class="tg-tabela-totalmente-a-direita-baqh" style="width: 148px">Massa seca dos elementos finos:</td>
                                                <td class="tg-tabela-totalmente-a-direita-0lax" style="width: 75px; text-align: center">' . $dataAnaliseGranulometricaSedimentacao['MassaFinos'] . ' g</td>
                                            </tr>
                                        </table>
                                    </div>
                                <table class="tg-primary-table" style="width: 100%">
                                    <tbody>
                                        <tr>
                                            <td class="tg-primary-table-0pky" style="width: 200px">Designação da peneira</td>
                                            <td class="tg-primary-table-0pky">' . $dataAnaliseGranulometricaSedimentacao['Dimensao8'] . '</td>
                                            <td class="tg-primary-table-0pky">' . $dataAnaliseGranulometricaSedimentacao['Dimensao9'] . '</td>
                                            <td class="tg-primary-table-0pky">' . $dataAnaliseGranulometricaSedimentacao['Dimensao10'] . '</td>
                                            <td class="tg-primary-table-0pky">' . $dataAnaliseGranulometricaSedimentacao['Dimensao11'] . '</td>
                                            <td class="tg-primary-table-0pky">' . $dataAnaliseGranulometricaSedimentacao['Dimensao12'] . '</td>
                                            <td class="tg-primary-table-0pky">' . $dataAnaliseGranulometricaSedimentacao['Dimensao13'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-primary-table-0pky">Massa retida acumulada (g)</td>
                                            <td class="tg-primary-table-0pky">' . $dataAnaliseGranulometricaSedimentacao['RetidosG1'] . '</td>
                                            <td class="tg-primary-table-0pky">' . $dataAnaliseGranulometricaSedimentacao['RetidosG2'] . '</td>
                                            <td class="tg-primary-table-0pky">' . $dataAnaliseGranulometricaSedimentacao['RetidosG3'] . '</td>
                                            <td class="tg-primary-table-0pky">' . $dataAnaliseGranulometricaSedimentacao['RetidosG4'] . '</td>
                                            <td class="tg-primary-table-0pky">' . $dataAnaliseGranulometricaSedimentacao['RetidosG5'] . '</td>
                                            <td class="tg-primary-table-0pky">' . $dataAnaliseGranulometricaSedimentacao['RetidosG6'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-primary-table-0pky">% Acumulada</td>
                                            <td class="tg-primary-table-0pky">' . $dataAnaliseGranulometricaSedimentacao['bulbo1'] . '</td>
                                            <td class="tg-primary-table-0pky">' . $dataAnaliseGranulometricaSedimentacao['Acumulado2'] . '</td>
                                            <td class="tg-primary-table-0pky">' . $dataAnaliseGranulometricaSedimentacao['Acumulado3'] . '</td>
                                            <td class="tg-primary-table-0pky">' . $dataAnaliseGranulometricaSedimentacao['Acumulado4'] . '</td>
                                            <td class="tg-primary-table-0pky">' . $dataAnaliseGranulometricaSedimentacao['Acumulado5'] . '</td>
                                            <td class="tg-primary-table-0pky">' . $dataAnaliseGranulometricaSedimentacao['Acumulado6'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-primary-table-0pky">% Corrigida para a massa total</td>
                                            <td class="tg-primary-table-0pky">' . $dataAnaliseGranulometricaSedimentacao['MassaTotal1'] . '</td>
                                            <td class="tg-primary-table-0pky">' . $dataAnaliseGranulometricaSedimentacao['MassaTotal2'] . '</td>
                                            <td class="tg-primary-table-0pky">' . $dataAnaliseGranulometricaSedimentacao['MassaTotal3'] . '</td>
                                            <td class="tg-primary-table-0pky">' . $dataAnaliseGranulometricaSedimentacao['MassaTotal4'] . '</td>
                                            <td class="tg-primary-table-0pky">' . $dataAnaliseGranulometricaSedimentacao['MassaTotal5'] . '</td>
                                            <td class="tg-primary-table-0pky">' . $dataAnaliseGranulometricaSedimentacao['MassaTotal6'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-primary-table-0pky">% Passada referida ao total</td>
                                            <td class="tg-primary-table-0pky" style="background-color:#c8c8c8; font-weight: bold; font-size: 12px">' . $dataAnaliseGranulometricaSedimentacao['Total1'] . '</td>
                                            <td class="tg-primary-table-0pky" style="background-color:#c8c8c8; font-weight: bold; font-size: 12px">' . $dataAnaliseGranulometricaSedimentacao['Total2'] . '</td>
                                            <td class="tg-primary-table-0pky" style="background-color:#c8c8c8; font-weight: bold; font-size: 12px">' . $dataAnaliseGranulometricaSedimentacao['Total3'] . '</td>
                                            <td class="tg-primary-table-0pky" style="background-color:#c8c8c8; font-weight: bold; font-size: 12px">' . $dataAnaliseGranulometricaSedimentacao['Total4'] . '</td>
                                            <td class="tg-primary-table-0pky" style="background-color:#c8c8c8; font-weight: bold; font-size: 12px">' . $dataAnaliseGranulometricaSedimentacao['Total5'] . '</td>
                                            <td class="tg-primary-table-0pky" style="background-color:#c8c8c8; font-weight: bold; font-size: 12px">' . $dataAnaliseGranulometricaSedimentacao['Total6'] . '</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <br />
                            <br />
                            <br />
                            <br />
                            <br />
                            <br />
                            <br />
                            <br />
                            <div class="tg-secund-table-wrap" style="display: inline-block; margin-bottom: -40px;">
                                <table class="tg-secund-table" style="undefined;table-layout: fixed; width: 451px">
                                    <colgroup>
                                        <col style="width: 53px;" />
                                        <col style="width: 43px;" />
                                        <col style="width: 66px;" />
                                        <col style="width: 80px;" />
                                        <col style="width: 67px;" />
                                        <col style="width: 63px;" />
                                        <col style="width: 78px;" />
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th class="tg-secund-table-91w8">
                                                Tempo<br />
                                                t (min)
                                            </th>
                                            <th class="tg-secund-table-91w8">
                                                Tempo<br />
                                                T (°)
                                            </th>
                                            <th class="tg-secund-table-91w8">
                                                Leitura no <br />
                                                densímetro L
                                            </th>
                                            <th class="tg-secund-table-91w8">
                                                Leitura corrigida<br />
                                                (L - Ld)
                                            </th>
                                            <th class="tg-secund-table-91w8">
                                                Altura ao<br />
                                                bulbo a
                                            </th>
                                            <th class="tg-secund-table-91w8">
                                                Diâmetro<br />
                                                partículas
                                            </th>
                                            <th class="tg-secund-table-91w8">
                                                % de partículas<br />
                                                sedimentada
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['Tempo_1'] . ',5</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['temperatura1'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['desimetro1'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['corrigida1'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['bulbo1'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['partículas1'] . '</td>
                                            <td class="tg-secund-table-91w8" style="background-color:#c8c8c8; font-weight: bold; font-size: 12px">' . $dataAnaliseGranulometricaSedimentacao['partículas1'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['Tempo_2'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['temperatura2'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['desimetro2'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['corrigida2'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['bulbo2'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['partículas2'] . '</td>
                                            <td class="tg-secund-table-91w8" style="background-color:#c8c8c8; font-weight: bold; font-size: 12px">' . $dataAnaliseGranulometricaSedimentacao['partículas2'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['Tempo_3'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['temperatura3'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['desimetro3'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['corrigida3'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['bulbo3'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['partículas3'] . '</td>
                                            <td class="tg-secund-table-91w8" style="background-color:#c8c8c8; font-weight: bold; font-size: 12px">' . $dataAnaliseGranulometricaSedimentacao['partículas3'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['Tempo_4'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['temperatura4'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['desimetro4'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['corrigida4'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['bulbo4'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['partículas4'] . '</td>
                                            <td class="tg-secund-table-91w8" style="background-color:#c8c8c8; font-weight: bold; font-size: 12px">' . $dataAnaliseGranulometricaSedimentacao['partículas4'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['Tempo_5'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['temperatura5'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['desimetro5'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['corrigida5'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['bulbo5'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['partículas5'] . '</td>
                                            <td class="tg-secund-table-91w8" style="background-color:#c8c8c8; font-weight: bold; font-size: 12px">' . $dataAnaliseGranulometricaSedimentacao['partículas5'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['Tempo_6'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['temperatura6'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['desimetro6'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['corrigida6'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['bulbo6'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['partículas6'] . '</td>
                                            <td class="tg-secund-table-91w8" style="background-color:#c8c8c8; font-weight: bold; font-size: 12px">' . $dataAnaliseGranulometricaSedimentacao['partículas6'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['Tempo_7'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['temperatura7'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['desimetro7'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['corrigida7'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['bulbo7'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['partículas7'] . '</td>
                                            <td class="tg-secund-table-91w8" style="background-color:#c8c8c8; font-weight: bold; font-size: 12px">' . $dataAnaliseGranulometricaSedimentacao['partículas7'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['Tempo_8'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['temperatura8'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['desimetro8'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['corrigida8'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['bulbo8'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['partículas8'] . '</td>
                                            <td class="tg-secund-table-91w8" style="background-color:#c8c8c8; font-weight: bold; font-size: 12px">' . $dataAnaliseGranulometricaSedimentacao['partículas8'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['Tempo_9'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['temperatura9'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['desimetro9'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['corrigida9'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['bulbo9'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['partículas9'] . '</td>
                                            <td class="tg-secund-table-91w8" style="background-color:#c8c8c8; font-weight: bold; font-size: 12px">' . $dataAnaliseGranulometricaSedimentacao['partículas9'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['Tempo_10'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['temperatura10'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['desimetro10'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['corrigida10'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['bulbo10'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['partículas10'] . '</td>
                                            <td class="tg-secund-table-91w8" style="background-color:#c8c8c8; font-weight: bold; font-size: 12px">' . $dataAnaliseGranulometricaSedimentacao['partículas10'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['Tempo_11'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['temperatura11'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['desimetro11'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['corrigida11'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['bulbo11'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['partículas11'] . '</td>
                                            <td class="tg-secund-table-91w8" style="background-color:#c8c8c8; font-weight: bold; font-size: 12px">' . $dataAnaliseGranulometricaSedimentacao['partículas11'] . 'd>
                                        </tr>
                                        <tr>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['Tempo_12'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['temperatura12'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['desimetro12'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['corrigida12'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['bulbo12'] . '</td>
                                            <td class="tg-secund-table-91w8">' . $dataAnaliseGranulometricaSedimentacao['partículas12'] . '</td>
                                            <td class="tg-secund-table-91w8" style="background-color:#c8c8c8; font-weight: bold; font-size: 12px">' . $dataAnaliseGranulometricaSedimentacao['partículas12'] . '</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div style="display: inline-block; margin-left: 480px; margin-bottom: -40px;">
                                <div class="tg-corrections-table-wrap">
                                    <table class="tg-corrections-table" style="width: 275px">
                                        <colgroup>
                                            <col style="width: 79px;" />
                                            <col style="width: 51px;" />
                                            <col style="width: 68px;" />
                                        </colgroup>
                                        <thead>
                                            <tr>
                                                <td class="tg-corrections-table-amwm" rowspan="2">
                                                    <br>
                                                    Correções:
                                                </td>
                                                <td class="tg-corrections-table-0lax">Menisco:</td>
                                                <td class="tg-corrections-table-0lax">' . $dataAnaliseGranulometricaSedimentacao['Menisco'] . '</td>
                                            </tr>
                                            <tr>
                                                <td class="tg-corrections-table-0lax">Defloculante:</td>
                                                <td class="tg-corrections-table-0lax">' . $dataAnaliseGranulometricaSedimentacao['Defloculante'] . '</td>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <br />
                                <br />
                                <div class="tg-densimetro-table-wrap">
                                    <table class="tg-densimetro-table" style="width: 275px">
                                        <tbody>
                                            <tr>
                                                <td class="tg-densimetro-table-0lax">Densimetro nº:</td>
                                                <td class="tg-densimetro-table-0lax">' . $dataAnaliseGranulometricaSedimentacao['desimetro'] . '</td>
                                            </tr>
                                            <tr>
                                                <td class="tg-densimetro-table-0lax">Massa do solo usada na sedimentação:</td>
                                                <td class="tg-densimetro-table-0lax">' . $dataAnaliseGranulometricaSedimentacao['MassaDoSolo'] . '</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <br />
                                <br />
                                <div class="tg-density-wrap">
                                    <table class="tg-density" style="width: 275px; margin-bottom: 70px">
                                        <colgroup>
                                            <col style="width: 136px;" />
                                            <col style="width: 20px;" />
                                            <col style="width: 83px;" />
                                        </colgroup>
                                        <thead>
                                            <tr>
                                                <th class="tg-density-1wig" colspan="2">
                                                    Densidade das partículas:
                                                </th>
                                                <th class="tg-density-0lax">' . $dataAnaliseGranulometricaSedimentacao['Particulas'] . ' g/cm³</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <br />
                                <br />
                                <div class="tg-pedregulho-wrap">
                                    <table class="tg-pedregulho" style="width: 275px">
                                        <tbody>
                                            <tr>
                                                <td class="tg-pedregulho-0lax">Pedregulho:</td>
                                                <td class="tg-pedregulho-0lax" style="text-align: center">' . $dataAnaliseGranulometricaSedimentacao['Pedregulho'] . '</td>
                                                <td class="tg-pedregulho-0lax">Areia:</td>
                                                <td class="tg-pedregulho-0lax" style="text-align: center">' . $dataAnaliseGranulometricaSedimentacao['Areia'] . '</td>
                                            </tr>
                                            <tr>
                                                <td class="tg-pedregulho-0lax">Silte:</td>
                                                <td class="tg-pedregulho-0lax" style="text-align: center">' . $dataAnaliseGranulometricaSedimentacao['Silte'] . '</td>
                                                <td class="tg-pedregulho-0lax">Argila:</td>
                                                <td class="tg-pedregulho-0lax" style="text-align: center">' . $dataAnaliseGranulometricaSedimentacao['Argila'] . '</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br><br>
                        </td>
                    </tr>
                    <tr>
          <td class="tg-0pky" colspan="15">
              <p class="title">Observação:</p>
              <div style="height: 35px;"> ' . $dataAnaliseGranulometricaSedimentacao['Observacoes'] . ' <div>
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
</html>


';
        return $html;
    }
}
