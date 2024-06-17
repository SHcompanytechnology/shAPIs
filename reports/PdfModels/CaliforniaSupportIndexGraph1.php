<?php
require_once 'mainSheet.php';
include_once('configureteConnection.php');
class CaliforniaSupportIndexGraph1
{
    private $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function generateModel($codSample, $numberSample, $observation, $dataHeaderAndFooter, $pagina, $totalPaginas, $logo, $dataFormatada)
    {
        $conexao = new ConfigureteConnection();
        $conexao->connect();

        $pdo = $conexao->getConnection();

        if ($pdo === null) {
            return null;
        }
        $graficoValue = "G1";
        $query = "SELECT * FROM Graficos_CBR WHERE Amostra = :codSample AND Grafico = :graficoValue AND N_Ensaio = :numberSample";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':codSample', $codSample, PDO::PARAM_INT);
        $stmt->bindParam(':graficoValue', $graficoValue, PDO::PARAM_STR);
        $stmt->bindParam(':numberSample', $numberSample, PDO::PARAM_INT);
        $stmt->execute();

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $graph = $data[0]['Image'];

        $query = "SELECT * FROM IndiceSuporteCalifornia WHERE Amostra = :codSample AND N_Ensaio = :numberSample";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':codSample', $codSample, PDO::PARAM_INT);
        $stmt->bindParam(':numberSample', $numberSample, PDO::PARAM_INT);
        $stmt->execute();

        $indiceSuporteCalifornia = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $dataIndiceSuporteCalifornia = $indiceSuporteCalifornia[0];

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

            .tg-gr1 {
                border-collapse: collapse;
                border-spacing: 0;
                margin: 0px auto;
            }
            .tg-gr1 td {
                border-color: black;
                border-style: solid;
                border-width: 1px;
                font-family: Arial, sans-serif;
                font-size: 10px;
                overflow: hidden;
                padding: 3px 2px;
                word-break: normal;
            }
            .tg-gr1 th {
                border-color: black;
                border-style: solid;
                border-width: 1px;
                font-family: Arial, sans-serif;
                font-size: 10px;
                font-weight: normal;
                overflow: hidden;
                padding: 0px 2px;
                word-break: normal;
            }
            .tg-gr1 .tg-gr1-6nwz {
                font-size: 12px;
                text-align: center;
                vertical-align: middle;
            }
            .tg-gr1 .tg-gr1-ltad {
                font-size: 12px;
                text-align: left;
                vertical-align: middle;
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
    <td class="tg-0pky" colspan="15" style="border-left: none !important; border-right: none !important; border-top-color: #fff; padding-left: 0px !important; padding-right: 0px !important; height: 675px;">
                            <div style="border: 1px solid #000; margin: 20px 0px 0px 0px; padding: 5px; border-bottom-color: #fff"">
                            <img src="data:image/jpeg;base64,' . base64_encode($graph) . '" alt="Imagem" width="700px" height="490px">
                            </div>

                            <table class="tg-gr1" style="width: 100%">
                                <colgroup>
                                    <col style="width: 200.2px;" />
                                    <col style="width: 46.2px;" />
                                    <col style="width: 46.2px;" />
                                    <col style="width: 25.2px;" />
                                    <col style="width: 25.2px;" />
                                    <col style="width: 46.2px;" />
                                    <col style="width: 46.2px;" />
                                    <col style="width: 46.2px;" />
                                    <col style="width: 44.2px;" />
                                    <col style="width: 46.2px;" />
                                    <col style="width: 46.2px;" />
                                </colgroup>
                                <tbody>
                                    <tr>
                                        <td class="tg-gr1-ltad" colspan="3">Corpo-de-prova</td>
                                        <td class="tg-gr1-6nwz" colspan="2">P1</td>
                                        <td class="tg-gr1-6nwz">P2</td>
                                        <td class="tg-gr1-6nwz">P3</td>
                                        <td class="tg-gr1-6nwz">P4</td>
                                        <td class="tg-gr1-6nwz" colspan="2">P5</td>
                                        <td class="tg-gr1-6nwz">P6</td>
                                    </tr>
                                    <tr>
                                        <td class="tg-gr1-ltad" style="width: 130px">Teor de umidade</td>
                                        <td class="tg-gr1-6nwz" style="width: 30px">H</td>
                                        <td class="tg-gr1-6nwz" style="width: 30px">%</td>
                                        <td class="tg-gr1-6nwz" colspan="2">' . $dataIndiceSuporteCalifornia['U_MEDIA1'] . '</td>
                                        <td class="tg-gr1-6nwz" style="width: 85px">' . $dataIndiceSuporteCalifornia['U_MEDIA2'] . '</td>
                                        <td class="tg-gr1-6nwz" style="width: 85px">' . $dataIndiceSuporteCalifornia['U_MEDIA3'] . '</td>
                                        <td class="tg-gr1-6nwz" style="width: 85px">' . $dataIndiceSuporteCalifornia['U_MEDIA4'] . '</td>
                                        <td class="tg-gr1-6nwz" colspan="2">' . $dataIndiceSuporteCalifornia['U_MEDIA5'] . '</td>
                                        <td class="tg-gr1-6nwz" style="width: 85px">00.00</td>
                                    </tr>
                                    <tr>
                                        <td class="tg-gr1-ltad">Massa específica seca</td>
                                        <td class="tg-gr1-6nwz">gs</td>
                                        <td class="tg-gr1-6nwz">g/cm³</td>
                                        <td class="tg-gr1-6nwz" colspan="2">' . $dataIndiceSuporteCalifornia['M_SECA1'] . '</td>
                                        <td class="tg-gr1-6nwz">' . $dataIndiceSuporteCalifornia['M_SECA2'] . '</td>
                                        <td class="tg-gr1-6nwz">' . $dataIndiceSuporteCalifornia['M_SECA3'] . '</td>
                                        <td class="tg-gr1-6nwz">' . $dataIndiceSuporteCalifornia['M_SECA4'] . '</td>
                                        <td class="tg-gr1-6nwz" colspan="2">' . $dataIndiceSuporteCalifornia['M_SECA5'] . '</td>
                                        <td class="tg-gr1-6nwz">00.00</td>
                                    </tr>
                                    <tr>
                                        <td class="tg-gr1-ltad">Compactação relativa</td>
                                        <td class="tg-gr1-6nwz">CR</td>
                                        <td class="tg-gr1-6nwz">%</td>
                                        <td class="tg-gr1-6nwz" colspan="2">' . $dataIndiceSuporteCalifornia['G1_CR_P11'] . '</td>
                                        <td class="tg-gr1-6nwz">' . $dataIndiceSuporteCalifornia['G1_CR_P21'] . '</td>
                                        <td class="tg-gr1-6nwz">' . $dataIndiceSuporteCalifornia['G1_CR_P31'] . '</td>
                                        <td class="tg-gr1-6nwz">' . $dataIndiceSuporteCalifornia['G1_CR_P41'] . '</td>
                                        <td class="tg-gr1-6nwz" colspan="2">' . $dataIndiceSuporteCalifornia['G1_CR_P51'] . '</td>
                                        <td class="tg-gr1-6nwz">00.00</td>
                                    </tr>
                                    <tr>
                                        <td class="tg-gr1-ltad">Desvio do ótimo</td>
                                        <td class="tg-gr1-6nwz" style="font-family: DejaVu Sans !important">&#916;</td>
                                        <td class="tg-gr1-6nwz">%</td>
                                        <td class="tg-gr1-6nwz" colspan="2">' . $dataIndiceSuporteCalifornia['G1_Do_P12'] . '</td>
                                        <td class="tg-gr1-6nwz">' . $dataIndiceSuporteCalifornia['G1_Do_P32'] . '</td>
                                        <td class="tg-gr1-6nwz">' . $dataIndiceSuporteCalifornia['G1_Do_P22'] . '</td>
                                        <td class="tg-gr1-6nwz">' . $dataIndiceSuporteCalifornia['G1_Do_P42'] . '</td>
                                        <td class="tg-gr1-6nwz" colspan="2">' . $dataIndiceSuporteCalifornia['G1_Do_P52'] . '</td>
                                        <td class="tg-gr1-6nwz">00.00</td>
                                    </tr>
                                    <tr>
                                        <td class="tg-gr1-ltad" colspan="4" style="width: 300px">Teor ótimo de umidade</td>
                                        <td class="tg-gr1-6nwz">%</td>
                                        <td class="tg-gr1-6nwz">' . $dataIndiceSuporteCalifornia['Twopt'] . '</td>
                                        <td class="tg-gr1-6nwz" colspan="3">Massa específica seca máxima</td>
                                        <td class="tg-gr1-6nwz">g/cm³</td>
                                        <td class="tg-gr1-6nwz">' . $dataIndiceSuporteCalifornia['gdmax'] . '</td>
                                    </tr>
                                </tbody>
                            </table>
                            <br />
                            <br />
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
