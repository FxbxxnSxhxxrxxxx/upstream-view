<?php

require("fpdf.php");

$pdf = new FPDF();

//Daten des Unternehmens
$p_name = $_GET['name'];
$p_isin = $_GET['isin'];
$p_jahr_geschaeftsbericht = $_GET['aktuellesJahr'];
$p_waerhung = $_GET['waehrung'];
$p_einheit = $_GET['einheit'];
$p_zeitraum = 4;

//Initialisierung der Werte Anfang_______________________________________

$p_umsatz[0] = $_GET['umsatz0'];
$p_umsatz[1] = $_GET['umsatz1'];
$p_umsatz[2] = $_GET['umsatz2'];
$p_umsatz[3] = $_GET['umsatz3'];
$p_umsatz[4] = $_GET['umsatz4'];
$p_abschreibungen[0] = $_GET['abschreibungen0'];
$p_abschreibungen[1] = $_GET['abschreibungen1'];
$p_abschreibungen[2] = $_GET['abschreibungen2'];
$p_abschreibungen[3] = $_GET['abschreibungen3'];
$p_abschreibungen[4] = $_GET['abschreibungen4'];
$p_ebit[0] = $_GET['ebit0'];
$p_ebit[1] = $_GET['ebit1'];
$p_ebit[2] = $_GET['ebit2'];
$p_ebit[3] = $_GET['ebit3'];
$p_ebit[4] = $_GET['ebit4'];
$p_zinsaufwendungen[0] = $_GET['zinsaufwendungen0'];
$p_zinsaufwendungen[1] = $_GET['zinsaufwendungen1'];
$p_zinsaufwendungen[2] = $_GET['zinsaufwendungen2'];
$p_zinsaufwendungen[3] = $_GET['zinsaufwendungen3'];
$p_zinsaufwendungen[4] = $_GET['zinsaufwendungen4'];
$p_steuern[0] = $_GET['steuern0'];
$p_steuern[1] = $_GET['steuern1'];
$p_steuern[2] = $_GET['steuern2'];
$p_steuern[3] = $_GET['steuern3'];
$p_steuern[4] = $_GET['steuern4'];
$p_jahresueberschuss[0] = $_GET['jahresueberschuss0'];
$p_jahresueberschuss[1] = $_GET['jahresueberschuss1'];
$p_jahresueberschuss[2] = $_GET['jahresueberschuss2'];
$p_jahresueberschuss[3] = $_GET['jahresueberschuss3'];
$p_jahresueberschuss[4] = $_GET['jahresueberschuss4'];

