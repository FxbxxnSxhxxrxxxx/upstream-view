<?php

require("fpdf.php");

$pdf = new FPDF();

//Daten des Unternehmens
$p_name = $_GET['name'];
$p_isin = $_GET['isin'];
$p_jahr_geschaeftsbericht = $_GET['aktuellesJahr'];
$p_waerhung = $_GET['waehrung'];
$p_einheit = $_GET['einheit'];

//Initialisierung der Werte Anfang_______________________________________

$p_1 = $_GET['1'];
$p_2 = $_GET['2'];
$p_3 = $_GET['3'];
$p_4 = $_GET['4'];
$p_5 = $_GET['5'];

$p_fremdkapital = $_GET['fremdkapital0'];

$p_sachanlagen = $_GET['sachanlagen0'];
$p_immaterielleVermoegensw = $_GET['immaterielleVermoegensw0'];
$p_finanzanlagen = $_GET['finanzanlagen0'];
$p_liquideMittel = $_GET['liquideMittel0'];
$p_vorraete = $_GET['vorraete0'];
$p_forderungenLuL = $_GET['forderungenLuL0'];

$p_sicherheitsmarge = 1 - ($_GET['sicherheitsmarge'] / 100);

$p_eigenkapitalkosten = 1 + ($_GET['eigenkapitalkosten'] / 100);
$p_langfristigesWachstum = 1 + $_GET['langfristigesWachstum'] / 100;

$p_ewigeRente = ($p_5 * $p_langfristigesWachstum) / ($p_eigenkapitalkosten - $p_langfristigesWachstum);
$p_abgezinsteEwigeRente = $p_ewigeRente / pow($p_eigenkapitalkosten,5);

//Initialisierung der Werte Ende__________________________________________

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

//Berechnung Substanzwert je Anteil
$p_gesamtsubstanzwert = ( ( ($_GET['s'] / 100) * $p_sachanlagen + ($_GET['f'] / 100) * $p_forderungenLuL + ($_GET['v'] / 100) * $p_vorraete + ($_GET['i'] / 100) * $p_immaterielleVermoegensw) * $p_sicherheitsmarge)+ $p_liquideMittel + $p_finanzanlagen - ($p_fremdkapital); 

//Berechnung Ertragswert je Anteil
$p_gesamtertragswert = $p_sicherheitsmarge * ( ($_GET['1'] / pow($p_eigenkapitalkosten,1) ) + ($_GET['2'] / pow($p_eigenkapitalkosten,2) ) +($_GET['3'] / pow($p_eigenkapitalkosten,3) ) + ($_GET['4'] / pow($p_eigenkapitalkosten,4) ) + ($_GET['5'] / pow($p_eigenkapitalkosten,5) ) + $p_abgezinsteEwigeRente);

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
$pdf->Cell(130,5,utf8_decode('Ausgegebene Aktien: '),0,0,); $pdf->SetFont("Arial","",12); $pdf->Cell(70,5,$_GET['anzahlAktien'],0,1,'L');
$pdf->SetFont("Arial","B",12);

//Abstand 
$pdf->Cell(0,5,'',0,1,'C');

$pdf->Cell(130,5,'Allgemeine Sicherheitsmarge: ', 0,0); $pdf->SetFont("Arial","",12); $pdf->Cell(70,5,100-100*$p_sicherheitsmarge.'%',0,1,'L');
$pdf->SetFont("Arial","B",12);
$pdf->Cell(130,5,'Gesamtsubstanzwert: ', 0,0); $pdf->SetFont("Arial","",12); $pdf->Cell(70,5,round($p_gesamtsubstanzwert,2),0,1,'L');
$pdf->SetFont("Arial","B",12);
$pdf->Cell(130,5,'Gesamtertragswert: ', 0,0); $pdf->SetFont("Arial","",12); $pdf->Cell(70,5,round($p_gesamtertragswert,2),0,1,'L');
$pdf->SetFont("Arial","B",12);
$pdf->Cell(130,5,utf8_decode('Vollständiger Gesamtwert: '), 0,0); $pdf->SetFont("Arial","",12); $pdf->Cell(70,5,round($p_gesamtsubstanzwert+$p_gesamtertragswert,2),0,1,'L');
$pdf->SetFont("Arial","B",12);
$pdf->Cell(130,5,utf8_decode('Eigenkapitalkosten: '),0,0); $pdf->SetFont("Arial","",12); $pdf->Cell(70,5,100*($p_eigenkapitalkosten-1).'%',0,1,'L');
$pdf->SetFont("Arial","B",12);
$pdf->Cell(130,5,utf8_decode('Langfristiges Wachstum: '),0,0); $pdf->SetFont("Arial","",12); $pdf->Cell(70,5,100*($p_langfristigesWachstum-1).'%',0,1,'L');

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
$pdf->Cell(47.5,5,'Liquide Mittel',1,0,'C'); $pdf->Cell(47.5,5,'Finanzanlagen',1,0,'C');

