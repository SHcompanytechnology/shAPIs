<?php
require_once 'mainSheet.php';
include_once('configureteConnection.php');

class GranulometricAnalysisBySievingModel
{
  private $data;
  public function __construct($data)
  {
    $this->data = $data;
  }

  public function generateModel($codSample, $numberSample, $observation, $dataHeaderAndFooter, $pagina, $totalPaginas, $dataAnaliseGranulometricaPeineiramento, $logo, $dataFormatada)
  {
    $conexao = new ConfigureteConnection();
    $conexao->connect();

    $pdo = $conexao->getConnection();

    if ($pdo === null) {
      return null;
    }

    $executador = $dataAnaliseGranulometricaPeineiramento['Executado'];
    $aprovador = $dataAnaliseGranulometricaPeineiramento['Aprovado'];
    $verificador = $dataAnaliseGranulometricaPeineiramento['Verificado'];

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

            .tg-compression {
                border-collapse: collapse;
                border-spacing: 0;
              }
              .tg-compression td {
                border-color: black;
                border-style: solid;
                border-width: 1px;
                font-family: Arial, sans-serif;
                font-size: 14px;
                overflow: hidden;
                padding: 8px 5px;
                word-break: normal;
              }
              .tg-compression th {
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
              .tg-compression .tg-compression-7wru {
                border-color: inherit;
                font-size: xx-small;
                font-weight: bold;
                text-align: left;
                vertical-align: middle;
              }
              .tg-compression .tg-compression-p1nr {
                border-color: inherit;
                font-size: 11px;
                text-align: left;
                vertical-align: middle;
              }
              .tg-compression .tg-compression-78ff {
                border-color: inherit;
                font-size: xx-small;
                text-align: center;
                vertical-align: middle;
              }
              .tg-compression .tg-compression-fmch {
                background-color: #c8c8c8;
                border-color: inherit;
                font-size: 11px;
                text-align: center;
                vertical-align: middle;
              }
              .tg-compression .tg-compression-gzo9 {
                border-color: inherit;
                font-size: 11px;
                text-align: center;
                vertical-align: middle;
              }
              .tg-compression .tg-compression-25da {
                border-color: inherit;
                font-size: x-small;
                font-weight: bold;
                text-align: center;
                vertical-align: middle;
              }
              .tg-compression .tg-compression-6rs4 {
                border-color: inherit;
                font-size: xx-small;
                font-weight: bold;
                text-align: center;
                vertical-align: middle;
              }
              .tg-compression .tg-compression-4nn5 {
                background-color: #c8c8c8;
                border-color: inherit;
                font-size: xx-small;
                text-align: center;
                vertical-align: middle;
              }
              @media screen and (max-width: 767px) {
                .tg-compression {
                  width: auto !important;
                }
                .tg-compression col {
                  width: auto !important;
                }
                .tg-compression-wrap {
                  overflow-x: auto;
                  -webkit-overflow-scrolling: touch;
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
                                ANÁLISE GRANULOMÉTRICA POR PENEIRAMENTO<div>
                        </th>
                    </tr>
                    <tr>
                        <th class="tg-cabecalho-0pky" colspan="1" style="padding: 0px !important">
                            <table class="tg-cabecalho" style="width: 100%">
                                <thead>
                                    <tr>
                                      <td class="tg-cabecalho-0pky" style="width: 160px !important;padding-bottom: 0px; border-top-color:#fff; border-bottom-color:#fff;white-space: nowrap; border-left-color:#fff"> 
                                            NORMA:
                                          <div style="font-size: 102x; margin-left: 10px; margin-top: 6px; margin-bottom: 5px" class="cabecalho-resultado-font">' . $dataAnaliseGranulometricaPeineiramento['Norma'] . '</div>
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
                                  <span class="cabecalho-resultado-font">' . $dataAnaliseGranulometricaPeineiramento['DataInicio'] . '</span>
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
                                <span class="cabecalho-resultado-font">' . $dataAnaliseGranulometricaPeineiramento['DataFinal'] . '</span>
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
                    <style type="text/css">
                      .tg-main-secund-element {
                        border-collapse: collapse;
                        border-spacing: 0;
                        margin: 0px;
                      }
                      .tg-main-secund-element td {
                        border-color: black;
                        border-style: solid;
                        border-width: 1px;
                        font-family: Arial, sans-serif;
                        font-size: 14px;
                        overflow: hidden;
                        padding: 10px 5px;
                        word-break: normal;
                      }
                      .tg-main-secund-element th {
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
                      .tg-main-secund-element .tg-main-secund-element-doti {
                        background-color: #ffffff;
                        border-color: inherit;
                        color: #ffffff;
                        font-size: 12px;
                        font-weight: bold;
                        text-align: left;
                        vertical-align: middle;
                      }
                      .tg-main-secund-element .tg-main-secund-element-pryc {
                        background-color: #ffffff;
                        border-color: inherit;
                        color: #000000;
                        font-size: 13px;
                        text-align: center;
                        vertical-align: middle;
                      }
                      .tg-main-secund-element .tg-main-secund-element-doh2 {
                        background-color: #ffffff;
                        border-color: inherit;
                        color: #000000;
                        font-size: 10px;
                        font-weight: bold;
                        padding-top: 20px;
                        padding-bottom: 20px;
                        text-align: left;
                        vertical-align: middle;
                      }
                      .tg-main-secund-element .tg-main-secund-element-gbl5 {
                        background-color: #9b9b9b;
                        border-color: inherit;
                        color: #000000;
                        font-size: 13px;
                        text-align: center;
                        vertical-align: middle;
                      }
                      @media screen and (max-width: 767px) {
                        .tg-main-secund-element {
                          width: auto !important;
                        }
                        .tg-main-secund-element col {
                          width: auto !important;
                        }
                        .tg-main-secund-element-wrap {
                          overflow-x: auto;
                          -webkit-overflow-scrolling: touch;
                          margin: 0px;
                        }
                      }
                    </style>

                      <table
                        class="tg-main-secund-element"
                        style="width: 393px; margin: 40px 0px 5px 0px"
                      >
                        <colgroup>
                          <col style="width: 431.2px" />
                          <col style="width: 58.2px" />
                        </colgroup>
                        <thead>
                          <tr>
                            <td class="tg-main-secund-element-doh2" style="width: 315px !important; font-size: 13px">Massa total da amostra seca</td>
                            <th class="tg-main-secund-element-pryc" style="font-size: 13px"><b>' . $dataAnaliseGranulometricaPeineiramento['MassaProvote'] . ' (g)</b></th>
                          </tr>
                        </thead>
                      </table>
    
                    <div class="tg-main-secund-element-wrap">
                      <table
                        class="tg-main-secund-element"
                        style="width: 100%; margin-bottom: 20px"
                      >
                        <colgroup>
                          <col style="width: 100.2px" />
                          <col style="width: 90.2px" />
                          <col style="width: 90.2px" />
                          <col style="width: 90.2px" />
                          <col style="width: 90.2px" />
                          <col style="width: 90.2px" />
                          <col style="width: 90.2px" />
                          <col style="width: 90.2px" />
                          <col style="width: 90.2px" />
                        </colgroup>
                        <thead>
                          <tr>
                            <td class="tg-main-secund-element-doh2" style="width: 180px !important">Designação da peneira (Malha mm)</td>
                            <th class="tg-main-secund-element-pryc">' . $dataAnaliseGranulometricaPeineiramento['Dimensao1'] . '</th>
                            <th class="tg-main-secund-element-pryc">' . $dataAnaliseGranulometricaPeineiramento['Dimensao2'] . '</th>
                            <th class="tg-main-secund-element-pryc">' . $dataAnaliseGranulometricaPeineiramento['Dimensao3'] . '</th>
                            <th class="tg-main-secund-element-pryc">' . $dataAnaliseGranulometricaPeineiramento['Dimensao4'] . '</th>
                            <th class="tg-main-secund-element-pryc">' . $dataAnaliseGranulometricaPeineiramento['Dimensao5'] . '</th>
                            <th class="tg-main-secund-element-pryc">' . $dataAnaliseGranulometricaPeineiramento['Dimensao6'] . '</th>
                            <th class="tg-main-secund-element-pryc">' . $dataAnaliseGranulometricaPeineiramento['Dimensao7'] . '</th>
                            <th class="tg-main-secund-element-pryc">' . $dataAnaliseGranulometricaPeineiramento['Dimensao8'] . '<br /></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="tg-main-secund-element-doh2">Massa retida acumulada (g)</td>
                            <td class="tg-main-secund-element-pryc">' . $dataAnaliseGranulometricaPeineiramento['Retidos1'] . '</td>
                            <td class="tg-main-secund-element-pryc">' . $dataAnaliseGranulometricaPeineiramento['Retidos2'] . '</td>
                            <td class="tg-main-secund-element-pryc">' . $dataAnaliseGranulometricaPeineiramento['Retidos3'] . '</td>
                            <td class="tg-main-secund-element-pryc">' . $dataAnaliseGranulometricaPeineiramento['Retidos4'] . '</td>
                            <td class="tg-main-secund-element-pryc">' . $dataAnaliseGranulometricaPeineiramento['Retidos5'] . '</td>
                            <td class="tg-main-secund-element-pryc">' . $dataAnaliseGranulometricaPeineiramento['Retidos6'] . '</td>
                            <td class="tg-main-secund-element-pryc">' . $dataAnaliseGranulometricaPeineiramento['Retidos7'] . '</td>
                            <td class="tg-main-secund-element-pryc">' . $dataAnaliseGranulometricaPeineiramento['Retidos8'] . '</td>
                          </tr>
                          <tr>
                            <td class="tg-main-secund-element-doh2">% Acumulada</td>
                            <td class="tg-main-secund-element-gbl5"><b>' . $dataAnaliseGranulometricaPeineiramento['acumulados1'] . '</b></td>
                            <td class="tg-main-secund-element-gbl5"><b>' . $dataAnaliseGranulometricaPeineiramento['acumulados2'] . '</b></td>
                            <td class="tg-main-secund-element-gbl5"><b>' . $dataAnaliseGranulometricaPeineiramento['acumulados3'] . '</b></td>
                            <td class="tg-main-secund-element-gbl5"><b>' . $dataAnaliseGranulometricaPeineiramento['acumulados4'] . '</b></td>
                            <td class="tg-main-secund-element-gbl5"><b>' . $dataAnaliseGranulometricaPeineiramento['acumulados5'] . '</b></td>
                            <td class="tg-main-secund-element-gbl5"><b>' . $dataAnaliseGranulometricaPeineiramento['acumulados6'] . '</b></td>
                            <td class="tg-main-secund-element-gbl5"><b>' . $dataAnaliseGranulometricaPeineiramento['acumulados7'] . '</b></td>
                            <td class="tg-main-secund-element-gbl5"><b>' . $dataAnaliseGranulometricaPeineiramento['acumulados8'] . '</b></td>
                          </tr>
                          <tr>
                            <td class="tg-main-secund-element-doh2">% Passada</b></td>
                            <td class="tg-main-secund-element-gbl5"><b>' . $dataAnaliseGranulometricaPeineiramento['Passados1'] . '</b></td>
                            <td class="tg-main-secund-element-gbl5"><b>' . $dataAnaliseGranulometricaPeineiramento['Passados2'] . '</b></td>
                            <td class="tg-main-secund-element-gbl5"><b>' . $dataAnaliseGranulometricaPeineiramento['Passados3'] . '</b></td>
                            <td class="tg-main-secund-element-gbl5"><b>' . $dataAnaliseGranulometricaPeineiramento['Passados4'] . '</b></td>
                            <td class="tg-main-secund-element-gbl5"><b>' . $dataAnaliseGranulometricaPeineiramento['Passados5'] . '</b></td>
                            <td class="tg-main-secund-element-gbl5"><b>' . $dataAnaliseGranulometricaPeineiramento['Passados6'] . '</b></td>
                            <td class="tg-main-secund-element-gbl5"><b>' . $dataAnaliseGranulometricaPeineiramento['Passados7'] . '</b></td>
                            <td class="tg-main-secund-element-gbl5"><b>' . $dataAnaliseGranulometricaPeineiramento['Passados8'] . '</b></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>

                    <div class="tg-main-secund-element-wrap">
                      <table
                        class="tg-main-secund-element"
                        style="width: 100%; margin-bottom: 0px"
                      >
                        <colgroup>
                          <col style="width: 257.2px" />
                          <col style="width: 58.2px" />
                          <col style="width: 58.2px" />
                          <col style="width: 58.2px" />
                          <col style="width: 58.2px" />
                          <col style="width: 58.2px" />
                          <col style="width: 58.2px" />
                          <col style="width: 58.2px" />
                          <col style="width: 58.2px" />
                        </colgroup>
                        <thead>
                          <tr>
                            <td class="tg-main-secund-element-doh2" style="width: 180px !important">Designação da peneira (Malha mm)</td>
                            <th class="tg-main-secund-element-pryc">' . $dataAnaliseGranulometricaPeineiramento['Dimensao9'] . '</th>
                            <th class="tg-main-secund-element-pryc">' . $dataAnaliseGranulometricaPeineiramento['Dimensao10'] . '</th>
                            <th class="tg-main-secund-element-pryc">' . $dataAnaliseGranulometricaPeineiramento['Dimensao11'] . '</th>
                            <th class="tg-main-secund-element-pryc">' . $dataAnaliseGranulometricaPeineiramento['Dimensao12'] . '</th>
                            <th class="tg-main-secund-element-pryc">' . $dataAnaliseGranulometricaPeineiramento['Dimensao13'] . '</th>
                            <th class="tg-main-secund-element-pryc">' . $dataAnaliseGranulometricaPeineiramento['Dimensao14'] . '</th>
                            <th class="tg-main-secund-element-pryc">' . $dataAnaliseGranulometricaPeineiramento['Dimensao15'] . '</th>
                            <th class="tg-main-secund-element-pryc">' . $dataAnaliseGranulometricaPeineiramento['Dimensao16'] . '<br /></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="tg-main-secund-element-doh2">Massa retida acumulada (g)</td>
                            <td class="tg-main-secund-element-pryc">' . $dataAnaliseGranulometricaPeineiramento['Retidos9'] . '</td>
                            <td class="tg-main-secund-element-pryc">' . $dataAnaliseGranulometricaPeineiramento['Retidos10'] . '</td>
                            <td class="tg-main-secund-element-pryc">' . $dataAnaliseGranulometricaPeineiramento['Retidos11'] . '</td>
                            <td class="tg-main-secund-element-pryc">' . $dataAnaliseGranulometricaPeineiramento['Retidos12'] . '</td>
                            <td class="tg-main-secund-element-pryc">' . $dataAnaliseGranulometricaPeineiramento['Retidos13'] . '</td>
                            <td class="tg-main-secund-element-pryc">' . $dataAnaliseGranulometricaPeineiramento['Retidos14'] . '</td>
                            <td class="tg-main-secund-element-pryc">' . $dataAnaliseGranulometricaPeineiramento['Retidos15'] . '</td>
                            <td class="tg-main-secund-element-pryc">' . $dataAnaliseGranulometricaPeineiramento['Retidos16'] . '</td>
                          </tr>
                          <tr>
                            <td class="tg-main-secund-element-doh2">% Acumulada</td>
                            <td class="tg-main-secund-element-gbl5"><b>' . $dataAnaliseGranulometricaPeineiramento['acumulados9'] . '</b></td>
                            <td class="tg-main-secund-element-gbl5"><b>' . $dataAnaliseGranulometricaPeineiramento['acumulados10'] . '</b></td>
                            <td class="tg-main-secund-element-gbl5"><b>' . $dataAnaliseGranulometricaPeineiramento['acumulados11'] . '</b></td>
                            <td class="tg-main-secund-element-gbl5"><b>' . $dataAnaliseGranulometricaPeineiramento['acumulados12'] . '</b></td>
                            <td class="tg-main-secund-element-gbl5"><b>' . $dataAnaliseGranulometricaPeineiramento['acumulados13'] . '</b></td>
                            <td class="tg-main-secund-element-gbl5"><b>' . $dataAnaliseGranulometricaPeineiramento['acumulados14'] . '</b></td>
                            <td class="tg-main-secund-element-gbl5"><b>' . $dataAnaliseGranulometricaPeineiramento['acumulados15'] . '</b></td>
                            <td class="tg-main-secund-element-gbl5"><b>' . $dataAnaliseGranulometricaPeineiramento['acumulados16'] . '</b></td>
                          </tr>
                          <tr>
                            <td class="tg-main-secund-element-doh2">% Passada</td>
                            <td class="tg-main-secund-element-gbl5"><b>' . $dataAnaliseGranulometricaPeineiramento['Passados9'] . '</b></td>
                            <td class="tg-main-secund-element-gbl5"><b>' . $dataAnaliseGranulometricaPeineiramento['Passados10'] . '</b></td>
                            <td class="tg-main-secund-element-gbl5"><b>' . $dataAnaliseGranulometricaPeineiramento['Passados11'] . '</b></td>
                            <td class="tg-main-secund-element-gbl5"><b>' . $dataAnaliseGranulometricaPeineiramento['Passados12'] . '</b></td>
                            <td class="tg-main-secund-element-gbl5"><b>' . $dataAnaliseGranulometricaPeineiramento['Passados13'] . '</b></td>
                            <td class="tg-main-secund-element-gbl5"><b>' . $dataAnaliseGranulometricaPeineiramento['Passados14'] . '</b></td>
                            <td class="tg-main-secund-element-gbl5"><b>' . $dataAnaliseGranulometricaPeineiramento['Passados15'] . '</b></td>
                            <td class="tg-main-secund-element-gbl5"><b>' . $dataAnaliseGranulometricaPeineiramento['Passados16'] . '</b></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    </div>
                  </td>
                </tr>
                <tr>
                      <td class="tg-0pky" colspan="15">
                          <p class="title">Observação:</p>
                          <div style="height: 35px;"> ' . $dataAnaliseGranulometricaPeineiramento['Observacoes'] . ' <div>
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
            <div style="text-align: center">
              <p style="font-size: 10px; font-weight: bold; margin: 0; font-family: Arial, sans-serif; !important">
              <p style="font-size: 10px; font-weight: bold; margin: 0; font-family: Arial, sans-serif; !important">
                Este relatório de ensaio só pode ser copiado integralmente ou
                parcialmente com autorização da Geocontrole
              </p>
              <p style="font-size: 10px; font-weight: bold; margin: 0; font-family: Arial, sans-serif; !important">
                Av.Canadá,Nº 159 - Jardim Canadá Nova Lima - Minas Gerais - Brasil -
                CEP: 34007-654 Tel.: +55 31 3517-9011
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
