<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: HEAD, GET, POST, PUT, PATCH, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
    header("HTTP/1.1 200 OK");
    die();
}
include_once('configureteConnection.php');
// require_once '../dompdf/autoload.inc.php';
require_once 'PdfModels/MainSheetModel.php';
require_once 'PdfModels/WaterContentModel.php';
require_once 'PdfModels/CompressionModel.php';
require_once 'PdfModels/CompressionGraphModel.php';
require_once 'PdfModels/GranulometricAnalysisBySievingModel.php';
require_once 'PdfModels/GranulometricAnalysisBySievingGraphModel.php';
require_once 'PdfModels/GranulometricAnalysisWithSedimentation.php';
require_once 'PdfModels/GranulometricAnalysisWithSedimentationGraph.php';
require_once 'PdfModels/ActualSpecificMassInGrainsModel.php';
require_once 'PdfModels/LimitOfLiquidityAndPlasticityModel.php';
require_once 'PdfModels/LimitOfLiquidityAndPlasticityGraph.php';
require_once 'PdfModels/CaliforniaSupportIndexModel.php';
require_once 'PdfModels/CaliforniaSupportIndexGraph1.php';
require_once 'PdfModels/CaliforniaSupportIndexGraph2.php';
require_once 'PdfModels/CaliforniaSupportIndexGraph3.php';
require_once 'PdfModels/CaliforniaSupportIndexGraph4.php';
require_once 'PdfModels/DeterminationOfApparentSpecificMassModel.php';
require_once 'PdfModels/DetermineMaximumAndMinimumSandModel.php';
require_once 'PdfModels/DeterminationOfTheSpecificMassOfVariableMassModel.php';
require_once 'PdfModels/DeterminationOfSpecificMassOfConstantMassModel.php';
require '../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

class MainSheet
{
    public function generateMainSheet(
        string $codSample,
        string $numberSample,
        array $reportsSelect,
        string $responsibility,
        string $classification1,
        string $classification2,
        ?string $descriptionSolo, // Permitir null
        string $observation,
        string $inundado
    ) {
        $this->generatePDF(
            $codSample,
            $numberSample,
            $reportsSelect,
            $responsibility,
            $classification1,
            $classification2,
            $descriptionSolo,
            $observation,
            $inundado
        );
    }

