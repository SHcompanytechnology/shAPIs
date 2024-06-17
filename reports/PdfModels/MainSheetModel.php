d<?php
   require_once 'mainSheet.php';

   class MainSheetModel
   {
      private $data;
      public function __construct($data)
      {
         $this->data = $data;
      }

      public function generateModel(
         $codSample,
         $numberSample,
         $responsibility,
         $classification1,
         $classification2,
         $descriptionSolo,
         $observation,
         $inundado,
         $dataRehearsal,
         $dataHeaderAndFooter,
         $dataEnsaioCompactacao,
         $pagina,
         $totalPaginas,
         $dataMassaEspecificaRealEmGraos,
         $dataLimitesAttemberg,
         $dataIndiceSuporteCalifornia,
         $dataAnaliseGranulometricaSedimentacao,
         $dataMassaEspecificaMaxEMinDeAreia,
         $logo,
         $dataDeterminacaoDaMassaEspecificaAparente,
         $mediaPesoEspUmido,
         $np,
         $calculoCc,
         $calculoCu,
         $dataCadastroAmostra,
         $massaEspSecaMax,
         $teorDeUmidade,
         $checkCargaVariavel,
         $checkCargaConstante,
         $checkCoeficienteConstanteEVariavel,
         $valorCoeficientePermeabilidade,
         $valorTensao,
         $checkTensaoConstanteEVariavel,
         $dataFormatada,
         $dataFolhaRosto
      ) {
         $dataANALISE_GRANULOMETRICA_SEDIMENTACAO = $dataAnaliseGranulometricaSedimentacao;

         $conexao = new ConfigureteConnection();
         $conexao->connect();

         $pdo = $conexao->getConnection();

         if ($pdo === null) {
            return null;
         }

         $query = "SELECT * FROM FolhaRosto WHERE Amostra = :codSample AND N_Ensaio = :numberSample";
         $stmt = $pdo->prepare($query);
         $stmt->bindParam(':codSample', $codSample, PDO::PARAM_INT);
         $stmt->bindParam(':numberSample', $numberSample, PDO::PARAM_INT);
         $stmt->execute();
         $response = $stmt->fetchAll(PDO::FETCH_ASSOC);
         $data = count($response) === 0 ? null : $response[0];

         $executador = $dataHeaderAndFooter['Execucao'];
         $aprovador = $dataHeaderAndFooter['Aprovacao'];
         $verificador = $dataHeaderAndFooter['Verificacao'];

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
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

       <style type="text/css">
          .tg {
          border-spacing: 0;
          width: 100%;
          border-collapse: collapse;
          }
          .tg td {
            border-color: black;
            border-style: solid;
            border-width: 1px;
          font-family: Arial, sans-serif;
          font-size: 8px;
          padding: 0px 0px;
          word-break: normal;
          }
          .tg th {
            border-color: black;
            border-style: solid;
            border-width: 1px;
          font-family: Arial, sans-serif;
          font-size: 10px;
          word-break: normal;
          padding-top: 0 !important;
          padding-right: 0 !important;
          padding-bottom: 0 !important;
          padding-left: 2px !important;
          }
          .tg .tg-0pky {
          padding: 5px;
          border-color: inherit;
          text-align: left;
          }
          .tg-0pky p {
          margin-top: 2px;
          vertical-align: top;
          }
          .tg .tg-0pky .title {
          font-size: 0.6rem;
          font-weight: bold;
          margin: 0 !important;
          }
          .tg .tg-0pky .response {
          font-size: 10px;
          margin-top: 0 !important;
          margin-bottom: 0 !important;
          }
          .checkbox {
          display: inline-block;
          margin-right: 5px;
          }
          .removeBorder {
          border: none !important;
          }
          @page {
          margin-left: 0.6cm;
          margin-right: 0.3cm;
          margin-top: 0.1cm;
          margin-bottom: 0.1cm;
          }
          header {
          position: fixed;
          top: 0cm;
          left: 0cm;
          right: 0cm;
          height: 3cm;
          }
         .cabecalho-resultado-font {
            font-weight: bold;
         }


          .tg-cabecalho  {border-collapse:collapse;border-spacing:0;margin:0px auto;}
          .tg-cabecalho td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:10px;
            overflow:hidden;padding:2px 5px;word-break:normal;}
          .tg-cabecalho th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:10px;
            font-weight:normal;overflow:hidden;padding:2px 5px;word-break:normal;}
          .tg-cabecalho .tg-cabecalho-ps66{font-size:9px;text-align:left;vertical-align:top}
          .tg-cabecalho .tg-cabecalho-p1nr{border-color:inherit;font-size:9px;text-align:left;vertical-align:top}
          .tg-cabecalho .tg-cabecalho-0pky{border-color:inherit;text-align:left;vertical-align:top}

          .tg-cabecalho .tg-cabecalho-0pky .title {
            font-size: 12px;
            text-align: center;
            margin: 0 !important;
            }

            .col-1 {
               width: 20%;
             }

             .col-2 {
               width: 15%;
             }

             .col-3 {
               width: 45%;
             }

             .col-4 {
               width: 40%;
             }
             .last-col {
               width: 40px;
             }

             .tg-cisalhamento  {border-collapse: none}
             .tg-cisalhamento td{border: none;font-family:Arial, sans-serif;font-size:10px;
               overflow:hidden;padding:0px;word-break:normal;}
             .tg-cisalhamento th{border: none;font-family:Arial, sans-serif;font-size:10px;
               font-weight:normal;overflow:hidden;padding:0px;word-break:normal;}
             .tg-cisalhamento .tg-cisalhamento-lboi{border: none;text-align:left;vertical-align:middle}
             .tg-cisalhamento .tg-cisalhamento-9wq8{border: none;text-align:center;vertical-align:middle}
             .tg-cisalhamento .tg-cisalhamento-0pky{border: none;text-align:left;vertical-align:top}

             .tg-adensamento  {border-collapse:none}
               .tg-adensamento td{border: none;font-family:Arial, sans-serif;font-size:10px;
               overflow:hidden;padding:0px 0px;word-break:normal;}
               .tg-adensamento th{border: none;font-family:Arial, sans-serif;font-size:10px;
               font-weight:normal;overflow:hidden;padding:0px 0px;word-break:normal;}
               .tg-adensamento .tg-adensamento-0lax{text-align:left;vertical-align:top}
          
       </style>
    </head>
    <body>
       <header>
          <div style="display: inline-block; width: 539px; padding-top: 20px">
              <img src="images/geocontrole.png" width="195px"/>
          </div>
          <div style="width: 212px; background-color: green; color: #fff; display: inline-block; font-family:Arial, sans-serif; font-size: 13px; padding: 2px; text-align: center">
            AMOSTRA Nº: ' . $codSample . ' / ' . $numberSample . '
         </div>
       </header>
       <main style="margin-top: 45px">
       
       <table class="tg-cabecalho" style="width: 100%;margin-bottom: 13px">
         <thead>
         <tr>
            <th class="tg-cabecalho-0pky col-1" colspan="2" rowspan="2">
               CLIENTE:
               <br>
               <img style="margin-left: 30%" src="data:image/jpeg;base64,' . base64_encode($logo) . '"  width="80px"">

            </th>
            <th class="tg-cabecalho-0pky col-3" colspan="2">RELATÓRIO ENSAIO:<div style="margin-left: 21%; font-size: 15px; margin-top: -6px">QUADRO RESULTADOS<div></th>
         </tr>
         <tr>
            <th class="tg-cabecalho-0pky" colspan="1" class="col-2">PROCESSO / LOTE:<br> <div style="text-align: center; font-size: 13px; margin-top: 4px" class="cabecalho-resultado-font">' . ($data === null ? '' : $data['Processo']) . ' / ' . $dataHeaderAndFooter['Lote'] . '</div></th>
            <th class="tg-cabecalho-p1nr">PROFUNDIDADE (m):<br> <div style="text-align: center; font-size: 13px; margin-top: 4px" class="cabecalho-resultado-font">' . $dataHeaderAndFooter['Profundidade_Inicial'] . ' -- ' . $dataHeaderAndFooter['Profundidade_Final'] . ' </div></th>
         </tr>
         </thead>
         <tbody>
         <tr>
            <td class="tg-cabecalho-0pky col-2" colspan="1" rowspan="4">DATA DO REGISTRO:<div style="margin-top: 15px"><span class="cabecalho-resultado-font">' . $dataHeaderAndFooter['Data_Registro'] . '</span></div></td>
            <td class="tg-cabecalho-0pky col-2" colspan="1" rowspan="4">DATA APROVAÇÃO:<div style="margin-top: 15px"><span class="cabecalho-resultado-font">' . $dataFolhaRosto['Data_Aprovado'] . '</span></div></td>
            <td class="tg-cabecalho-0pky col-3" rowspan="4">SONDAGEM:<br> <div style="text-align: center; font-size: 12px; margin-top: 9px;"><b><span class="cabecalho-resultado-font">' . $dataHeaderAndFooter['Sondagem'] . '</span></div></td>
            <td class="tg-cabecalho-p1nr">**DATUM: ' . $dataHeaderAndFooter['Datum'] . '</td>
         </tr>
         <tr>
            <td class="tg-cabecalho-p1nr">**COORDENADA X: <span class="cabecalho-resultado-font">' . $dataHeaderAndFooter['Coordenada_X'] . '</span></td>
         </tr>
         <tr>
            <td class="tg-cabecalho-p1nr">**COORDENADA Y: <span class="cabecalho-resultado-font">' . $dataHeaderAndFooter['Coordenada_Y'] . '</span></td>
         </tr>
         <tr>
            <td class="tg-cabecalho-ps66">**COORDENADA Z: <span class="cabecalho-resultado-font">' . $dataHeaderAndFooter['Coordenada_Z'] . '</span></td>
         </tr>
         <tr>
            <td class="tg-cabecalho-0pky" rowspan="2">DATA CONCLUSÃO:<div style="margin-top: 15px"><span class="cabecalho-resultado-font">' . $dataHeaderAndFooter['Data_Conclusao'] . '</span></div><br></td>
            <td class="tg-cabecalho-0pky" rowspan="2">**APLICAÇÃO:<div style="margin-top: 15px"><span class="cabecalho-resultado-font">' . $dataHeaderAndFooter['Aplicacao'] . '</span></div></td>
            <td class="tg-cabecalho-0pky col-3">**OBRA: <br> <div style="text-align: center; font-size: 12px; margin-top: 0px;"><b><span class="cabecalho-resultado-font">' . $dataHeaderAndFooter['Obra'] . '</span></div></td>
            <td class="tg-cabecalho-p1nr" rowspan="2">**ESPECIFICAÇÃO TÉCNICA: <span class="cabecalho-resultado-font">' . $dataHeaderAndFooter['Especificacao_tecnica'] . '</span></td>
         </tr>
         <tr>
            <td class="tg-cabecalho-0pky">**LOCAL DA COLETA / ENDEREÇO: <br> <div style="text-align: center; font-size: 12px"><b>Idea <span class="cabecalho-resultado-font">' . $dataHeaderAndFooter['Especificacao_tecnica'] . '</div></td>
         </tr>
         </tbody>
      </table>
       <table class="tg">
          <tbody>
             <tr>
                <td class="tg-0pky" colspan="15">
                   <div
                      style="font-size: 10px; width: 80%; display: inline-block"
                      >
                      Responsabilidade da amostragem: <span class="cabecalho-resultado-font">' . $responsibility . '</span>
                   </div>
                   <div style="font-size: 10px; display: inline-block">
                      Tipo de amostra: <span class="cabecalho-resultado-font">' . $dataCadastroAmostra['Tipo_Amostra'] . '</span>
                   </div>
                </td>
             </tr>
             <!--========================Ensaios de identificação=========================-->
             <tr>
                <td class="tg-0pky" colspan="15" style="padding: 0px 0px 0px 4px !important;">
                   <div style="text-align: center;">
                      <p style="font-size: 13px; margin-top: 1px !important; margin-bottom: 0px !important; font-weight: bold">Classificação</p>
                   </div>
                   <p
                      class="response"
                      style="display: inline-block; margin-right: 334px;"
                      >
                      Classificação: (ASTM D2487-00) <span class="cabecalho-resultado-font">' . $classification1 . '</span>
                   </p>
                   <p class="response" style="display: inline-block; margin-right: 5%;">
                      (ASTM D3282-09) <span class="cabecalho-resultado-font">' . $classification2 . '</span>
                   </p>
                   <br>
                   <p class="response" style="display: inline-block; margin-top: 12px !important">
                      Descrição do solo: <span class="cabecalho-resultado-font">' . $descriptionSolo . '</span>
                   </p>
                </td>
             </tr>
             <!--========================Ensaio=========================-->
             <tr>
               <td class="tg-0pky" colspan="15" style="padding: 0px 0px 0px 4px !important;">
                   <div style="text-align: center">
                     <p style="font-size: 13px; margin-top: 1px !important; margin-bottom: 0px !important; font-weight: bold">Índices físicos</p>
                   </div>
                   <p class="response" style="display: inline-block; margin-right: 5%">
                      Teor de umidade: <span style="margin-right: 5px" class="cabecalho-resultado-font">' . ($dataRehearsal === null ? '' : $dataRehearsal['Media']) . '%</span>
                   </p>
                   <p class="response" style="display: inline-block; margin-right: 35px">
                      M.Especifica de grãos: <span class="cabecalho-resultado-font">' . ($dataMassaEspecificaRealEmGraos === null ? '' : $dataMassaEspecificaRealEmGraos['massaEspMEDIA']) . ' g/cm³</span>
                   </p>
                   <p class="response" style="display: inline-block; margin-right: 20px">
                      Peso especifico úmido: <span class="cabecalho-resultado-font">' . $mediaPesoEspUmido . ' g/cm³</span>
                   </p>
                   <p class="response" style="display: inline-block; margin-right: 5%">
                      Peso especifico seco: <span class="cabecalho-resultado-font">' . ($dataDeterminacaoDaMassaEspecificaAparente === null ? '' : $dataDeterminacaoDaMassaEspecificaAparente['MediaMassaEspSeca']) . ' g/cm³</span>
                   </p>
                   <!-- drop -->
                   <div style="margin-top: 12px">
                      <p
                         class="response"
                         style="display: inline-block; margin-right: 5%"
                         >
                         Teor em matéria orgânica:
                      </p>
                      <p
                         class="response"
                         style="display: inline-block; margin-right: 3%"
                         >
                         pH:
                      </p>
                      <p
                         class="response"
                         style="display: inline-block; margin-right: 52px"
                         >
                         Teor em sulfatos:
                      </p>
                      <p
                         class="response"
                         style="display: inline-block; margin-right: 103px"
                         >
                         Teor em cloretos:
                      </p>
                      <p
                         class="response"
                         style="display: inline-block; margin-right: 5%"
                         >
                         Teor em carbonatos:
                      </p>
                   </div>
                </td>
             </tr>
             <!--========================Limites de consistência=========================-->
             <tr>
               <td class="tg-0pky" colspan="15" style="padding: 0px 0px 0px 4px !important;">
                   <div style="text-align: center">
                     <p style="font-size: 13px; margin-top: 3px !important; margin-bottom: 5px !important; font-weight: bold">Limites de consistência</p>
                   </div>
                   <p
                      class="response"
                      style="display: inline-block; margin-right: 16%"
                      >
                      LL (%): <span class="cabecalho-resultado-font">' . ($dataLimitesAttemberg === null ? '' : ($np ? "NP" : $dataLimitesAttemberg['LL'])) . '</span>
                   </p>
                   <p
                      class="response"
                      style="display: inline-block; margin-right: 16%"
                      >
                      LP (%): <span class="cabecalho-resultado-font">' . ($dataLimitesAttemberg === null ? '' : ($np ? "NP" : $dataLimitesAttemberg['LP'])) . '</span>
                   </p>
                   <p
                      class="response"
                      style="display: inline-block; margin-right: 17%"
                      >
                      IP (%): <span class="cabecalho-resultado-font">' . ($dataLimitesAttemberg === null ? '' : ($np ? "NP" :  $dataLimitesAttemberg['IP'])) . '</span>
                   </p>
                   <p
                      class="response"
                      style="display: inline-block; margin-right: 16%"
                      >
                      LC (%): ' . ($np ? "<b>NP</b>" : '') . '
                   </p>
                   <p
                      class="response"
                      style="display: inline-block;"
                      >
                      IC (%): <span class="cabecalho-resultado-font">' . ($dataLimitesAttemberg === null ? '' : ($np ? "NP" : $dataLimitesAttemberg['IC'])) . '</span>
                   </p>
                </td>
             </tr>
             <!--========================Distribuição granilométrica=========================-->
             <tr>
               <td class="tg-0pky" colspan="15" style="padding: 0px 0px 0px 4px !important;">
                   <div style="text-align: center">
                     <p style="font-size: 13px; margin-top: 3px !important; margin-bottom: 5px !important; font-weight: bold">Distribuição granulométrica</p>
                   </div>
                   <p class="response" style="display: inline-block; margin-right: 5%">
                      &#37;&lt;4.75mm: <span class="cabecalho-resultado-font">' . ($dataANALISE_GRANULOMETRICA_SEDIMENTACAO === null ? '' : $dataANALISE_GRANULOMETRICA_SEDIMENTACAO['Passados6']) . '</span>
                   </p>
                   <p class="response" style="display: inline-block; margin-right: 5%">
                      &#37;&lt;2.00mm: <span class="cabecalho-resultado-font">' . ($dataANALISE_GRANULOMETRICA_SEDIMENTACAO === null ? '' : $dataANALISE_GRANULOMETRICA_SEDIMENTACAO['Passados7']) . '</span>
                   </p>
                   <p class="response" style="display: inline-block; margin-right: 5%">
                      &#37;&lt;0.42mm: <span class="cabecalho-resultado-font">' . ($dataANALISE_GRANULOMETRICA_SEDIMENTACAO === null ? '' : $dataANALISE_GRANULOMETRICA_SEDIMENTACAO['Total3']) . '</span>
                   </p>
                   <p class="response" style="display: inline-block; margin-right: 6%">
                      &#37;&lt;0.75mm: <span class="cabecalho-resultado-font">' . ($dataANALISE_GRANULOMETRICA_SEDIMENTACAO === null ? '' : $dataANALISE_GRANULOMETRICA_SEDIMENTACAO['Total6']) . '</span>
                   </p>
                   <p class="response" style="display: inline-block; margin-right: 5%">
                      &#37;&lt;0.002mm: <span class="cabecalho-resultado-font">' . ($dataANALISE_GRANULOMETRICA_SEDIMENTACAO === null ? '' : $dataANALISE_GRANULOMETRICA_SEDIMENTACAO['Argila']) . '</span>
                   </p>
                   <p class="response" style="display: inline-block; margin-right: 5%">
                      Cu: <span class="cabecalho-resultado-font">' . $calculoCu . '</span>
                   </p>
                   <p class="response" style="display: inline-block;">
                      Cc: <span class="cabecalho-resultado-font">' . $calculoCc . '</span>
                   </p>
                </td>
             </tr>
             <!--========================FIM Distribuição granilométrica=========================-->
             <tr>
                <td class="tg-0pky" colspan="11">
                   <p class="response" style="display: inline-block; margin-right: 5%">
                      Equivalente de areia: <span class="cabecalho-resultado-font"></span>
                   </p>
                   <p class="response" style="display: inline-block; margin-right: 8%">
                      Azul de metileno (teste da mancha):
                   </p>
                   <p class="response" style="display: inline-block; margin-right: 0%; font-size: 8px !important">
                     (Expresso em g de azul de metileno por 100g de solo)
                   </p>
                   <br>
                   <p
                      class="response"
                      style="display: inline-block; margin-right: 10px; margin-top: 12px !important;"
                      >
                      Expansibilidade: <span class="cabecalho-resultado-font" style="margin-left: 30px">%</span>
                   </p>
                   <p
                      class="response"
                      style="display: inline-block; margin-top: 12px !important;"
                      >
                      Amostra sujeita a uma carga inicial: <span class="cabecalho-resultado-font" style="margin-left: 30px">g</span>
                   </p>
                </td>
                <td class="tg-0pky" colspan="4">
                   <div style="text-align: center; margin-top: -10px !important">
                      <p class="title">ÍNDICES DE VAZIOS</p>
                      <div style="margin-top: 5px">
                      <p
                         class="response"
                         style="display: inline-block; margin-right: 9%"
                         >
                         <div style="display: inline-block; padding-bottom: 0.5px; font-size: 11px !important">e</div>min: <div style="display: inline-block; padding-bottom: 0.6px; font-size: 10px !important" class="cabecalho-resultado-font"><b>' . ($dataMassaEspecificaMaxEMinDeAreia === null ? '' : $dataMassaEspecificaMaxEMinDeAreia['IndiceVazioMax']) . '</div>
                      </p>
                      <p
                         class="response"
                         style="display: inline-block; margin-right: 9%"
                         >
                         <div style="display: inline-block; padding-bottom: 0.5px; font-size: 11px !important">e</div>max: <div style="display: inline-block; padding-bottom: 0.6px; font-size: 10px !important" class="cabecalho-resultado-font"><b>' . ($dataMassaEspecificaMaxEMinDeAreia === null ? '' : $dataMassaEspecificaMaxEMinDeAreia['IndiceVazioMinimo']) . '</div>
                      </p>
                      </div>
                   </div>
                </td>
             </tr>
             <!-- =============================COMPACTAÇÃO========================================== -->
             <tr>
                <td class="tg-0pky" colspan="15">
                   <div style="margin-top: 1px">
                      <p style="display: inline-block; font-size: 10px; margin-bottom: 15px">
                         Compactação (Proctor):
                      </p>
                      <div class="checkbox">
                      <input type="checkbox" id="checkbox1" name="checkboxes" value="checkbox1" ' . ($dataEnsaioCompactacao === null ? '' : ($dataEnsaioCompactacao['EnergiaCompactacao'] === "Normal" ? 'checked="checked"' : '')) . '>
                         <label for="checkbox1" style="font-size: 10px; vertical-align: middle;">Normal</label>
                      </div>
                      <div class="checkbox">
                         <input type="checkbox" id="checkbox2" name="checkboxes" value="checkbox2" ' . ($dataEnsaioCompactacao === null ? '' : ($dataEnsaioCompactacao['EnergiaCompactacao'] === "Intenormal" ? 'checked="checked"' : '')) . '>
                         <label for="checkbox2" style="font-size: 10px; vertical-align: middle;">Internormal</label>
                      </div>
                      <div class="checkbox">
                         <input type="checkbox" id="checkbox3" name="checkboxes" value="checkbox3" ' . ($dataEnsaioCompactacao === null ? '' : ($dataEnsaioCompactacao['EnergiaCompactacao'] === "Intermediária" ? 'checked="checked"' : '')) . '>
                         <label for="checkbox3" style="font-size: 10px; vertical-align: middle;">Intermediária</label>
                      </div>
                      <div class="checkbox">
                         <input type="checkbox" id="checkbox3" name="checkboxes" value="checkbox3" ' . ($dataEnsaioCompactacao === null ? '' : ($dataEnsaioCompactacao['EnergiaCompactacao'] === "Intermodificada" ? 'checked="checked"' : '')) . '>
                         <label for="checkbox4" style="font-size: 10px; vertical-align: middle;">Intermodificada</label>
                      </div>
                      
                      <div class="checkbox">
                         <input type="checkbox" id="checkbox4" name="checkboxes" value="checkbox3" ' . ($dataEnsaioCompactacao === null ? '' : ($dataEnsaioCompactacao['EnergiaCompactacao'] === "Modificada" ? 'checked="checked"' : '')) . '>
                         <label for="checkbox4" style="font-size: 10px; vertical-align: middle;">Modificada</label>
                      </div>
                      
                      <div class="checkbox" style="margin-left: -3px">
                         <input type="checkbox" id="checkbox4" name="checkboxes" value="checkbox3" ' . ($dataEnsaioCompactacao === null ? '' : ($dataEnsaioCompactacao['EnergiaCompactacao'] === "Superpesado" ? 'checked="checked"' : '')) . '>
                         <label for="checkbox4" style="font-size: 10px; vertical-align: middle;">Superpesado</label>
                      </div>
                      <div style="display: inline-block; margin-left: 5px; height: 20px">
                        <p class="response" style="margin-bottom: 13px !important">Massa Esp. seca max(ys): <span class="cabecalho-resultado-font">' . $massaEspSecaMax . 'g/cm³</span></p>
                        <p class="response" style="margin-left: 11px;">Teor ótimo de umidade: <span class="cabecalho-resultado-font">' . $teorDeUmidade . '%</span></p>
                      </div>
                        
                      <br>
                      <div class="checkbox" style="margin-left: 491px">
                         <input type="checkbox" id="checkbox4" name="checkboxes" value="checkbox3" ' . ($dataEnsaioCompactacao === null ? '' : ($dataEnsaioCompactacao['EnergiaCompactacao'] === "Outro" ? 'checked="checked"' : '')) . '>
                         <label for="checkbox4" style="font-size: 10px; vertical-align: middle;">Outro</label>
                      </div>
                   </div>
                   
                </td>
             </tr>
             <!--================================== CBR (ISC - ìndice de suporte califórnia) ==============================-->
             <tr>
               <td class="tg-0pky" colspan="11" style="padding: 0px 0px 0px 4px !important;">
                   <div style="text-align: center;">
                   <p style="font-size: 13px; margin-top: 3px !important; margin-bottom: 5px !important; font-weight: bold">CBR (ISC - Índice de Suporte Califórnia)</p>
                   </div>
                   <div style="height: 88px">
                     <div style="display: inline-block; margin-top: 21px;">
                        <table class="tg" style="width: 140px;">
                           <thead>
                              <tr>
                                 <th class="tg-0pky" style="font-size: 10px;font-weight: normal; padding: 0;">Penetração (mm)</th>
                                 <th class="tg-0pky" style="font-size: 10px;font-weight: normal; padding: 0;">ISC (no teor ótimo)</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td class="tg-0pky" style="font-size: 10px; font-weight: bold; padding: 0; text-align: center;">2,5</td>
                                 <td class="tg-0pky" style="font-size: 10px; font-weight: bold; padding: 0; text-align: center;">5,0</td>
                              </tr>
                              <tr>
                                 <td class="tg-0pky" style="font-size: 10px; font-weight: bold; padding: 0; text-align: center;">' . ($dataIndiceSuporteCalifornia === null ? '0' : $dataIndiceSuporteCalifornia['Twopt']) . '</td>
                                 <td class="tg-0pky" style="font-size: 10px; font-weight: bold; padding: 0; text-align: center;">' . ($dataIndiceSuporteCalifornia === null ? '0' : $dataIndiceSuporteCalifornia['CBR_2_max']) . '</td>
                              </tr>
                           </tbody>
                        </table>
                        <div class="checkbox" style="margin-top: 16px">
                           <input type="checkbox" id="checkbox1" name="checkboxes" value="checkbox1"' . ($inundado === "Inundado" ? 'checked="checked"' : "") . ' >
                           <label for="checkbox1" style="font-size: 10px; vertical-align: middle;">Inundado</label>
                        </div>
                        <div class="checkbox">
                           <input type="checkbox" id="checkbox2" name="checkboxes" value="checkbox2" ' . ($inundado === "NaoInundado" ? 'checked="checked"' : "") . '>
                           <label for="checkbox2" style="font-size: 10px; vertical-align: middle;">Não inundado</label>
                        </div>
                     </div>
                     <div style="display: inline-block; width: 29%; margin-bottom: 12px;">
                        <table class="tg" style="width: 382px;">
                           <tbody>
                              <tr>
                                 <td class="tg-0pky" style="padding-right: 4px !important;font-size: 10px; padding: 0;text-align: right;border-top-color: #fff; border-left-color: #fff; border-bottom-color: #fff">Teor de umidade:</td>
                                 <td class="tg-0pky" style="padding: 3px;font-size: 10px; text-align: center;">h</td>
                                 <td class="tg-0pky" style="padding: 3px;font-weight: bold; font-size: 10px; text-align: center; width: 15px">' . ($dataIndiceSuporteCalifornia === null ? '' : $dataIndiceSuporteCalifornia['TeorUmidade1']) . '</td>
                                 <td class="tg-0pky" style="padding: 3px;font-weight: bold; font-size: 10px; text-align: center; width: 15px">' . ($dataIndiceSuporteCalifornia === null ? '' : $dataIndiceSuporteCalifornia['TeorUmidade2']) . '</td>
                                 <td class="tg-0pky" style="padding: 3px;font-weight: bold; font-size: 10px; text-align: center; width: 15px">' . ($dataIndiceSuporteCalifornia === null ? '' : $dataIndiceSuporteCalifornia['TeorUmidade3']) . '</td>
                                 <td class="tg-0pky" style="padding: 3px;font-weight: bold; font-size: 10px; text-align: center; width: 15px">' . ($dataIndiceSuporteCalifornia === null ? '' : $dataIndiceSuporteCalifornia['TeorUmidade4']) . '</td>
                                 <td class="tg-0pky" style="padding: 3px;font-weight: bold; font-size: 10px; text-align: center; width: 15px">' . ($dataIndiceSuporteCalifornia === null ? '' : $dataIndiceSuporteCalifornia['TeorUmidade5']) . '</td>
                                 <td class="tg-0pky" style="padding: 3px;font-weight: bold; font-size: 10px; border-right-color: #fff; text-align: center;">%</td>
                              </tr>
                              <tr>
                                 <td class="tg-0pky" style="padding-right: 4px !important;font-size: 10px; padding: 0;text-align: right;border-top-color: #fff; border-left-color: #fff; border-bottom-color: #fff">Massa específica seca:</td>
                                 <td class="tg-0pky" style="padding: 3px; font-size: 10px; text-align: center;">ys</td>
                                 <td class="tg-0pky" style="padding: 3px; font-weight: bold; font-size: 10px; width: 15px">' . ($dataIndiceSuporteCalifornia === null ? '' : $dataIndiceSuporteCalifornia['MassaEspSeca1']) . '</td>
                                 <td class="tg-0pky" style="padding: 3px; font-weight: bold; font-size: 10px; width: 15px">' . ($dataIndiceSuporteCalifornia === null ? '' : $dataIndiceSuporteCalifornia['MassaEspSeca2']) . '</td>
                                 <td class="tg-0pky" style="padding: 3px; font-weight: bold; font-size: 10px; width: 15px">' . ($dataIndiceSuporteCalifornia === null ? '' : $dataIndiceSuporteCalifornia['MassaEspSeca3']) . '</td>
                                 <td class="tg-0pky" style="padding: 3px; font-weight: bold; font-size: 10px; width: 15px">' . ($dataIndiceSuporteCalifornia === null ? '' : $dataIndiceSuporteCalifornia['MassaEspSeca4']) . '</td>
                                 <td class="tg-0pky" style="padding: 3px; font-weight: bold; font-size: 10px; width: 15px">' . ($dataIndiceSuporteCalifornia === null ? '' : $dataIndiceSuporteCalifornia['MassaEspSeca5']) . '</td>
                                 <td class="tg-0pky" style="padding: 3px; font-weight: bold; font-size: 10px; border-right-color: #fff; text-align: center;">g/cm3</td>
                              </tr>
                              <tr>
                                 <td class="tg-0pky" style="padding-right: 4px !important;font-size: 10px; padding: 0;text-align: right;border-top-color: #fff; border-left-color: #fff; border-bottom-color: #fff">Expansão:</td>
                                 <td class="tg-0pky" style="padding: 3px; font-weight: bold; font-size: 10px; text-align: center;"></td>
                                 <td class="tg-0pky" style="padding: 3px; font-weight: bold;font-size: 10px; text-align: center; width: 15px">' . ($dataIndiceSuporteCalifornia === null ? '' : $dataIndiceSuporteCalifornia['Expansao5']) . '</td>
                                 <td class="tg-0pky" style="padding: 3px; font-weight: bold;font-size: 10px; text-align: center; width: 15px">' . ($dataIndiceSuporteCalifornia === null ? '' : $dataIndiceSuporteCalifornia['Expansao10']) . '</td>
                                 <td class="tg-0pky" style="padding: 3px; font-weight: bold;font-size: 10px; text-align: center; width: 15px">' . ($dataIndiceSuporteCalifornia === null ? '' : $dataIndiceSuporteCalifornia['Expansao15']) . '</td>
                                 <td class="tg-0pky" style="padding: 3px; font-weight: bold;font-size: 10px; text-align: center; width: 15px">' . ($dataIndiceSuporteCalifornia === null ? '' : $dataIndiceSuporteCalifornia['Expansao20']) . '</td>
                                 <td class="tg-0pky" style="padding: 3px; font-weight: bold;font-size: 10px; text-align: center; width: 15px">' . ($dataIndiceSuporteCalifornia === null ? '' : $dataIndiceSuporteCalifornia['Expansao25']) . '</td>
                                 <td class="tg-0pky" style="padding: 3px; font-weight: bold;font-size: 10px; border-right-color: #fff; text-align: center;">%</td>
                              </tr>
                              <tr>
                                 <td class="tg-0pky" style="padding-right: 4px !important;font-size: 10px; padding: 0;text-align: right;border-top-color: #fff; border-left-color: #fff; border-bottom-color: #fff">Índice Suporte Califórnia:</td>
                                 <td class="tg-0pky" style="padding: 3px; font-size: 10px; text-align: center;">ISC</td>
                                 <td class="tg-0pky" style="padding: 3px; font-weight: bold;font-size: 10px; text-align: center; width: 15px">' . ($dataIndiceSuporteCalifornia === null ? '' : $dataIndiceSuporteCalifornia['ISC_P12']) . '</td>
                                 <td class="tg-0pky" style="padding: 3px; font-weight: bold;font-size: 10px; text-align: center; width: 15px">' . ($dataIndiceSuporteCalifornia === null ? '' : $dataIndiceSuporteCalifornia['ISC_P22']) . '</td>
                                 <td class="tg-0pky" style="padding: 3px; font-weight: bold;font-size: 10px; text-align: center; width: 15px">' . ($dataIndiceSuporteCalifornia === null ? '' : $dataIndiceSuporteCalifornia['ISC_P32']) . '</td>
                                 <td class="tg-0pky" style="padding: 3px; font-weight: bold;font-size: 10px; text-align: center; width: 15px">' . ($dataIndiceSuporteCalifornia === null ? '' : $dataIndiceSuporteCalifornia['ISC_P42']) . '</td>
                                 <td class="tg-0pky" style="padding: 3px; font-weight: bold;font-size: 10px; text-align: center; width: 15px">' . ($dataIndiceSuporteCalifornia === null ? '' : $dataIndiceSuporteCalifornia['ISC_P52']) . '</td>
                                 <td class="tg-0pky" style="padding: 3px; font-weight: bold;font-size: 10px;border-right-color: #fff; text-align: center;">5mm</td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                   </div>
                </td>
                <!-- =================================COEFICINTE ================================= -->
                <td class="tg-0pky" colspan="4" style="padding: 0px !important">
                     <div style="text-align: center; margin-bottom: 30px !important;">
                        <p style="font-size: 13px; margin-top: -8px !important; margin-bottom: 5px !important; font-weight: bold">COEFICIENTE</p>
                        <p class="response">Fragmentabilidade: <span class="cabecalho-resultado-font"></span></p>
                        <br>
                        <br>
                        <p class="response" style="margin-left: 8px">Degradabilidade: <span class="cabecalho-resultado-font"></span></p>
                     </div>
                </td>
             </tr>
             <!--=====================================PERMEABILIDADE===========================================-->
             <tr>
                <td class="tg-0pky" colspan="11" style="padding: 0px 0px 0px 4px !important;">
                   <div style="text-align: center; margin-bottom: 5px !important">
                     <p style="font-size: 13px; margin-top: 3px !important; margin-bottom: 0px !important; font-weight: bold">Permeabilidade</p>
                   </div>
                   <div style="display: inline-block;">
                      <div>
                         <input type="checkbox" id="checkbox1" name="checkboxes" value="checkbox1" ' . ($checkCargaConstante !== null ? 'checked="checked"' : '') . '>
                         <label for="checkbox1" style="font-size: 9px; vertical-align: middle;">Carga constante</label>
                      </div>
                      <div>
                         <input type="checkbox" id="checkbox2" name="checkboxes" value="checkbox2" ' . ($checkCargaVariavel !== null ? 'checked="checked"' : '') . '>
                         <label for="checkbox2" style="font-size: 9px; vertical-align: middle;">Carga variável</label>
                      </div>
                   </div>
                   <div style="display: inline-block; width: 30%;">
                      <table class="tg" style="width: 455px; margin-left: 12px">
                         <tbody>
                            <tr>
                               <td class="tg-0pky" style="padding: 2px;font-size: 10px;vertical-align: middle !important; font-weight: normal; padding: 0; text-align: right;border-top-color: #fff; border-left-color: #fff; border-bottom-color: #fff; padding-right: 3px;">Coeficiente de permeabilidade:</td>
                               <td class="tg-0pky" style="padding: 7px 2px 2px 5px;font-size: 9px;font-weight: bold; min-width: 37px; text-align: center; word-break: break-all">' . ($checkCoeficienteConstanteEVariavel !== null ? $checkCoeficienteConstanteEVariavel['coeficienteConstate'] : $valorCoeficientePermeabilidade) . '</td>
                               <td class="tg-0pky" style="padding: 5px 2px 2px 5px;font-size: 9px;font-weight: bold;min-width: 37px; text-align: center">' . ($checkCoeficienteConstanteEVariavel !== null ? $checkCoeficienteConstanteEVariavel['coeficienteVariavel'] : '') . '</td>
                               <td class="tg-0pky" style="padding: 5px 2px 2px 5px;font-size: 9px;font-weight: bold;min-width: 37px; text-align: center"></td>
                               <td class="tg-0pky" style="padding: 5px 2px 2px 5px;font-size: 9px;font-weight: bold;min-width: 37px; text-align: center"></td>
                               <td class="tg-0pky" style="padding: 5px 2px 2px 5px;font-size: 9px;font-weight: bold;min-width: 37px; text-align: center"></td>
                               <td class="tg-0pky" style="padding: 5px 2px 2px 5px;font-size: 9px;font-weight: bold;min-width: 37px; text-align: center"></td>
                               <td class="tg-0pky" style="padding: 5px 2px 2px 5px;font-size: 9px;font-weight: bold; border-right-color: #fff; text-align: center;">cm/s</td>
                            </tr>
                            <tr>
                               <td class="tg-0pky" style="padding: 7px 2px 2px 5px;font-size: 10px; vertical-align: middle !important;font-weight: bold; font-weight: normal; padding: 0; text-align: right;border-top-color: #fff; border-left-color: #fff; border-bottom-color: #fff; padding-right: 3px;"">Tensão confinamento:</td>
                               <td class="tg-0pky" style="padding: 5px 2px 2px 5px;font-size: 9px;font-weight: bold; text-align: center">' . ($checkTensaoConstanteEVariavel !== null ? $checkTensaoConstanteEVariavel['tensaoConstate'] : $valorTensao) . '</td>
                               <td class="tg-0pky" style="padding: 5px 2px 2px 5px;font-size: 9px;font-weight: bold; text-align: center"></td>
                               <td class="tg-0pky" style="padding: 5px 2px 2px 5px;font-size: 9px;font-weight: bold; text-align: center"></td>
                               <td class="tg-0pky" style="padding: 5px 2px 2px 5px;font-size: 9px;font-weight: bold; text-align: center"></td>
                               <td class="tg-0pky" style="padding: 5px 2px 2px 5px;font-size: 9px;font-weight: bold; text-align: center"></td>
                               <td class="tg-0pky" style="padding: 5px 2px 2px 5px;font-size: 9px;font-weight: bold; text-align: center"></td>
                               <td class="tg-0pky" style="padding: 5px 2px 2px 5px;font-size: 9px;font-weight: bold; border-right-color: #fff; text-align: center;">kPa</td>
                            </tr>
                         </tbody>
                      </table>
                   </div>
                </td>
                <!--=====================================ADENSAMENTO===========================================-->
                <td class="tg-0pky" colspan="4">
                  <div style="font-size: 13px; margin-bottom: 0px !important; font-weight: bold; text-align: center;">Adensamento</div>
                  <table class="tg-adensamento" style="width: 100%">
                  <tbody>
                     <tr>
                      <td class="tg-adensamento-0lax">Cc: </td>
                      <td class="tg-adensamento-0lax">Cv: <span style="margin-left: 56%">cm³/s</span></td>
                    </tr>
                    <tr>
                      <td class="tg-adensamento-0lax">Ap: <span style="margin-left: 47%">KPa<span></td>
                      <td class="tg-adensamento-0lax">K: <span style="margin-left: 56%"cm/s</span></td>
                    </tr>
                    <tr>
                      <td class="tg-adensamento-0lax">e(): </td>
                      <td class="tg-adensamento-0lax"></td>
                    </tr>
                  </tbody>
                  </table>
                </td>
             </tr>
             <!--=====================================Ensaio de cisalhamento direto:===========================================-->
             <tr>
                <td class="tg-0pky" colspan="11" style="padding: 0px 0px 0px 4px !important;">
                <div style="margin-left: 33%">
                     <p style="font-size: 13px; margin-top: 2px !important; margin-bottom: 1px !important; font-weight: bold">Ensaio de cisalhamento direto:</p>
                   </div>
                  <table class="tg-cisalhamento" style="width: 100%">
                  <thead>
                     <tr>
                     <td class="tg-cisalhamento-0pky" style="width: 40px !important">
                        <input type="checkbox" style="margin: 0px !important" id="checkbox2" name="checkboxes" value="checkbox2">
                        <label for="checkbox2" style="vertical-align: middle;">UU</label>
                     </td>
                     <td class="tg-cisalhamento-9wq8" rowspan="3">
                        c:<br>
                        <p style="font-family: DejaVu Sans !important">&#x3D5;:</p>
                     </td>
                     <td class="tg-cisalhamento-9wq8" rowspan="3">KPa<br><p style="margin-top: 3px">&#186;</p></td>
                     <td class="tg-cisalhamento-9wq8" rowspan="3">
                        c&#180;:<br>
                        <p style="font-family: DejaVu Sans !important">&#x3D5;:</p>
                     </td>
                     <td class="tg-cisalhamento-9wq8" rowspan="3">KPa<br><p style="margin-top: 3px">&#186;</p></td>
                     <td class="tg-cisalhamento-0pky" style="width: 40px !important">
                        <input style="margin: 0px !important" type="checkbox" id="checkbox2" name="checkboxes" value="checkbox2">
                        <label for="checkbox2" style="vertical-align: middle;">UU</label>
                     </td>
                     <td class="tg-cisalhamento-9wq8" rowspan="3">
                        c:<br>
                        <p style="font-family: DejaVu Sans !important">&#x3D5;:</p>
                     </td>
                     <td class="tg-cisalhamento-9wq8" rowspan="3">KPa<br><p style="margin-top: 3px">&#186;</p></td>
                     <td class="tg-cisalhamento-9wq8" rowspan="3">
                        c&#180;:<br>
                        <p style="font-family: DejaVu Sans !important">&#x3D5;:</p>
                     </td>
                     <td class="tg-cisalhamento-9wq8" rowspan="3">KPa<br><p style="margin-top: 3px">&#186;</p></td>
                     </tr>
                     <tr>
                     <td class="tg-cisalhamento-0pky">
                        <input style="margin: 0px !important" type="checkbox" id="checkbox2" name="checkboxes" value="checkbox2">
                        <label for="checkbox2" style="vertical-align: middle;">CU</label>
                     </td>
                     <td class="tg-cisalhamento-0pky">
                        <input style="margin: 0px !important" type="checkbox" id="checkbox2" name="checkboxes" value="checkbox2">
                        <label for="checkbox2" style="vertical-align: middle;">CU</label>
                     </td>
                     </tr>
                     <tr>
                     <td class="tg-cisalhamento-0pky">
                        <input style="margin: 0px !important" type="checkbox" id="checkbox2" name="checkboxes" value="checkbox2">
                        <label for="checkbox2" style="vertical-align: middle;">CD</label>
                     </td>
                     <td class="tg-cisalhamento-0pky">
                        <input style="margin: 0px !important" type="checkbox" id="checkbox2" name="checkboxes" value="checkbox2">
                        <label for="checkbox2" style="vertical-align: middle;">CD</label>
                     </td>
                     </tr>
                  </thead>
                  </table>
                </td>
                <!--=====================================Ensaio de resistência:===========================================-->
                <td class="tg-0pky" colspan="4">
                   <div style="text-align: center;">
                     <p style="font-size: 13px; margin-top: -21px !important; margin-bottom: 0px !important;font-weight: bold">Ensaio de resistência</p>
                        <p class="response" style="margin-bottom: 5px !important;">(Compressão simples)</p>
                      <p class="response">Resistência qu: <span class="cabecalho-resultado-font"></span></p>
                      <p class="response">Módulo de deformabilidade Ei: <span class="cabecalho-resultado-font"></span></p>
                      <p class="response">Deformação na rotura: <span class="cabecalho-resultado-font"></span></p>
                   </div>
                </td>
             </tr>
             <!--=====================================Ensaio de compressão triaxial:===========================================-->
             <tr>
                <td class="tg-0pky" colspan="15" style="padding: 0px 0px 0px 4px !important;">
                   <div style="margin-left: 25%">
                     <p style="font-size: 13px; margin-top: 2px !important; margin-bottom: 1px !important; font-weight: bold">Ensaio de compressão triaxial:</p>
                   </div>
                     <table class="tg-cisalhamento" style="width: 100%; margin-top: -9px">
                        <thead>
                        <tr>
                           <td class="tg-cisalhamento-0pky"; style="width: 34px !important">
                              <input style="margin: 0px !important" type="checkbox" id="checkbox2" name="checkboxes" value="checkbox2">
                              <label for="checkbox2" style="vertical-align: middle;">UU</label>
                           </td>
                           <td class="tg-cisalhamento-9wq8" rowspan="3">
                              <p style="font-family: DejaVu Sans !important">&#963;3(l): </p><p style="font-family: DejaVu Sans !important">&#963;1(l):</p>
                           </td>
                           <td class="tg-cisalhamento-9wq8" rowspan="3">
                              <div style="gap: 10px"><p>KPa</p><p>KPa</p></div>
                           </td>
                           <td class="tg-cisalhamento-9wq8" rowspan="3">
                              <p style="font-family: DejaVu Sans !important">&#963;3(ll): </p><p style="font-family: DejaVu Sans !important">&#963;1(ll):</p>
                           </td>
                           <td class="tg-cisalhamento-9wq8" rowspan="3">
                              <div style="gap: 10px"><p>KPa</p><p>KPa</p></div>
                           </td>
                           <td class="tg-cisalhamento-9wq8" rowspan="3">
                              <p style="font-family: DejaVu Sans !important">&#963;3(lll): </p><p style="font-family: DejaVu Sans !important">&#963;1(lll):</p>
                           </td>
                           <td class="tg-cisalhamento-9wq8" rowspan="3">
                              <div style="gap: 10px"><p>KPa</p><p>KPa</p></div>
                           </td>
                           <td class="tg-cisalhamento-9wq8" rowspan="3">
                              <p style="font-family: DejaVu Sans !important">&#963;3(lV): </p><p style="font-family: DejaVu Sans !important">&#963;1(lV):</p>
                           </td>
                           <td class="tg-cisalhamento-9wq8" rowspan="3">
                              <div style="gap: 10px"><p>KPa</p><p>KPa</p></div>
                           </td>
                           <td class="tg-cisalhamento-9wq8" rowspan="3">
                              <div style="gap: 10px"
                                 <p>c:</p>
                                 <p style="font-family: DejaVu Sans !important">&#x3D5;:</p>
                              </div>
                           </td>
                           <td class="tg-cisalhamento-9wq8" rowspan="3">
                              <div style="gap: 10px"><p>KPa</p><p>KPa</p></div>
                           </td>
                           <td class="tg-cisalhamento-9wq8" rowspan="3">
                              <div style="gap: 10px"
                                 <p>c&#180;:</p>
                                 <p style="font-family: DejaVu Sans !important">&#x3D5;:</p>
                              </div>
                           </td>
                           <td class="tg-cisalhamento-9wq8" rowspan="3">
                              <div style="gap: 10px"><p>KPa</p><p>KPa</p></div>
                           </td>
                        </tr>
                        <tr>
                           <td class="tg-cisalhamento-0pky">
                              <input style="margin: 0px !important" type="checkbox" id="checkbox2" name="checkboxes" value="checkbox2">
                              <label for="checkbox2" style="vertical-align: middle;">CU</label>
                           </td>
                        </tr>
                        <tr>
                           <td class="tg-cisalhamento-0pky">
                              <input style="margin: 0px !important" type="checkbox" id="checkbox2" name="checkboxes" value="checkbox2">
                              <label for="checkbox2" style="vertical-align: middle;">CD</label>
                           </td>
                        </tr>
                        </thead>
                        </table>
                </td>
             </tr>
             <tr>
                <td class="tg-0pky" colspan="15" style="border-right-color: #fff; border-left-color: #fff">
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