$pdf->Cell(0,5,'',0,1,'C');
$pdf->SetFont("Arial","",12);
$pdf->Cell(47.5,5,$p_liquideMittel,1,0,'C'); $pdf->Cell(47.5,5,$p_finanzanlagen,1,0,'C');

//Abstand 
$pdf->Cell(0,5,'',0,1,'C');

//Abtrennung
$pdf->Cell(95,0,'',1,1,'C');

//Zweite Zeile Design
$pdf->SetTextColor(0,0,0);
$pdf->SetFont("Arial","B",12);
$pdf->Cell(47.5,5,'Fremdkapital',1,0,'C');

$pdf->Cell(0,5,'',0,1,'C');
$pdf->SetFont("Arial","",12);
$pdf->Cell(47.5,5,$p_fremdkapital,1,0,'C'); 

//Abstand 
$pdf->Cell(0,5,'',0,1,'C');

//Abtrennung
$pdf->Cell(95,0,'',1,1,'C');

//Dritte Zeile Design
$pdf->SetTextColor(0,0,0);
$pdf->SetFont("Arial","B",11);
$pdf->Cell(47.5,5,'Sachanlagen'.' ('.$_GET['s'].'%)',1,0,'C'); $pdf->Cell(47.5,5,utf8_decode('Imm. Vermögensw.'.' ('.$_GET['i'].'%)'),1,0,'C'); $pdf->Cell(47.5,5,utf8_decode('Vorräte'.' ('.$_GET['v'].'%)'),1,0,'C'); $pdf->Cell(47.5,5,'Forderungen LuL'.' ('.$_GET['f'].'%)',1,0,'C');

$pdf->Cell(0,5,'',0,1,'C');
$pdf->SetFont("Arial","",12);
$pdf->Cell(47.5,5,$p_sachanlagen,1,0,'C'); $pdf->Cell(47.5,5,$p_immaterielleVermoegensw,1,0,'C'); $pdf->Cell(47.5,5,$p_vorraete,1,0,'C'); $pdf->Cell(47.5,5,$p_forderungenLuL,1,0,'C');

//Abstand 
$pdf->Cell(0,5,'',0,1,'C');

//Daten Erträge
$pdf->SetTextColor(255,0,0);
$pdf->SetFont("Arial","B",12);
//Abstand nach Abtrennung
$pdf->Cell(0,2,'',0,1,'C');
$pdf->Cell(0,5,'Ertragsprognose: ',0,2,'L');

//Erste Zeile Design
$pdf->SetTextColor(0,0,0);
$pdf->SetFont("Arial","B",12);
$pdf->Cell(38,5,'1',1,0,'C'); $pdf->Cell(38,5,'2',1,0,'C'); $pdf->Cell(38,5,'3',1,0,'C'); $pdf->Cell(38,5,'4',1,0,'C'); $pdf->Cell(38,5,'5',1,0,'C');

$pdf->Cell(0,5,'',0,1,'C');
$pdf->SetFont("Arial","",12);
$pdf->Cell(38,5,$_GET['1'],1,0,'C'); $pdf->Cell(38,5,$_GET['2'],1,0,'C'); $pdf->Cell(38,5,$_GET['3'],1,0,'C'); $pdf->Cell(38,5,$_GET['4'],1,0,'C'); $pdf->Cell(38,5,$_GET['5'],1,0,'C'); 

