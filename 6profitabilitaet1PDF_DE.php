<?php

require("fpdf.php");

$pdf = new FPDF();

//Daten des Unternehmens
$p_name = $_GET['name'];
$p_isin = $_GET['isin'];
$p_jahr_geschaeftsbericht = $_GET['aktuellesJahr'];
$p_waerhung = $_GET['waehrung'];
$p_einheit = $_GET['einheit'];
$p_zeitraum = 0;

//Initialisierung der Werte Anfang_______________________________________

$p_umsatz[0] = $_GET['umsatz0'];
$p_abschreibungen[0] = $_GET['abschreibungen0'];
$p_ebit[0] = $_GET['ebit0'];
$p_zinsaufwendungen[0] = $_GET['zinsaufwendungen0'];
$p_steuern[0] = $_GET['steuern0'];
$p_jahresueberschuss[0] = $_GET['jahresueberschuss0'];

$p_bilanzsumme[0] = $_GET['bilanzsumme0'];
$p_eigenkapital[0] = $_GET['eigenkapital0'];
$p_anlagevermoegen[0] = $_GET['anlagevermoegen0'];
$p_vorraete[0] = $_GET['vorraete0'];
$p_forderungenLuL[0] = $_GET['forderungenLuL0'];
$p_verbindlichkeitenLuL[0] = $_GET['verbindlichkeitenLuL0'];

$p_cashflowOperativ[0] = $_GET['operaCashFlow0'];
$p_cashflowInvestiv[0] = $_GET['investCashFlow0'];

//Initialisierung der Werte Ende__________________________________________

//Rechnungen Kennzahlen Anfang___________________________________________________________________________

for($p_i = $p_zeitraum; $p_i >= 0; $p_i--){
    $p_ebt[$p_i] = $p_jahresueberschuss[$p_i]+$p_steuern[$p_i];
    $p_ebitda[$p_i] = $p_ebit[$p_i]+$p_abschreibungen[$p_i];
    $p_cashflowFrei[$p_i] = $p_cashflowOperativ[$p_i]+$p_cashflowInvestiv[$p_i];

    $p_eigenkapitalrendite_JUE[$p_i] = round(100* $p_jahresueberschuss[$p_i]/$p_eigenkapital[$p_i],2);
    $p_eigenkapitalrendite_FCF[$p_i] = round(100* $p_cashflowFrei[$p_i]/$p_eigenkapital[$p_i],2);
    $p_roce[$p_i] = round(100*  $p_ebit[$p_i] / ($p_anlagevermoegen[$p_i]+$p_vorraete[$p_i]+$p_forderungenLuL[$p_i]-$p_verbindlichkeitenLuL[$p_i]),2);
    $p_roic[$p_i] = round(100* ($p_jahresueberschuss[$p_i]+$p_zinsaufwendungen[$p_i])/$p_bilanzsumme[$p_i],2);
    $p_marge_FCF[$p_i] = round(100* $p_cashflowFrei[$p_i]/$p_umsatz[$p_i],2);
    $p_marge_ebit[$p_i] = round(100* $p_ebit[$p_i]/$p_umsatz[$p_i],2);
    $p_marge_ebitda[$p_i] = round(100* $p_ebitda[$p_i]/$p_umsatz[$p_i],2);
    $p_marge_nopat[$p_i] = round(100* ($p_jahresueberschuss[$p_i]+$p_zinsaufwendungen[$p_i])/$p_umsatz[$p_i],2);
    $p_steuerquote[$p_i] = round(100* $p_steuern[$p_i]/($p_steuern[$p_i]+$p_jahresueberschuss[$p_i]),2);
}

//Rechnungen Kennzahlen Ende_____________________________________________________________________________

//Einbindung Wasserzeichen Anfang________________________________________________________________________

class PDF_Rotate extends FPDF
{
var $angle=0;

function Rotate($angle,$x=-1,$y=-1)
{
    if($x==-1)
        $x=$this->x;
    if($y==-1)
        $y=$this->y;
    if($this->angle!=0)
        $this->_out('Q');
    $this->angle=$angle;
    if($angle!=0)
    {
        $angle*=M_PI/180;
        $c=cos($angle);
        $s=sin($angle);
        $cx=$x*$this->k;
        $cy=($this->h-$y)*$this->k;
        $this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm',$c,$s,-$s,$c,$cx,$cy,-$cx,-$cy));
    }
}

function _endpage()
{
    if($this->angle!=0)
    {
        $this->angle=0;
        $this->_out('Q');
    }
    parent::_endpage();
}
}