$p_bilanzsumme[0] = $_GET['bilanzsumme0'];
$p_bilanzsumme[1] = $_GET['bilanzsumme1'];
$p_bilanzsumme[2] = $_GET['bilanzsumme2'];
$p_bilanzsumme[3] = $_GET['bilanzsumme3'];
$p_bilanzsumme[4] = $_GET['bilanzsumme4'];
$p_eigenkapital[0] = $_GET['eigenkapital0'];
$p_eigenkapital[1] = $_GET['eigenkapital1'];
$p_eigenkapital[2] = $_GET['eigenkapital2'];
$p_eigenkapital[3] = $_GET['eigenkapital3'];
$p_eigenkapital[4] = $_GET['eigenkapital4'];
$p_kurzfrVerbind[0] = $_GET['kurzfrVerbind0'];
$p_kurzfrVerbind[1] = $_GET['kurzfrVerbind1'];
$p_kurzfrVerbind[2] = $_GET['kurzfrVerbind2'];
$p_kurzfrVerbind[3] = $_GET['kurzfrVerbind3'];
$p_kurzfrVerbind[4] = $_GET['kurzfrVerbind4'];
$p_langfrVerbind[0] = $_GET['langfrVerbind0'];
$p_langfrVerbind[1] = $_GET['langfrVerbind1'];
$p_langfrVerbind[2] = $_GET['langfrVerbind2'];
$p_langfrVerbind[3] = $_GET['langfrVerbind3'];
$p_langfrVerbind[4] = $_GET['langfrVerbind4'];
$p_anlagevermoegen[0] = $_GET['anlagevermoegen0'];
$p_anlagevermoegen[1] = $_GET['anlagevermoegen1'];
$p_anlagevermoegen[2] = $_GET['anlagevermoegen2'];
$p_anlagevermoegen[3] = $_GET['anlagevermoegen3'];
$p_anlagevermoegen[4] = $_GET['anlagevermoegen4'];
$p_sachanlagen[0] = $_GET['sachanlagen0'];
$p_sachanlagen[1] = $_GET['sachanlagen1'];
$p_sachanlagen[2] = $_GET['sachanlagen2'];
$p_sachanlagen[3] = $_GET['sachanlagen3'];
$p_sachanlagen[4] = $_GET['sachanlagen4'];
$p_goodwill[0] = $_GET['goodwill0'];
$p_goodwill[1] = $_GET['goodwill1'];
$p_goodwill[2] = $_GET['goodwill2'];
$p_goodwill[3] = $_GET['goodwill3'];
$p_goodwill[4] = $_GET['goodwill4'];
$p_immaterielleVermoegensw[0] = $_GET['immaterielleVermoegensw0'];
$p_immaterielleVermoegensw[1] = $_GET['immaterielleVermoegensw1'];
$p_immaterielleVermoegensw[2] = $_GET['immaterielleVermoegensw2'];
$p_immaterielleVermoegensw[3] = $_GET['immaterielleVermoegensw3'];
$p_immaterielleVermoegensw[4] = $_GET['immaterielleVermoegensw4'];
$p_finanzanlagen[0] = $_GET['finanzanlagen0'];
$p_finanzanlagen[1] = $_GET['finanzanlagen1'];
$p_finanzanlagen[2] = $_GET['finanzanlagen2'];
$p_finanzanlagen[3] = $_GET['finanzanlagen3'];
$p_finanzanlagen[4] = $_GET['finanzanlagen4'];
$p_liquideMittel[0] = $_GET['liquideMittel0'];
$p_liquideMittel[1] = $_GET['liquideMittel1'];
$p_liquideMittel[2] = $_GET['liquideMittel2'];
$p_liquideMittel[3] = $_GET['liquideMittel3'];
$p_liquideMittel[4] = $_GET['liquideMittel4'];
$p_vorraete[0] = $_GET['vorraete0'];
$p_vorraete[1] = $_GET['vorraete1'];
$p_vorraete[2] = $_GET['vorraete2'];
$p_vorraete[3] = $_GET['vorraete3'];
$p_vorraete[4] = $_GET['vorraete4'];
$p_forderungenLuL[0] = $_GET['forderungenLuL0'];
$p_forderungenLuL[1] = $_GET['forderungenLuL1'];
$p_forderungenLuL[2] = $_GET['forderungenLuL2'];
$p_forderungenLuL[3] = $_GET['forderungenLuL3'];
$p_forderungenLuL[4] = $_GET['forderungenLuL4'];
$p_verbindlichkeitenLuL[0] = $_GET['verbindlichkeitenLuL0'];
$p_verbindlichkeitenLuL[1] = $_GET['verbindlichkeitenLuL1'];
$p_verbindlichkeitenLuL[2] = $_GET['verbindlichkeitenLuL2'];
$p_verbindlichkeitenLuL[3] = $_GET['verbindlichkeitenLuL3'];
$p_verbindlichkeitenLuL[4] = $_GET['verbindlichkeitenLuL4'];

