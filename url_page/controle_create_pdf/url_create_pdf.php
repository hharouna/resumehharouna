
<?php

require_once("../../pdfphp/fpdf.php");
require_once("../../private/private_db_root.php"); 
require_once("../../function_php/url_mysql.php"); 

class PDF extends FPDF
{

    protected $B = 0;
    protected $I = 0;
    protected $U = 0;
    protected $HREF = '';
/* zone pour les Paragraphes  */
protected $outlines = array();
protected $outlineRoot;

public function Bookmark($txt, $isUTF8=false, $level=0, $y=0)
{
    if(!$isUTF8)
        $txt = $this->_UTF8encode($txt);
    if($y==-1)
        $y = $this->GetY();
    $this->outlines[] = array('t'=>$txt, 'l'=>$level, 'y'=>($this->h-$y)*$this->k, 'p'=>$this->PageNo());
}

public function _putbookmarks()
{
    $nb = count($this->outlines);
    if($nb==0)
        return;
    $lru = array();
    $level = 0;
    foreach($this->outlines as $i=>$o)
    {
        if($o['l']>0)
        {
            $parent = $lru[$o['l']-1];
            // Set parent and last pointers
            $this->outlines[$i]['parent'] = $parent;
            $this->outlines[$parent]['last'] = $i;
            if($o['l']>$level)
            {
                // Level increasing: set first pointer
                $this->outlines[$parent]['first'] = $i;
            }
        }
        else
            $this->outlines[$i]['parent'] = $nb;
        if($o['l']<=$level && $i>0)
        {
            // Set prev and next pointers
            $prev = $lru[$o['l']];
            $this->outlines[$prev]['next'] = $i;
            $this->outlines[$i]['prev'] = $prev;
        }
        $lru[$o['l']] = $i;
        $level = $o['l'];
    }
    // Outline items
    $n = $this->n+1;
    foreach($this->outlines as $i=>$o)
    {
        $this->_newobj();
        $this->_put('<</Title '.$this->_textstring($o['t']));
        $this->_put('/Parent '.($n+$o['parent']).' 0 R');
        if(isset($o['prev']))
            $this->_put('/Prev '.($n+$o['prev']).' 0 R');
        if(isset($o['next']))
            $this->_put('/Next '.($n+$o['next']).' 0 R');
        if(isset($o['first']))
            $this->_put('/First '.($n+$o['first']).' 0 R');
        if(isset($o['last']))
            $this->_put('/Last '.($n+$o['last']).' 0 R');
        $this->_put(sprintf('/Dest [%d 0 R /XYZ 0 %.2F null]',$this->PageInfo[$o['p']]['n'],$o['y']));
        $this->_put('/Count 0>>');
        $this->_put('endobj');
    }
    // Outline root
    $this->_newobj();
    $this->outlineRoot = $this->n;
    $this->_put('<</Type /Outlines /First '.$n.' 0 R');
    $this->_put('/Last '.($n+$lru[0]).' 0 R>>');
    $this->_put('endobj');
}

public function _putresources()
{
    parent::_putresources();
    $this->_putbookmarks();
}

public function _putcatalog()
{
    parent::_putcatalog();
    if(count($this->outlines)>0)
    {
        $this->_put('/Outlines '.$this->outlineRoot.' 0 R');
        $this->_put('/PageMode /UseOutlines');
    }
}




/*---------------------------------- */
public function Header()
{
    global $title;

    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Calculate width of title and position
    $w = $this->GetStringWidth($title)+5;
    $this->SetX((210-$w)/2);
    // Colors of frame, background and text
    $this->SetDrawColor(255,255,255);
    $this->SetFillColor(255,255,255);
    $this->SetTextColor(0,0,0);
    // Thickness of frame (1 mm)
    $this->SetLineWidth(1);
    // Title
    $this->Cell($w,9,$title,1,1,'C',true);
    // Line break
    $this->Ln(10);
}

public function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Text color in gray
    $this->SetTextColor(128);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
}

