<?php
require_once 'mainSheet.php';
include_once('configureteConnection.php');
class DeterminationOfTheSpecificMassOfVariableMassModel
{
    private $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function generateModel($codSample, $numberSample, $observation, $dataHeaderAndFooter, $pagina, $totalPaginas, $dataDeterminacaoDoCoeficienteDePermeabilidade, $logo, $dataFormatada)
    {
        $conexao = new ConfigureteConnection();
        $conexao->connect();

        $pdo = $conexao->getConnection();

        if ($pdo === null) {
            return null;
        }

        $executador = $dataDeterminacaoDoCoeficienteDePermeabilidade['Executado'];
        $aprovador = $dataDeterminacaoDoCoeficienteDePermeabilidade['Aprovado'];
        $verificador = $dataDeterminacaoDoCoeficienteDePermeabilidade['Verificado'];

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
            
            
            .tg-lista-de-tabelas  {border-collapse:collapse;border-spacing:0;}
            .tg-lista-de-tabelas td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:12px;
              overflow:hidden;padding:2px 2px !important;word-break:normal;}
            .tg-lista-de-tabelas th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:12px;
              font-weight:normal;overflow:hidden;padding:2px 2px !important;word-break:normal;}
            .tg-lista-de-tabelas .tg-lista-de-tabelas-w2dt{font-size:12px;text-align:center;vertical-align:middle}
            
            .tg-coeficiente  {border-collapse:collapse;border-spacing:0;}
            .tg-coeficiente td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:12px;
              overflow:hidden;padding:2px 2px !important;word-break:normal;}
            .tg-coeficiente th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:12px;
              font-weight:normal;overflow:hidden;padding:2px 2px !important;word-break:normal;}
            .tg-coeficiente .tg-coeficiente-73a0{border-color:inherit;font-size:12px;text-align:left;vertical-align:middle;}
            .tg-coeficiente .tg-coeficiente-f4iu{border-color:inherit;font-size:12px;text-align:center;vertical-align:middle;}
            .tg-coeficiente .tg-coeficiente-3qkg{background-color:#c0c0c0;border-color:inherit;font-size:12px;text-align:center;vertical-align:middle;}
        </style>
    </head>
    
    <body>
    <header>
        
        </header>
        <main style="margin-top: 43px">
        <table class="tg-cabecalho" style="width: 100%;margin-bottom: 13px">
                <thead>
                    <tr>
                        <th class="tg-cabecalho-0pky col-1" colspan="2" rowspan="2"> CLIENTE: <br>
                            <img style="margin-left: 30%" src="data:image/jpeg;base64,' . base64_encode($logo) . '"  width="80px"">
                        </th>
                        <th class="tg-cabecalho-0pky col-3" colspan="2">RELATÓRIO ENSAIO: <div style="margin-left: 15%; font-size: 15px; margin-top: -4px">
                                COEFICIENTE DE PERMEABILIDADE A CARGA VARIÁVEL<div>
                        </th>
                    </tr>
                    <tr>
                        <th class="tg-cabecalho-0pky" colspan="1" style="padding: 0px !important">
                            <table class="tg-cabecalho" style="width: 100%">
                                <thead>
                                    <tr>
                                      <td class="tg-cabecalho-0pky" style="width: 160px !important;padding-bottom: 0px; border-top-color:#fff; border-bottom-color:#fff;white-space: nowrap; border-left-color:#fff"> 
                                            NORMA:
                                          <div style="font-size: 102x; margin-left: 10px; margin-top: 6px; margin-bottom: 5px" class="cabecalho-resultado-font">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['NormaEnsaio'] . '</div>
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
                                  <span class="cabecalho-resultado-font">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['DataInicio'] . '</span>
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
                                <span class="cabecalho-resultado-font">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['DataFinal'] . '</span>
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
    <td class="tg-0pky" colspan="15" style="border-left: none !important; border-right: none !important; border-top-color: #fff; padding-left: 0px !important; padding-right: 0px !important; height: 675px;">                        <div style="width: 100%; text-align: center; font-size: 15px; margin-top: -15px">
                            DETERMINAÇÃO DO COEFICIENTE DE PERMEABILIDADE A CARGA VARIÁVEL EM CÂMARA TRIAXIAL<br>(MÉTODO A)
                        </div>    
                        <div style="display: inline-block; margin-top: 42px;">
                                <div style="display: inline-block">
                                    <table class="tg-altura-incial" style="width: 348px">
                                        <colgroup>
                                            <col style="width: 180.2px">
                                            <col style="width: 28.2px">
                                            <col style="width: 43.2px">
                                            <col style="width: 42.2px">
                                        </colgroup>
                                        <thead>
                                            <tr>
                                                <th class="tg-altura-incial-387r" style="width: 160px">Altura inicial</th>
                                                <th class="tg-altura-incial-387r" style="font-size: 9px; text-align: center">Hi:</th>
                                                <th class="tg-altura-incial-9mbj" style="text-align: center; width: 90px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['AlturaInicial'] . '</th>
                                                <th class="tg-altura-incial-vask" style="text-align: center">cm</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="tg-altura-incial-387r">Diâmetro inicial</td>
                                                <td class="tg-altura-incial-387r" style="font-size: 9px; text-align: center">Di</td>
                                                <td class="tg-altura-incial-9mbj" style="text-align: center"' . $dataDeterminacaoDoCoeficienteDePermeabilidade['DiametroInicial'] . '</td>
                                                <td class="tg-altura-incial-vask" style="text-align: center">cm</td>
                                            </tr>
                                            <tr>
                                                <td class="tg-altura-incial-387r">Área inicial</td>
                                                <td class="tg-altura-incial-387r" style="font-size: 9px; text-align: center">Ai</td>
                                                <td class="tg-altura-incial-9mbj" style="text-align: center">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['AreaInicial'] . '</td>
                                                <td class="tg-altura-incial-vask" style="text-align: center">cm²</td>
                                            </tr>
                                            <tr>
                                                <td class="tg-altura-incial-387r">Volume inicial</td>
                                                <td class="tg-altura-incial-387r" style="font-size: 9px; text-align: center">Vi</td>
                                                <td class="tg-altura-incial-9mbj" style="text-align: center">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['VolInicial'] . '</td>
                                                <td class="tg-altura-incial-vask" style="text-align: center">cm³</td>
                                            </tr>
                                            <tr>
                                                <td class="tg-altura-incial-387r">Massa úmida</td>
                                                <td class="tg-altura-incial-387r" style="font-size: 9px; text-align: center">M</td>
                                                <td class="tg-altura-incial-9mbj" style="text-align: center">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['MassaUmida'] . '</td>
                                                <td class="tg-altura-incial-vask" style="text-align: center">g</td>
                                            </tr>
                                            <tr>
                                                <td class="tg-altura-incial-387r">Massa seca</td>
                                                <td class="tg-altura-incial-387r" style="font-size: 9px; text-align: center">Ms</td>
                                                <td class="tg-altura-incial-9mbj" style="text-align: center">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['MassaSeca'] . '</td>
                                                <td class="tg-altura-incial-vask" style="text-align: center">g</td>
                                            </tr>
                                            <tr>
                                                <td class="tg-altura-incial-387r">Teor em água</td>
                                                <td class="tg-altura-incial-387r" style="font-size: 9px; text-align: center">w</td>
                                                <td class="tg-altura-incial-9mbj" style="text-align: center">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['TeorAgua'] . '</td>
                                                <td class="tg-altura-incial-vask" style="text-align: center">%</td>
                                            </tr>
                                            <tr>
                                                <td class="tg-altura-incial-387r">Temperatura do Ensaio</td>
                                                <td class="tg-altura-incial-387r" style="font-size: 9px; text-align: center">T</td>
                                                <td class="tg-altura-incial-9mbj" style="text-align: center">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['TempeEnsaio'] . '</td>
                                                <td class="tg-altura-incial-vask" style="text-align: center">°C</td>
                                            </tr>
                                            <tr>
                                                <td class="tg-altura-incial-387r">Área interna do tubo</td>
                                                <td class="tg-altura-incial-387r" style="font-size: 9px; text-align: center">a</td>
                                                <td class="tg-altura-incial-9mbj" style="text-align: center">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['AreaInternaTubo'] . '</td>
                                                <td class="tg-altura-incial-vask" style="text-align: center">KPa</td>
                                            </tr>
                                            <tr>
                                                <td class="tg-altura-incial-vask">Tensão de confinamento</td>
                                                <td class="tg-altura-incial-vask" style="font-size: 9px; text-align: center">--</td>
                                                <td class="tg-altura-incial-vask" style="text-align: center">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['TensaoConfinamento'] . '</td>
                                                <td class="tg-altura-incial-vask" style="text-align: center">KPa</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div style="display: inline-block; margin-left: 122px;">
                                    <table class="tg-altura-incial" style="width: 323px">
                                        <colgroup>
                                            <col style="width: 130.2px">
                                            <col style="width: 28.2px">
                                            <col style="width: 43.2px">
                                            <col style="width: 42.2px">
                                        </colgroup>
                                        <thead>
                                            <tr>
                                                <th class="tg-altura-incial-387r" style="width: 160px">Altura final</th>
                                                <th class="tg-altura-incial-387r" style="font-size: 9px; text-align: center">Hf:</th>
                                                <th class="tg-altura-incial-9mbj" style="text-align: center; width: 80px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['AlturaFinal'] . '</th>
                                                <th class="tg-altura-incial-vask" style="text-align: center">cm</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="tg-altura-incial-387r">Diâmetro final</td>
                                                <td class="tg-altura-incial-387r" style="font-size: 9px; text-align: center">Df</td>
                                                <td class="tg-altura-incial-9mbj" style="text-align: center">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['DiametroFinal'] . '</td>
                                                <td class="tg-altura-incial-vask" style="text-align: center">cm</td>
                                            </tr>
                                            <tr>
                                                <td class="tg-altura-incial-387r">Área final</td>
                                                <td class="tg-altura-incial-387r" style="font-size: 9px; text-align: center">Af</td>
                                                <td class="tg-altura-incial-9mbj" style="text-align: center">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['AreaFinal'] . '</td>
                                                <td class="tg-altura-incial-vask" style="text-align: center">cm²</td>
                                            </tr>
                                            <tr>
                                                <td class="tg-altura-incial-387r">Volume final</td>
                                                <td class="tg-altura-incial-387r" style="font-size: 9px; text-align: center">Vf</td>
                                                <td class="tg-altura-incial-9mbj" style="text-align: center">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['VolFinal'] . '</td>
                                                <td class="tg-altura-incial-vask" style="text-align: center">cm³</td>
                                            </tr>
                                            <tr>
                                                <td class="tg-altura-incial-387r">Massa específica húmida</td>
                                                <td class="tg-altura-incial-387r" style="font-size: 9px; text-align: center"><span style="font-family: DejaVu Sans !important">&#x3D5;</span></td>
                                                <td class="tg-altura-incial-9mbj" style="text-align: center">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['MassaEspHumida'] . '</td>
                                                <td class="tg-altura-incial-vask" style="text-align: center">g/cm³</td>
                                            </tr>
                                            <tr>
                                                <td class="tg-altura-incial-387r">Massa específica seca</td>
                                                <td class="tg-altura-incial-387r" style="font-size: 9px; text-align: center"><span style="font-family: DejaVu Sans !important; padding: 0px;">&#966;</span>d</td>
                                                <td class="tg-altura-incial-9mbj" style="text-align: center">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['MassaEspSeca'] . '</td>
                                                <td class="tg-altura-incial-vask" style="text-align: center">g</td>
                                            </tr>
                                            <tr>
                                                <td class="tg-altura-incial-387r">Massa espec. dos grãos</td>
                                                <td class="tg-altura-incial-387r" style="font-size: 9px; text-align: center"><span style="font-family: DejaVu Sans !important">&#966;</span>s</td>
                                                <td class="tg-altura-incial-9mbj" style="text-align: center">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['MassaEspGraos'] . '</td>
                                                <td class="tg-altura-incial-vask" style="text-align: center">g/cm³</td>
                                            </tr>
                                            <tr>
                                                <td class="tg-altura-incial-387r">Índice de vazios inicial</td>
                                                <td class="tg-altura-incial-387r" style="font-size: 9px; text-align: center">ei</td>
                                                <td class="tg-altura-incial-9mbj" style="text-align: center">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['IndiceVazios'] . '</td>
                                                <td class="tg-altura-incial-vask" style="text-align: center">--</td>
                                            </tr>
                                            <tr>
                                                <td class="tg-altura-incial-387r">Grau de saturação inicial</td>
                                                <td class="tg-altura-incial-387r" style="font-size: 9px; text-align: center">Sr</td>
                                                <td class="tg-altura-incial-9mbj" style="text-align: center">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['GrauSaturacao'] . '</td>
                                                <td class="tg-altura-incial-vask" style="text-align: center">%</td>
                                            </tr>
                                            <tr>
                                                <td class="tg-altura-incial-vask">Volume de vazios</td>
                                                <td class="tg-altura-incial-vask" style="font-size: 9px; text-align: center">Vv</td>
                                                <td class="tg-altura-incial-vask" style="text-align: center">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['VolVazios'] . '</td>
                                                <td class="tg-altura-incial-vask" style="text-align: center">%</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div style="margin-top: -20px">
                                <table class="tg-legenda" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th class="tg-legenda-baqh">T1</th>
                                            <th class="tg-legenda-baqh" style="width: 78px">T2</th>
                                            <th class="tg-legenda-baqh">H1</th>
                                            <th class="tg-legenda-baqh">H2</th>
                                            <th class="tg-legenda-baqh">V1</th>
                                            <th class="tg-legenda-baqh">V2</th>
                                            <th class="tg-legenda-baqh">V3</th>
                                            <th class="tg-legenda-baqh">V4</th>
                                            <th class="tg-legenda-baqh"><span style="font-family: DejaVu Sans !important">&#x394;</span> t (seg)</th>
                                            <th class="tg-legenda-baqh">In (H1/H2)</th>
                                            <th class="tg-legenda-baqh">aH/A<span style="font-family: DejaVu Sans !important">&#x394;</span>t</th>
                                            <th class="tg-legenda-baqh">K (cm/s)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="tg-legenda-88oy" style="width: 50px">(dd:mm:aaaa)</td>
                                            <td class="tg-legenda-88oy" style="width: 50px">(h:m:s)</td>
                                            <td class="tg-legenda-88oy" style="width: 40px" colspan="2">(cm)</td>
                                            <td class="tg-legenda-88oy" style="width: 40px" colspan="2">cm³</td>
                                            <td class="tg-legenda-88oy" style="width: 40px" colspan="2">cm³</td>
                                            <td class="tg-legenda-88oy" style="width: 60px">(s)</td>
                                            <td class="tg-legenda-88oy" style="width: 60px">------</td>
                                            <td class="tg-legenda-88oy" style="width: 60px">(cm/s)</td>
                                            <td class="tg-legenda-88oy" style="width: 60px">(cm/s)</td>
                                        </tr>
                                    </tbody>
                                </table> <br>
                                <table class="tg-lista-de-tabelas" style="width: 100%">
                                    <colgroup>
                                        <col style="width: 70.2px">
                                        <col style="width: 58.2px">
                                        <col style="width: 41.2px">
                                        <col style="width: 34.2px">
                                        <col style="width: 25.2px">
                                        <col style="width: 43.2px">
                                        <col style="width: 49.2px">
                                        <col style="width: 67.2px">
                                        <col style="width: 61.2px">
                                    </colgroup>
                                    <tbody>
                                        <tr>
                                            <td class="tg-lista-de-tabelas-w2dt" style="width: 75px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['DataT1'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" style="width: 95px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['Hora_T1'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" style="width: 80px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['H1'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" style="width: 79px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['V1'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" style="width: 79px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['Vv1'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" rowspan="2" style="width: 76px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['DeltaT1'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" rowspan="2" style="width: 76px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['InH1'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" rowspan="2" style="width: 76px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['AH1'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" rowspan="2" style="width: 76px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['K1'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-lista-de-tabelas-w2dt">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['DataT2'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['Hora_T2'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['H2'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['V2'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['Vv2'] . '</td>
                                        </tr>
                                    </tbody>
                                </table>  <br>
                                <table class="tg-lista-de-tabelas" style="width: 100%">
                                    <colgroup>
                                        <col style="width: 70.2px">
                                        <col style="width: 58.2px">
                                        <col style="width: 41.2px">
                                        <col style="width: 34.2px">
                                        <col style="width: 25.2px">
                                        <col style="width: 43.2px">
                                        <col style="width: 49.2px">
                                        <col style="width: 67.2px">
                                        <col style="width: 61.2px">
                                    </colgroup>
                                    <tbody>
                                        <tr>
                                            <td class="tg-lista-de-tabelas-w2dt" style="width: 75px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['DataT3'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" style="width: 95px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['Hora_T3'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" style="width: 80px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['H3'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" style="width: 79px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['V3'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" style="width: 79px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['Vv3'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" rowspan="2" style="width: 76px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['DeltaT2'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" rowspan="2" style="width: 76px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['InH2'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" rowspan="2" style="width: 76px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['AH2'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" rowspan="2" style="width: 76px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['K2'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-lista-de-tabelas-w2dt">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['DataT4'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['Hora_T4'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['H4'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['V4'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['Vv4'] . '</td>
                                        </tr>
                                    </tbody>
                                </table> <br>
                                <table class="tg-lista-de-tabelas" style="width: 100%">
                                    <colgroup>
                                        <col style="width: 70.2px">
                                        <col style="width: 58.2px">
                                        <col style="width: 41.2px">
                                        <col style="width: 34.2px">
                                        <col style="width: 25.2px">
                                        <col style="width: 43.2px">
                                        <col style="width: 49.2px">
                                        <col style="width: 67.2px">
                                        <col style="width: 61.2px">
                                    </colgroup>
                                    <tbody>
                                        <tr>
                                            <td class="tg-lista-de-tabelas-w2dt" style="width: 75px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['DataT5'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" style="width: 95px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['Hora_T5'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" style="width: 80px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['H5'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" style="width: 79px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['V5'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" style="width: 79px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['Vv5'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" rowspan="2" style="width: 76px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['DeltaT3'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" rowspan="2" style="width: 76px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['InH3'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" rowspan="2" style="width: 76px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['AH3'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" rowspan="2" style="width: 76px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['K3'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-lista-de-tabelas-w2dt">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['DataT6'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['Hora_T6'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['H6'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['V6'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['Vv6'] . '</td>
                                        </tr>
                                    </tbody>
                                </table> <br>
                                <table class="tg-lista-de-tabelas" style="width: 100%">
                                    <colgroup>
                                        <col style="width: 70.2px">
                                        <col style="width: 58.2px">
                                        <col style="width: 41.2px">
                                        <col style="width: 34.2px">
                                        <col style="width: 25.2px">
                                        <col style="width: 43.2px">
                                        <col style="width: 49.2px">
                                        <col style="width: 67.2px">
                                        <col style="width: 61.2px">
                                    </colgroup>
                                    <tbody>
                                        <tr>
                                            <td class="tg-lista-de-tabelas-w2dt" style="width: 75px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['DataT7'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" style="width: 95px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['Hora_T7'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" style="width: 80px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['H7'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" style="width: 79px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['V7'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" style="width: 79px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['Vv7'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" rowspan="2" style="width: 76px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['DeltaT4'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" rowspan="2" style="width: 76px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['InH4'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" rowspan="2" style="width: 76px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['AH4'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" rowspan="2" style="width: 76px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['K4'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-lista-de-tabelas-w2dt">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['DataT8'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['Hora_T8'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['H8'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['V8'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['Vv8'] . '</td>
                                        </tr>
                                    </tbody>
                                </table> <br>
                                <table class="tg-lista-de-tabelas" style="width: 100%">
                                    <colgroup>
                                        <col style="width: 70.2px">
                                        <col style="width: 58.2px">
                                        <col style="width: 41.2px">
                                        <col style="width: 34.2px">
                                        <col style="width: 25.2px">
                                        <col style="width: 43.2px">
                                        <col style="width: 49.2px">
                                        <col style="width: 67.2px">
                                        <col style="width: 61.2px">
                                    </colgroup>
                                    <tbody>
                                        <tr>
                                            <td class="tg-lista-de-tabelas-w2dt" style="width: 75px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['DataT9'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" style="width: 95px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['Hora_T9'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" style="width: 80px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['H9'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" style="width: 79px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['V9'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" style="width: 79px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['Vv9'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" rowspan="2" style="width: 76px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['DeltaT5'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" rowspan="2" style="width: 76px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['InH5'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" rowspan="2" style="width: 76px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['AH5'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" rowspan="2" style="width: 76px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['K5'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-lista-de-tabelas-w2dt">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['DataT10'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['Hora_T10'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['H10'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['V10'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['Vv10'] . '</td>
                                        </tr>
                                    </tbody>
                                </table> <br>
                                <table class="tg-lista-de-tabelas" style="width: 100%">
                                    <colgroup>
                                        <col style="width: 70.2px">
                                        <col style="width: 58.2px">
                                        <col style="width: 41.2px">
                                        <col style="width: 34.2px">
                                        <col style="width: 25.2px">
                                        <col style="width: 43.2px">
                                        <col style="width: 49.2px">
                                        <col style="width: 67.2px">
                                        <col style="width: 61.2px">
                                    </colgroup>
                                    <tbody>
                                        <tr>
                                            <td class="tg-lista-de-tabelas-w2dt" style="width: 75px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['DataT11'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" style="width: 95px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['Hora_T11'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" style="width: 80px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['H11'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" style="width: 79px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['V11'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" style="width: 79px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['Vv11'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" rowspan="2" style="width: 76px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['DeltaT6'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" rowspan="2" style="width: 76px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['InH6'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" rowspan="2" style="width: 76px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['AH6'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" rowspan="2" style="width: 76px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['K6'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-lista-de-tabelas-w2dt">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['DataT12'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['Hora_T12'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['H12'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['V12'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['Vv12'] . '</td>
                                        </tr>
                                    </tbody>
                                </table> <br>
                                <table class="tg-lista-de-tabelas" style="width: 100%">
                                    <colgroup>
                                        <col style="width: 70.2px">
                                        <col style="width: 58.2px">
                                        <col style="width: 41.2px">
                                        <col style="width: 34.2px">
                                        <col style="width: 25.2px">
                                        <col style="width: 43.2px">
                                        <col style="width: 49.2px">
                                        <col style="width: 67.2px">
                                        <col style="width: 61.2px">
                                    </colgroup>
                                    <tbody>
                                        <tr>
                                            <td class="tg-lista-de-tabelas-w2dt" style="width: 75px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['DataT13'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" style="width: 95px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['Hora_T13'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" style="width: 80px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['H13'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" style="width: 79px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['V13'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" style="width: 79px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['Vv13'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" rowspan="2" style="width: 76px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['DeltaT7'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" rowspan="2" style="width: 76px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['InH7'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" rowspan="2" style="width: 76px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['AH7'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt" rowspan="2" style="width: 76px">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['K7'] . '</td>
                                        </tr>
                                        <tr>
                                            <td class="tg-lista-de-tabelas-w2dt">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['DataT14'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['Hora_T14'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['H14'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['V14'] . '</td>
                                            <td class="tg-lista-de-tabelas-w2dt">' . $dataDeterminacaoDoCoeficienteDePermeabilidade['Vv14'] . '</td>
                                        </tr>
                                    </tbody>
                                </table> <br>
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
                                                <td class="tg-coeficiente-3qkg"><b>' . $dataDeterminacaoDoCoeficienteDePermeabilidade['CoeficientePerme'] . '</b></td>
                                                <td class="tg-coeficiente-f4iu">cm/s</td>
                                            </tr>
                                            <tr>
                                                <td class="tg-coeficiente-73a0" style="text-align: center;">Coeficiente de permeabilidade para 20°C</td>
                                                <td class="tg-coeficiente-f4iu">K20</td>
                                                <td class="tg-coeficiente-3qkg"><b>' . $dataDeterminacaoDoCoeficienteDePermeabilidade['CoeficientePerme20C'] . '</b></td>
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
              <div style="height: 35px;"> ' . $dataDeterminacaoDoCoeficienteDePermeabilidade['Observacao'] . ' <div>
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