$p_cashflowOperativ[0] = $_GET['operaCashFlow0'];
$p_cashflowOperativ[1] = $_GET['operaCashFlow1'];
$p_cashflowOperativ[2] = $_GET['operaCashFlow2'];
$p_cashflowOperativ[3] = $_GET['operaCashFlow3'];
$p_cashflowOperativ[4] = $_GET['operaCashFlow4'];
$p_cashflowInvestiv[0] = $_GET['investCashFlow0'];
$p_cashflowInvestiv[1] = $_GET['investCashFlow1'];
$p_cashflowInvestiv[2] = $_GET['investCashFlow2'];
$p_cashflowInvestiv[3] = $_GET['investCashFlow3'];
$p_cashflowInvestiv[4] = $_GET['investCashFlow4'];
$p_dividende_rueckkauf[0] = $_GET['dividende_rueckkauf0'];
$p_dividende_rueckkauf[1] = $_GET['dividende_rueckkauf1'];
$p_dividende_rueckkauf[2] = $_GET['dividende_rueckkauf2'];
$p_dividende_rueckkauf[3] = $_GET['dividende_rueckkauf3'];
$p_dividende_rueckkauf[4] = $_GET['dividende_rueckkauf4'];

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

    $p_eigenkapitalquote[$p_i] = round(100* $p_eigenkapital[$p_i]/$p_bilanzsumme[$p_i],2);
    $p_verhaeltnis_netdebt_ebitda[$p_i] = round( ($p_bilanzsumme[$p_i]-$p_eigenkapital[$p_i]-$p_liquideMittel[$p_i]) / $p_ebitda[$p_i],2);
    $p_dynamVerschuldungsg[$p_i] = round( ($p_bilanzsumme[$p_i]-$p_eigenkapital[$p_i]-$p_liquideMittel[$p_i]) / $p_cashflowFrei[$p_i],2);
    $p_gearing[$p_i] = round( 100* ($p_bilanzsumme[$p_i]-$p_eigenkapital[$p_i]-$p_liquideMittel[$p_i]) / $p_eigenkapital[$p_i],2);
    
    $p_zinsdeckungsgrad[$p_i] = round($p_ebit[$p_i] / $p_zinsaufwendungen[$p_i],2);
    $p_goodwill_anteil[$p_i] = round( 100* $p_goodwill[$p_i] / $p_eigenkapital[$p_i],2);
    $p_ausschuettungsquote[$p_i] = round( 100* $p_dividende_rueckkauf[$p_i] / $p_cashflowFrei[$p_i],2);

    $p_liquiditaet1[$p_i] = round( 100* ($p_liquideMittel[$p_i]+$p_finanzanlagen[$p_i]) / $p_kurzfrVerbind[$p_i],2);
    $p_liquiditaet2[$p_i] = round( 100* ($p_liquideMittel[$p_i]+$p_finanzanlagen[$p_i]+$p_forderungenLuL[$p_i]) / $p_kurzfrVerbind[$p_i],2);
    $p_liquiditaet3[$p_i] = round( 100* ($p_bilanzsumme[$p_i]-$p_anlagevermoegen[$p_i]) / $p_kurzfrVerbind[$p_i],2);

    $p_anlagendeckungsgrad1[$p_i] = round(100* $p_eigenkapital[$p_i] / $p_anlagevermoegen[$p_i],2);
    $p_anlagendeckungsgrad2[$p_i] = round(100* ($p_eigenkapital[$p_i]+$p_langfrVerbind[$p_i]) / $p_anlagevermoegen[$p_i],2);

    $p_anlagenintensitaet[$p_i] = round(100* $p_anlagevermoegen[$p_i] / $p_bilanzsumme[$p_i],2);
    $p_umlaufintensitaet[$p_i] = round(100* ($p_bilanzsumme[$p_i]-$p_anlagevermoegen[$p_i]) / $p_bilanzsumme[$p_i],2);
    $p_kapitalintensitaet[$p_i] = round(100* $p_cashflowFrei[$p_i] / $p_bilanzsumme[$p_i],2);
    $p_vorratsintensitaet[$p_i] = round(100* $p_vorraete[$p_i] / $p_bilanzsumme[$p_i],2);

    if($_GET['eigenkapitalkosten'] != null){
        $p_gesamtkapitalkosten[$p_i] = round( ($p_eigenkapital[$p_i] / $p_bilanzsumme[$p_i])* (float)$_GET['eigenkapitalkosten'] + 100* ( ( ($p_bilanzsumme[$p_i]-$p_eigenkapital[$p_i]) / $p_bilanzsumme[$p_i] )* ($p_zinsaufwendungen[$p_i] / ($p_bilanzsumme[$p_i]-$p_eigenkapital[$p_i])) ),2);
    }else
        $p_gesamtkapitalkosten[$p_i] = 'No value';
}

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