class PDF extends PDF_Rotate
{
function Header()
{
    //Put the watermark
    $this->SetFont('Arial','B',50);
    $this->SetTextColor(255,192,203);
    $this->RotatedText(35,185,'www.upstream-view.com',45);
}

function RotatedText($x, $y, $txt, $angle)
{
    //Text rotated around its origin
    $this->Rotate($angle,$x,$y);
    $this->Text($x,$y,$txt);
    $this->Rotate(0);
}
}

$pdf=new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);

//Einbindung Wasserzeichen Ende________________________________________________________________________

//Titel der Seite
$pdf->SetTitle('Do not become biased');

//Überschrift
$pdf->SetTextColor(255,0,0);
$pdf->SetFont("Arial","B",14);
$pdf->Cell(0,5,'"An insight-driven overview - knowledge shapes investing"',1,1,'C');
//Abstand 
$pdf->Cell(0,5,'',0,1,'C');

//Kopf mit grundlegenden Informationen

$pdf->SetTextColor(0,0,0);
$pdf->SetFont("Arial","B",12);
$pdf->Cell(130,5,'Unternehmensname: ',0,0); $pdf->SetFont("Arial","",12); $pdf->Cell(70,5,$p_name,0,1,'L');
$pdf->SetFont("Arial","B",12);
$pdf->Cell(130,5,'ISIN: ',0,0); $pdf->SetFont("Arial","",12); $pdf->Cell(70,5,$p_isin,0,1,'L');
$pdf->SetFont("Arial","B",12);
$pdf->Cell(130,5,utf8_decode('Jahr (Aktuellster Geschäftsbericht): '),0,0); $pdf->SetFont("Arial","",12); $pdf->Cell(70,5,$p_jahr_geschaeftsbericht,0,1,'L');
$pdf->SetFont("Arial","B",12);
$pdf->Cell(130,5,utf8_decode('Währung: '),0,0,'L'); $pdf->SetFont("Arial","",12); $pdf->Cell(70,5,$p_waerhung,0,1,'L');
$pdf->SetFont("Arial","B",12);
$pdf->Cell(130,5,'Einheit: ',0,0,'L'); $pdf->SetFont("Arial","",12); $pdf->Cell(70,5,$p_einheit,0,1,'L');
$pdf->Cell(190,5,'Einjahreszeitraum', 0,0, 'R');

//Abstand 
$pdf->Cell(0,5,'',0,1,'C');

//Abtrennung
$pdf->Cell(190,0,'',1,1,'C');

//Daten (Gewinn-/Verlustrechnung)
$pdf->SetTextColor(255,0,0);
$pdf->SetFont("Arial","B",12);
//Abstand nach Abtrennung
$pdf->Cell(0,2,'',0,1,'C');
$pdf->Cell(0,5,'Daten (Gewinn-/Verlustrechnung): ',0,2,'L');

//Erste Zeile Design
$pdf->SetTextColor(0,0,0);
$pdf->SetFont("Arial","B",12);
$pdf->Cell(47.5,5,'Umsatz',1,0,'C'); $pdf->Cell(47.5,5,'EBITDA',1,0,'C'); $pdf->Cell(47.5,5,'Abschreibungen',1,0,'C'); $pdf->Cell(47.5,5,'EBIT',1,0,'C');
//Ausgabe Zeilen
for($p_i = $p_zeitraum; $p_i >= 0; $p_i--){
    //Abstand
    $pdf->Cell(0,5,'',0,1,'C');
    $pdf->SetFont("Arial","",12);
    $pdf->Cell(47.5,5,$p_umsatz[$p_i],1,0,'C'); $pdf->Cell(47.5,5,$p_ebitda[$p_i],1,0,'C'); $pdf->Cell(47.5,5,$p_abschreibungen[$p_i],1,0,'C'); $pdf->Cell(47.5,5,$p_ebit[$p_i],1,0,'C');   
}

