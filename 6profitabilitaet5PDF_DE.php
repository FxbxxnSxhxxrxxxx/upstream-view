<?php

require("fpdf.php");

$pdf = new FPDF();

//Daten des Unternehmens
$p_name = $_PUT['name'];
$p_isin = $_PUT['isin'];
$p_jahr_geschaeftsbericht = $_PUT['aktuellesJahr'];
$p_waerhung = $_PUT['waehrung'];
$p_einheit = $_PUT['einheit'];
$p_zeitraum = 4;

//Initialisierung der Werte Anfang_______________________________________

$p_umsatz[0] = $_PUT['umsatz0'];
$p_umsatz[1] = $_PUT['umsatz1'];
$p_umsatz[2] = $_PUT['umsatz2'];
$p_umsatz[3] = $_PUT['umsatz3'];
$p_umsatz[4] = $_PUT['umsatz4'];

$p_abschreibungen[0] = $_PUT['abschreibungen0'];
$p_abschreibungen[1] = $_PUT['abschreibungen1'];
$p_abschreibungen[2] = $_PUT['abschreibungen2'];
$p_abschreibungen[3] = $_PUT['abschreibungen3'];
$p_abschreibungen[4] = $_PUT['abschreibungen4'];
$p_ebit[0] = $_PUT['ebit0'];
$p_ebit[1] = $_PUT['ebit1'];
$p_ebit[2] = $_PUT['ebit2'];
$p_ebit[3] = $_PUT['ebit3'];
$p_ebit[4] = $_PUT['ebit4'];
$p_zinsaufwendungen[0] = $_PUT['zinsaufwendungen0'];
$p_zinsaufwendungen[1] = $_PUT['zinsaufwendungen1'];
$p_zinsaufwendungen[2] = $_PUT['zinsaufwendungen2'];
$p_zinsaufwendungen[3] = $_PUT['zinsaufwendungen3'];
$p_zinsaufwendungen[4] = $_PUT['zinsaufwendungen4'];

$p_steuern[0] = $_PUT['steuern0'];
$p_steuern[1] = $_PUT['steuern1'];
$p_steuern[2] = $_PUT['steuern2'];
$p_steuern[3] = $_PUT['steuern3'];
$p_steuern[4] = $_PUT['steuern4'];
$p_jahresueberschuss[0] = $_PUT['jahresueberschuss0'];
$p_jahresueberschuss[1] = $_PUT['jahresueberschuss1'];
$p_jahresueberschuss[2] = $_PUT['jahresueberschuss2'];
$p_jahresueberschuss[3] = $_PUT['jahresueberschuss3'];
$p_jahresueberschuss[4] = $_PUT['jahresueberschuss4'];

$p_bilanzsumme[0] = $_PUT['bilanzsumme0'];
$p_bilanzsumme[1] = $_PUT['bilanzsumme1'];
$p_bilanzsumme[2] = $_PUT['bilanzsumme2'];
$p_bilanzsumme[3] = $_PUT['bilanzsumme3'];
$p_bilanzsumme[4] = $_PUT['bilanzsumme4'];
$p_eigenkapital[0] = $_PUT['eigenkapital0'];
$p_eigenkapital[1] = $_PUT['eigenkapital1'];
$p_eigenkapital[2] = $_PUT['eigenkapital2'];
$p_eigenkapital[3] = $_PUT['eigenkapital3'];
$p_eigenkapital[4] = $_PUT['eigenkapital4'];
$p_anlagevermoegen[0] = $_PUT['anlagevermoegen0'];
$p_anlagevermoegen[1] = $_PUT['anlagevermoegen1'];
$p_anlagevermoegen[2] = $_PUT['anlagevermoegen2'];
$p_anlagevermoegen[3] = $_PUT['anlagevermoegen3'];
$p_anlagevermoegen[4] = $_PUT['anlagevermoegen4'];
$p_vorraete[0] = $_PUT['vorraete0'];
$p_vorraete[1] = $_PUT['vorraete1'];
$p_vorraete[2] = $_PUT['vorraete2'];
$p_vorraete[3] = $_PUT['vorraete3'];
$p_vorraete[4] = $_PUT['vorraete4'];
$p_forderungenLuL[0] = $_PUT['forderungenLuL0'];
$p_forderungenLuL[1] = $_PUT['forderungenLuL1'];
$p_forderungenLuL[2] = $_PUT['forderungenLuL2'];
$p_forderungenLuL[3] = $_PUT['forderungenLuL3'];
$p_forderungenLuL[4] = $_PUT['forderungenLuL4'];
$p_verbindlichkeitenLuL[0] = $_PUT['verbindlichkeitenLuL0'];
$p_verbindlichkeitenLuL[1] = $_PUT['verbindlichkeitenLuL1'];
$p_verbindlichkeitenLuL[2] = $_PUT['verbindlichkeitenLuL2'];
$p_verbindlichkeitenLuL[3] = $_PUT['verbindlichkeitenLuL3'];
$p_verbindlichkeitenLuL[4] = $_PUT['verbindlichkeitenLuL4'];

$p_cashflowOperativ[0] = $_PUT['operaCashFlow0'];
$p_cashflowOperativ[1] = $_PUT['operaCashFlow1'];
$p_cashflowOperativ[2] = $_PUT['operaCashFlow2'];
$p_cashflowOperativ[3] = $_PUT['operaCashFlow3'];
$p_cashflowOperativ[4] = $_PUT['operaCashFlow4'];
$p_cashflowInvestiv[0] = $_PUT['investCashFlow0'];
$p_cashflowInvestiv[1] = $_PUT['investCashFlow1'];
$p_cashflowInvestiv[2] = $_PUT['investCashFlow2'];
$p_cashflowInvestiv[3] = $_PUT['investCashFlow3'];
$p_cashflowInvestiv[4] = $_PUT['investCashFlow4'];

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
$pdf->Cell(190,5,utf8_decode('Fünfjahreszeitraum'), 0,0, 'R');

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
$pdf->Output('Profitability5_'.$p_name.'_'.$p_isin.'.pdf', 'D');
?>