//Berechnung Substanzwert
$p_substanzwert = ( ( (100-$_GET['sicherheitsmarge']) / 100) * ( ($_GET['s'] / 100) * $p_sachanlagen[0] + ($_GET['f'] / 100) * $p_forderungenLuL[0] + ($_GET['v'] / 100) * $p_vorraete[0] + ($_GET['i'] / 100) * $p_immaterielleVermoegensw[0]) + $p_liquideMittel[0] + $p_finanzanlagen[0] - ($p_bilanzsumme[0] - $p_eigenkapital[0]) ); 

$pdf->SetTextColor(0,0,0);
$pdf->SetFont("Arial","B",12);
$pdf->Cell(130,5,'Unternehmensname: ',0,0); $pdf->SetFont("Arial","",12); $pdf->Cell(70,5,$p_name,0,1,'L');
$pdf->SetFont("Arial","B",12);
$pdf->Cell(130,5,'ISIN: ',0,0); $pdf->SetFont("Arial","",12); $pdf->Cell(70,5,$p_isin,0,1,'L');
$pdf->SetFont("Arial","B",12);
$pdf->Cell(130,5,utf8_decode('Jahr (Aktuellster Geschäftsbericht): '),0,0); $pdf->SetFont("Arial","",12); $pdf->Cell(70,5,$p_jahr_geschaeftsbericht,0,1,'L');
$pdf->SetFont("Arial","B",12);
$pdf->Cell(130,5,utf8_decode('Währung: '),0,0); $pdf->SetFont("Arial","",12); $pdf->Cell(70,5,$p_waerhung,0,1,'L');
$pdf->SetFont("Arial","B",12);
$pdf->Cell(130,5,utf8_decode('Einheit: '),0,0); $pdf->SetFont("Arial","",12); $pdf->Cell(70,5,$p_einheit,0,1,'L');
$pdf->SetFont("Arial","B",12);
$pdf->Cell(130,5,'Substanzwert ('.(100-$_GET['sicherheitsmarge']).'%) ', 0,0); $pdf->SetFont("Arial","",12); $pdf->Cell(70,5,round($p_substanzwert,2),0,1,'L');
$pdf->Cell(190,5,utf8_decode('Fünfjahreszeitraum'), 0,0,'R');

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
$pdf->Cell(47.5,5,'Bilanzsumme',1,0,'C'); $pdf->Cell(47.5,5,'Eigenkapital',1,0,'C'); $pdf->Cell(47.5,5,'Kurzfristige Verb.',1,0,'C'); $pdf->Cell(47.5,5,'Langfristige Verb.',1,0,'C');
//Ausgabe Zeilen
for($p_i = $p_zeitraum; $p_i >= 0; $p_i--){
$pdf->Cell(0,5,'',0,1,'C');
$pdf->SetFont("Arial","",12);
$pdf->Cell(47.5,5,$p_bilanzsumme[$p_i],1,0,'C'); $pdf->Cell(47.5,5,$p_eigenkapital[$p_i],1,0,'C'); $pdf->Cell(47.5,5,$p_kurzfrVerbind[$p_i],1,0,'C'); $pdf->Cell(47.5,5,$p_langfrVerbind[$p_i],1,0,'C');
}

//Zweite Zeile Design
//Abstand 
$pdf->Cell(0,5,'',0,1,'C');
$pdf->SetFont("Arial","B",12);
$pdf->Cell(47.5,5,'Verbindlichkeiten LuL',1,0,'C'); $pdf->Cell(47.5,5,'Forderungen LuL'.' ('.$_GET['f'].'%)',1,0,'C'); 
//Ausgabe Zeilen
for($p_i = $p_zeitraum; $p_i >= 0; $p_i--){
$pdf->Cell(0,5,'',0,1,'C');
$pdf->SetFont("Arial","",12);
$pdf->Cell(47.5,5,$p_verbindlichkeitenLuL[$p_i],1,0,'C'); $pdf->Cell(47.5,5,$p_forderungenLuL[$p_i],1,0,'C'); 
}

