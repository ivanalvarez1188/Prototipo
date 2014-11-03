<?php

ob_start();
		
?>



<?php



//$json= json_decode($_POST["objRequest"]);
//$json = file_get_contents('php://input');
/*$json='{
			"funcion": "convertirHtmlaPdf",
			"htmlCatalogo":"<page ><div style=\"width: 100%; background-color:red; margin-top:100px;\">\"hol2\" siii por finn</div></page> <page>Pagina 2 porfinnnnnnnnnnnnnnnn</page>"  
	}' ;
	*/
$objRequest = json_decode($_POST["json"],true);

	switch ($objRequest['funcion']) {
  		case 'convertirHtmlaPdf':
		convertirHtmlaPdf($objRequest['htmlCatalogo']);
    	break;		
  default:
  }
    

	

function convertirHtmlaPdf($htmlCatalogo)
{

    $content = ob_get_clean();
$content='<html><head><title>TODO supply a title</title><meta charset="UTF-8"><link href="Editor/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>      <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css"></head><body>'.$htmlCatalogo.'</body></html>';
 
    require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
    try
    {

        $html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', 0);
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('groups1.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }

}







?>