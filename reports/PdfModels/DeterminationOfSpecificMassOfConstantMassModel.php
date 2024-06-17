<?php
require_once 'mainSheet.php';
include_once('configureteConnection.php');
class DeterminationOfSpecificMassOfConstantMassModel
{
    private $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function generateModel($codSample, $numberSample, $observation, $dataHeaderAndFooter, $pagina, $totalPaginas, $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante, $logo, $dataFormatada)
    {
        $conexao = new ConfigureteConnection();
        $conexao->connect();

        $pdo = $conexao->getConnection();

        if ($pdo === null) {
            return null;
        }

        $executador = $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['Executado'];
        $aprovador = $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['Aprovado'];
        $verificador = $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['Verificado'];

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
                
            .tg-altura-incial  {border-collapse:collapse;border-spacing:0;margin:0px auto;}
            .tg-altura-incial td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:10px;
              overflow:hidden;padding:1px 4px;word-break:normal;}
            .tg-altura-incial th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:10px;
              font-weight:normal;overflow:hidden;padding:1px 4px;word-break:normal;}
            .tg-altura-incial .tg-altura-incial-387r{border-color:inherit;font-size:13px;text-align:left;vertical-align:middle;}
            .tg-altura-incial .tg-altura-incial-9mbj{border-color:#000000;font-size:13px;text-align:left;vertical-align:middle;}
            .tg-altura-incial .tg-altura-incial-vask{font-size:13px;text-align:left;vertical-align:middle;}

            .tg-legenda  {border-collapse:collapse;border-spacing:0;}
            .tg-legenda td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
              overflow:hidden;padding:2px 10px !important;word-break:normal;}
            .tg-legenda th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:12px;
              font-weight:normal;overflow:hidden;padding:5px 10px !important;word-break:normal;}
            .tg-legenda .tg-legenda-baqh{text-align:center;vertical-align:middle;}
            .tg-legenda .tg-legenda-88oy{font-size:xx-small;text-align:center;vertical-align:middle;}
            
            .tg-coeficiente  {border-collapse:collapse;border-spacing:0;}
            .tg-coeficiente td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:12px;
              overflow:hidden;padding:2px 2px !important;word-break:normal;}
            .tg-coeficiente th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:12px;
              font-weight:normal;overflow:hidden;padding:2px 2px !important;word-break:normal;}
            .tg-coeficiente .tg-coeficiente-73a0{border-color:inherit;font-size:12px;text-align:left;vertical-align:middle;}
            .tg-coeficiente .tg-coeficiente-f4iu{border-color:inherit;font-size:12px;text-align:center;vertical-align:middle;}
            .tg-coeficiente .tg-coeficiente-3qkg{background-color:#c0c0c0;border-color:inherit;font-size:12px;text-align:center;vertical-align:middle;}
            
                .tg-lista-tabelas  {border-collapse:collapse;border-spacing:0;}
                .tg-lista-tabelas td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:12px;
                  overflow:hidden;padding:2px 2px;word-break:normal;}
                .tg-lista-tabelas th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:12px;
                  font-weight:normal;overflow:hidden;padding:5px 2px;word-break:normal;}
                .tg-lista-tabelas .tg-lista-tabelas-0lax{text-align:center;vertical-align:middle}
                .tg-lista-tabelas .tg-lista-tabelas-zohn{font-size:12px;text-align:center;vertical-align:middle}
                .tg-lista-tabelas .tg-lista-tabelas-nrix{text-align:center;vertical-align:middle}
                .tg-lista-tabelas .tg-lista-tabelas-ltad{font-size:12px;text-align:center;vertical-align:middle}
                
                
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
                        <th class="tg-cabecalho-0pky col-3" colspan="2">RELATÓRIO ENSAIO: <div style="margin-left: 15%; font-size: 15px; margin-top: -4px">
                                COEFICIENTE DE PERMEABILIDADE A CARGA CONSTANTE<div>
                        </th>
                    </tr>
                    <tr>
                        <th class="tg-cabecalho-0pky" colspan="1" style="padding: 0px !important">
                            <table class="tg-cabecalho" style="width: 100%">
                                <thead>
                                    <tr>
                                      <td class="tg-cabecalho-0pky" style="width: 160px !important;padding-bottom: 0px; border-top-color:#fff; border-bottom-color:#fff;white-space: nowrap; border-left-color:#fff"> 
                                            NORMA:
                                          <div style="font-size: 102x; margin-left: 10px; margin-top: 6px; margin-bottom: 5px" class="cabecalho-resultado-font">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['NormaEnsaio'] . '</div>
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
                                  <span class="cabecalho-resultado-font">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['DataInicio'] . '</span>
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
                                <span class="cabecalho-resultado-font">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['DataFinal'] . '</span>
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
        <td class="tg-0pky" colspan="15" style="border-left: none !important; border-right: none !important; border-top-color: #fff; padding-left: 0px !important; padding-right: 0px !important; height: 675px;">                                <div style="width: 100%; text-align: center; font-size: 15px; margin-top: -15px">
                                    DETERMINAÇÃO DO COEFICIENTE DE PERMEABILIDADE A CARGA CONSTANTE EM CÂMARA TRIAXIAL<br>(MÉTODO A)
                                </div>
                                <div style="display: inline-block; margin-top: 40px;">
                                    <div style="display: inline-block">
                                        <table class="tg-altura-incial" style="width: 315px">
                                            <colgroup>
                                                <col style="width: 180.2px">
                                                <col style="width: 28.2px">
                                                <col style="width: 43.2px">
                                                <col style="width: 42.2px">
                                            </colgroup>
                                            <thead>
                                                <tr>
                                                    <th class="tg-altura-incial-387r" style="width: 155px">Altura inicial</th>
                                                    <th class="tg-altura-incial-387r" style="font-size: 9px; text-align: center">Hi:</th>
                                                    <th class="tg-altura-incial-9mbj" style="text-align: center;width: 70px">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['AlturaInicial'] . '</th>
                                                    <th class="tg-altura-incial-vask" style="text-align: center">cm</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="tg-altura-incial-387r">Diâmetro inicial</td>
                                                    <td class="tg-altura-incial-387r" style="font-size: 9px; text-align: center">Di</td>
                                                    <td class="tg-altura-incial-9mbj" style="text-align: center">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['DiametroInicial'] . '</td>
                                                    <td class="tg-altura-incial-vask" style="text-align: center">cm</td>
                                                </tr>
                                                <tr>
                                                    <td class="tg-altura-incial-387r">Área inicial</td>
                                                    <td class="tg-altura-incial-387r" style="font-size: 9px; text-align: center">Ai</td>
                                                    <td class="tg-altura-incial-9mbj" style="text-align: center">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['AreaInicial'] . '</td>
                                                    <td class="tg-altura-incial-vask" style="text-align: center">cm²</td>
                                                </tr>
                                                <tr>
                                                    <td class="tg-altura-incial-387r">Volume inicial</td>
                                                    <td class="tg-altura-incial-387r" style="font-size: 9px; text-align: center">Vi</td>
                                                    <td class="tg-altura-incial-9mbj" style="text-align: center">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['VolInicial'] . '</td>
                                                    <td class="tg-altura-incial-vask" style="text-align: center">cm³</td>
                                                </tr>
                                                <tr>
                                                    <td class="tg-altura-incial-387r">Massa úmida</td>
                                                    <td class="tg-altura-incial-387r" style="font-size: 9px; text-align: center">M</td>
                                                    <td class="tg-altura-incial-9mbj" style="text-align: center">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['MassaUmida'] . '</td>
                                                    <td class="tg-altura-incial-vask" style="text-align: center">g</td>
                                                </tr>
                                                <tr>
                                                    <td class="tg-altura-incial-387r">Massa seca</td>
                                                    <td class="tg-altura-incial-387r" style="font-size: 9px; text-align: center">Ms</td>
                                                    <td class="tg-altura-incial-9mbj" style="text-align: center">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['MassaSeca'] . '</td>
                                                    <td class="tg-altura-incial-vask" style="text-align: center">g</td>
                                                </tr>
                                                <tr>
                                                    <td class="tg-altura-incial-387r">Teor em água</td>
                                                    <td class="tg-altura-incial-387r" style="font-size: 9px; text-align: center">w</td>
                                                    <td class="tg-altura-incial-9mbj" style="text-align: center">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['TeorAgua'] . '</td>
                                                    <td class="tg-altura-incial-vask" style="text-align: center">%</td>
                                                </tr>
                                                <tr>
                                                    <td class="tg-altura-incial-387r">Temperatura do Ensaio</td>
                                                    <td class="tg-altura-incial-387r" style="font-size: 9px; text-align: center">T</td>
                                                    <td class="tg-altura-incial-9mbj" style="text-align: center">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['TempeEnsaio'] . '</td>
                                                    <td class="tg-altura-incial-vask" style="text-align: center">°C</td>
                                                </tr>
                                                <tr>
                                                    <td class="tg-altura-incial-387r">Carga hidráulica</td>
                                                    <td class="tg-altura-incial-387r" style="font-size: 9px; text-align: center">a</td>
                                                    <td class="tg-altura-incial-9mbj" style="text-align: center">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['Carga_Hidraulica'] . '</td>
                                                    <td class="tg-altura-incial-vask" style="text-align: center">KPa</td>
                                                </tr>
                                                <tr>
                                                    <td class="tg-altura-incial-vask">Tensão de confinamento</td>
                                                    <td class="tg-altura-incial-vask"  style="font-size: 9px; text-align: center">--</td>
                                                    <td class="tg-altura-incial-vask" style="text-align: center">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['TensaoConfinamento'] . '</td>
                                                    <td class="tg-altura-incial-vask" style="text-align: center">KPa</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div style="display: inline-block; margin-left: 135px;">
                                        <table class="tg-altura-incial" style="width: 334px">
                                            <colgroup>
                                                <col style="width: 180.2px">
                                                <col style="width: 28.2px">
                                                <col style="width: 43.2px">
                                                <col style="width: 42.2px">
                                            </colgroup>
                                            <thead>
                                                <tr>
                                                    <th class="tg-altura-incial-387r style="width: 160px"">Altura final</th>
                                                    <th class="tg-altura-incial-387r" style="font-size: 9px; text-align: center">Hf:</th>
                                                    <th class="tg-altura-incial-9mbj" style="width: 80px; text-align: center">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['AlturaFinal'] . '</th>
                                                    <th class="tg-altura-incial-vask" style="text-align: center">cm</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="tg-altura-incial-387r">Diâmetro final</td>
                                                    <td class="tg-altura-incial-387r" style="font-size: 9px; text-align: center">Df</td>
                                                    <td class="tg-altura-incial-9mbj" style="text-align: center">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['DiametroFinal'] . '</td>
                                                    <td class="tg-altura-incial-vask" style="text-align: center">cm</td>
                                                </tr>
                                                <tr>
                                                    <td class="tg-altura-incial-387r">Área final</td>
                                                    <td class="tg-altura-incial-387r" style="font-size: 9px; text-align: center">Af</td>
                                                    <td class="tg-altura-incial-9mbj" style="text-align: center">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['AreaFinal'] . '</td>
                                                    <td class="tg-altura-incial-vask" style="text-align: center">cm²</td>
                                                </tr>
                                                <tr>
                                                    <td class="tg-altura-incial-387r">Volume final</td>
                                                    <td class="tg-altura-incial-387r" style="font-size: 9px; text-align: center">Vf</td>
                                                    <td class="tg-altura-incial-9mbj" style="text-align: center">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['VolFinal'] . '</td>
                                                    <td class="tg-altura-incial-vask" style="text-align: center">cm³</td>
                                                </tr>
                                                <tr>
                                                    <td class="tg-altura-incial-387r">Massa específica húmida</td>
                                                    <td class="tg-altura-incial-387r" style="font-size: 9px; text-align: center">?</td>
                                                    <td class="tg-altura-incial-9mbj" style="text-align: center">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['MassaEspHumida'] . '</td>
                                                    <td class="tg-altura-incial-vask" style="text-align: center">g/cm³</td>
                                                </tr>
                                                <tr>
                                                    <td class="tg-altura-incial-387r">Massa específica seca</td>
                                                    <td class="tg-altura-incial-387r" style="font-size: 9px; text-align: center">?d</td>
                                                    <td class="tg-altura-incial-9mbj" style="text-align: center">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['MassaEspSeca'] . '</td>
                                                    <td class="tg-altura-incial-vask" style="text-align: center">g</td>
                                                </tr>
                                                <tr>
                                                    <td class="tg-altura-incial-387r">Massa espec. dos grãos</td>
                                                    <td class="tg-altura-incial-387r" style="font-size: 9px; text-align: center">?s</td>
                                                    <td class="tg-altura-incial-9mbj" style="text-align: center">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['MassaEspGraos'] . '</td>
                                                    <td class="tg-altura-incial-vask" style="text-align: center">g/cm³</td>
                                                </tr>
                                                <tr>
                                                    <td class="tg-altura-incial-387r">Índice de vazios inicial</td>
                                                    <td class="tg-altura-incial-387r" style="font-size: 9px; text-align: center">ei</td>
                                                    <td class="tg-altura-incial-9mbj" style="text-align: center">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['IndiceVazios'] . '</td>
                                                    <td class="tg-altura-incial-vask" style="text-align: center">--</td>
                                                </tr>
                                                <tr>
                                                    <td class="tg-altura-incial-387r">Grau de saturação inicial</td>
                                                    <td class="tg-altura-incial-387r" style="font-size: 9px; text-align: center">Sr</td>
                                                    <td class="tg-altura-incial-9mbj" style="text-align: center">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['GrauSaturacao'] . '</td>
                                                    <td class="tg-altura-incial-vask" style="text-align: center">%</td>
                                                </tr>
                                                <tr>
                                                    <td class="tg-altura-incial-vask">Volume de vazios</td>
                                                    <td class="tg-altura-incial-vask" style="font-size: 9px; text-align: center">Vv</td>
                                                    <td class="tg-altura-incial-vask" style="text-align: center">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['VolVazios'] . '</td>
                                                    <td class="tg-altura-incial-vask" style="text-align: center">%</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div style="margin-top: -20px">
                                <table class="tg-legenda" style="width: 100%">
                                    <colgroup>
                                        <col style="width: 67.2px">
                                        <col style="width: 36.2px">
                                        <col style="width: 37.2px">
                                        <col style="width: 37.2px">
                                        <col style="width: 36.2px">
                                        <col style="width: 51.2px">
                                        <col style="width: 58.2px">
                                        <col style="width: 49.2px">
                                        <col style="width: 36.2px">
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th class="tg-legenda-baqh" style="width: 78px">Data</th>
                                            <th class="tg-legenda-baqh">Hi</th>
                                            <th class="tg-legenda-baqh">Hf</th>
                                            <th class="tg-legenda-baqh">Vi</th>
                                            <th class="tg-legenda-baqh">Vf</th>
                                            <th class="tg-legenda-baqh"><span style="font-family: DejaVu Sans !important">&#x394;</span> V</th>
                                            <th class="tg-legenda-baqh"><span style="font-family: DejaVu Sans !important">&#x394;</span>t (seg)</th>
                                            <th class="tg-legenda-baqh">q</th>
                                            <th class="tg-legenda-baqh">K</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="tg-legenda-88oy" style="width: 50px">(dd:mm:aaaa)</td>
                                            <td class="tg-legenda-88oy" style="width: 10px" colspan="2">(h:m:s)</td>
                                            <td class="tg-legenda-88oy" style="width: 10px" colspan="2">(cm³)</td>
                                            <td class="tg-legenda-88oy" style="width: 90px">(cm³)</td>
                                            <td class="tg-legenda-88oy" style="width: 90px">(s)</td>
                                            <td class="tg-legenda-88oy" style="width: 90px">(cm³/min)</td>
                                            <td class="tg-legenda-88oy" style="width: 90px">(cm/s)</td>
                                        </tr>
                                    </tbody>
                                </table> <br>
                                <table class="tg-lista-tabelas" style="width: 100%">
                                    <colgroup>
                                        <col style="width: 37.2px">
                                        <col style="width: 95.2px">
                                        <col style="width: 34.2px">
                                        <col style="width: 30.2px">
                                        <col style="width: 26.2px">
                                        <col style="width: 46.2px">
                                        <col style="width: 68.2px">
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <td class="tg-lista-tabelas-0lax" style="width: 94px">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['dtDataT1'] . '</td>
                                            <td class="tg-lista-tabelas-0lax" style="width: 102px">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['H1'] . '</td>
                                            <td class="tg-lista-tabelas-zohn" style="width: 103px">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['V1'] . '</td>
                                            <td class="tg-lista-tabelas-nrix" style="width: 105px" rowspan="2">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['DeltaV1'] . '</td>
                                            <td class="tg-lista-tabelas-nrix" style="width: 107px" rowspan="2">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['DeltaT1'] . '</td>
                                            <td class="tg-lista-tabelas-nrix" style="width: 106px" rowspan="2">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['Q1'] . '</td>
                                            <td class="tg-lista-tabelas-nrix" style="width: 105px" rowspan="2">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['K1'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-lista-tabelas-ltad">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['dtDataT2'] . '</td>
                                            <td class="tg-lista-tabelas-ltad">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['H2'] . '</td>
                                            <td class="tg-lista-tabelas-ltad">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['V2'] . '</td>
                                        </tr>
                                    </thead>
                                </table> <br>
                                <table class="tg-lista-tabelas" style="width: 100%">
                                    <colgroup>
                                        <col style="width: 37.2px">
                                        <col style="width: 95.2px">
                                        <col style="width: 34.2px">
                                        <col style="width: 30.2px">
                                        <col style="width: 26.2px">
                                        <col style="width: 46.2px">
                                        <col style="width: 68.2px">
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <td class="tg-lista-tabelas-0lax" style="width: 94px">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['dtDataT3'] . '</td>
                                            <td class="tg-lista-tabelas-0lax" style="width: 102px">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['H3'] . '</td>
                                            <td class="tg-lista-tabelas-zohn" style="width: 103px">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['V3'] . '</td>
                                            <td class="tg-lista-tabelas-nrix" style="width: 105px" rowspan="2">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['DeltaV2'] . '</td>
                                            <td class="tg-lista-tabelas-nrix" style="width: 107px" rowspan="2">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['DeltaT2'] . '</td>
                                            <td class="tg-lista-tabelas-nrix" style="width: 106px" rowspan="2">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['Q2'] . '</td>
                                            <td class="tg-lista-tabelas-nrix" style="width: 105px" rowspan="2">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['K2'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-lista-tabelas-ltad">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['dtDataT4'] . '</td>
                                            <td class="tg-lista-tabelas-ltad">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['H4'] . '</td>
                                            <td class="tg-lista-tabelas-ltad">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['V4'] . '</td>
                                        </tr>
                                    </thead>
                                </table> <br>
                                <table class="tg-lista-tabelas" style="width: 100%">
                                    <colgroup>
                                        <col style="width: 37.2px">
                                        <col style="width: 95.2px">
                                        <col style="width: 34.2px">
                                        <col style="width: 30.2px">
                                        <col style="width: 26.2px">
                                        <col style="width: 46.2px">
                                        <col style="width: 68.2px">
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <td class="tg-lista-tabelas-0lax" style="width: 94px">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['dtDataT5'] . '</td>
                                            <td class="tg-lista-tabelas-0lax" style="width: 102px">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['H5'] . '</td>
                                            <td class="tg-lista-tabelas-zohn" style="width: 103px">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['V5'] . '</td>
                                            <td class="tg-lista-tabelas-nrix" style="width: 105px" rowspan="2">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['DeltaV3'] . '</td>
                                            <td class="tg-lista-tabelas-nrix" style="width: 107px" rowspan="2">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['DeltaT3'] . '</td>
                                            <td class="tg-lista-tabelas-nrix" style="width: 106px" rowspan="2">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['Q3'] . '</td>
                                            <td class="tg-lista-tabelas-nrix" style="width: 105px" rowspan="2">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['K3'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-lista-tabelas-ltad">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['dtDataT6'] . '</td>
                                            <td class="tg-lista-tabelas-ltad">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['H6'] . '</td>
                                            <td class="tg-lista-tabelas-ltad">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['V6'] . '</td>
                                        </tr>
                                    </thead>
                                </table> <br>
                                <table class="tg-lista-tabelas" style="width: 100%">
                                    <colgroup>
                                        <col style="width: 37.2px">
                                        <col style="width: 95.2px">
                                        <col style="width: 34.2px">
                                        <col style="width: 30.2px">
                                        <col style="width: 26.2px">
                                        <col style="width: 46.2px">
                                        <col style="width: 68.2px">
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <td class="tg-lista-tabelas-0lax" style="width: 94px">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['dtDataT7'] . '</td>
                                            <td class="tg-lista-tabelas-0lax" style="width: 102px">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['H7'] . '</td>
                                            <td class="tg-lista-tabelas-zohn" style="width: 103px">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['V7'] . '</td>
                                            <td class="tg-lista-tabelas-nrix" style="width: 105px" rowspan="2">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['DeltaV4'] . '</td>
                                            <td class="tg-lista-tabelas-nrix" style="width: 107px" rowspan="2">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['DeltaT4'] . '</td>
                                            <td class="tg-lista-tabelas-nrix" style="width: 106px" rowspan="2">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['Q4'] . '</td>
                                            <td class="tg-lista-tabelas-nrix" style="width: 105px" rowspan="2">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['K4'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-lista-tabelas-ltad">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['dtDataT8'] . '</td>
                                            <td class="tg-lista-tabelas-ltad">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['H8'] . '</td>
                                            <td class="tg-lista-tabelas-ltad">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['V8'] . '</td>
                                        </tr>
                                    </thead>
                                </table> <br>
                                <table class="tg-lista-tabelas" style="width: 100%">
                                    <colgroup>
                                        <col style="width: 37.2px">
                                        <col style="width: 95.2px">
                                        <col style="width: 34.2px">
                                        <col style="width: 30.2px">
                                        <col style="width: 26.2px">
                                        <col style="width: 46.2px">
                                        <col style="width: 68.2px">
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <td class="tg-lista-tabelas-0lax" style="width: 94px">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['dtDataT9'] . '</td>
                                            <td class="tg-lista-tabelas-0lax" style="width: 102px">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['H9'] . '</td>
                                            <td class="tg-lista-tabelas-zohn" style="width: 103px">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['V9'] . '</td>
                                            <td class="tg-lista-tabelas-nrix" style="width: 105px" rowspan="2">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['DeltaV5'] . '</td>
                                            <td class="tg-lista-tabelas-nrix" style="width: 107px" rowspan="2">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['DeltaT5'] . '</td>
                                            <td class="tg-lista-tabelas-nrix" style="width: 106px" rowspan="2">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['Q5'] . '</td>
                                            <td class="tg-lista-tabelas-nrix" style="width: 105px" rowspan="2">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['K5'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-lista-tabelas-ltad">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['dtDataT10'] . '</td>
                                            <td class="tg-lista-tabelas-ltad">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['H10'] . '</td>
                                            <td class="tg-lista-tabelas-ltad">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['V10'] . '</td>
                                        </tr>
                                    </thead>
                                </table> <br>
                                <table class="tg-lista-tabelas" style="width: 100%">
                                    <colgroup>
                                        <col style="width: 37.2px">
                                        <col style="width: 95.2px">
                                        <col style="width: 34.2px">
                                        <col style="width: 30.2px">
                                        <col style="width: 26.2px">
                                        <col style="width: 46.2px">
                                        <col style="width: 68.2px">
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <td class="tg-lista-tabelas-0lax" style="width: 94px">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['dtDataT11'] . '</td>
                                            <td class="tg-lista-tabelas-0lax" style="width: 102px">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['H11'] . '</td>
                                            <td class="tg-lista-tabelas-zohn" style="width: 103px">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['V11'] . '</td>
                                            <td class="tg-lista-tabelas-nrix" style="width: 105px" rowspan="2">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['DeltaV6'] . '</td>
                                            <td class="tg-lista-tabelas-nrix" style="width: 107px" rowspan="2">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['DeltaT6'] . '</td>
                                            <td class="tg-lista-tabelas-nrix" style="width: 106px" rowspan="2">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['Q6'] . '</td>
                                            <td class="tg-lista-tabelas-nrix" style="width: 105px" rowspan="2">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['K6'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-lista-tabelas-ltad">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['dtDataT12'] . '</td>
                                            <td class="tg-lista-tabelas-ltad">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['H12'] . '</td>
                                            <td class="tg-lista-tabelas-ltad">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['V12'] . '</td>
                                        </tr>
                                    </thead>
                                </table> <br>
                                <table class="tg-lista-tabelas" style="width: 100%">
                                    <colgroup>
                                        <col style="width: 37.2px">
                                        <col style="width: 95.2px">
                                        <col style="width: 34.2px">
                                        <col style="width: 30.2px">
                                        <col style="width: 26.2px">
                                        <col style="width: 46.2px">
                                        <col style="width: 68.2px">
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <td class="tg-lista-tabelas-0lax" style="width: 94px">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['dtDataT13'] . '</td>
                                            <td class="tg-lista-tabelas-0lax" style="width: 102px">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['H13'] . '</td>
                                            <td class="tg-lista-tabelas-zohn" style="width: 103px">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['V13'] . '</td>
                                            <td class="tg-lista-tabelas-nrix" style="width: 105px" rowspan="2">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['DeltaV7'] . '</td>
                                            <td class="tg-lista-tabelas-nrix" style="width: 107px" rowspan="2">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['DeltaT7'] . '</td>
                                            <td class="tg-lista-tabelas-nrix" style="width: 106px" rowspan="2">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['Q7'] . '</td>
                                            <td class="tg-lista-tabelas-nrix" style="width: 105px" rowspan="2">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['K7'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-lista-tabelas-ltad">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['dtDataT14'] . '</td>
                                            <td class="tg-lista-tabelas-ltad">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['H14'] . '</td>
                                            <td class="tg-lista-tabelas-ltad">' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['V14'] . '</td>
                                        </tr>
                                    </thead>
                                </table><br>
                                <div style="margin-left: 20%">
                                    <table class="tg-coeficiente" style="width: 80%">
                                        <colgroup>
                                            <col style="width: 261.2px">
                                            <col style="width: 44.2px">
                                            <col style="width: 72.2px">
                                            <col style="width: 48.2px">
                                        </colgroup>
                                        <tbody>
                                            <tr>
                                                <td class="tg-coeficiente-73a0" style="text-align: center;">Coeficiente de permeabilidade K</td>
                                                <td class="tg-coeficiente-f4iu">K</td>
                                                <td class="tg-coeficiente-3qkg"><b>' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['CoeficientePerme'] . '</b></td>
                                                <td class="tg-coeficiente-f4iu">cm/s</td>
                                            </tr>
                                            <tr>
                                                <td class="tg-coeficiente-73a0" style="text-align: center;">Coeficiente de permeabilidade para 20°C</td>
                                                <td class="tg-coeficiente-f4iu">K20</td>
                                                <td class="tg-coeficiente-3qkg"><b>' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['CoeficientePerme20C'] . '</b></td>
                                                <td class="tg-coeficiente-f4iu">cm/s</td>
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
              <div style="height: 35px;"> ' . $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['Observacao'] . ' <div>
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
