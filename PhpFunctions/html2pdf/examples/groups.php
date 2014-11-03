<?php
/**
 * HTML2PDF Librairy - example
 *
 * HTML => PDF convertor
 * distributed under the LGPL License
 *
 * @author      Laurent MINGUET <webmaster@html2pdf.fr>
 *
 * isset($_GET['vuehtml']) is not mandatory
 * it allow to display the result in the HTML format
 */

ob_start();
?>

<page  >
<div style="width: 100%; background-color:red; margin-top:100px;">
    Ceci est la page 2 du groupe 1
    </div>
</page>
<page pageset="old">
    Ceci est la page 3 du groupe 1
</page>

<?php
    $content = ob_get_clean();

    require_once(dirname(__FILE__).'/../html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', 0);
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('groups.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
    
    ?>