<?php
require_once 'mainSheet.php';
include_once('configureteConnection.php');
class ActualSpecificMassInGrainsModel
{
    private $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function generateModel($codSample, $numberSample, $observation, $dataHeaderAndFooter, $pagina, $totalPaginas, $dataMassaEspecificaRealEmGraos, $logo, $dataFormatada)
    {
        $conexao = new ConfigureteConnection();
        $conexao->connect();

        $pdo = $conexao->getConnection();

        if ($pdo === null) {
            return null;
        }

        $executador = $dataMassaEspecificaRealEmGraos['Executado'];
        $aprovador = $dataMassaEspecificaRealEmGraos['Aprovado'];
        $verificador = $dataMassaEspecificaRealEmGraos['Verificado'];

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
    
                .tg-main-table {
                    border-collapse: collapse;
                    border-spacing: 0;
                    margin: 0px auto;
                }
                .tg-main-table td {
                    border-color: black;
                    border-style: solid;
                    border-width: 1px;
                    font-family: Arial, sans-serif;
                    font-size: 10px;
                    overflow: hidden;
                    padding: 8px 8px;
                    word-break: normal;
                }
                .tg-main-table th {
                    border-color: black;
                    border-style: solid;
                    border-width: 1px;
                    font-family: Arial, sans-serif;
                    font-size: 10px;
                    font-weight: normal;
                    overflow: hidden;
                    padding: 7px 7px;
                    word-break: normal;
                }
                .tg-main-table .tg-main-table-ey1n {
                    border-color: inherit;
                    font-size: 12px;
                    font-weight: normal !important;
                    text-align: left;
                    vertical-align: middle;
                }
                .tg-main-table .tg-main-table-c3ow {
                    border-color: inherit;
                    font-size: 12px;
                    text-align: center;
                    vertical-align: middle;
                }
                .tg-main-table .tg-main-table-umgj {
                    border-color: inherit;
                    font-size: 10px;
                    font-weight: normal !important;
                    text-align: center;
                    vertical-align: middle;
                }
                .tg-main-table .tg-main-table-fymr {
                    border-color: inherit;
                    font-weight: normal !important;
                    font-size: 12px;
                    text-align: left;
                    vertical-align: middle;
                }
                .tg-main-table .tg-main-table-lqf5 {
                    background-color: #c8c8c8;
                    border-color: inherit;
                    color: #000000;
                    text-align: center;
                    font-weight: bold;
                    vertical-align: middle;
                }
                @media screen and (max-width: 767px) {
                    .tg-main-table {
                        width: auto !important;
                    }
                    .tg-main-table col {
                        width: auto !important;
                    }
                    .tg-main-table-wrap {
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
                                MASSA ESPECÍFICA REAL DOS GRÃOS<div>
                        </th>
                    </tr>
                    <tr>
                        <th class="tg-cabecalho-0pky" colspan="1" style="padding: 0px !important">
                            <table class="tg-cabecalho" style="width: 100%">
                                <thead>
                                    <tr>
                                      <td class="tg-cabecalho-0pky" style="width: 160px !important;padding-bottom: 0px; border-top-color:#fff; border-bottom-color:#fff;white-space: nowrap; border-left-color:#fff"> 
                                            NORMA:
                                          <div style="font-size: 102x; margin-left: 10px; margin-top: 6px; margin-bottom: 5px" class="cabecalho-resultado-font">' . $dataMassaEspecificaRealEmGraos['Norma'] . '</div>
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
                                  <span class="cabecalho-resultado-font">' . $dataMassaEspecificaRealEmGraos['DataInicio'] . '</span>
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
                                <span class="cabecalho-resultado-font">' . $dataMassaEspecificaRealEmGraos['DataFinal'] . '</span>
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
        <td class="tg-0pky" colspan="15" style="border-left: none !important; border-right: none !important; border-top-color: #fff; padding-left: 0px !important; padding-right: 0px !important; height: 675px;">
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                
                                <div class="tg-main-table-wrap">
                                    <table class="tg-main-table" style="width: 100%">
                                        <colgroup>
                                            <col style="width: 400px;" />
                                            <col style="width: 48px;" />
                                            <col style="width: 60px;" />
                                            <col style="width: 59px;" />
                                            <col style="width: 52px;" />
                                            <col style="width: 55px;" />
                                            <col style="width: 55px;" />
                                            <col style="width: 49px;" />
                                            <col style="width: 52px;" />
                                        </colgroup>
                                        <tbody>
                                            <tr>
                                                <td class="tg-main-table-fymr" colspan="3">Corpo de prova</td>
                                                <td class="tg-main-table-c3ow" colspan="3">l</td>
                                                <td class="tg-main-table-c3ow" colspan="3">ll</td>
                                            </tr>
                                            <tr>
                                                <td class="tg-main-table-fymr">Picnômetro</td>
                                                <td class="tg-main-table-c3ow">Nº</td>
                                                <td class="tg-main-table-c3ow"></td>
                                                <td class="tg-main-table-c3ow" colspan="3">' . $dataMassaEspecificaRealEmGraos['PICNOMETRO1'] . '</td>
                                                <td class="tg-main-table-c3ow" colspan="3">' . $dataMassaEspecificaRealEmGraos['PICNOMETRO2'] . '</td>
                                            </tr>
                                            <tr>
                                                <td class="tg-main-table-fymr">Massa úmida do corpo de prova</td>
                                                <td class="tg-main-table-c3ow">M¹</td>
                                                <td class="tg-main-table-c3ow">g</td>
                                                <td class="tg-main-table-c3ow" colspan="3">' . $dataMassaEspecificaRealEmGraos['massaEspCorpoProva1'] . '</td>
                                                <td class="tg-main-table-c3ow" colspan="3">' . $dataMassaEspecificaRealEmGraos['massaEspCorpoProva2'] . '</td>
                                            </tr>
                                            <tr>
                                                <td class="tg-main-table-fymr">Cápsula</td>
                                                <td class="tg-main-table-c3ow">Nº</td>
                                                <td class="tg-main-table-c3ow"></td>
                                                <td class="tg-main-table-c3ow">' . $dataMassaEspecificaRealEmGraos['Capsula1'] . '</td>
                                                <td class="tg-main-table-c3ow">' . $dataMassaEspecificaRealEmGraos['Capsula2'] . '</td>
                                                <td class="tg-main-table-c3ow">' . $dataMassaEspecificaRealEmGraos['Capsula3'] . '</td>
                                                <td class="tg-main-table-c3ow">' . $dataMassaEspecificaRealEmGraos['Capsula4'] . '</td>
                                                <td class="tg-main-table-c3ow">' . $dataMassaEspecificaRealEmGraos['Capsula5'] . '</td>
                                                <td class="tg-main-table-c3ow">' . $dataMassaEspecificaRealEmGraos['Capsula6'] . '</td>
                                            </tr>
                                            <tr>
                                                <td class="tg-main-table-fymr">Massa do solo úmido + cápsula</td>
                                                <td class="tg-main-table-c3ow">Mh</td>
                                                <td class="tg-main-table-c3ow">g</td>
                                                <td class="tg-main-table-c3ow">' . $dataMassaEspecificaRealEmGraos['massaDoSoloUmdCaps1'] . '</td>
                                                <td class="tg-main-table-c3ow">' . $dataMassaEspecificaRealEmGraos['massaDoSoloUmdCaps2'] . '</td>
                                                <td class="tg-main-table-c3ow">' . $dataMassaEspecificaRealEmGraos['massaDoSoloUmdCaps3'] . '</td>
                                                <td class="tg-main-table-c3ow">' . $dataMassaEspecificaRealEmGraos['massaDoSoloUmdCaps4'] . '</td>
                                                <td class="tg-main-table-c3ow">' . $dataMassaEspecificaRealEmGraos['massaDoSoloUmdCaps5'] . '</td>
                                                <td class="tg-main-table-c3ow">' . $dataMassaEspecificaRealEmGraos['massaDoSoloUmdCaps6'] . '</td>
                                            </tr>
                                            <tr>
                                                <td class="tg-main-table-fymr">Massa do solo seco + cápsula</td>
                                                <td class="tg-main-table-c3ow">Ms</td>
                                                <td class="tg-main-table-c3ow">g</td>
                                                <td class="tg-main-table-c3ow">' . $dataMassaEspecificaRealEmGraos['massaDoSoloSecCaps1'] . '</td>
                                                <td class="tg-main-table-c3ow">' . $dataMassaEspecificaRealEmGraos['massaDoSoloSecCaps2'] . '</td>
                                                <td class="tg-main-table-c3ow">' . $dataMassaEspecificaRealEmGraos['massaDoSoloSecCaps3'] . '</td>
                                                <td class="tg-main-table-c3ow">' . $dataMassaEspecificaRealEmGraos['massaDoSoloSecCaps4'] . '</td>
                                                <td class="tg-main-table-c3ow">' . $dataMassaEspecificaRealEmGraos['massaDoSoloSecCaps5'] . '</td>
                                                <td class="tg-main-table-c3ow">' . $dataMassaEspecificaRealEmGraos['massaDoSoloSecCaps6'] . '</td>
                                            </tr>
                                            <tr>
                                                <td class="tg-main-table-fymr">Massa da cápsula</td>
                                                <td class="tg-main-table-c3ow">Mc</td>
                                                <td class="tg-main-table-c3ow">g</td>
                                                <td class="tg-main-table-c3ow">' . $dataMassaEspecificaRealEmGraos['MassaCaps1'] . '</td>
                                                <td class="tg-main-table-c3ow">' . $dataMassaEspecificaRealEmGraos['MassaCaps2'] . '</td>
                                                <td class="tg-main-table-c3ow">' . $dataMassaEspecificaRealEmGraos['MassaCaps3'] . '</td>
                                                <td class="tg-main-table-c3ow">' . $dataMassaEspecificaRealEmGraos['MassaCaps4'] . '</td>
                                                <td class="tg-main-table-c3ow">' . $dataMassaEspecificaRealEmGraos['MassaCaps5'] . '</td>
                                                <td class="tg-main-table-c3ow">' . $dataMassaEspecificaRealEmGraos['MassaCaps6'] . '</td>
                                            </tr>
                                            <tr>
                                                <td class="tg-main-table-fymr">Teor em umidade</td>
                                                <td class="tg-main-table-c3ow">h</td>
                                                <td class="tg-main-table-c3ow">%</td>
                                                <td class="tg-main-table-c3ow">' . $dataMassaEspecificaRealEmGraos['teorDeUmd1'] . '</td>
                                                <td class="tg-main-table-c3ow">' . $dataMassaEspecificaRealEmGraos['teorDeUmd2'] . '</td>
                                                <td class="tg-main-table-c3ow">' . $dataMassaEspecificaRealEmGraos['teorDeUmd3'] . '</td>
                                                <td class="tg-main-table-c3ow">' . $dataMassaEspecificaRealEmGraos['teorDeUmd4'] . '</td>
                                                <td class="tg-main-table-c3ow">' . $dataMassaEspecificaRealEmGraos['teorDeUmd5'] . '</td>
                                                <td class="tg-main-table-c3ow">' . $dataMassaEspecificaRealEmGraos['teorDeUmd6'] . '</td>
                                            </tr>
                                            <tr>
                                                <td class="tg-main-table-fymr">Teor de umidade médio</td>
                                                <td class="tg-main-table-c3ow">h</td>
                                                <td class="tg-main-table-c3ow">%</td>
                                                <td class="tg-main-table-c3ow" colspan="3">' . $dataMassaEspecificaRealEmGraos['teorDeUmdMEDIO1'] . '</td>
                                                <td class="tg-main-table-c3ow" colspan="3">' . $dataMassaEspecificaRealEmGraos['teorDeUmdMEDIO2'] . '</td>
                                            </tr>
                                            <tr>
                                                <td class="tg-main-table-fymr">Massa do picnômetro + água destilada</td>
                                                <td class="tg-main-table-c3ow">M³</td>
                                                <td class="tg-main-table-c3ow">g</td>
                                                <td class="tg-main-table-c3ow" colspan="3">' . $dataMassaEspecificaRealEmGraos['massaPicAgDestilada1'] . '</td>
                                                <td class="tg-main-table-c3ow" colspan="3">' . $dataMassaEspecificaRealEmGraos['massaPicAgDestilada2'] . '</td>
                                            </tr>
                                            <tr>
                                                <td class="tg-main-table-fymr">Massa do picnômetro + corpo de prova</td>
                                                <td class="tg-main-table-c3ow">M³</td>
                                                <td class="tg-main-table-c3ow">g</td>
                                                <td class="tg-main-table-c3ow" colspan="3">' . $dataMassaEspecificaRealEmGraos['massaPicCorpoProva1'] . '</td>
                                                <td class="tg-main-table-c3ow" colspan="3">' . $dataMassaEspecificaRealEmGraos['massaPicCorpoProva2'] . '</td>
                                            </tr>
                                            <tr>
                                                <td class="tg-main-table-fymr">Temperatura do ensaio</td>
                                                <td class="tg-main-table-c3ow">T</td>
                                                <td class="tg-main-table-c3ow">º</td>
                                                <td class="tg-main-table-c3ow" colspan="3">' . $dataMassaEspecificaRealEmGraos['temperaturaDoEnsaio1'] . '</td>
                                                <td class="tg-main-table-c3ow" colspan="3">' . $dataMassaEspecificaRealEmGraos['temperaturaDoEnsaio2'] . '</td>
                                            </tr>
                                            <tr>
                                                <td class="tg-main-table-fymr">Massa específica da água à temperatura T do ensaio</td>
                                                <td class="tg-main-table-c3ow">pw(T)</td>
                                                <td class="tg-main-table-c3ow">g/cm³</td>
                                                <td class="tg-main-table-c3ow" colspan="3">' . $dataMassaEspecificaRealEmGraos['massaEspDaAguaATempT1'] . '</td>
                                                <td class="tg-main-table-c3ow" colspan="3">' . $dataMassaEspecificaRealEmGraos['massaEspDaAguaATempT2'] . '</td>
                                            </tr>
                                            <tr>
                                                <td class="tg-main-table-fymr">Massa específica do corpo de prova</td>
                                                <td class="tg-main-table-c3ow">d</td>
                                                <td class="tg-main-table-c3ow">g/cm³</td>
                                                <td class="tg-main-table-c3ow" colspan="3">' . $dataMassaEspecificaRealEmGraos['massaEspCorpoProva1'] . '</td>
                                                <td class="tg-main-table-c3ow" colspan="3">' . $dataMassaEspecificaRealEmGraos['massaEspCorpoProva2'] . '</td>
                                            </tr>
                                            <tr>
                                                <td class="tg-main-table-fymr">Massa específica média</td>
                                                <td class="tg-main-table-c3ow">d</td>
                                                <td class="tg-main-table-c3ow">g/cm³</td>
                                                <td class="tg-main-table-lqf5" colspan="6" style="font-size: 12px"><b>' . $dataMassaEspecificaRealEmGraos['massaEspMEDIA'] . '</b></td>
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
              <div style="height: 35px;"> ' . $dataMassaEspecificaRealEmGraos['Observacao'] . ' <div>
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
