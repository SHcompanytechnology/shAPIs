<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
include_once('configureteConnection.php');
require_once 'mainSheet.php';


class GenerateReports
{
    private $json_data;

    public function __construct($json_data)
    {
        $this->json_data = $json_data;
    }

    public function generateReport()
    {
        $data = json_decode($this->json_data);
        $codSample = intval($data->amostra);
        $numberSample = intval($data->numeroAmostra);
        $reportsSelect = $data->relatoriosSelecionados;
        $responsibility = $data->responsabilidadeAmostra;
        $classification1 = $data->classificacao1;
        $classification2 = $data->classificacao2;
        $descriptionSolo = $data->descricaoSolo;
        $observation = $data->observacao;

        $inundado = $data->inundado;

        $conexao = new ConfigureteConnection();
        $conexao->connect();

        $pdo = $conexao->getConnection();

        if ($pdo === null) {
            return null;
        }

        $checkQuery = $pdo->prepare("SELECT * FROM FolhaRosto WHERE Amostra = :codSample AND N_Ensaio = :numberSample");
        $checkQuery->bindParam(':codSample', $codSample, PDO::PARAM_STR);
        $checkQuery->bindParam(':numberSample', $numberSample, PDO::PARAM_STR);
        $checkQuery->execute();

        if ($checkQuery->rowCount() > 0) {

            $updateQuery = $pdo->prepare("UPDATE FolhaRosto SET Responsabilidade_Amostragem = :responsibility, DescricaoDoSolo = :descriptionSolo, Class_1 = :classification1, Class_2 = :classification2, Inundado_naoinundado = :inundado WHERE Amostra = :codSample AND N_Ensaio = :numberSample");
            $updateQuery->bindValue(":responsibility", $responsibility);
            $updateQuery->bindValue(":descriptionSolo", $descriptionSolo);
            $updateQuery->bindValue(":classification1", $classification1);
            $updateQuery->bindValue(":classification2", $classification2);
            $updateQuery->bindValue(":inundado", $inundado);
            $updateQuery->bindValue(":codSample", $codSample, PDO::PARAM_STR);
            $updateQuery->bindValue(":numberSample", $numberSample, PDO::PARAM_STR);
            $updateQuery->execute();
        } else {
            $insertQuery = $pdo->prepare("INSERT INTO FolhaRosto (Amostra, N_Ensaio, Responsabilidade_Amostragem, DescricaoDoSolo, Class_1, Class_2, Inundado_naoinundado) VALUES (:codSample, :numberSample, :responsibility, :descriptionSolo, :classification1, :classification2, :inundado)");
            $insertQuery->bindValue(":codSample", $codSample, PDO::PARAM_STR);
            $insertQuery->bindValue(":numberSample", $numberSample, PDO::PARAM_STR);
            $insertQuery->bindValue(":responsibility", $responsibility);
            $insertQuery->bindValue(":descriptionSolo", $descriptionSolo);
            $insertQuery->bindValue(":classification1", $classification1);
            $insertQuery->bindValue(":classification2", $classification2);
            $insertQuery->bindValue(":inundado", $inundado);
            $insertQuery->execute();
        }

        $mainSheet = new MainSheet();

        $resultMainSheet = $mainSheet->generateMainSheet(
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

        return json_encode($resultMainSheet);
    }
}

// $getCodSample = $_GET['codSample'];
// $getReportsSelect = $_GET['reportsSelect'];
$json_data = file_get_contents('php://input');
$generateReports = new GenerateReports($json_data);
// $response = $generateReports->generateReport();

$generateReports->generateReport();