//Zweite Zeile Design
//Abstand 
$pdf->Cell(0,5,'',0,1,'C');
$pdf->SetFont("Arial","B",12);
$pdf->Cell(47.5,5,'Zinsaufwendungen',1,0,'C'); $pdf->Cell(47.5,5,'EBT',1,0,'C'); $pdf->Cell(47.5,5,'Steuern',1,0,'C'); $pdf->Cell(47.5,5,utf8_decode('Jahresüberschuss'),1,0,'C');
//Ausgabe Zeilen
for($p_i = $p_zeitraum; $p_i >= 0; $p_i--){
    //Abstand
    $pdf->Cell(0,5,'',0,1,'C');
    $pdf->SetFont("Arial","",12);
    $pdf->Cell(47.5,5,$p_zinsaufwendungen[$p_i],1,0,'C'); $pdf->Cell(47.5,5,$p_ebt[$p_i],1,0,'C'); $pdf->Cell(47.5,5,$p_steuern[$p_i],1,0,'C'); $pdf->Cell(47.5,5,$p_jahresueberschuss[$p_i],1,0,'C');
}
//Abstand 
$pdf->Cell(0,5,'',0,1,'C');

//Abtrennung
$pdf->Cell(190,0,'',1,1,'C');

//Daten (Bilanz)
$pdf->SetTextColor(255,0,0);
$pdf->SetFont("Arial","B",12);
//Abstand nach Abtrennung
$pdf->Cell(0,2,'',0,1,'C');
$pdf->Cell(0,5,'Daten (Bilanz): ',0,2,'L');

//Erste Zeile Design
$pdf->SetTextColor(0,0,0);
$pdf->SetFont("Arial","B",12);
$pdf->Cell(47.5,5,'Bilanzsumme',1,0,'C'); $pdf->Cell(47.5,5,'Eigenkapital',1,0,'C'); $pdf->Cell(47.5,5,'Fremdkapital',1,0,'C'); 
//Ausgabe Zeilen
for($p_i = $p_zeitraum; $p_i >= 0; $p_i--){
    //Abstand
    $pdf->Cell(0,5,'',0,1,'C');
    $pdf->SetFont("Arial","",12);
    $pdf->Cell(47.5,5,$p_bilanzsumme[$p_i],1,0,'C'); $pdf->Cell(47.5,5,$p_eigenkapital[$p_i],1,0,'C'); $pdf->Cell(47.5,5,$p_bilanzsumme[$p_i]-$p_eigenkapital[$p_i],1,0,'C');
}

//Zweite Zeile Design
//Abstand 
$pdf->Cell(0,5,'',0,1,'C');
$pdf->SetFont("Arial","B",12);
$pdf->Cell(47.5,5,utf8_decode('Anlagevermögen'),1,0,'C'); $pdf->Cell(47.5,5,utf8_decode('Umlaufvermögen'),1,0,'C'); 
//Ausgabe Zeilen
for($p_i = $p_zeitraum; $p_i >= 0; $p_i--){
    //Abstand
    $pdf->Cell(0,5,'',0,1,'C');
    $pdf->SetFont("Arial","",12);
    $pdf->Cell(47.5,5,$p_anlagevermoegen[$p_i],1,0,'C'); $pdf->Cell(47.5,5,$p_bilanzsumme[$p_i]-$p_anlagevermoegen[$p_i],1,0,'C'); 
}
 
//Dritte Zeile Design
//Abstand 
$pdf->Cell(0,5,'',0,1,'C');
$pdf->SetFont("Arial","B",12);
$pdf->Cell(47.5,5,utf8_decode('Vorräte'),1,0,'C'); $pdf->Cell(47.5,5,'Forderungen LuL',1,0,'C'); $pdf->Cell(47.5,5,utf8_decode('Verbindlichkeiten LuL'),1,0,'C');
//Ausgabe Zeilen
for($p_i = $p_zeitraum; $p_i >= 0; $p_i--){
    //Abstand
    $pdf->Cell(0,5,'',0,1,'C');
    $pdf->SetFont("Arial","",12);
    $pdf->Cell(47.5,5,$p_vorraete[$p_i],1,0,'C'); $pdf->Cell(47.5,5,$p_forderungenLuL[$p_i],1,0,'C'); $pdf->Cell(47.5,5,$p_verbindlichkeitenLuL[$p_i],1,0,'C');
}

//Abstand 
$pdf->Cell(0,5,'',0,1,'C');

//Abtrennung
$pdf->Cell(95,0,'',1,1,'C');

//Daten (Kapitalflussrechnung)
$pdf->SetTextColor(255,0,0);
$pdf->SetFont("Arial","B",12);
//Abstand nach Abtrennung
$pdf->Cell(0,2,'',0,1,'C');
$pdf->Cell(0,5,'Daten (Kapitalflussrechnung): ',0,2,'L');

