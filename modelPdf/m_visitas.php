<?php
ini_set('default_charset', 'UTF-8');
require('../lib/fpdf/fpdf.php');

class PDF extends FPDF
{
    protected $fontFamily = 'Arial';
    protected $headerFontSize = 16;
    protected $labelFontSize = 12;
    protected $contentFontSize = 11;

    protected $logoPath = '../img/IGARDI.png'; // Ruta predeterminada del logo

    function __construct($cia)
    {
        parent::__construct();
        $this->setLogoPath($cia);
    }

    private function setLogoPath($cia)
    {
        switch ($cia) {
            case 'eyh':
                $this->logoPath = '../img/equipos.png'; // Ruta para logo 'eyh'
                break;
            default:
                $this->logoPath = '../img/IGARDI.png'; // Logo predeterminado
                break;
        }
    }

    function Header()
    {
        $this->Image($this->logoPath, 10, 6, 30);
        $this->SetFont($this->fontFamily, 'B', $this->headerFontSize);
        $this->Cell(0, 10, 'Registro de Visita', 0, 1, 'C');
        $this->Line(10, 20, 200, 20);
        $this->Ln(10);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont($this->fontFamily, 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    function AddLabelValueCell($label, $value)
    {
        $this->SetFont($this->fontFamily, 'B', $this->labelFontSize);
        $this->Cell(50, 10, utf8_decode($label), 0, 0, 'L');

        $this->SetFont($this->fontFamily, '', $this->contentFontSize);
        $this->MultiCell(0, 10, utf8_decode($value), 0, 'L');
    }

    function AddSignatures()
    {
        $this->Ln(20);
        $this->Cell(80, 5, '', 'B', 0, 'C'); // Línea de firma para Visitador
        $this->Cell(30, 5, '', 0, 0); // Espacio entre las firmas
        $this->Cell(80, 5, '', 'B', 1, 'C'); // Línea de firma para Recepción

        $this->Cell(80, 10, 'Gerente', 0, 0, 'C');
        $this->Cell(30, 10, '', 0, 0); // Espacio entre las etiquetas
        $this->Cell(80, 10, 'Cliente', 0, 1, 'C');
    }
}

class modelPdf
{
    public function visit($array)
    {
        
        $data = $array[0];
        $cia = $data['cia'];

        $pdf = new PDF($cia);
        $pdf->AliasNbPages();
        $pdf->AddPage();
        // Asegurar que los datos estén en UTF-8
        foreach ($data as $key => $value) {
            $data[$key] = mb_convert_encoding($value, 'ISO-8859-1', 'UTF-8');
        }
        // Mostrar datos en el PDF
        $pdf->AddLabelValueCell('RUC:', $data['ruc']);
        $pdf->AddLabelValueCell('Nombre de Cliente:', $data['nomper']);
        $pdf->AddLabelValueCell('Vendedor:', $data['vendedor']);
        $pdf->AddLabelValueCell('Motivo:', $data['motivo']);
        $pdf->AddLabelValueCell('Fecha de Visita:', $data['fec_visit']);
        $pdf->AddLabelValueCell('Hora de Visita:', $data['hora_visit']);
        $pdf->AddLabelValueCell('Distrito:', 'capacitación');
        $pdf->AddLabelValueCell('Dirección:', $data['direccion']);
        //$pdf->AddLabelValueCell('Contacto:', $data['contacto']);
        $pdf->AddLabelValueCell('Descripción:', $data['descrip']);

        // Añadir el área de firmas
        $pdf->AddSignatures();

        // Generar el PDF y enviarlo para descarga
        // Asegurar que los encabezados se envían antes del contenido
        //header('Content-Type: text/html; charset=utf-8');
        header('Content-Type: application/pdf; charset=utf-8');
        header('Content-Disposition: attachment; filename="registro_visita.pdf"');
        header('Content-Transfer-Encoding: binary');

        // Output del PDF al navegador
        $pdf->Output('D', 'registro_visita.pdf');
    }
}
?>