    public function generatePDF(
        $codSample,
        $numberSample,
        $reportsSelect,
        $responsibility,
        $classification1,
        $classification2,
        $descriptionSolo,
        $observation,
        $inundado
    ) {
        $options = new Options();
        $options->set('chroot', realpath(''));
        $dompdf = new Dompdf($options);
        $pdfModelMainSheet = new MainSheetModel("passar data aqui futuramente");
        $pdfModelWaterContent = new WaterContentModel("passar data aqui futuramente");
        $pdfModelCompression = new CompressionModel("passar data aqui futuramente");
        $pdfModelGraphCompression = new CompressionGraphModel("passar data aqui futuramente");
        $pdfModelGranulometricAnalysisBySieving = new GranulometricAnalysisBySievingModel("passar data aqui futuramente");
        $pdfModelGranulometricAnalysisBySievingGraph = new GranulometricAnalysisBySievingGraphModel("passar data aqui futuramente");
        $pdfModelGranulometricAnalysisWithSedimentation = new GranulometricAnalysisWithSedimentation("passar data aqui futuramente");
        $pdfModelGraphGranulometricAnalysisWithSedimentation = new GranulometricAnalysisWithSedimentationGraph("passar data aqui futuramente");
        $pdfModelActualSpecificMassInGrains = new ActualSpecificMassInGrainsModel("passar data aqui futuramente");
        $pdfModelLimitOfLiquidityAndPlasticity = new LimitOfLiquidityAndPlasticityModel("passar data aqui futuramente");
        $pdfModelLimitOfLiquidityAndPlasticityGraph = new LimitOfLiquidityAndPlasticityGraph("passar data aqui futuramente");
        $pdfModelCaliforniaSupportIndexGraph1 = new CaliforniaSupportIndexGraph1("passar data aqui futuramente");
        $pdfModelCaliforniaSupportIndexGraph2 = new CaliforniaSupportIndexGraph2("passar data aqui futuramente");
        $pdfModelCaliforniaSupportIndexGraph3 = new CaliforniaSupportIndexGraph3("passar data aqui futuramente");
        $pdfModelCaliforniaSupportIndexGraph4 = new CaliforniaSupportIndexGraph4("passar data aqui futuramente");
        $pdfModelCaliforniaSupportIndex = new CaliforniaSupportIndexModel("passar data aqui futuramente");
        $pdfModelDeterminationOfApparentSpecificMass = new DeterminationOfApparentSpecificMassModel("passar data aqui futuramente");
        $pdfModelDetermineMaximumAndMinimumSand = new DetermineMaximumAndMinimumSandModel("passar data aqui futuramente");
        $pdfModelDeterminationOfTheSpecificMassOfVariableMass = new DeterminationOfTheSpecificMassOfVariableMassModel("passar data aqui futuramente");
        $pdfModelDeterminationOfSpecificMassOfConstantMass = new DeterminationOfSpecificMassOfConstantMassModel("passar data aqui futuramente");

        $getData = $this->getData($codSample, $numberSample);
        
        $dataHeaderAndFooter = $getData['dataHeaderAndFooter'];
        $dataCadastroDeClientes = $getData['dataCadastroDeClientes'];
        $dataImagemLimitesAttemberg = $getData['dataImagemLimitesAttemberg'];
        $dataCadastroAmostra = $getData['dataCadastroAmostra'];
        $dataFolhaRosto = $getData['dataFolhaRosto'];

        $dataRehearsal = null;
        $dataEnsaioCompactacao = null;
        $dataAnaliseGranulometricaPeineiramento = null;
        $dataAnaliseGranulometricaSedimentacao = null;
        $dataMassaEspecificaRealEmGraos = null;
        $dataLimitesAttemberg = null;
        $dataIndiceSuporteCalifornia = null;
        $dataDeterminacaoDaMassaEspecificaAparente = null;
        $dataMassaEspecificaMaxEMinDeAreia = null;
        $dataDeterminacaoDoCoeficienteDePermeabilidade = null;
        $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante = null;

        if ($dataHeaderAndFooter === null) {
            http_response_code(404); // Define o status HTTP como 404
            $response = ["message" => "Amostra e/ou número de ensaio não encontrado."];
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }

        $pagina = 1;
        $totalPaginas = 1;
        $checkCargaVariavel = null;
        $checkCargaConstante = null;

        foreach ($reportsSelect as $reportSelect) {
            switch ($reportSelect) {
                case 'Teor de umidade':
                    $totalPaginas++;
                    $dataRehearsal = $getData['dataRehearsal'];
                    break;
                case 'Compactação':
                    $totalPaginas = $totalPaginas + 2;
                    $dataEnsaioCompactacao = $getData['dataEnsaioCompactacao'];
                    break;

                case 'Análise granulométrica por peneiramento':
                    $totalPaginas = $totalPaginas + 2;
                    $dataAnaliseGranulometricaPeineiramento = $getData['dataAnaliseGranulometricaPeineiramento'];
                    break;

                case 'Análise granulométrica com sedimentação':
                    $totalPaginas = $totalPaginas + 2;
                    $dataAnaliseGranulometricaSedimentacao = $getData['dataAnaliseGranulometricaSedimentacao'];
                    break;

                case 'Massa específica real dos grãos':
                    $totalPaginas++;
                    $dataMassaEspecificaRealEmGraos = $getData['dataMassaEspecificaRealEmGraos'];
                    break;

                case 'Limites de liquidez e plasticidade (ATTERBERG)':
                    $totalPaginas = $totalPaginas + 2;
                    $dataLimitesAttemberg = $getData['dataLimitesAttemberg'];
                    break;

                case 'Índice de suporte Califórnia':
                    $totalPaginas = $totalPaginas + 5;
                    $dataIndiceSuporteCalifornia = $getData['dataIndiceSuporteCalifornia'];
                    break;

                case 'Determinação da massa específica aparente':
                    $totalPaginas++;
                    $dataDeterminacaoDaMassaEspecificaAparente = $getData['dataDeterminacaoDaMassaEspecificaAparente'];
                    break;

                case 'Massa específica máxima e mínima de areias':
                    $totalPaginas++;
                    $dataMassaEspecificaMaxEMinDeAreia = $getData['dataMassaEspecificaMaxEMinDeAreia'];
                    break;

                case 'Determinação do coeficiente de permeabilidade em carga variável em câmara triaxial':
                    $checkCargaVariavel = true;
                    $totalPaginas++;
                    $dataDeterminacaoDoCoeficienteDePermeabilidade = $getData['dataDeterminacaoDoCoeficienteDePermeabilidade'];
                    break;

                case 'Determinação do coeficiente de permeabilidade em carga constante em câmera triaxial':
                    $checkCargaConstante = true;
                    $totalPaginas++;
                    $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante = $getData['dataDeterminacaoDoCoeficienteDePermeabilidadeConstante'];
                    break;

                default:
                    break;
            }
        }
        $logo = $dataCadastroDeClientes['LOGO'];

        if ($dataDeterminacaoDaMassaEspecificaAparente !== null) {
            $mediaPesoEspUmido = $this->calcularMediaPesoEspUmido($dataDeterminacaoDaMassaEspecificaAparente['MassaEspUmidaP1'], $dataDeterminacaoDaMassaEspecificaAparente['MassaEspUmidaP2'], $dataDeterminacaoDaMassaEspecificaAparente['MassaEspUmidaP3']);
        } else {
            $mediaPesoEspUmido = null;
        }
        if ($dataLimitesAttemberg !== null) {
            $np = $dataLimitesAttemberg['NP'] === "NP" ? true : false;
        } else {
            $np = null;
        }


        if ($dataAnaliseGranulometricaSedimentacao !== null) {
            $d10 = floatval(str_replace(',', '.', $dataAnaliseGranulometricaSedimentacao['D10']));
            $d30 = floatval(str_replace(',', '.', $dataAnaliseGranulometricaSedimentacao['D30']));
            $d60 = floatval(str_replace(',', '.', $dataAnaliseGranulometricaSedimentacao['D60']));
            $calculoCc = number_format(($d30 * $d30) / ($d10 * $d60), 3, ',', '.');
            $calculoCu = number_format($d60 / $d10, 3, ',', '.');
        } else {
            $d10 = null;
            $d30 = null;
            $d60 = null;
            $calculoCc = null;
            $calculoCu = null;
        }

        if ($dataIndiceSuporteCalifornia !== null && $dataEnsaioCompactacao !== null) {
            $massaEspSecaMaxCaliforniaNumero = floatval(str_replace(',', '.', $dataIndiceSuporteCalifornia['gdmax']));
            $massaEspSecaMaxCompactacaoNumero = floatval(str_replace(',', '.', $dataEnsaioCompactacao['Ydmax']));

            $massaEspSecaMax = ($dataEnsaioCompactacao === null ? number_format($massaEspSecaMaxCaliforniaNumero, 2, ',', '.') : number_format($massaEspSecaMaxCompactacaoNumero, 2, ',', '.'));


            $teorUmidadeCalifoniaNumero = floatval(str_replace(',', '.', $dataIndiceSuporteCalifornia['Twopt']));
            $teorUmidadeCompactacaoNumero = floatval(str_replace(',', '.', $dataEnsaioCompactacao['Twopt']));
            $teorDeUmidade = ($dataEnsaioCompactacao === null ? number_format($teorUmidadeCalifoniaNumero, 1, ',', '.') : number_format($teorUmidadeCompactacaoNumero, 1, ',', '.'));
        } else {
            $massaEspSecaMax = null;
            $teorDeUmidade = null;
        }


        if ($checkCargaConstante && $checkCargaVariavel) {
            if ($dataDeterminacaoDoCoeficienteDePermeabilidadeConstante !== null && $dataDeterminacaoDoCoeficienteDePermeabilidade !== null) {
                $arrayCheckCoeficienteConstanteEVariavel = [
                    [
                        "coeficienteConstate" => $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['CoeficientePerme20C'],
                        "coeficienteVariavel" => $dataDeterminacaoDoCoeficienteDePermeabilidade['CoeficientePerme20C']
                    ]
                ];

                $checkCoeficienteConstanteEVariavel = $arrayCheckCoeficienteConstanteEVariavel[0];
                $valorCoeficientePermeabilidade = null;

                $arrayCheckTensaoConstanteEVariavel = [
                    [
                        "tensaoConstate" => $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['TensaoConfinamento'],
                        "tensaoVariavel" => $dataDeterminacaoDoCoeficienteDePermeabilidade['TensaoConfinamento']
                    ]
                ];
            } else {
                $arrayCheckCoeficienteConstanteEVariavel = [
                    [
                        "coeficienteConstate" => null,
                        "coeficienteVariavel" => null
                    ]
                ];

                $arrayCheckTensaoConstanteEVariavel = [
                    [
                        "tensaoConstate" => null,
                        "tensaoVariavel" => null
                    ]
                ];
                $checkCoeficienteConstanteEVariavel = null;
                $valorCoeficientePermeabilidade = null;
            }


            $checkTensaoConstanteEVariavel = $arrayCheckTensaoConstanteEVariavel[0];
            $valorTensao = null;
        } else if ($checkCargaConstante !== null) {
            $checkCoeficienteConstanteEVariavel = null;
            $checkTensaoConstanteEVariavel = null;

            $valorCoeficientePermeabilidade = $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['CoeficientePerme20C'];
            $valorTensao = $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante['TensaoConfinamento'];
        } else if ($checkCargaVariavel !== null) {
            $checkCoeficienteConstanteEVariavel = null;
            $checkTensaoConstanteEVariavel = null;

            $valorCoeficientePermeabilidade = $dataDeterminacaoDoCoeficienteDePermeabilidade['CoeficientePerme20C'];
            $valorTensao = $dataDeterminacaoDoCoeficienteDePermeabilidade['TensaoConfinamento'];
        } else {
            $checkCoeficienteConstanteEVariavel = null;
            $checkTensaoConstanteEVariavel = null;
            $valorCoeficientePermeabilidade = null;
            $valorTensao = null;
        }

        $dataAtual = new DateTime();
        $dataFormatada = $dataAtual->format('d/m/Y');

        $htmlMainSheet = $pdfModelMainSheet->generateModel(
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
        );
        // $htmlWaterContent = $pdfModelWaterContent->generateModel();

        $htmlCompleto = $htmlMainSheet;

        foreach ($reportsSelect as $reportSelect) {
            switch ($reportSelect) {
                case $reportSelect === 'Teor de umidade' && $dataRehearsal !== null:
                    $pagina++;
                    $htmlWaterContent = $pdfModelWaterContent->generateModel($dataRehearsal, $dataHeaderAndFooter, $codSample, $numberSample, $observation, $pagina, $totalPaginas, $logo, $dataFormatada);
                    $htmlCompleto .= $htmlWaterContent;
                    break;

                case $reportSelect ===  'Compactação' && $dataEnsaioCompactacao !== null:
                    $pagina++;
                    $htmlCompression = $pdfModelCompression->generateModel($dataHeaderAndFooter, $dataEnsaioCompactacao, $codSample, $numberSample, $observation, $pagina, $totalPaginas, $logo, $dataFormatada);
                    $htmlCompleto .= $htmlCompression;

                    $pagina++;
                    $htmlGraphCompression = $pdfModelGraphCompression->generateModel($dataHeaderAndFooter, $dataEnsaioCompactacao, $codSample, $numberSample, $observation, $pagina, $totalPaginas, $logo, $dataFormatada);
                    $htmlCompleto .= $htmlGraphCompression;
                    break;

                case $reportSelect ===  'Análise granulométrica por peneiramento' && $dataAnaliseGranulometricaPeineiramento !== null:
                    $pagina++;
                    $htmlGranulometricAnalysisBySieving = $pdfModelGranulometricAnalysisBySieving->generateModel($codSample, $numberSample, $observation, $dataHeaderAndFooter, $pagina, $totalPaginas, $dataAnaliseGranulometricaPeineiramento, $logo, $dataFormatada);
                    $htmlCompleto .= $htmlGranulometricAnalysisBySieving;

                    $pagina++;
                    $htmlGraphGranulometricAnalysisBySieving = $pdfModelGranulometricAnalysisBySievingGraph->generateModel($codSample, $numberSample, $observation, $dataHeaderAndFooter, $pagina, $totalPaginas, $logo, $dataFormatada, $dataAnaliseGranulometricaPeineiramento);
                    $htmlCompleto .= $htmlGraphGranulometricAnalysisBySieving;
                    break;

                case $reportSelect ===  'Análise granulométrica com sedimentação' && $dataAnaliseGranulometricaSedimentacao !== null:
                    $pagina++;
                    $htmlGranulometricAnalysisWithSedimentation = $pdfModelGranulometricAnalysisWithSedimentation->generateModel($codSample, $numberSample, $observation, $dataHeaderAndFooter, $pagina, $totalPaginas, $dataAnaliseGranulometricaSedimentacao, $logo, $dataFormatada);
                    $htmlCompleto .= $htmlGranulometricAnalysisWithSedimentation;

                    $pagina++;
                    $htmlGraphGranulometricAnalysisWithSedimentation = $pdfModelGraphGranulometricAnalysisWithSedimentation->generateModel($codSample, $numberSample, $observation, $dataHeaderAndFooter, $pagina, $totalPaginas, $logo, $dataFormatada, $dataAnaliseGranulometricaSedimentacao);
                    $htmlCompleto .= $htmlGraphGranulometricAnalysisWithSedimentation;
                    break;

                case $reportSelect ===  'Massa específica real dos grãos' && $dataMassaEspecificaRealEmGraos !== null:
                    $pagina++;
                    $htmlActualSpecificMassInGrains = $pdfModelActualSpecificMassInGrains->generateModel($codSample, $numberSample, $observation, $dataHeaderAndFooter, $pagina, $totalPaginas, $dataMassaEspecificaRealEmGraos, $logo, $dataFormatada);
                    $htmlCompleto .= $htmlActualSpecificMassInGrains;
                    break;

                case $reportSelect ===  'Limites de liquidez e plasticidade (ATTERBERG)' && $dataLimitesAttemberg !== null:
                    $pagina++;
                    $htmlLimitOfLiquidityAndPlasticity = $pdfModelLimitOfLiquidityAndPlasticity->generateModel($codSample, $numberSample, $observation, $dataHeaderAndFooter, $pagina, $totalPaginas, $dataLimitesAttemberg, $logo, $dataFormatada);
                    $htmlCompleto .= $htmlLimitOfLiquidityAndPlasticity;

                    if ($dataImagemLimitesAttemberg !== null) {
                        $pagina++;
                        $htmlGraphLimitOfLiquidityAndPlasticity = $pdfModelLimitOfLiquidityAndPlasticityGraph->generateModel($codSample, $numberSample, $observation, $dataHeaderAndFooter, $pagina, $totalPaginas, $logo, $dataLimitesAttemberg, $dataImagemLimitesAttemberg, $dataFormatada);
                        $htmlCompleto .= $htmlGraphLimitOfLiquidityAndPlasticity;
                    }

                    break;

                case $reportSelect ===  'Índice de suporte Califórnia' && $dataIndiceSuporteCalifornia !== null:
                    $pagina++;
                    $htmlCaliforniaSupportIndexModel = $pdfModelCaliforniaSupportIndex->generateModel($codSample, $numberSample, $observation, $dataHeaderAndFooter, $pagina, $totalPaginas, $dataIndiceSuporteCalifornia, $logo, $dataFormatada);
                    $htmlCompleto .= $htmlCaliforniaSupportIndexModel;

                    $pagina++;
                    $htmlGraphCaliforniaSupportIndex = $pdfModelCaliforniaSupportIndexGraph1->generateModel($codSample, $numberSample, $observation, $dataHeaderAndFooter, $pagina, $totalPaginas, $logo, $dataFormatada);
                    $htmlCompleto .= $htmlGraphCaliforniaSupportIndex;

                    $pagina++;
                    $htmlGraphCaliforniaSupportIndex = $pdfModelCaliforniaSupportIndexGraph2->generateModel($codSample, $numberSample, $observation, $dataHeaderAndFooter, $pagina, $totalPaginas, $logo, $dataFormatada);
                    $htmlCompleto .= $htmlGraphCaliforniaSupportIndex;

                    $pagina++;
                    $htmlGraphCaliforniaSupportIndex = $pdfModelCaliforniaSupportIndexGraph3->generateModel($codSample, $numberSample, $observation, $dataHeaderAndFooter, $pagina, $totalPaginas, $logo, $dataFormatada);
                    $htmlCompleto .= $htmlGraphCaliforniaSupportIndex;

                    $pagina++;
                    $htmlGraphCaliforniaSupportIndex = $pdfModelCaliforniaSupportIndexGraph4->generateModel($codSample, $numberSample, $observation, $dataHeaderAndFooter, $pagina, $totalPaginas, $logo, $dataFormatada);
                    $htmlCompleto .= $htmlGraphCaliforniaSupportIndex;
                    break;

                case $reportSelect ===  'Determinação da massa específica aparente' && $dataDeterminacaoDaMassaEspecificaAparente !== null:
                    $pagina++;
                    $htmlDeterminationOfApparentSpecificMassModel = $pdfModelDeterminationOfApparentSpecificMass->generateModel($codSample, $numberSample, $observation, $dataHeaderAndFooter, $pagina, $totalPaginas, $dataDeterminacaoDaMassaEspecificaAparente, $logo, $dataFormatada);
                    $htmlCompleto .= $htmlDeterminationOfApparentSpecificMassModel;
                    break;

                case $reportSelect ===  'Massa específica máxima e mínima de areias' && $dataMassaEspecificaMaxEMinDeAreia !== null:
                    $pagina++;
                    $htmlDetermineMaximumAndMinimumSandModel = $pdfModelDetermineMaximumAndMinimumSand->generateModel($codSample, $numberSample, $observation, $dataHeaderAndFooter, $pagina, $totalPaginas, $dataMassaEspecificaMaxEMinDeAreia, $logo, $dataFormatada);
                    $htmlCompleto .= $htmlDetermineMaximumAndMinimumSandModel;
                    break;

                case $reportSelect ===  'Determinação do coeficiente de permeabilidade em carga variável em câmara triaxial' && $dataDeterminacaoDoCoeficienteDePermeabilidade !== null:
                    $pagina++;
                    $htmlDeterminationOfTheSpecificMassOfVariableMassModel = $pdfModelDeterminationOfTheSpecificMassOfVariableMass->generateModel($codSample, $numberSample, $observation, $dataHeaderAndFooter, $pagina, $totalPaginas, $dataDeterminacaoDoCoeficienteDePermeabilidade, $logo, $dataFormatada);
                    $htmlCompleto .= $htmlDeterminationOfTheSpecificMassOfVariableMassModel;
                    break;

                case $reportSelect ===  'Determinação do coeficiente de permeabilidade em carga constante em câmera triaxial' && $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante !== null:
                    $pagina++;
                    $htmlDeterminationOfSpecificMassOfConstantMassModel = $pdfModelDeterminationOfSpecificMassOfConstantMass->generateModel($codSample, $numberSample, $observation, $dataHeaderAndFooter, $pagina, $totalPaginas, $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante, $logo, $dataFormatada);
                    $htmlCompleto .= $htmlDeterminationOfSpecificMassOfConstantMassModel;
                    break;

                default:
                    break;
            }
        }

        $dompdf->loadHtml($htmlCompleto);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();


        $output = $dompdf->output();
        $filename = 'table.pdf';

        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Length: ' . strlen($output));

        echo $output;
    }

