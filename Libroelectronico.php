<?php
$obj = $_REQUEST['json'];
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
</head>


<body onload="GenerateEbook()">
    <script src="js/jQuery.js" type="text/javascript"></script>
    <script src="http://code.jquery.com/ui/1.8.24/jquery-ui.min.js" type="text/javascript"></script>
    <script src="js/modernizr.2.5.3.min.js" type="text/javascript"></script>
    
    <div id="dvSource">
       <div class="flipbook-viewport" style="text-align: center;">
           <div class="container" style="text-align: center;">
                    <div id="idFlip" class="flipbook" style="text-align: center;">
                        <?php echo $obj; ?>
                    </div>
            </div>	
        </div>
    </div>
    <script src="js/EbookExt.js" type="text/javascript"></script>

</body>

</html>