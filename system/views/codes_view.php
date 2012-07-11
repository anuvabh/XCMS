<?php
$this->load->library('fpdf/fpdf');
class PDF extends FPDF
{
    protected $BID;
    protected $BSID;
    public function __construct($a, $b)
    {
        parent::__construct();
        $this->BID = $a;
        $this->BSID = $b;
    }
    // Page header
    function Header()
    {
        // Logo
        $this->Image('images/150yrsLogo.gif',12,12,23);
        
        $this->SetFont('Times','B',12);
        // Move to the right
        $this->Cell(25);
        // Title
        $this->Cell(35,17,'St. Xavier\'s (Autonomous) College,',0,0,'L');
        // Line break
        $this->Ln(5);
        $this->SetFont('Times','',12);
        $this->Cell(25);
        $this->Cell(35,17,'30 Mother Teresa Sarani,',0,0,'L');
        
        $this->Ln(5);
        $this->SetFont('Times','',12);
        $this->Cell(25);
        $this->Cell(35,17,'Kolkata 700016',0,0,'L');
        $this->Ln(5);
        $this->SetFont('Times','I',12);
        $this->Cell(0,17,"Set Number: ".$this->BID." / ".$this->BSID,0,0,'R');
        $this->Ln(25);

    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        
        $this->SetFont('Times','I',8);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

// Instanciation of inherited class
$pdf = new PDF($blockID,$blockSetID);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','BU',15);
$pdf->Cell(0,10,"Registration Codes",0,0,'C');

$pdf->Ln();
$pdf->SetFont('Times','B',12);
$pdf->Cell(70,11,"Code",0,0,'R');
$pdf->Cell(10);
$pdf->Cell(80,11,"Signature of Student",0,1,'C');
$pdf->SetFont('Times','',11);
for ($i = 0; $i<$limit; $i++)
{	
	$pdf->Cell(70,10,$codes[$i],0,0,'R');
	$pdf->Cell(10);
	$pdf->Cell(80,10,"_______________________________",0,1,'C');

}
$pdf->Output();