//Dritte Zeile Design
//Abstand 
$pdf->Cell(0,5,'',0,1,'C');
$pdf->SetFont("Arial","B",12);
$pdf->Cell(47.5,5,'Liquide Mittel',1,0,'C'); $pdf->Cell(47.5,5,'Finanzanlagen',1,0,'C'); $pdf->Cell(47.5,5,'Sachanlagen'.' ('.$_GET['s'].'%)',1,0,'C'); $pdf->Cell(47.5,5,utf8_decode('Vorräte'.' ('.$_GET['v'].'%)'),1,0,'C');
//Ausgabe Zeilen
for($p_i = $p_zeitraum; $p_i >= 0; $p_i--){ 
$pdf->Cell(0,5,'',0,1,'C');
$pdf->SetFont("Arial","",12);
$pdf->Cell(47.5,5,$p_liquideMittel[$p_i],1,0,'C'); $pdf->Cell(47.5,5,$p_finanzanlagen[$p_i],1,0,'C'); $pdf->Cell(47.5,5,$p_sachanlagen[$p_i],1,0,'C'); $pdf->Cell(47.5,5,$p_vorraete[$p_i],1,0,'C');
}

//Vierte Zeile Design
//Abstand 
$pdf->Cell(0,5,'',0,1,'C');
$pdf->SetFont("Arial","B",11);
$pdf->Cell(47.5,5,utf8_decode('Imm. Vermögensw.'.' ('.$_GET['i'].'%)'),1,0,'C'); $pdf->Cell(47.5,5,'Goodwill',1,0,'C'); $pdf->Cell(47.5,5,utf8_decode('Anlagevermögen'),1,0,'C'); $pdf->Cell(47.5,5,utf8_decode('Umlaufvermögen'),1,0,'C');
//Ausgabe Zeilen
for($p_i = $p_zeitraum; $p_i >= 0; $p_i--){
$pdf->Cell(0,5,'',0,1,'C');
$pdf->SetFont("Arial","",12);
$pdf->Cell(47.5,5,$p_immaterielleVermoegensw[$p_i],1,0,'C'); $pdf->Cell(47.5,5,$p_goodwill[$p_i],1,0,'C'); $pdf->Cell(47.5,5,$p_anlagevermoegen[$p_i],1,0,'C'); $pdf->Cell(47.5,5,$p_bilanzsumme[$p_i]-$p_anlagevermoegen[$p_i],1,0,'C');
}

//Abstand 
$pdf->Cell(0,5,'',0,1,'C');

//Abtrennung
$pdf->Cell(190,0,'',1,1,'C');

//_____________________________________

//Neue Seite
$pdf->AddPage();

//Daten (Kapitalflussrechnung)
$pdf->SetTextColor(255,0,0);
$pdf->SetFont("Arial","B",12);
//Abstand nach Abtrennung
$pdf->Cell(0,2,'',0,1,'C');
$pdf->Cell(0,5,'Daten (Kapitalflussrechnung): ',0,2,'L');