//Erste Zeile Design
$pdf->SetTextColor(0,0,0);
$pdf->SetFont("Arial","B",12);
$pdf->Cell(47.5,5,'Opera. Cash Flow',1,0,'C'); $pdf->Cell(47.5,5,'Invest. Cash Flow',1,0,'C'); $pdf->Cell(47.5,5,'Freier Cash Flow',1,0,'C');
//Ausgabe Zeilen
for($p_i = $p_zeitraum; $p_i >= 0; $p_i--){
    //Abstand
    $pdf->Cell(0,5,'',0,1,'C');
    $pdf->SetFont("Arial","",12);
    $pdf->Cell(47.5,5,$p_cashflowOperativ[$p_i],1,0,'C'); $pdf->Cell(47.5,5,$p_cashflowInvestiv[$p_i],1,0,'C'); $pdf->Cell(47.5,5,$p_cashflowFrei[$p_i],1,0,'C');
}

//_____________________________________

//Neue Seite
$pdf->AddPage();

//Überschrift
$pdf->SetTextColor(255,0,0);
$pdf->SetFont("Arial","B",14);
$pdf->Cell(0,5,'"An insight-driven overview - knowledge shapes investing"',1,1,'C');

//Abstand 
$pdf->Cell(0,5,'',0,1,'C');

//Erste Zeile Design
$pdf->SetTextColor(0,0,0);
$pdf->SetFont("Arial","B",11);
$pdf->Cell(47.5,5,'Eigenkapitalrendite| FCF',1,0,'C'); $pdf->Cell(47.5,5,utf8_decode('Eigenkapitalrendite| JÜ'),1,0,'C'); $pdf->SetFont("Arial","B",12); $pdf->Cell(47.5,5,'ROIC',1,0,'C'); $pdf->Cell(47.5,5,'ROCE',1,0,'C');
//Ausgabe Zeilen
for($p_i = $p_zeitraum; $p_i >= 0; $p_i--){
    //Abstand
    $pdf->Cell(0,5,'',0,1,'C');
    $pdf->SetFont("Arial","",12);
    $pdf->Cell(47.5,5,$p_eigenkapitalrendite_FCF[$p_i].'%',1,0,'C'); $pdf->Cell(47.5,5,$p_eigenkapitalrendite_JUE[$p_i].'%',1,0,'C'); $pdf->Cell(47.5,5,$p_roic[$p_i].'%',1,0,'C'); $pdf->Cell(47.5,5,$p_roce[$p_i].'%',1,0,'C');
}
//Abstand 
$pdf->Cell(0,5,'',0,1,'C');

//Zweite Zeile Design
//Abstand 
$pdf->Cell(0,5,'',0,1,'C');
$pdf->SetFont("Arial","B",12);
$pdf->Cell(47.5,5,'FCF-Marge',1,0,'C'); $pdf->Cell(47.5,5,'EBIT-Marge',1,0,'C'); $pdf->Cell(47.5,5,'EBITDA-Marge',1,0,'C'); $pdf->Cell(47.5,5,'NOPAT-Marge',1,0,'C');
//Ausgabe Zeilen
for($p_i = $p_zeitraum; $p_i >= 0; $p_i--){
    //Abstand
    $pdf->Cell(0,5,'',0,1,'C');
    $pdf->SetFont("Arial","",12);
    $pdf->Cell(47.5,5,$p_marge_FCF[$p_i].'%',1,0,'C'); $pdf->Cell(47.5,5,$p_marge_ebit[$p_i].'%',1,0,'C'); $pdf->Cell(47.5,5,$p_marge_ebitda[$p_i].'%',1,0,'C'); $pdf->Cell(47.5,5,$p_marge_nopat[$p_i].'%',1,0,'C');
}
//Abstand 
$pdf->Cell(0,5,'',0,1,'C');

//Dritte Zeile Design
//Abstand 
$pdf->Cell(0,5,'',0,1,'C');
$pdf->SetFont("Arial","B",12);
$pdf->Cell(47.5,5,'Steuerquote',1,0,'C');
//Ausgabe Zeilen
for($p_i = $p_zeitraum; $p_i >= 0; $p_i--){
    //Abstand
    $pdf->Cell(0,5,'',0,1,'C');
    $pdf->SetFont("Arial","",12);
    $pdf->Cell(47.5,5,$p_steuerquote[$p_i].'%',1,0,'C');
}
//Ausgabe
$pdf->Output('Profitability1_'.$p_name.'_'.$p_isin.'.pdf', 'D');
?>