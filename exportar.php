<?php
include('conexion.php');
$db = conexion();

if (isset($_GET['format'])) {
    $format = $_GET['format'];

    if ($format == 'excel') {
        exportExcel($db);
    } elseif ($format == 'pdf') {
        exportPDF($db);
    }
}

function exportExcel($db) {
    require 'vendor/autoload.php'; // Cargar PhpSpreadsheet
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Establecer cabeceras
    $sheet->setCellValue('A1', 'ID');
    $sheet->setCellValue('B1', 'Documento');
    $sheet->setCellValue('C1', 'Nombre');
    $sheet->setCellValue('D1', 'Apellido');
    $sheet->setCellValue('E1', 'Dirección');
    $sheet->setCellValue('F1', 'Celular');

    $query = "SELECT * FROM persona";
    $result = pg_query($db, $query);
    
    if ($result) {
        $rowNum = 2; // Comenzar desde la segunda fila
        while ($row = pg_fetch_assoc($result)) {
            $sheet->setCellValue('A' . $rowNum, $row['idpersona']);
            $sheet->setCellValue('B' . $rowNum, $row['documento']);
            $sheet->setCellValue('C' . $rowNum, $row['nombre']);
            $sheet->setCellValue('D' . $rowNum, $row['apellido']);
            $sheet->setCellValue('E' . $rowNum, $row['direccion']);
            $sheet->setCellValue('F' . $rowNum, $row['celular']);
            $rowNum++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'personas.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'. $filename .'"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}

function exportPDF($db) {
    require 'vendor/fpdf/fpdf.php';

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 12);

    // Cabeceras
    $pdf->Cell(10, 10, 'ID', 1);
    $pdf->Cell(30, 10, 'Documento', 1);
    $pdf->Cell(30, 10, 'Nombre', 1);
    $pdf->Cell(30, 10, 'Apellido', 1);
    $pdf->Cell(50, 10, 'Dirección', 1);
    $pdf->Cell(30, 10, 'Celular', 1);
    $pdf->Ln();

    $query = "SELECT * FROM persona";
    $result = pg_query($db, $query);
    
    if ($result) {
        while ($row = pg_fetch_assoc($result)) {
            $pdf->Cell(10, 10, $row['idpersona'], 1);
            $pdf->Cell(30, 10, $row['documento'], 1);
            $pdf->Cell(30, 10, $row['nombre'], 1);
            $pdf->Cell(30, 10, $row['apellido'], 1);
            $pdf->Cell(50, 10, $row['direccion'], 1);
            $pdf->Cell(30, 10, $row['celular'], 1);
            $pdf->Ln();
        }

        $pdf->Output('D', 'personas.pdf');
        exit;
    }
}

pg_close($db);
?>