public function ChapterTitle($num, $label)
{
    // Arial 12
    $this->SetFont('Arial','',12);
    // Background color
    $this->SetFillColor(200,220,255);
    $this->SetTextColor(0,0,0);
    // Title
    $this->SetMargins(10,5,10);
    $this->SetLeftMargin(10);
    $this->Cell(0,6,"$num : $label",0,1,'L',true);
    // Line break
    $this->Ln(4);
}
public function sept_detail($id_sept, $___db){
    
    $sql= new __root_mysql(); 
    $select_c= "SELECT * FROM sept_detail WHERE id_sept_d=:id_sept_d"; 
    $array_c= array(":id_sept_d"=>$id_sept);
    $rst_c= $sql->__select($select_c,$array_c,false,$___db);
   
        $contenu_sept =""; 
        $this->SetFont('Arial','',12);
        $this->SetTextColor(0,78,134);
        $this->SetLeftMargin(14);
        $this->SetMargins(10,5,10); 
        $this->SetLeftMargin(20);

        $this->WriteHTML($rst_c['Contenu_sept']);
        $this->SetMargins(0,5,0); 

        $this->SetLeftMargin(10);
        //$this->MultiCell(0,2, $rst_c['Contenu_sept']);
        // $this->SetLineWidth(0.2);
        $this->Ln(4);
   
}
public function type_cathegorie($id_cat,$___db){
    
    $sql= new __root_mysql(); 
    $select_cat= "SELECT * FROM  contenu_type_cathegorie  WHERE id_t_cat=:id_t_cat"; 
    $array_cat= array(":id_t_cat"=>$id_cat);

    $rst_cat= $sql->__select($select_cat,$array_cat,true,$___db);
   
    foreach($rst_cat['fectAll'] as $rs_fe => $_fecthAll){
       // $line_s = $this->WriteHTML("<p>".ucfirst(strtolower($_fecthAll['contenu_type']))."</p> <hr> </br>");
       
        $this->Bookmark(ucfirst(strtolower($_fecthAll['contenu_type'])), false, 3, -1);
        $this->SetFont('Arial','',8);
        $this->SetTextColor(0,39,76);
        $this->SetLeftMargin(20);
        $this->SetMargins(2,5,0);

        $this->Cell(0,8,ucfirst(strtolower($_fecthAll['contenu_type'])));
        
        $this->Ln(4);
      }
}
public function ChapterBody($_num,$__db)
{

    $sql= new __root_mysql(); 
    $select_sql = "SELECT * FROM type_cathegorie WHERE id_sept_cathegorie=:id_sept_cathegorie"; 
    $array_sql= array(":id_sept_cathegorie"=>$_num);
    $rst_sq= $sql->__select($select_sql,$array_sql,true,$__db);
    $r_page =""; 
     
        $this->sept_detail($_num,$__db);
    foreach($rst_sq['fectAll'] as $rs_fe => $_fecthAll){
        $ctitle= preg_replace('#[^a-zA-Z0-9=@._-]#i',' ', $_fecthAll['c-title']);
        //$line_ = $this->WriteHTML(ucfirst(strtolower($ctitle)));
           //$this->Bookmark($_num, false);
        $this->Bookmark(ucfirst(strtolower($_fecthAll['c-title'])), false, 2, -1);
        $this->SetFont('Arial','U',12);
        $this->SetTextColor(128,128,128);
        $this->SetLeftMargin(10);
        $this->SetMargins(2,5,0);
       
        $this->Cell(0,5,ucfirst(strtolower($_fecthAll['c-title'])));
        $this->type_cathegorie($_fecthAll['id_cathegorie'],$__db);
        //$this->SetX(4);
        $this->SetLineWidth(0.2);
        $this->Ln(4);
      }

    // Read text file
    //$txt = file_get_contents($file); // recuperer le contenu d'un ficher
    // Times 12
    $this->SetFont('Times','',12);
    // Output justified text
    //$html = $this->WriteHTML($r_page);
    //$this->MultiCell(1,5,$html);
    // Line break
    $this->Ln(4);
    // Mention in italics
    $this->SetFont('','I');
    $this->Cell(0,5,'(end of excerpt)');

}

public function PrintChapter($num, $title, $file,$_db)
{
        $this->AddPage();
        //$this->Bookmark($num, false);
        $this->Bookmark($title, false, 1, -1);
        $this->ChapterTitle($num,$title);
        $this->ChapterBody($num,$_db);
}

/*--------------------------------------------------------- 
zone witre html 
*/


public function WriteHTML($html)
{
    // HTML parser
    $html = str_replace("\n",' ',$html);
    $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
    foreach($a as $i=>$e)
    {
        if($i%2==0)
        {
            // Text
            if($this->HREF)
                $this->PutLink($this->HREF,$e);
            else
                $this->Write(5,$e);
        }
        else
        {
            // Tag
            if($e[0]=='/')
                $this->CloseTag(strtoupper(substr($e,1)));
            else
            {
                // Extract attributes
                $a2 = explode(' ',$e);
                $tag = strtoupper(array_shift($a2));
                $attr = array();
                foreach($a2 as $v)
                {
                    if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                        $attr[strtoupper($a3[1])] = $a3[2];
                }
                $this->OpenTag($tag,$attr);
            }
        }
    }
}

public function OpenTag($tag, $attr)
{
    // Opening tag
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,true);
    if($tag=='A')
        $this->HREF = $attr['HREF'];
    if($tag=='BR')
        $this->Ln(5);
}

public function CloseTag($tag)
{
    // Closing tag
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,false);
    if($tag=='A')
        $this->HREF = '';
}

function SetStyle($tag, $enable)
{
    // Modify style and select corresponding font
    $this->$tag += ($enable ? 1 : -1);
    $style = '';
    foreach(array('B', 'I', 'U') as $s)
    {
        if($this->$s>0)
            $style .= $s;
    }
    $this->SetFont('',$style);
}

public function PutLink($URL, $txt)
{
    // Put a hyperlink
    $this->SetTextColor(0,0,255);
    $this->SetStyle('U',true);
    $this->Write(5,$txt,$URL);
    $this->SetStyle('U',false);
    $this->SetTextColor(0);
}


}

$pdf = new PDF();

$title = 'RESUME HAROUNA HAROUNA';
$pdf->SetTitle($title);
$pdf->SetAuthor('HAROUNA HAROUNA');

        $sql_url= new __root_mysql(); 
        $select_sql_ = "SELECT * FROM sept"; 
        $array_sql_= array();
        $rst_sql_= $sql_url->__select($select_sql_,$array_sql_,true,$db);

        $r_page ="";
        foreach($rst_sql_['fectAll'] as $rs_fe => $_fecthAll){
        $pdf->PrintChapter($_fecthAll["id_sept"],$_fecthAll["title_sept"],"",$db);
        }

//$pdf->PrintChapter(1,'A RUNAWAY REEF','20k_c1.txt',$db);

$pdf->Output('D',"pdf.pdf");   



?>