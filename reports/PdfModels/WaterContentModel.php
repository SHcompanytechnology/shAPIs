<?php
require_once 'mainSheet.php';

class WaterContentModel
{
    private $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function generateModel($dataRehearsal, $dataHeaderAndFooter, $codSample, $numberSample, $observation, $pagina, $totalPaginas, $logo, $dataFormatada)
    {
        $conexao = new ConfigureteConnection();
        $conexao->connect();

        $pdo = $conexao->getConnection();

        if ($pdo === null) {
            return null;
        }

        $executador = $dataRehearsal['Executado'];
        $aprovador = $dataRehearsal['Aprovado'];
        $verificador = $dataRehearsal['Verificado'];

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
        // return var_dump($assinaturaAprovador);

        $html = '<html>
      <head></head>
      <body>
            <header>
                
              <style type="text/css">
                  .tg-tabela-de-capsula {
                      border-collapse: collapse;
                      border-spacing: 0;
                      margin: 0px auto;
                  }
  
                  .tg-tabela-de-capsula td {
                      border-color: black;
                      border-style: solid;
                      border-width: 1px;
                      font-family: Arial, sans-serif;
                      font-size: 14px;
                      overflow: hidden;
                      padding: 10px 5px;
                      word-break: normal;
                  }
  
                  .tg-tabela-de-capsula th {
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
  
                  .tg-tabela-de-capsula .tg-tabela-de-capsula-0r18 {
                      border-color: inherit;
                      font-size: 14px;
                      text-align: center;
                      vertical-align: middle;
                      padding-top: 15px;
                      padding-bottom: 15px;
                  }
  
                  .tg-tabela-de-capsula .tg-tabela-de-capsula-zd5i {
                      border-color: inherit;
                      font-size: 14px;
                      text-align: left;
                      vertical-align: middle;
                  }
              </style>
          </header>
          <main style="margin-top: 45px">
              <table class="tg-cabecalho" style="width: 100%;margin-bottom: 13px;">
                  <thead>
                      <tr>
                          <th class="tg-cabecalho-0pky col-1" colspan="2" rowspan="2"> CLIENTE: <br>
                              <img style="margin-left: 30%" src="data:image/jpeg;base64,' . base64_encode($logo) . '"  width="80px"">
                          </th>
                          <th class="tg-cabecalho-0pky col-3" colspan="2">RELATÓRIO ENSAIO: <div style="margin-left: 21%; font-size: 15px; margin-top: -6px">
                                  DETERMINAÇÃO DO TEOR DE UMIDADE DO SOLO </div>
                          </th>
                      </tr>
                      <tr>
                          <th class="tg-cabecalho-0pky" colspan="1" style="padding: 0px !important">
                              <table class="tg-cabecalho" style="width: 100%">
                                  <thead>
                                      <tr>
                                          <td class="tg-cabecalho-0pky" style="width: 160px !important;padding-bottom: 0px; border-top-color:#fff; border-bottom-color:#fff;white-space: nowrap; border-left-color:#fff"> 
                                                NORMA:
                                              <div style="font-size: 102x; margin-left: 10px; margin-top: 6px; margin-bottom: 5px" class="cabecalho-resultado-font">' . $dataRehearsal['NormaEnsaio'] . '</div>
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
                                  <span class="cabecalho-resultado-font">' . $dataRehearsal['DataInicio'] . '</span>
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
                                  <span class="cabecalho-resultado-font">' . $dataRehearsal['DataFinal'] . '</span>
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
                                  <b>Idea <span class="cabecalho-resultado-font">' . $dataHeaderAndFooter['Localizacao'] . '
                              </div>
                          </td>
                      </tr>
                  </tbody>
              </table>
              <table class="tg">
                  <tr>
                      <td class="tg-0pky" colspan="15" style="border-left: none !important; border-right: none !important; border-top-color: #fff; padding-left: 0px !important; padding-right: 0px !important; height: 675px;">
                          <table class="tg-tabela-de-capsula" style="width: 100%; margin-top: 90px">
                              <colgroup>
                                  <col style="width: 252.2px">
                                  <col style="width: 42.2px">
                                  <col style="width: 54.2px">
                                  <col style="width: 54.2px">
                                  <col style="width: 54.2px">
                                  <col style="width: 54.2px">
                              </colgroup>
                              <tr>
                                  <td class="tg-tabela-de-capsula-0r18" style="text-align: left">Cápsula</td>
                                  <td class="tg-tabela-de-capsula-0r18">Nº</td>
                                  <td class="tg-tabela-de-capsula-0r18" style="width: 50px">' . $dataRehearsal['Capsula1'] . '</td>
                                  <td class="tg-tabela-de-capsula-0r18" style="width: 50px">' . $dataRehearsal['Capsula2'] . '</td>
                                  <td class="tg-tabela-de-capsula-0r18" style="width: 50px">' . $dataRehearsal['Capsula3'] . '</td>
                                  <td class="tg-tabela-de-capsula-0r18" style="width: 50px">' . $dataRehearsal['Capsula4'] . '</td>
                              </tr>
                              <tbody>
                                  <tr>
                                      <td class="tg-tabela-de-capsula-0r18" style="text-align: left" >Massa de amostra úmida + cápsula</td>
                                      <td class="tg-tabela-de-capsula-0r18">g</td>
                                      <td class="tg-tabela-de-capsula-0r18">' . $dataRehearsal['MassaUmida1'] . '</td>
                                      <td class="tg-tabela-de-capsula-0r18">' . $dataRehearsal['MassaUmida2'] . '</td>
                                      <td class="tg-tabela-de-capsula-0r18">' . $dataRehearsal['MassaUmida3'] . '</td>
                                      <td class="tg-tabela-de-capsula-0r18">' . $dataRehearsal['MassaUmida4'] . '</td>
                                  </tr>
                                  <tr>
                                      <td class="tg-tabela-de-capsula-0r18" style="text-align: left">Massa da amostra seca + cápsula</td>
                                      <td class="tg-tabela-de-capsula-0r18">g</td>
                                      <td class="tg-tabela-de-capsula-0r18">' . $dataRehearsal['MassaSeca1'] . '</td>
                                      <td class="tg-tabela-de-capsula-0r18">' . $dataRehearsal['MassaSeca2'] . '</td>
                                      <td class="tg-tabela-de-capsula-0r18">' . $dataRehearsal['MassaSeca3'] . '</td>
                                      <td class="tg-tabela-de-capsula-0r18">' . $dataRehearsal['MassaSeca4'] . '</td>
                                  </tr>
                                  <tr>
                                      <td class="tg-tabela-de-capsula-0r18" style="text-align: left">Massa da cápsula</td>
                                      <td class="tg-tabela-de-capsula-0r18">g</td>
                                      <td class="tg-tabela-de-capsula-0r18">' . $dataRehearsal['MassaCapsula1'] . '</td>
                                      <td class="tg-tabela-de-capsula-0r18">' . $dataRehearsal['MassaCapsula2'] . '</td>
                                      <td class="tg-tabela-de-capsula-0r18">' . $dataRehearsal['MassaCapsula3'] . '</td>
                                      <td class="tg-tabela-de-capsula-0r18">' . $dataRehearsal['MassaCapsula4'] . '</td>
                                  </tr>
                                  <tr>
                                      <td class="tg-tabela-de-capsula-0r18" style="text-align: left">Massa da água</td>
                                      <td class="tg-tabela-de-capsula-0r18">g</td>
                                      <td class="tg-tabela-de-capsula-0r18">' . $dataRehearsal['MassaAgua1'] . '</td>
                                      <td class="tg-tabela-de-capsula-0r18">' . $dataRehearsal['MassaAgua2'] . '</td>
                                      <td class="tg-tabela-de-capsula-0r18">' . $dataRehearsal['MassaAgua3'] . '</td>
                                      <td class="tg-tabela-de-capsula-0r18">' . $dataRehearsal['MassaAgua4'] . '</td>
                                  </tr>
                                  <tr>
                                      <td class="tg-tabela-de-capsula-0r18" style="text-align: left">Massa do selo seco</td>
                                      <td class="tg-tabela-de-capsula-0r18">g</td>
                                      <td class="tg-tabela-de-capsula-0r18">' . $dataRehearsal['MassaSoloSeco1'] . '</td>
                                      <td class="tg-tabela-de-capsula-0r18">' . $dataRehearsal['MassaSoloSeco2'] . '</td>
                                      <td class="tg-tabela-de-capsula-0r18">' . $dataRehearsal['MassaSoloSeco3'] . '</td>
                                      <td class="tg-tabela-de-capsula-0r18">' . $dataRehearsal['MassaSoloSeco4'] . '</td>
                                  </tr>
                                  <tr>
                                      <td class="tg-tabela-de-capsula-0r18" style="text-align: left">Teor da água</td>
                                      <td class="tg-tabela-de-capsula-0r18">%</td>
                                      <td class="tg-tabela-de-capsula-0r18">' . $dataRehearsal['TeorAgua1'] . '</td>
                                      <td class="tg-tabela-de-capsula-0r18">' . $dataRehearsal['TeorAgua2'] . '</td>
                                      <td class="tg-tabela-de-capsula-0r18">' . $dataRehearsal['TeorAgua3'] . '</td>
                                      <td class="tg-tabela-de-capsula-0r18">' . $dataRehearsal['TeorAgua4'] . '</td>
                                  </tr>
                                  <tr>
                                      <td class="tg-tabela-de-capsula-0r18" style="text-align: left">Teor de água médio</td>
                                      <td class="tg-tabela-de-capsula-0r18">%</td>
                                      <td class="tg-tabela-de-capsula-0r18" style="background-color: #c8c8c8; font-weight: bold" colspan="4">' . $dataRehearsal['Media'] . '</td>
                                  </tr>
                              </tbody>
                          </table>
                          <div style="margin-top: 10%; padding-left: 30%; height: 50px;">
                          <div style="display: inline-block; margin-bottom: 18px; padding-right: 2px">
                            <p style="font-size: 13px">Temperatura de secagem:</p>
                          </div>
                          <div style="display: inline-block;font-size: 13px; margin-top: 20px; border-left: 2px solid #000; padding-left: 8px; padding-top: 2px">
                            <input
                                type="checkbox"
                                id="checkbox1"
                                name="checkboxes"
                                value="checkbox1"
                                ' . ($dataRehearsal['Temp_CheckBox1'] === "True" ? 'checked="checked"' : '') . '
                            />
                            <label
                                for="checkbox1"
                                style="font-size: 10px; vertical-align: middle"
                                >Intervalo 105º/110º</label
                            >
                            <br>
                            <input
                                type="checkbox"
                                id="checkbox1"
                                name="checkboxes"
                                value="checkbox1"
                                ' . ($dataRehearsal['Temp_CheckBox2'] === "True" ? 'checked="checked"' : '') . '
                            />
                            <label
                                for="checkbox1"
                                style="font-size: 10px; vertical-align: middle"
                                >Intervalo 60º/65º</label
                            >
                          </div>
                          </div>
                      </td>
                  </tr>
                  <tr>
               <td class="tg-0pky" colspan="15">
                  <p class="title">Observação:</p>
                  <div style="height: 35px;">' . $observation . ' <div>
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
                  <p style="font-size: 10px; font-weight: bold; margin: 0; font-family: Arial, sans-serif; !important">Este relatório de ensaio só pode ser copiado integralmente ou parcialmente com autorização da Geocontrole</p>
                  <p style="font-size: 10px; font-weight: bold; margin: 0; font-family: Arial, sans-serif; !important">Av.Canadá,Nº 159 - Jardim Canadá Nova Lima - Minas Gerais - Brasil - CEP: 34007-654 Tel.: +55 31 3517-9011</p>
                  <div style="width: 100%; background-color: green; color: #fff; font-family: Arial, sans-serif; !important">www.geocontrole.com - e-mail: mail.br@geocontrole.com </div>
              </div>
          </footer>
      </body>
  </html>';
        return $html;
    }
}
