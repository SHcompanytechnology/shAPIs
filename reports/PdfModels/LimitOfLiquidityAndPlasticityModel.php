<?php
require_once 'mainSheet.php';
include_once('configureteConnection.php');
class LimitOfLiquidityAndPlasticityModel
{
    private $data;
    public function __construct($data)
    {
        $this->data = $data;
    }
    public function generateModel($codSample, $numberSample, $observation, $dataHeaderAndFooter, $pagina, $totalPaginas, $dataLimitesAttemberg, $logo, $dataFormatada)
    {
        $conexao = new ConfigureteConnection();
        $conexao->connect();

        $pdo = $conexao->getConnection();

        if ($pdo === null) {
            return null;
        }

        $executador = $dataLimitesAttemberg['Executado'];
        $aprovador = $dataLimitesAttemberg['Aprovado'];
        $verificador = $dataLimitesAttemberg['Verificado'];

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

        $np = $dataLimitesAttemberg['NP'] === "NP" ? true : false;

        $html = '<html>
        <head>
            <style type="text/css">

                .tg-main-table-2 {
                    border-collapse: collapse;
                    border-spacing: 0;
                    margin: 0px auto;
                }
                .tg-main-table-2 td {
                    border-color: black;
                    border-style: solid;
                    border-width: 1px;
                    font-family: Arial, sans-serif;
                    font-size: 14px;
                    overflow: hidden;
                    padding: 10px 10px;
                    word-break: normal;
                }
                .tg-main-table-2 th {
                    border-color: black;
                    border-style: solid;
                    border-width: 1px;
                    font-family: Arial, sans-serif;
                    font-size: 14px;
                    font-weight: normal;
                    overflow: hidden;
                    padding: 2px 5px;
                    word-break: normal;
                }
                .tg-main-table-2 .tg-main-table-2-doeh {
                    border-color: inherit;
                    font-size: 10px;
                    font-weight: normal !important;
                    text-align: center;
                    vertical-align: top;
                }
                .tg-main-table-2 .tg-main-table-2-uxaa {
                    background-color: #c0c0c0;
                    border-color: inherit;
                    font-size: 12px;
                    text-align: center;
                    vertical-align: top;
                }
                .tg-main-table-2 .tg-main-table-2-91w8 {
                    border-color: inherit;
                    font-size: 12px;
                    text-align: center;
                    vertical-align: top;
                }
                .tg-main-table-2 .tg-main-table-2-l6li {
                    border-color: inherit;
                    font-size: 10px;
                    text-align: left;
                    vertical-align: top;
                }
                .tg-main-table-2 .tg-main-table-2-4k6h {
                    border-color: inherit;
                    font-size: 12px;
                    font-weight: normal !important;
                    text-align: left;
                    vertical-align: top;
                }
                @media screen and (max-width: 767px) {
                    .tg-main-table-2 {
                        width: auto !important;
                    }
                    .tg-main-table-2 col {
                        width: auto !important;
                    }
                    .tg-main-table-2-wrap {
                        overflow-x: auto;
                        -webkit-overflow-scrolling: touch;
                        margin: auto 0px;
                    }
                }
                #imagem-sobreposta {
                    position: absolute;
                    top: 330; /* Ajuste a posição vertical conforme necessário */
                    left: 300; /* Ajuste a posição horizontal conforme necessário */
                    z-index: 1; /* Garante que a imagem fique sobreposta à tabela */
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
                                LIMITE DE LIQUIDEZ E PLASTICIDADE<div>
                        </th>
                    </tr>
                    <tr>
                        <th class="tg-cabecalho-0pky" colspan="1" style="padding: 0px !important">
                            <table class="tg-cabecalho" style="width: 100%">
                                <thead>
                                    <tr>
                                      <td class="tg-cabecalho-0pky" style="width: 160px !important;padding-bottom: 0px; border-top-color:#fff; border-bottom-color:#fff;white-space: nowrap; border-left-color:#fff"> 
                                            NORMA:
                                          <div style="font-size: 102x; margin-left: 10px; margin-top: 6px; margin-bottom: 5px" class="cabecalho-resultado-font">' . $dataLimitesAttemberg['Norma'] . '</div>
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
                                  <span class="cabecalho-resultado-font">' . $dataLimitesAttemberg['DataInicio'] . '</span>
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
                                <span class="cabecalho-resultado-font">' . $dataLimitesAttemberg['DataFinal'] . '</span>
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
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                <div class="tg-main-table-2-wrap">
                                ' . ($np == true ?
            '
                                    <table class="tg-main-table-2" style="width: 100%">
                                            <colgroup>
                                                <col style="width: 154px;" />
                                                <col style="width: 100px;" />
                                                <col style="width: 55px;" />
                                                <col style="width: 55px;" />
                                                <col style="width: 55px;" />
                                                <col style="width: 55px;" />
                                                <col style="width: 55px;" />
                                                <col style="width: 55px;" />
                                                <col style="width: 55px;" />
                                                <col style="width: 55px;" />
                                            </colgroup>
                                            <tbody>
                                                <tr>
                                                    <td class="tg-main-table-2-4k6h" colspan="2"></td>
                                                    <td class="tg-main-table-2-91w8" colspan="5" style="width: 250px; font-size: 11px">LIMITE DE LIQUIDEZ (LL)</td>
                                                    <td class="tg-main-table-2-91w8" colspan="3" style="font-size: 11px">LIMITE DE PLASTICIDADE (LP)</td>
                                                </tr>
                                                <tr>
                                                    <td class="tg-main-table-2-4k6h">Cápsula</td>
                                                    <td class="tg-main-table-2-91w8">nº</td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                </tr>
                                                <tr>
                                                    <td class="tg-main-table-2-4k6h">Massa do solo úmido + massa da cápsula</td>
                                                    <td class="tg-main-table-2-91w8">g</td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                </tr>
                                                <tr>
                                                    <td class="tg-main-table-2-4k6h">Massa do solo seco + massa da cápsula</td>
                                                    <td class="tg-main-table-2-91w8">g</td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                </tr>
                                                <tr>
                                                    <td class="tg-main-table-2-4k6h">Massa da cápsula</td>
                                                    <td class="tg-main-table-2-91w8">g</td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                </tr>
                                                <tr>
                                                    <td class="tg-main-table-2-4k6h">Massa de água</td>
                                                    <td class="tg-main-table-2-91w8">g</td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                </tr>
                                                <tr>
                                                    <td class="tg-main-table-2-4k6h">Massa de solo seco</td>
                                                    <td class="tg-main-table-2-91w8">g</td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                </tr>
                                                <tr>
                                                    <td class="tg-main-table-2-4k6h">Teor de umidade</td>
                                                    <td class="tg-main-table-2-91w8">%</td>
                                                    <td class="tg-main-table-2-91w8" style="background-color: #c0c0c0"></td>
                                                    <td class="tg-main-table-2-91w8" style="background-color: #c0c0c0"></td>
                                                    <td class="tg-main-table-2-91w8" style="background-color: #c0c0c0"></td>
                                                    <td class="tg-main-table-2-91w8" style="background-color: #c0c0c0"></td>
                                                    <td class="tg-main-table-2-91w8" style="background-color: #c0c0c0"></td>
                                                    <td class="tg-main-table-2-91w8" style="background-color: #c0c0c0"></td>
                                                    <td class="tg-main-table-2-91w8" style="background-color: #c0c0c0"></td>
                                                    <td class="tg-main-table-2-91w8" style="background-color: #c0c0c0"></td>
                                                </tr>
                                                <tr>
                                                    <td class="tg-main-table-2-4k6h">Nº de golpes</td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8"></td>
                                                    <td class="tg-main-table-2-91w8" colspan="2">Média (%)</td>
                                                    <td class="tg-main-table-2-uxaa"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <img src="images/NP.png" alt="NP" id="imagem-sobreposta">
                                    ' : '
                                    <table class="tg-main-table-2" style="width: 100%">
                                    <colgroup>
                                        <col style="width: 154px;" />
                                        <col style="width: 100px;" />
                                        <col style="width: 55px;" />
                                        <col style="width: 55px;" />
                                        <col style="width: 55px;" />
                                        <col style="width: 55px;" />
                                        <col style="width: 55px;" />
                                        <col style="width: 55px;" />
                                        <col style="width: 55px;" />
                                        <col style="width: 55px;" />
                                    </colgroup>
                                    <tbody>
                                        <tr>
                                            <td class="tg-main-table-2-4k6h" colspan="2"></td>
                                            <td class="tg-main-table-2-91w8" colspan="5" style="width: 250px; font-size: 11px">LIMITE DE LIQUIDEZ (LL)</td>
                                                    <td class="tg-main-table-2-91w8" colspan="3" style="font-size: 11px">LIMITE DE PLASTICIDADE (LP)</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-main-table-2-4k6h">Cápsula</td>
                                            <td class="tg-main-table-2-91w8">nº</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['Capsula1'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['Capsula2'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['Capsula3'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['Capsula4'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['Capsula5'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['Capsula6'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['Capsula7'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['Capsula8'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-main-table-2-4k6h">Massa do solo úmido + massa da cápsula</td>
                                            <td class="tg-main-table-2-91w8">g</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['MassaSoloUmdCaps1'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['MassaSoloUmdCaps2'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['MassaSoloUmdCaps3'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['MassaSoloUmdCaps4'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['MassaSoloUmdCaps5'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['MassaSoloUmdCaps6'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['MassaSoloUmdCaps7'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['MassaSoloUmdCaps8'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-main-table-2-4k6h">Massa do solo seco + massa da cápsula</td>
                                            <td class="tg-main-table-2-91w8">g</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['MassaSoloSecCaps1'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['MassaSoloSecCaps2'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['MassaSoloSecCaps3'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['MassaSoloSecCaps4'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['MassaSoloSecCaps5'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['MassaSoloSecCaps6'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['MassaSoloSecCaps7'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['MassaSoloSecCaps8'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-main-table-2-4k6h">Massa da cápsula</td>
                                            <td class="tg-main-table-2-91w8">g</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['Massa_Da_Capsula1'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['Massa_Da_Capsula2'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['Massa_Da_Capsula3'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['Massa_Da_Capsula4'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['Massa_Da_Capsula5'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['Massa_Da_Capsula6'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['Massa_Da_Capsula7'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['Massa_Da_Capsula8'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-main-table-2-4k6h">Massa de água</td>
                                            <td class="tg-main-table-2-91w8">g</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['Massa_da_Agua1'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['Massa_da_Agua2'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['Massa_da_Agua3'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['Massa_da_Agua4'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['Massa_da_Agua5'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['Massa_da_Agua6'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['Massa_da_Agua7'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['Massa_da_Agua8'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-main-table-2-4k6h">Massa de solo seco</td>
                                            <td class="tg-main-table-2-91w8">g</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['Massa_Solo_Seco1'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['Massa_Solo_Seco2'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['Massa_Solo_Seco3'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['Massa_Solo_Seco4'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['Massa_Solo_Seco5'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['Massa_Solo_Seco6'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['Massa_Solo_Seco7'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['Massa_Solo_Seco8'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-main-table-2-4k6h">Teor de umidade</td>
                                            <td class="tg-main-table-2-91w8">%</td>
                                            <td class="tg-main-table-2-91w8" style="background-color: #c0c0c0"><b>' . $dataLimitesAttemberg['TeorUmidade1'] . '</b></td>
                                            <td class="tg-main-table-2-91w8" style="background-color: #c0c0c0"><b>' . $dataLimitesAttemberg['TeorUmidade2'] . '</b></td>
                                            <td class="tg-main-table-2-91w8" style="background-color: #c0c0c0"><b>' . $dataLimitesAttemberg['TeorUmidade3'] . '</b></td>
                                            <td class="tg-main-table-2-91w8" style="background-color: #c0c0c0"><b>' . $dataLimitesAttemberg['TeorUmidade4'] . '</b></td>
                                            <td class="tg-main-table-2-91w8" style="background-color: #c0c0c0"><b>' . $dataLimitesAttemberg['TeorUmidade5'] . '</b></td>
                                            <td class="tg-main-table-2-91w8" style="background-color: #c0c0c0"><b>' . $dataLimitesAttemberg['TeorUmidade6'] . '</b></td>
                                            <td class="tg-main-table-2-91w8" style="background-color: #c0c0c0"><b>' . $dataLimitesAttemberg['TeorUmidade7'] . '</b></td>
                                            <td class="tg-main-table-2-91w8" style="background-color: #c0c0c0"><b>' . $dataLimitesAttemberg['TeorUmidade8'] . '</b></td>
                                        </tr>
                                        <tr>
                                            <td class="tg-main-table-2-4k6h">Nº de golpes</td>
                                            <td class="tg-main-table-2-91w8"></td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['Num_Golpes1'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['Num_Golpes2'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['Num_Golpes3'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['Num_Golpes4'] . '</td>
                                            <td class="tg-main-table-2-91w8">' . $dataLimitesAttemberg['Num_Golpes5'] . '</td>
                                            <td class="tg-main-table-2-91w8" colspan="2">Média (%)</td>
                                            <td class="tg-main-table-2-uxaa"><b>' . $dataLimitesAttemberg['Media'] . '</b></td>
                                        </tr>
                                    </tbody>
                                </table>
                                    '
        ) . '
                                </div>
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                            </td>
                        </tr>
                        <tr>
          <td class="tg-0pky" colspan="15">
              <p class="title">Observação:</p>
              <div style="height: 35px;"> ' . $dataLimitesAttemberg['Observacao'] . ' <div>
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
