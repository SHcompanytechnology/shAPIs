<?php
require_once 'mainSheet.php';

class CompressionModel
{
  private $data;
  public function __construct($data)
  {
    $this->data = $data;
  }

  public function generateModel($dataHeaderAndFooter, $dataEnsaioCompactacao, $codSample, $numberSample, $observation, $pagina, $totalPaginas, $logo, $dataFormatada)
  {
    try {
      $conexao = new ConfigureteConnection();
      $conexao->connect();

      $pdo = $conexao->getConnection();

      if ($pdo === null) {
        return null;
      }

      $executador = $dataEnsaioCompactacao['Executado'];
      $aprovador = $dataEnsaioCompactacao['Aprovado'];
      $verificador = $dataEnsaioCompactacao['Verificado'];

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
              }
              .tg-compression .tg-compression-7wru {
                border-color: inherit;
                text-align: center;
                font-size: xx-small;
                font-weight: normal !important;
                text-align: left;
                vertical-align: middle !important;
              }
              .tg-compression .tg-compression-p1nr {
                border-color: inherit;
                text-align: center;
                font-size: 11px;
                text-align: left;
                vertical-align: middle !important;
              }
              .tg-compression .tg-compression-78ff {
                border-color: inherit;
                font-size: xx-small;
                text-align: center;
                vertical-align: middle !important;
                white-space: nowrap;
              }
              .tg-compression .tg-compression-fmch {
                background-color: #c0c0c0;
                border-color: inherit;
                font-size: 11px;
                text-align: center;
                vertical-align: middle !important;
              }
              .tg-compression .tg-compression-gzo9 {
                border-color: inherit;
                font-size: 11px;
                text-align: center;
                vertical-align: middle !important;
              }
              .tg-compression .tg-compression-25da {
                border-color: inherit;
                font-size: x-small;
                text-align: center;
                vertical-align: middle !important;
              }
              .tg-compression .tg-compression-6rs4 {
                border-color: inherit;
                font-size: xx-small;
                font-weight: normal !important;
                text-align: center;
                vertical-align: middle !important;
              }
              .tg-compression .tg-compression-4nn5 {
                background-color: #c0c0c0;
                border-color: inherit;
                font-size: xx-small;
                font-weight: bold !important;
                text-align: center;
                vertical-align: middle !important;
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
                                  SOLO-ENSAIO DE COMPACTAÇÃO<div>
                          </th>
                      </tr>
                      <tr>
                          <th class="tg-cabecalho-0pky" colspan="1" style="padding: 0px !important">
                              <table class="tg-cabecalho" style="width: 100%">
                                  <thead>
                                      <tr>
                                        <td class="tg-cabecalho-0pky" style="width: 160px !important;padding-bottom: 0px; border-top-color:#fff; border-bottom-color:#fff;white-space: nowrap; border-left-color:#fff"> 
                                              NORMA:
                                            <div style="font-size: 102x; margin-left: 10px; margin-top: 6px; margin-bottom: 5px" class="cabecalho-resultado-font">' . $dataEnsaioCompactacao['NormaEnsaio'] . '</div>
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
                                  <span class="cabecalho-resultado-font">' . $dataEnsaioCompactacao['DataInicio'] . '</span>
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
                                  <span class="cabecalho-resultado-font">' . $dataEnsaioCompactacao['DataFinal'] . '</span>
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
                    <p
                      style="
                        display: inline-block;
                        font-size: 10px;
                        margin-bottom: 15px;
                      "
                    >
                      Compactação (Proctor):
                    </p>
                    <div class="checkbox">
                      <input
                        type="checkbox"
                        id="checkbox1"
                        name="checkboxes"
                        value="checkbox1" ' . ($dataEnsaioCompactacao['EnergiaCompactacao'] === "Normal" ? 'checked="checked"' : '') . '
                      />
                      <label
                        for="checkbox1"
                        style="font-size: 10px; vertical-align: middle"
                        >Normal</label
                      >
                    </div>
                    <div class="checkbox" style="margin-left: 18px">
                      <input
                        type="checkbox"
                        id="checkbox2"
                        name="checkboxes"
                        value="checkbox2" ' . ($dataEnsaioCompactacao['EnergiaCompactacao'] === "Intenormal" ? 'checked="checked"' : '') . '
                      />
                      <label
                        for="checkbox2"
                        style="font-size: 10px; vertical-align: middle"
                        >Intenormal</label
                      >
                    </div>
                    <div class="checkbox" style="margin-left: 18px">
                      <input
                        type="checkbox"
                        id="checkbox3"
                        name="checkboxes"
                        value="checkbox3" ' . ($dataEnsaioCompactacao['EnergiaCompactacao'] === "Intermediaria" ? 'checked="checked"' : '') . '
                      />
                      <label
                        for="checkbox3"
                        style="font-size: 10px; vertical-align: middle"
                        >Intermediária</label
                      >
                    </div>
                    <div class="checkbox" style="margin-left: 18px">
                      <input
                        type="checkbox"
                        id="checkbox3"
                        name="checkboxes"
                        value="checkbox3" ' . ($dataEnsaioCompactacao['EnergiaCompactacao'] === "Intermodificada" ? 'checked="checked"' : '') . '
                      />
                      <label
                        for="checkbox4"
                        style="font-size: 10px; vertical-align: middle"
                        >Intermodificada</label
                      >
                    </div>
                    <div class="checkbox" style="margin-left: 19px">
                      <input
                        type="checkbox"
                        id="checkbox4"
                        name="checkboxes"
                        value="checkbox3" ' . ($dataEnsaioCompactacao['EnergiaCompactacao'] === "Modificada" ? 'checked="checked"' : '') . '
                      />
                      <label
                        for="checkbox4"
                        style="font-size: 10px; vertical-align: middle"
                        >Modificada</label
                      >
                    </div>
                    <div class="checkbox" style="margin-left: 19px">
                      <input
                        type="checkbox"
                        id="checkbox4"
                        name="checkboxes"
                        value="checkbox3" ' . ($dataEnsaioCompactacao['EnergiaCompactacao'] === "Outro" ? 'checked="checked"' : '') . '
                      />
                      <label
                        for="checkbox4"
                        style="font-size: 10px; vertical-align: middle"
                        >Outro</label
                      >
                    </div>
                    <br /><br />
                    <div class="tg-compression-wrap">
                      <table
                        class="tg-compression"
                        style="undefined;table-layout: fixed; width: 758px"
                      >
                        <colgroup>
                          <col style="width: 34.2px" />
                          <col style="width: 21.2px" />
                          <col style="width: 21.2px" />
                          <col style="width: 21.2px" />
                          <col style="width: 39.2px" />
                          <col style="width: 39.2px" />
                          <col style="width: 37.2px" />
                          <col style="width: 39.2px" />
                          <col style="width: 39.2px" />
                          <col style="width: 39.2px" />
                          <col style="width: 39.2px" />
                          <col style="width: 39.2px" />
                          <col style="width: 39.2px" />
                          <col style="width: 39.2px" />
                          <col style="width: 39.2px" />
                          <col style="width: 39.2px" />
                          <col style="width: 39.2px" />
                          <col style="width: 39.2px" />
                          <col style="width: 39.2px" />
                          <col style="width: 25.2px" />
                          <col style="width: 25.2px" />
                          <col style="width: 25.2px" />
                        </colgroup>
                        <thead>
                          <tr>
                            <th class="tg-compression-7wru" colspan="2">Moldagem</th>
                            <th class="tg-compression-7wru" colspan="2">Corpo de prova</th>
                            <th class="tg-compression-25da" colspan="3"><b>P1</b></th>
                            <th class="tg-compression-25da" colspan="3"><b>P2</b></th>
                            <th class="tg-compression-25da" colspan="3"><b>P3</b></th>
                            <th class="tg-compression-25da" colspan="3"><b>P4</b></th>
                            <th class="tg-compression-25da" colspan="3"><b>P5</b></th>
                            <th class="tg-compression-25da" colspan="3"><b>P6</b></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="tg-compression-7wru" colspan="3">Molde de compactação</td>
                            <td class="tg-compression-6rs4">nº</td>
                            <td class="tg-compression-gzo9" colspan="3">' . $dataEnsaioCompactacao['MoldeP1'] . '</td>
                            <td class="tg-compression-gzo9" colspan="3">' . $dataEnsaioCompactacao['MoldeP2'] . '</td>
                            <td class="tg-compression-gzo9" colspan="3">' . $dataEnsaioCompactacao['MoldeP3'] . '</td>
                            <td class="tg-compression-gzo9" colspan="3">' . $dataEnsaioCompactacao['MoldeP4'] . '</td>
                            <td class="tg-compression-gzo9" colspan="3">' . $dataEnsaioCompactacao['MoldeP5'] . '</td>
                            <td class="tg-compression-gzo9" colspan="3">' . $dataEnsaioCompactacao['MoldeP6'] . '</td>
                          </tr>
                          <tr>
                            <td class="tg-compression-7wru" colspan="3">
                              Massa do solo úmido + massa do molde
                            </td>
                            <td class="tg-compression-6rs4">g</td>
                            <td class="tg-compression-gzo9" colspan="3">' . $dataEnsaioCompactacao['MassaSoloUmiMassaMolP1'] . '</td>
                            <td class="tg-compression-gzo9" colspan="3">' . $dataEnsaioCompactacao['MassaSoloUmiMassaMolP2'] . '</td>
                            <td class="tg-compression-gzo9" colspan="3">' . $dataEnsaioCompactacao['MassaSoloUmiMassaMolP3'] . '</td>
                            <td class="tg-compression-gzo9" colspan="3">' . $dataEnsaioCompactacao['MassaSoloUmiMassaMolP4'] . '</td>
                            <td class="tg-compression-gzo9" colspan="3">' . $dataEnsaioCompactacao['MassaSoloUmiMassaMolP5'] . '</td>
                            <td class="tg-compression-gzo9" colspan="3">' . $dataEnsaioCompactacao['MassaSoloUmiMassaMolP6'] . '</td>
                          </tr>
                          <tr>
                            <td class="tg-compression-7wru" colspan="2">Massa do solo úmido</td>
                            <td class="tg-compression-6rs4">Mh</td>
                            <td class="tg-compression-6rs4">g</td>
                            <td class="tg-compression-gzo9" colspan="3">' . $dataEnsaioCompactacao['MassaSoloUmidaP1'] . '</td>
                            <td class="tg-compression-gzo9" colspan="3">' . $dataEnsaioCompactacao['MassaSoloUmidaP2'] . '</td>
                            <td class="tg-compression-gzo9" colspan="3">' . $dataEnsaioCompactacao['MassaSoloUmidaP3'] . '</td>
                            <td class="tg-compression-gzo9" colspan="3">' . $dataEnsaioCompactacao['MassaSoloUmidaP4'] . '</td>
                            <td class="tg-compression-gzo9" colspan="3">' . $dataEnsaioCompactacao['MassaSoloUmidaP5'] . '</td>
                            <td class="tg-compression-gzo9" colspan="3">' . $dataEnsaioCompactacao['MassaSoloUmidaP6'] . '</td>
                          </tr>
                          <tr>
                            <td class="tg-compression-7wru" colspan="2">Volume do molde</td>
                            <td class="tg-compression-6rs4">V</td>
                            <td class="tg-compression-6rs4">g</td>
                            <td class="tg-compression-gzo9" colspan="3">' . $dataEnsaioCompactacao['VolumeMolde1'] . '</td>
                            <td class="tg-compression-gzo9" colspan="3">' . $dataEnsaioCompactacao['VolumeMolde2'] . '</td>
                            <td class="tg-compression-gzo9" colspan="3">' . $dataEnsaioCompactacao['VolumeMolde3'] . '</td>
                            <td class="tg-compression-gzo9" colspan="3">' . $dataEnsaioCompactacao['VolumeMolde4'] . '</td>
                            <td class="tg-compression-gzo9" colspan="3">' . $dataEnsaioCompactacao['VolumeMolde5'] . '</td>
                            <td class="tg-compression-gzo9" colspan="3">' . $dataEnsaioCompactacao['VolumeMolde6'] . '</td>
                          </tr>
                          <tr>
                            <td class="tg-compression-7wru" colspan="2">Massa especifica úmida</td>
                            <td class="tg-compression-6rs4"><p style="font-family: DejaVu Sans !important">&#929;u</p></td>
                            <td class="tg-compression-6rs4">g</td>
                            <td class="tg-compression-gzo9" colspan="3">' . $dataEnsaioCompactacao['MassaAgua1'] . '</td>
                            <td class="tg-compression-gzo9" colspan="3">' . $dataEnsaioCompactacao['MassaAgua2'] . '</td>
                            <td class="tg-compression-gzo9" colspan="3">' . $dataEnsaioCompactacao['MassaAgua3'] . '</td>
                            <td class="tg-compression-gzo9" colspan="3">' . $dataEnsaioCompactacao['MassaAgua4'] . '</td>
                            <td class="tg-compression-gzo9" colspan="3">' . $dataEnsaioCompactacao['MassaAgua5'] . '</td>
                            <td class="tg-compression-gzo9" colspan="3">' . $dataEnsaioCompactacao['MassaAgua6'] . '</td>
                          </tr>
                          <tr>
                            <td class="tg-compression-7wru" colspan="3">Cápsula</td>
                            <td class="tg-compression-6rs4">g</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['CapsulaP11'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['CapsulaP12'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['CapsulaP13'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['CapsulaP21'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['CapsulaP22'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['CapsulaP23'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['CapsulaP31'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['CapsulaP32'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['CapsulaP33'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['CapsulaP41'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['CapsulaP42'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['CapsulaP43'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['CapsulaP51'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['CapsulaP52'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['CapsulaP53'] . '</td>
                            <td class="tg-compression-gzo9">' . $dataEnsaioCompactacao['CapsulaP61'] . '</td>
                            <td class="tg-compression-p1nr">' . $dataEnsaioCompactacao['CapsulaP62'] . '</td>
                            <td class="tg-compression-p1nr">' . $dataEnsaioCompactacao['CapsulaP63'] . '</td>
                          </tr>
                          <tr>
                            <td class="tg-compression-7wru" colspan="3">
                              Amostra úmida + cápsula
                            </td>
                            <td class="tg-compression-6rs4">g</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['UmidaCapsulaP11'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['UmidaCapsulaP12'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['UmidaCapsulaP13'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['UmidaCapsulaP21'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['UmidaCapsulaP22'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['UmidaCapsulaP23'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['UmidaCapsulaP31'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['UmidaCapsulaP32'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['UmidaCapsulaP33'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['UmidaCapsulaP41'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['UmidaCapsulaP42'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['UmidaCapsulaP43'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['UmidaCapsulaP51'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['UmidaCapsulaP52'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['UmidaCapsulaP53'] . '</td>
                            <td class="tg-compression-gzo9">' . $dataEnsaioCompactacao['UmidaCapsulaP61'] . '</td>
                            <td class="tg-compression-p1nr">' . $dataEnsaioCompactacao['UmidaCapsulaP62'] . '</td>
                            <td class="tg-compression-p1nr">' . $dataEnsaioCompactacao['UmidaCapsulaP63'] . '</td>
                          </tr>
                          <tr>
                            <td class="tg-compression-7wru" colspan="3">
                              Amostra seca + cápsula
                            </td>
                            <td class="tg-compression-6rs4">g</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['SecaCapsulaP11'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['SecaCapsulaP12'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['SecaCapsulaP13'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['SecaCapsulaP21'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['SecaCapsulaP22'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['SecaCapsulaP23'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['SecaCapsulaP31'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['SecaCapsulaP32'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['SecaCapsulaP33'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['SecaCapsulaP41'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['SecaCapsulaP42'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['SecaCapsulaP51'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['SecaCapsulaP52'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['SecaCapsulaP53'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['SecaCapsulaP61'] . '</td>
                            <td class="tg-compression-gzo9">' . $dataEnsaioCompactacao['SecaCapsulaP62'] . '</td>
                            <td class="tg-compression-p1nr">' . $dataEnsaioCompactacao['SecaCapsulaP63'] . '</td>
                            <td class="tg-compression-p1nr"></td>
                          </tr>
                          <tr>
                            <td class="tg-compression-7wru" colspan="3">Massa da cápsula</td>
                            <td class="tg-compression-6rs4">g</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['MassaCapsulaP11'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['MassaCapsulaP12'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['MassaCapsulaP13'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['MassaCapsulaP21'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['MassaCapsulaP22'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['MassaCapsulaP23'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['MassaCapsulaP31'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['MassaCapsulaP32'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['MassaCapsulaP33'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['MassaCapsulaP41'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['MassaCapsulaP42'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['MassaCapsulaP43'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['MassaCapsulaP51'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['MassaCapsulaP52'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['MassaCapsulaP53'] . '</td>
                            <td class="tg-compression-gzo9"></td>
                            <td class="tg-compression-p1nr"></td>
                            <td class="tg-compression-p1nr"></td>
                          </tr>
                          <tr>
                            <td class="tg-compression-7wru" colspan="3">Massa de água</td>
                            <td class="tg-compression-6rs4">g</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['MassaAguaP11'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['MassaAguaP12'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['MassaAguaP13'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['MassaAguaP21'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['MassaAguaP22'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['MassaAguaP23'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['MassaAguaP31'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['MassaAguaP32'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['MassaAguaP33'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['MassaAguaP41'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['MassaAguaP42'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['MassaAguaP43'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['MassaAguaP51'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['MassaAguaP52'] . '</td>
                            <td class="tg-compression-78ff"></td>
                            <td class="tg-compression-gzo9"></td>
                            <td class="tg-compression-p1nr"></td>
                            <td class="tg-compression-p1nr"></td>
                          </tr>
                          <tr>
                            <td class="tg-compression-7wru" colspan="3">Massa de solo seco</td>
                            <td class="tg-compression-6rs4">%</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['MassaSoloSecoP11'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['MassaSoloSecoP12'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['MassaSoloSecoP13'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['MassaSoloSecoP21'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['MassaSoloSecoP22'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['MassaSoloSecoP23'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['MassaSoloSecoP31'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['MassaSoloSecoP32'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['MassaSoloSecoP33'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['MassaSoloSecoP41'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['MassaSoloSecoP42'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['MassaSoloSecoP43'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['MassaSoloSecoP51'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['MassaSoloSecoP52'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['MassaSoloSecoP53'] . '</td>
                            <td class="tg-compression-gzo9"></td>
                            <td class="tg-compression-p1nr"></td>
                            <td class="tg-compression-p1nr"></td>
                          </tr>
                          <tr>
                            <td class="tg-compression-7wru" colspan="3">Teor de umidade</td>
                            <td class="tg-compression-6rs4">%</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['TeorUmidadeP11'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['TeorUmidadeP12'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['TeorUmidadeP13'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['TeorUmidadeP21'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['TeorUmidadeP22'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['TeorUmidadeP23'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['TeorUmidadeP31'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['TeorUmidadeP32'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['TeorUmidadeP33'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['TeorUmidadeP41'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['TeorUmidadeP42'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['TeorUmidadeP43'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['TeorUmidadeP51'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['TeorUmidadeP53'] . '</td>
                            <td class="tg-compression-78ff">' . $dataEnsaioCompactacao['TeorUmidadeP61'] . '</td>
                            <td class="tg-compression-gzo9">' . $dataEnsaioCompactacao['TeorUmidadeP62'] . '</td>
                            <td class="tg-compression-p1nr">' . $dataEnsaioCompactacao['TeorUmidadeP63'] . '</td>
                            <td class="tg-compression-p1nr"></td>
                          </tr>
                          <tr>
                            <td class="tg-compression-7wru" colspan="2">
                              Teor de umidade<br />médio
                            </td>
                            <td class="tg-compression-7wru" style="text-align: center">h</td>
                            <td class="tg-compression-6rs4">%</td>
                            <td class="tg-compression-4nn5" colspan="3">' . $dataEnsaioCompactacao['UmidadeMediaP1'] . '</td>
                            <td class="tg-compression-4nn5" colspan="3">' . $dataEnsaioCompactacao['UmidadeMediaP2'] . '</td>
                            <td class="tg-compression-4nn5" colspan="3">' . $dataEnsaioCompactacao['UmidadeMediaP3'] . '</td>
                            <td class="tg-compression-4nn5" colspan="3">' . $dataEnsaioCompactacao['UmidadeMediaP4'] . '</td>
                            <td class="tg-compression-4nn5" colspan="3">' . $dataEnsaioCompactacao['UmidadeMediaP5'] . '</td>
                            <td class="tg-compression-fmch" colspan="3"></td>
                          </tr>
                          <tr>
                            <td class="tg-compression-7wru" colspan="2">Massa especifica seca</td>
                            <td class="tg-compression-7wru" style="text-align: center"><p style="font-family: DejaVu Sans !important">&#929;d</p></td>
                            <td class="tg-compression-6rs4">g/cm</td>
                            <td class="tg-compression-4nn5" colspan="3">' . $dataEnsaioCompactacao['MassaEspSecaP1'] . '</td>
                            <td class="tg-compression-4nn5" colspan="3">' . $dataEnsaioCompactacao['MassaEspSecaP2'] . '</td>
                            <td class="tg-compression-4nn5" colspan="3">' . $dataEnsaioCompactacao['MassaEspSecaP3'] . '</td>
                            <td class="tg-compression-4nn5" colspan="3">' . $dataEnsaioCompactacao['MassaEspSecaP4'] . '</td>
                            <td class="tg-compression-4nn5" colspan="3">' . $dataEnsaioCompactacao['MassaEspSecaP5'] . '</td>
                            <td class="tg-compression-fmch" colspan="3">' . $dataEnsaioCompactacao['MassaEspSecaP6'] . '</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </td>
                </tr>
                <tr>
               <td class="tg-0pky" colspan="15">
                  <p class="title">Observação:</p>
                  <div style="height: 30px;">' . $observation . ' <div>
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
    } catch (\Throwable $th) {
      throw $th;
    }
  }
}