//Erste Zeile Design
$pdf->SetTextColor(0,0,0);
$pdf->SetFont("Arial","B",12);
$pdf->Cell(47.5,5,utf8_decode('Dividende/Rückkäufe'),1,0,'C'); $pdf->Cell(47.5,5,'Opera. Cash Flow',1,0,'C'); $pdf->Cell(47.5,5,'Invest. Cash Flow',1,0,'C'); $pdf->Cell(47.5,5,'Freier Cash Flow',1,0,'C'); 
//Ausgabe Zeilen
for($p_i = $p_zeitraum; $p_i >= 0; $p_i--){
$pdf->Cell(0,5,'',0,1,'C');
$pdf->SetFont("Arial","",12);
$pdf->Cell(47.5,5,$p_dividende_rueckkauf[$p_i],1,0,'C'); $pdf->Cell(47.5,5,$p_cashflowOperativ[$p_i],1,0,'C'); $pdf->Cell(47.5,5,$p_cashflowInvestiv[$p_i],1,0,'C'); $pdf->Cell(47.5,5,$p_cashflowFrei[$p_i],1,0,'C');
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

//Zwischenüberschrift
$pdf->SetTextColor(255,0,0);
$pdf->SetFont("Arial","B",14);
$pdf->Cell(0,5,utf8_decode('Profitabilität'),1,1,'C');

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

//Gesamtkapitalkosten Design
if($_GET['eigenkapitalkosten'] != null){
    //Abstand Doppelt
    $pdf->Cell(0,5,'',0,1,'C'); 
    $pdf->Cell(0,5,'',0,1,'C');

    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont("Arial","B",11);
    $pdf->Cell(47.5,5,'Gesamtkapitalkosten',1,0,'C'); 
    //Ausgabe Zeilen
    for($p_i = $p_zeitraum; $p_i >= 0; $p_i--){
    //Abstand
    $pdf->Cell(0,5,'',0,1,'C');
    $pdf->SetFont("Arial","",12);
    $pdf->Cell(47.5,5,$p_gesamtkapitalkosten[$p_i].'%',1,0,'C'); 
    }
	//Abstand Doppelt
    $pdf->Cell(0,5,'',0,1,'C'); 
    $pdf->Cell(0,5,'',0,1,'C');

	$pdf->SetTextColor(0,0,0);
    $pdf->SetFont("Arial","B",11);
    $pdf->Cell(47.5,5,'Eigenkapitalkosten',1,0,'C'); 
	//Abstand
    $pdf->Cell(0,5,'',0,1,'C');
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont("Arial","B",11);
    $pdf->Cell(47.5,5,$_GET['eigenkapitalkosten'].'%',1,0,'C');
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

//_____________________________________

//Neue Seite
$pdf->AddPage();

//Überschrift
$pdf->SetTextColor(255,0,0);
$pdf->SetFont("Arial","B",14);
$pdf->Cell(0,5,'"An insight-driven overview - knowledge shapes investing"',1,1,'C');

//Abstand 
$pdf->Cell(0,5,'',0,1,'C');

//Zwischenüberschrift
$pdf->SetTextColor(255,0,0);
$pdf->SetFont("Arial","B",14);
$pdf->Cell(0,5,utf8_decode('Finanzstabilität'),1,1,'C');

//Abstand 
$pdf->Cell(0,5,'',0,1,'C');

//Erste Zeile Design
$pdf->SetTextColor(0,0,0);
$pdf->SetFont("Arial","B",11);
$pdf->Cell(47.5,5,'Eigenkapitalquote',1,0,'C'); $pdf->Cell(47.5,5,utf8_decode('Net Debt / EBITDA'),1,0,'C'); $pdf->SetFont("Arial","B",11); $pdf->Cell(47.5,5,'Dynm. Verschuldungsg.',1,0,'C'); $pdf->Cell(47.5,5,'Gearing',1,0,'C');
//Ausgabe Zeilen
for($p_i = $p_zeitraum; $p_i >= 0; $p_i--){
    //Abstand
    $pdf->Cell(0,5,'',0,1,'C');
    $pdf->SetFont("Arial","",12);
    $pdf->Cell(47.5,5,$p_eigenkapitalquote[$p_i].'%',1,0,'C'); $pdf->Cell(47.5,5,$p_verhaeltnis_netdebt_ebitda[$p_i],1,0,'C'); $pdf->Cell(47.5,5,$p_dynamVerschuldungsg[$p_i],1,0,'C'); $pdf->Cell(47.5,5,$p_gearing[$p_i].'%',1,0,'C');
}
//Abstand 
$pdf->Cell(0,5,'',0,1,'C');

//Zweite Zeile Design
$pdf->SetTextColor(0,0,0);
$pdf->SetFont("Arial","B",11);
$pdf->Cell(47.5,5,'Zinsdeckungsgrad',1,0,'C'); $pdf->Cell(47.5,5,utf8_decode('Goodwill-Anteil'),1,0,'C'); $pdf->SetFont("Arial","B",12); $pdf->Cell(47.5,5,utf8_decode('Ausschüttungsquote'),1,0,'C'); 
//Ausgabe Zeilen
for($p_i = $p_zeitraum; $p_i >= 0; $p_i--){
    //Abstand
    $pdf->Cell(0,5,'',0,1,'C');
    $pdf->SetFont("Arial","",12);
    $pdf->Cell(47.5,5,$p_zinsdeckungsgrad[$p_i],1,0,'C'); $pdf->Cell(47.5,5,$p_goodwill_anteil[$p_i].'%',1,0,'C'); $pdf->Cell(47.5,5,$p_ausschuettungsquote[$p_i].'%',1,0,'C'); 
}
//Abstand 
$pdf->Cell(0,5,'',0,1,'C');

//Dritte Zeile Design
$pdf->SetTextColor(0,0,0);
$pdf->SetFont("Arial","B",11);
$pdf->Cell(47.5,5,utf8_decode('Liquidität 1'),1,0,'C'); $pdf->Cell(47.5,5,utf8_decode('Liquidität 2'),1,0,'C'); $pdf->SetFont("Arial","B",12); $pdf->Cell(47.5,5,utf8_decode('Liquidität 3'),1,0,'C'); 
//Ausgabe Zeilen
for($p_i = $p_zeitraum; $p_i >= 0; $p_i--){
    //Abstand
    $pdf->Cell(0,5,'',0,1,'C');
    $pdf->SetFont("Arial","",12);
    $pdf->Cell(47.5,5,$p_liquiditaet1[$p_i].'%',1,0,'C'); $pdf->Cell(47.5,5,$p_liquiditaet2[$p_i].'%',1,0,'C'); $pdf->Cell(47.5,5,$p_liquiditaet3[$p_i].'%',1,0,'C'); 
}
//Abstand 
$pdf->Cell(0,5,'',0,1,'C');

//Vierte Zeile Design
$pdf->SetTextColor(0,0,0);
$pdf->SetFont("Arial","B",11);
$pdf->Cell(47.5,5,utf8_decode('Anlagendeckungsgrad 1'),1,0,'C'); $pdf->Cell(47.5,5,utf8_decode('Anlagendeckungsgrad 2'),1,0,'C');  
//Ausgabe Zeilen
for($p_i = $p_zeitraum; $p_i >= 0; $p_i--){
    //Abstand
    $pdf->Cell(0,5,'',0,1,'C');
    $pdf->SetFont("Arial","",12);
    $pdf->Cell(47.5,5,$p_anlagendeckungsgrad1[$p_i].'%',1,0,'C'); $pdf->Cell(47.5,5,$p_anlagendeckungsgrad2[$p_i].'%',1,0,'C'); 
}
//Abstand 
$pdf->Cell(0,5,'',0,1,'C');

//Vierte Zeile Design
$pdf->SetTextColor(0,0,0);
$pdf->SetFont("Arial","B",11);
$pdf->Cell(47.5,5,utf8_decode('Anlagenintensität'),1,0,'C'); $pdf->Cell(47.5,5,utf8_decode('Umlaufintensität'),1,0,'C'); $pdf->SetFont("Arial","B",12); $pdf->Cell(47.5,5,utf8_decode('Kapitalintensität'),1,0,'C'); $pdf->Cell(47.5,5,utf8_decode('Vorratsintensität'),1,0,'C');
//Ausgabe Zeilen
for($p_i = $p_zeitraum; $p_i >= 0; $p_i--){
    //Abstand
    $pdf->Cell(0,5,'',0,1,'C');
    $pdf->SetFont("Arial","",12);
    $pdf->Cell(47.5,5,$p_anlagenintensitaet[$p_i].'%',1,0,'C'); $pdf->Cell(47.5,5,$p_umlaufintensitaet[$p_i].'%',1,0,'C'); $pdf->Cell(47.5,5,$p_kapitalintensitaet[$p_i].'%',1,0,'C'); $pdf->Cell(47.5,5,$p_vorratsintensitaet[$p_i].'%',1,0,'C');
}
//Abstand 
$pdf->Cell(0,5,'',0,1,'C');

//Ausgabe
$pdf->Output('Fundamental_Overview5_'.$p_name.'_'.$p_isin.'.pdf', 'D');
?>