    public function getData($codSample, $numberSample)
    {
        $conexao = new ConfigureteConnection();
        $conexao->connect();

        $pdo = $conexao->getConnection();

        if ($pdo === null) {
            return null;
        }

        $query = "SELECT * FROM Ensaios WHERE Amostra = :codSample AND N_Ensaio = :numberSample";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':codSample', $codSample, PDO::PARAM_INT);
        $stmt->bindParam(':numberSample', $numberSample, PDO::PARAM_INT);
        $stmt->execute();
        $responseRehearsal = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $dataRehearsal = count($responseRehearsal) === 0 ? null : $responseRehearsal[0];

        $query = "SELECT * FROM Cabecalho_Rodape WHERE Amostra = :codSample";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':codSample', $codSample, PDO::PARAM_INT);
        $stmt->execute();
        $responseHeaderAndFooter = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $dataHeaderAndFooter = count($responseHeaderAndFooter) === 0 ? null : $responseHeaderAndFooter[0];

        if ($dataHeaderAndFooter !== null) {
            $query = "SELECT * FROM CadastrodeClientes WHERE Entidade = :Entidade";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':Entidade', $dataHeaderAndFooter['Entidade'], PDO::PARAM_INT);
            $stmt->execute();
            $cadastroDeClientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $dataCadastroDeClientes = count($cadastroDeClientes) === 0 ? null : $cadastroDeClientes[0];
        } else {
            $dataCadastroDeClientes = null;
        }

        $query = "SELECT * FROM EnsaioCompactacao WHERE Amostra = :codSample AND N_Ensaio = :numberSample";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':codSample', $codSample, PDO::PARAM_INT);
        $stmt->bindParam(':numberSample', $numberSample, PDO::PARAM_INT);
        $stmt->execute();
        $responseEnsaioCompactacao = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $dataEnsaioCompactacao = count($responseEnsaioCompactacao) === 0 ? null : $responseEnsaioCompactacao[0];

        $query = "SELECT * FROM ANALISE_GRANULOMETRICA_PENEIRAMENTO WHERE Amostra = :codSample AND N_Ensaio = :numberSample LIMIT 1";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':codSample', $codSample, PDO::PARAM_INT);
        $stmt->bindParam(':numberSample', $numberSample, PDO::PARAM_INT);
        $stmt->execute();
        $analiseGranulometricaPeineiramento = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $dataAnaliseGranulometricaPeineiramento = count($analiseGranulometricaPeineiramento) === 0 ? null : $analiseGranulometricaPeineiramento[0];

        $query = "SELECT * FROM ANALISE_GRANULOMETRICA_SEDIMENTACAO WHERE Amostra = :codSample AND N_Ensaio = :numberSample LIMIT 1";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':codSample', $codSample, PDO::PARAM_INT);
        $stmt->bindParam(':numberSample', $numberSample, PDO::PARAM_INT);
        $stmt->execute();
        $analiseGranulometricaSedimentacao = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $dataAnaliseGranulometricaSedimentacao = count($analiseGranulometricaSedimentacao) === 0 ? null : $analiseGranulometricaSedimentacao[0];

        $query = "SELECT * FROM MassaEspecificaRealEmGraos WHERE Amostra = :codSample AND N_Ensaio = :numberSample";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':codSample', $codSample, PDO::PARAM_INT);
        $stmt->bindParam(':numberSample', $numberSample, PDO::PARAM_INT);
        $stmt->execute();
        $massaEspecificaRealEmGraos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $dataMassaEspecificaRealEmGraos = count($massaEspecificaRealEmGraos) === 0 ? null : $massaEspecificaRealEmGraos[0];

        $query = "SELECT * FROM LimitesAttemberg WHERE Amostra = :codSample AND N_Ensaio = :numberSample";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':codSample', $codSample, PDO::PARAM_INT);
        $stmt->bindParam(':numberSample', $numberSample, PDO::PARAM_INT);
        $stmt->execute();
        $limitesAttemberg = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $dataLimitesAttemberg = count($limitesAttemberg) === 0 ? null : $limitesAttemberg[0];

        $query = "SELECT * FROM IndiceSuporteCalifornia WHERE Amostra = :codSample AND N_Ensaio = :numberSample";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':codSample', $codSample, PDO::PARAM_INT);
        $stmt->bindParam(':numberSample', $numberSample, PDO::PARAM_INT);
        $stmt->execute();
        $indiceSuporteCalifornia = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $dataIndiceSuporteCalifornia = count($indiceSuporteCalifornia) === 0 ? null : $indiceSuporteCalifornia[0];

        $query = "SELECT * FROM DETERMINACAO_DA_MASSA_ESPECIFICA_APARENTE WHERE Amostra = :codSample AND N_Ensaio = :numberSample";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':codSample', $codSample, PDO::PARAM_INT);
        $stmt->bindParam(':numberSample', $numberSample, PDO::PARAM_INT);
        $stmt->execute();
        $determinacaoDaMassaEspecificaAparente = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $dataDeterminacaoDaMassaEspecificaAparente = count($determinacaoDaMassaEspecificaAparente) === 0 ? null : $determinacaoDaMassaEspecificaAparente[0];

        $query = "SELECT * FROM MassaEspecificaMaxEMinDeAreia WHERE Amostra = :codSample AND N_Ensaio = :numberSample";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':codSample', $codSample, PDO::PARAM_INT);
        $stmt->bindParam(':numberSample', $numberSample, PDO::PARAM_INT);
        $stmt->execute();
        $massaEspecificaMaxEMinDeAreia = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $dataMassaEspecificaMaxEMinDeAreia = count($massaEspecificaMaxEMinDeAreia) === 0 ? null : $massaEspecificaMaxEMinDeAreia[0];

        $query = "SELECT * FROM DETERMINACAO_DO_COEFICIENTE_DE_PERMEABILIDADE WHERE Amostra = :codSample AND N_Ensaio = :numberSample";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':codSample', $codSample, PDO::PARAM_INT);
        $stmt->bindParam(':numberSample', $numberSample, PDO::PARAM_INT);
        $stmt->execute();
        $determinacaoDoCoeficienteDePermeabilidade = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $dataDeterminacaoDoCoeficienteDePermeabilidade = count($determinacaoDoCoeficienteDePermeabilidade) === 0 ? null : $determinacaoDoCoeficienteDePermeabilidade[0];

        $query = "SELECT * FROM DETERMINACAO_DO_COEFICIENTE_DE_PERMEABILIDADE_CARGA_CONSTANTE WHERE Amostra = :codSample AND N_Ensaio = :numberSample";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':codSample', $codSample, PDO::PARAM_INT);
        $stmt->bindParam(':numberSample', $numberSample, PDO::PARAM_INT);
        $stmt->execute();
        $determinacaoDoCoeficienteDePermeabilidadeConstante = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante = count($determinacaoDoCoeficienteDePermeabilidadeConstante) === 0 ? null : $determinacaoDoCoeficienteDePermeabilidadeConstante[0];

        $query = "SELECT * FROM IMAGEM_GRAFICO_LIMITES_LIQUIDEZ_PLASTICIDADE WHERE Amostra = :codSample AND N_Ensaio = :numberSample";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':codSample', $codSample, PDO::PARAM_INT);
        $stmt->bindParam(':numberSample', $numberSample, PDO::PARAM_INT);
        $stmt->execute();
        $imagemLimitesAttemberg = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $dataImagemLimitesAttemberg = count($imagemLimitesAttemberg) === 0 ? null : $imagemLimitesAttemberg[0];

        $query = "SELECT * FROM Cadastro_Amostra WHERE Amostra = :codSample";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':codSample', $codSample, PDO::PARAM_INT);
        $stmt->execute();
        $cadastroAmostra = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $dataCadastroAmostra = count($cadastroAmostra) === 0 ? null : $cadastroAmostra[0];

        $query = "SELECT * FROM FolhaRosto WHERE Amostra = :codSample AND N_Ensaio = :numberSample";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':codSample', $codSample, PDO::PARAM_INT);
        $stmt->bindParam(':numberSample', $numberSample, PDO::PARAM_INT);
        $stmt->execute();
        $folhaRosto = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $dataFolhaRosto = count($folhaRosto) === 0 ? null : $folhaRosto[0];

        return [
            'dataRehearsal' => $dataRehearsal,
            'dataHeaderAndFooter' => $dataHeaderAndFooter,
            'dataEnsaioCompactacao' => $dataEnsaioCompactacao,
            'dataAnaliseGranulometricaPeineiramento' => $dataAnaliseGranulometricaPeineiramento,
            'dataAnaliseGranulometricaSedimentacao' => $dataAnaliseGranulometricaSedimentacao,
            'dataMassaEspecificaRealEmGraos' => $dataMassaEspecificaRealEmGraos,
            'dataLimitesAttemberg' => $dataLimitesAttemberg,
            'dataIndiceSuporteCalifornia' => $dataIndiceSuporteCalifornia,
            'dataDeterminacaoDaMassaEspecificaAparente' => $dataDeterminacaoDaMassaEspecificaAparente,
            'dataMassaEspecificaMaxEMinDeAreia' => $dataMassaEspecificaMaxEMinDeAreia,
            'dataDeterminacaoDoCoeficienteDePermeabilidade' => $dataDeterminacaoDoCoeficienteDePermeabilidade,
            'dataDeterminacaoDoCoeficienteDePermeabilidadeConstante' => $dataDeterminacaoDoCoeficienteDePermeabilidadeConstante,
            'dataCadastroDeClientes' => $dataCadastroDeClientes,
            'dataImagemLimitesAttemberg' => $dataImagemLimitesAttemberg,
            'dataCadastroAmostra' => $dataCadastroAmostra,
            'dataFolhaRosto' => $dataFolhaRosto,
        ];
    }

    public function calcularMediaPesoEspUmido($n1, $n2, $n3)
    {
        // return var_dump($n1 !== "");
        $n1 !== null || $n1 !== "" ? $n1Float = str_replace(',', '.', $n1) : $n1Float = null;
        $n2 !== null || $n2 !== "" ? $n2Float = str_replace(',', '.', $n2) : $n2Float = null;
        $n3 !== null || $n3 !== "" ? $n3Float = str_replace(',', '.', $n3) : $n3Float = null;

        $valoresFiltrados = array_filter([$n1Float, $n2Float, $n3Float], function ($valor) {
            return $valor !== null;
        });

        $qtdMedia = 0;
        if ($n1Float !== "") {
            $qtdMedia++;
        }
        if ($n2Float !== "") {
            $qtdMedia++;
        }
        if ($n3Float !== "") {
            $qtdMedia++;
        }

        if (count($valoresFiltrados) > 0) {
            $soma = array_sum($valoresFiltrados);

            return number_format((float) ($soma / $qtdMedia), 3, ',', '.');
        } else {
            return (float) 0.0;
        }
    }
}
