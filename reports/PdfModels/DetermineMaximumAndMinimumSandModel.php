<?php
require_once 'mainSheet.php';
include_once('configureteConnection.php');
class DetermineMaximumAndMinimumSandModel
{
    private $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function generateModel($codSample, $numberSample, $observation, $dataHeaderAndFooter, $pagina, $totalPaginas, $dataMassaEspecificaMaxEMinDeAreia, $logo, $dataFormatada)
    {
        $conexao = new ConfigureteConnection();
        $conexao->connect();

        $pdo = $conexao->getConnection();

        if ($pdo === null) {
            return null;
        }

        $executador = $dataMassaEspecificaMaxEMinDeAreia['Executado'];
        $aprovador = $dataMassaEspecificaMaxEMinDeAreia['Aprovado'];
        $verificador = $dataMassaEspecificaMaxEMinDeAreia['Verificado'];

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
    
                .tg-minima {
                    border-collapse: collapse;
                    border-spacing: 0;
                    margin: 0px auto;
                }
    
                .tg-minima td {
                    border-color: black;
                    border-style: solid;
                    border-width: 1px;
                    font-family: Arial, sans-serif;
                    font-size: 13px;
                    overflow: hidden;
                    padding: 1px 4px;
                    word-break: normal;
                }
    
                .tg-minima th {
                    border-color: black;
                    border-style: solid;
                    border-width: 1px;
                    font-family: Arial, sans-serif;
                    font-size: 13px;
                    font-weight: normal;
                    overflow: hidden;
                    padding: 1px 4px;
                    word-break: normal;
                }
    
                .tg-minima .tg-minima-34fe {
                    background-color: #c0c0c0;
                    border-color: inherit;
                    text-align: center;
                    vertical-align: middle;
                    font-weight: bold;
                }
    
                .tg-minima .tg-minima-c3ow {
                    border-color: inherit;
                    text-align: center;
                    vertical-align: middle;
                }
    
                .tg-minima .tg-minima-0pky {
                    border-color: inherit;
                    text-align: left;
                    vertical-align: middle;
                }
    
                .tg-maxima {
                    border-collapse: collapse;
                    border-spacing: 0;
                    margin: 0px auto;
                }
    
                .tg-maxima td {
                    border-color: black;
                    border-style: solid;
                    border-width: 1px;
                    font-family: Arial, sans-serif;
                    font-size: 13px;
                    overflow: hidden;
                    padding: 4px 5px;
                    word-break: normal;
                }
    
                .tg-maxima th {
                    border-color: black;
                    border-style: solid;
                    border-width: 1px;
                    font-family: Arial, sans-serif;
                    font-size: 13px;
                    font-weight: normal;
                    overflow: hidden;
                    padding: 4px 5px;
                    word-break: normal;
                }
    
                .tg-maxima .tg-maxima-76qt {
                    border-color: inherit;
                    font-size: 13px;
                    text-align: center;
                    vertical-align: middle;
                }
    
                .tg-maxima .tg-maxima-387r {
                    border-color: inherit;
                    font-size: 13px;
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
                                MASSA ESPECIFICA MAXIMA E MINIMA DE AREIAS<div>
                        </th>
                    </tr>
                    <tr>
                        <th class="tg-cabecalho-0pky" colspan="1" style="padding: 0px !important">
                            <table class="tg-cabecalho" style="width: 100%">
                                <thead>
                                    <tr>
                                      <td class="tg-cabecalho-0pky" style="width: 160px !important;padding-bottom: 0px; border-top-color:#fff; border-bottom-color:#fff;white-space: nowrap; border-left-color:#fff"> 
                                            NORMA:
                                          <div style="font-size: 102x; margin-left: 10px; margin-top: 6px; margin-bottom: 5px" class="cabecalho-resultado-font">' . $dataMassaEspecificaMaxEMinDeAreia['NormaEnsaio'] . '</div>
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
                                  <span class="cabecalho-resultado-font">' . $dataMassaEspecificaMaxEMinDeAreia['DataInicio'] . '</span>
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
                                <span class="cabecalho-resultado-font">' . $dataMassaEspecificaMaxEMinDeAreia['DataFinal'] . '</span>
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
                                <table class="tg-minima" style="width: 100%">
                                    <colgroup>
                                        <col style="width: 151px">
                                        <col style="width: 55px">
                                        <col style="width: 62px">
                                        <col style="width: 62px">
                                        <col style="width: 62px">
                                        <col style="width: 48px">
                                        <col style="width: 48px">
                                        <col style="width: 48px">
                                        <col style="width: 65px">
                                        <col style="width: 50px">
                                        <col style="width: 46px">
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th class="tg-minima-c3ow" colspan="11">Massa específica mínima das areia</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="tg-minima-0pky" colspan="3">Molde</td>
                                            <td class="tg-minima-c3ow" colspan="2">' . $dataMassaEspecificaMaxEMinDeAreia['MoldeMin'] . '</td>
                                            <td class="tg-minima-0pky" colspan="3">Volume do molde:</td>
                                            <td class="tg-minima-c3ow">(g/cm³)</td>
                                            <td class="tg-minima-c3ow" colspan="2">' . $dataMassaEspecificaMaxEMinDeAreia['VolumeMolde'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-minima-0pky" colspan="2">Peso do molde:</td>
                                            <td class="tg-minima-c3ow">(g)</td>
                                            <td class="tg-minima-c3ow" colspan="2">' . $dataMassaEspecificaMaxEMinDeAreia['PesoMolde'] . '</td>
                                            <td class="tg-minima-0pky" colspan="4" style="width: 40px">Massa específica das partículas</td>
                                            <td class="tg-minima-c3ow" colspan="2">' . $dataMassaEspecificaMaxEMinDeAreia['MassaEspDasPart'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-minima-0pky" colspan="2">Corpo de prova</td>
                                            <td class="tg-minima-c3ow" style="width: 40px !important;">1</td>
                                            <td class="tg-minima-c3ow" style="width: 40px !important;">2</td>
                                            <td class="tg-minima-c3ow" style="width: 40px !important;">3</td>
                                            <td class="tg-minima-c3ow" style="width: 40px !important;">4</td>
                                            <td class="tg-minima-c3ow" style="width: 40px !important;">5</td>
                                            <td class="tg-minima-c3ow" style="width: 40px !important;">6</td>
                                            <td class="tg-minima-c3ow" style="width: 40px !important;">7</td>
                                            <td class="tg-minima-c3ow" style="width: 40px !important;">8</td>
                                            <td class="tg-minima-c3ow" style="width: 40px !important;">9</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-minima-0pky">Peso do molde + areia</td>
                                            <td class="tg-minima-c3ow">(g)</td>
                                            <td class="tg-minima-c3ow">' . $dataMassaEspecificaMaxEMinDeAreia['PesoMoldeAreia1'] . '</td>
                                            <td class="tg-minima-c3ow">' . $dataMassaEspecificaMaxEMinDeAreia['PesoMoldeAreia2'] . '</td>
                                            <td class="tg-minima-c3ow">' . $dataMassaEspecificaMaxEMinDeAreia['PesoMoldeAreia3'] . '</td>
                                            <td class="tg-minima-0pky">' . $dataMassaEspecificaMaxEMinDeAreia['PesoMoldeAreia4'] . '</td>
                                            <td class="tg-minima-0pky">' . $dataMassaEspecificaMaxEMinDeAreia['PesoMoldeAreia5'] . '</td>
                                            <td class="tg-minima-0pky">' . $dataMassaEspecificaMaxEMinDeAreia['PesoMoldeAreia6'] . '</td>
                                            <td class="tg-minima-0pky">' . $dataMassaEspecificaMaxEMinDeAreia['PesoMoldeAreia7'] . '</td>
                                            <td class="tg-minima-0pky">' . $dataMassaEspecificaMaxEMinDeAreia['PesoMoldeAreia8'] . '</td>
                                            <td class="tg-minima-0pky">' . $dataMassaEspecificaMaxEMinDeAreia['PesoMoldeAreia9'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-minima-0pky">Peso da areia</td>
                                            <td class="tg-minima-c3ow">(g)</td>
                                            <td class="tg-minima-c3ow">' . $dataMassaEspecificaMaxEMinDeAreia['PesoAreia1'] . '</td>
                                            <td class="tg-minima-c3ow">' . $dataMassaEspecificaMaxEMinDeAreia['PesoAreia2'] . '</td>
                                            <td class="tg-minima-c3ow">' . $dataMassaEspecificaMaxEMinDeAreia['PesoAreia3'] . '</td>
                                            <td class="tg-minima-0pky">' . $dataMassaEspecificaMaxEMinDeAreia['PesoAreia4'] . '</td>
                                            <td class="tg-minima-0pky">' . $dataMassaEspecificaMaxEMinDeAreia['PesoAreia5'] . '</td>
                                            <td class="tg-minima-0pky">' . $dataMassaEspecificaMaxEMinDeAreia['PesoAreia6'] . '</td>
                                            <td class="tg-minima-0pky">' . $dataMassaEspecificaMaxEMinDeAreia['PesoAreia7'] . '</td>
                                            <td class="tg-minima-0pky">' . $dataMassaEspecificaMaxEMinDeAreia['PesoAreia8'] . '</td>
                                            <td class="tg-minima-0pky">' . $dataMassaEspecificaMaxEMinDeAreia['PesoAreia9'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-minima-0pky">Massa específica</td>
                                            <td class="tg-minima-c3ow">(g/cm³)</td>
                                            <td class="tg-minima-c3ow">' . $dataMassaEspecificaMaxEMinDeAreia['MassaEsp1'] . '</td>
                                            <td class="tg-minima-c3ow">' . $dataMassaEspecificaMaxEMinDeAreia['MassaEsp2'] . '</td>
                                            <td class="tg-minima-c3ow">' . $dataMassaEspecificaMaxEMinDeAreia['MassaEsp3'] . '</td>
                                            <td class="tg-minima-0pky">' . $dataMassaEspecificaMaxEMinDeAreia['MassaEsp4'] . '</td>
                                            <td class="tg-minima-0pky">' . $dataMassaEspecificaMaxEMinDeAreia['MassaEsp5'] . '</td>
                                            <td class="tg-minima-0pky">' . $dataMassaEspecificaMaxEMinDeAreia['MassaEsp6'] . '</td>
                                            <td class="tg-minima-0pky">' . $dataMassaEspecificaMaxEMinDeAreia['MassaEsp7'] . '</td>
                                            <td class="tg-minima-0pky">' . $dataMassaEspecificaMaxEMinDeAreia['MassaEsp8'] . '</td>
                                            <td class="tg-minima-0pky">' . $dataMassaEspecificaMaxEMinDeAreia['MassaEsp9'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-minima-0pky" colspan="3">Massa específica mínima média</td>
                                            <td class="tg-minima-c3ow">rmin</td>
                                            <td class="tg-minima-34fe">' . $dataMassaEspecificaMaxEMinDeAreia['MassaEspminMd'] . '</td>
                                            <td class="tg-minima-0pky" colspan="5">Índice de vazios máximos</td>
                                            <td class="tg-minima-34fe">' . $dataMassaEspecificaMaxEMinDeAreia['IndiceVazioMax'] . '</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br>
                                <br>
                                <br>
                                <br>
                                <table class="tg-maxima" style="width: 100%">
                                    <colgroup>
                                        <col style="width: 400px">
                                        <col style="width: 50px">
                                        <col style="width: 53px">
                                        <col style="width: 53px">
                                        <col style="width: 53px">
                                        <col style="width: 53px">
                                        <col style="width: 53px">
                                        <col style="width: 53px">
                                        <col style="width: 53px">
                                        <col style="width: 53px">
                                        <col style="width: 53px">
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th class="tg-maxima-76qt" colspan="11">Massa específica máxima das areia</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="tg-maxima-387r" colspan="2">Molde</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['MoldeMAXIMOP'] . '</td>
                                            <td class="tg-maxima-76qt" colspan="2">Volume do molde</td>
                                            <td class="tg-maxima-76qt">(g/cm³)</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['volumeMoldeMax'] . '</td>
                                            <td class="tg-maxima-76qt" colspan="2">Peso do molde:</td>
                                            <td class="tg-maxima-76qt">(g)</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['PesoMoldeMax'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-maxima-387r" colspan="2">Corpo de prova</td>
                                            <td class="tg-maxima-76qt" style="width: 40px">1</td>
                                            <td class="tg-maxima-76qt" style="width: 40px">2</td>
                                            <td class="tg-maxima-76qt" style="width: 40px">3</td>
                                            <td class="tg-maxima-76qt" style="width: 40px">4</td>
                                            <td class="tg-maxima-76qt" style="width: 40px">5</td>
                                            <td class="tg-maxima-76qt" style="width: 40px">6</td>
                                            <td class="tg-maxima-76qt" style="width: 40px">7</td>
                                            <td class="tg-maxima-76qt" style="width: 40px">8</td>
                                            <td class="tg-maxima-76qt" style="width: 40px">9</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-maxima-387r">Peso do molde + areia</td>
                                            <td class="tg-maxima-76qt">(g)</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['pesoMoldemax1'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['pesoMoldemax2'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['pesoMoldemax3'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['pesoMoldemax4'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['pesoMoldemax5'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['pesoMoldemax6'] . '</td>
                                            <td class="tg-maxima-387r">' . $dataMassaEspecificaMaxEMinDeAreia['pesoMoldemax7'] . '</td>
                                            <td class="tg-maxima-387r">' . $dataMassaEspecificaMaxEMinDeAreia['pesoMoldemax8'] . '</td>
                                            <td class="tg-maxima-387r">' . $dataMassaEspecificaMaxEMinDeAreia['pesoMoldemax9'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-maxima-387r">Peso da areia</td>
                                            <td class="tg-maxima-76qt">(g)</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['pesoAreiaMax1'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['pesoAreiaMax2'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['pesoAreiaMax3'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['pesoAreiaMax4'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['pesoAreiaMax5'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['pesoAreiaMax6'] . '</td>
                                            <td class="tg-maxima-387r">' . $dataMassaEspecificaMaxEMinDeAreia['pesoAreiaMax7'] . '</td>
                                            <td class="tg-maxima-387r">' . $dataMassaEspecificaMaxEMinDeAreia['pesoAreiaMax8'] . '</td>
                                            <td class="tg-maxima-387r">' . $dataMassaEspecificaMaxEMinDeAreia['pesoAreiaMax9'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-maxima-387r">Massa específica úmida</td>
                                            <td class="tg-maxima-76qt">(g/cm³)</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['MassaEspUmd1'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['MassaEspUmd2'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['MassaEspUmd3'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['MassaEspUmd4'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['MassaEspUmd5'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['MassaEspUmd6'] . '</td>
                                            <td class="tg-maxima-387r">' . $dataMassaEspecificaMaxEMinDeAreia['MassaEspUmd7'] . '</td>
                                            <td class="tg-maxima-387r">' . $dataMassaEspecificaMaxEMinDeAreia['MassaEspUmd8'] . '</td>
                                            <td class="tg-maxima-387r">' . $dataMassaEspecificaMaxEMinDeAreia['MassaEspUmd9'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-maxima-387r">Solo + água + cápsula</td>
                                            <td class="tg-maxima-76qt">(g)</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['SoloAguaECap1'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['SoloAguaECap2'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['SoloAguaECap3'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['SoloAguaECap4'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['SoloAguaECap5'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['SoloAguaECap6'] . '</td>
                                            <td class="tg-maxima-387r">' . $dataMassaEspecificaMaxEMinDeAreia['SoloAguaECap7'] . '</td>
                                            <td class="tg-maxima-387r">' . $dataMassaEspecificaMaxEMinDeAreia['SoloAguaECap8'] . '</td>
                                            <td class="tg-maxima-387r">' . $dataMassaEspecificaMaxEMinDeAreia['SoloAguaECap9'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-maxima-387r">Solo seco + cápsula</td>
                                            <td class="tg-maxima-76qt">(g)</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['SoloSecCap1'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['SoloSecCap2'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['SoloSecCap3'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['SoloSecCap4'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['SoloSecCap5'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['SoloSecCap6'] . '</td>
                                            <td class="tg-maxima-387r">' . $dataMassaEspecificaMaxEMinDeAreia['SoloSecCap7'] . '</td>
                                            <td class="tg-maxima-387r">' . $dataMassaEspecificaMaxEMinDeAreia['SoloSecCap8'] . '</td>
                                            <td class="tg-maxima-387r">' . $dataMassaEspecificaMaxEMinDeAreia['SoloSecCap9'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-maxima-387r">Massa da cápsula</td>
                                            <td class="tg-maxima-76qt">(g)</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['MassaDaCapsula1'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['MassaDaCapsula2'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['MassaDaCapsula3'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['MassaDaCapsula4'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['MassaDaCapsula5'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['MassaDaCapsula6'] . '</td>
                                            <td class="tg-maxima-387r">' . $dataMassaEspecificaMaxEMinDeAreia['MassaDaCapsula7'] . '</td>
                                            <td class="tg-maxima-387r">' . $dataMassaEspecificaMaxEMinDeAreia['MassaDaCapsula8'] . '</td>
                                            <td class="tg-maxima-387r">' . $dataMassaEspecificaMaxEMinDeAreia['MassaDaCapsula9'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-maxima-387r">Massa do solo seco</td>
                                            <td class="tg-maxima-76qt">(g)</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['MassaSoloSeco1'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['MassaSoloSeco2'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['MassaSoloSeco3'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['MassaSoloSeco4'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['MassaSoloSeco5'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['MassaSoloSeco6'] . '</td>
                                            <td class="tg-maxima-387r">' . $dataMassaEspecificaMaxEMinDeAreia['MassaSoloSeco7'] . '</td>
                                            <td class="tg-maxima-387r">' . $dataMassaEspecificaMaxEMinDeAreia['MassaSoloSeco8'] . '</td>
                                            <td class="tg-maxima-387r">' . $dataMassaEspecificaMaxEMinDeAreia['MassaSoloSeco9'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-maxima-387r">Massa de água</td>
                                            <td class="tg-maxima-76qt">(g)</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['MassaDaAgua1'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['MassaDaAgua2'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['MassaDaAgua3'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['MassaDaAgua4'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['MassaDaAgua5'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['MassaDaAgua6'] . '</td>
                                            <td class="tg-maxima-387r">' . $dataMassaEspecificaMaxEMinDeAreia['MassaDaAgua7'] . '</td>
                                            <td class="tg-maxima-387r">' . $dataMassaEspecificaMaxEMinDeAreia['MassaDaAgua8'] . '</td>
                                            <td class="tg-maxima-387r">' . $dataMassaEspecificaMaxEMinDeAreia['MassaDaAgua9'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-maxima-387r">Teor de umidade</td>
                                            <td class="tg-maxima-76qt">%</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['TeorUmidade1'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['TeorUmidade2'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['TeorUmidade3'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['TeorUmidade4'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['TeorUmidade5'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['TeorUmidade6'] . '</td>
                                            <td class="tg-maxima-387r">' . $dataMassaEspecificaMaxEMinDeAreia['TeorUmidade7'] . '</td>
                                            <td class="tg-maxima-387r">' . $dataMassaEspecificaMaxEMinDeAreia['TeorUmidade8'] . '</td>
                                            <td class="tg-maxima-387r">' . $dataMassaEspecificaMaxEMinDeAreia['TeorUmidade9'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-maxima-387r">Teor de umidade médio</td>
                                            <td class="tg-maxima-76qt">%</td>
                                            <td class="tg-maxima-76qt" colspan="9" style="background-color: #c0c0c0; font-weight: bold"">' . $dataMassaEspecificaMaxEMinDeAreia['TeorUmdMd'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-maxima-387r">Massa específica seca</td>
                                            <td class="tg-maxima-76qt">(g/cm³)</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['MasEspSeca1'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['MasEspSeca2'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['MasEspSeca3'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['MasEspSeca4'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['MasEspSeca5'] . '</td>
                                            <td class="tg-maxima-76qt">' . $dataMassaEspecificaMaxEMinDeAreia['MasEspSeca6'] . '</td>
                                            <td class="tg-maxima-387r">' . $dataMassaEspecificaMaxEMinDeAreia['MasEspSeca7'] . '</td>
                                            <td class="tg-maxima-387r">' . $dataMassaEspecificaMaxEMinDeAreia['MasEspSeca8'] . '</td>
                                            <td class="tg-maxima-387r">' . $dataMassaEspecificaMaxEMinDeAreia['MasEspSeca9'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-maxima-387r" colspan="4">Massa específica média</td>
                                            <td class="tg-maxima-76qt" style="background-color: #c0c0c0; font-weight: bold">' . $dataMassaEspecificaMaxEMinDeAreia['MassaEspminMd'] . '</td>
                                            <td class="tg-maxima-387r" colspan="5">Índice de vazios mínimo</td>
                                            <td class="tg-maxima-76qt" style="background-color: #c0c0c0; font-weight: bold">' . $dataMassaEspecificaMaxEMinDeAreia['IndiceVazioMinimo'] . '</td>
                                        </tr>
                                    </tbody>
                                </table>
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
              <div style="height: 35px;"> ' . $dataMassaEspecificaMaxEMinDeAreia['Observacao'] . ' <div>
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
                    <p style="font-size: 10px; font-weight: bold; margin: 0; font-family: Arial, sans-serif; !important"> Este relatório de ensaio só pode ser copiado integralmente ou parcialmente com autorização da Geocontrole </p>
                    <p style="font-size: 10px; font-weight: bold; margin: 0; font-family: Arial, sans-serif; !important"> Av.Canadá,Nº 159 - Jardim Canadá Nova Lima - Minas Gerais - Brasil - CEP: 34007-654 Tel.: +55 31 3517-9011 </p>
                    <div style="width: 100%; background-color: green; color: #fff; font-family: Arial, sans-serif; !important"> www.geocontrole.com - e-mail: mail.br@geocontrole.com </div>
                </div>
            </footer>
        </body>
    </html>';
        return $html;
    }
}