//Abstand 
$pdf->Cell(0,5,'',0,1,'C');

//Daten Erträge
$pdf->SetTextColor(255,0,0);
$pdf->SetFont("Arial","B",12);
//Abstand nach Abtrennung
$pdf->Cell(0,2,'',0,1,'C');
$pdf->Cell(0,5,'Abgezinste Ertragsprognose: ',0,2,'L');

//Erste Zeile Design
$pdf->SetTextColor(0,0,0);
$pdf->SetFont("Arial","B",12);
$pdf->Cell(38,5,'1',1,0,'C'); $pdf->Cell(38,5,'2',1,0,'C'); $pdf->Cell(38,5,'3',1,0,'C'); $pdf->Cell(38,5,'4',1,0,'C'); $pdf->Cell(38,5,'5',1,0,'C');

$pdf->Cell(0,5,'',0,1,'C');
$pdf->SetFont("Arial","",12);
$pdf->Cell(38,5,round(($p_1 / pow($p_eigenkapitalkosten,1) ),2),1,0,'C'); $pdf->Cell(38,5,round(($p_2 / pow($p_eigenkapitalkosten,2) ),2),1,0,'C'); $pdf->Cell(38,5,round(($p_3 / pow($p_eigenkapitalkosten,3) ),2),1,0,'C'); $pdf->Cell(38,5,round(($p_4 / pow($p_eigenkapitalkosten,4) ),2),1,0,'C'); $pdf->Cell(38,5,round(($p_5 / pow($p_eigenkapitalkosten,5) ),2),1,0,'C');

//Abstand 
$pdf->Cell(0,5,'',0,1,'C');

//Zweite Zeile Design
$pdf->Cell(0,5,'',0,1,'C');
$pdf->SetFont("Arial","B",11);
$pdf->Cell(38,5,'Ewige Rente',1,0,'C'); $pdf->Cell(47.5,5,'Abgezinste Ewige Rente',1,0,'C');

$pdf->Cell(0,5,'',0,1,'C');
$pdf->SetFont("Arial","",12);
$pdf->Cell(38,5,round($p_ewigeRente,2),1,0,'C'); $pdf->Cell(47.5,5,round($p_abgezinsteEwigeRente,2),1,0,'C');

//Abstand 
$pdf->Cell(0,5,'',0,1,'C');
//Abstand 
$pdf->Cell(0,5,'',0,1,'C');

//Abtrennung
$pdf->Cell(190,0,'',1,1,'C');

//Daten (Preis)
$pdf->SetTextColor(255,0,0);
$pdf->SetFont("Arial","B",12);
//Abstand nach Abtrennung
$pdf->Cell(0,2,'',0,1,'C');
$pdf->Cell(0,5,utf8_decode('Geschätzte Werte je Anteil: '),0,2,'L');

//Erste Zeile Design
$pdf->SetTextColor(0,0,0);
$pdf->SetFont("Arial","B",12);
$pdf->Cell(47.5,5,'Substanzwert',1,0,'C'); $pdf->Cell(47.5,5,'Ertragswert',1,0,'C'); $pdf->Cell(47.5,5,'Gesamtwert',1,0,'C');

$pdf->Cell(0,5,'',0,1,'C');
$pdf->SetFont("Arial","",12);
$pdf->Cell(47.5,5,round($p_gesamtsubstanzwert / $_GET['anzahlAktien'],2),1,0,'C'); $pdf->Cell(47.5,5,round($p_gesamtertragswert / $_GET['anzahlAktien'],2),1,0,'C'); $pdf->Cell(47.5,5,round(($p_gesamtertragswert+$p_gesamtsubstanzwert) / $_GET['anzahlAktien'],2),1,0,'C');

//Ausgabe
$pdf->Output('Fair_Value_'.$p_name.'_'.$p_isin.'.pdf', 'D');

?>