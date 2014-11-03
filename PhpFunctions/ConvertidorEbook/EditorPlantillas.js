	function loadApp() {

	// Create the flipbook

	$('.flipbook').turn({
			// Width

			width:922,
			
			// Height

			height:600,

			// Elevation

			elevation: 50,
			
			// Enable gradients

			gradients: true,
			
			// Auto center this flipbook

			autoCenter: true

	});
	
	
}

			




$(function() {
$a=0;
//Doble click en la imagen de portada
$( "#idBo" ).click(function() {
  alert( "Handler for .dblclick() called." );
  
  
if($a==0){       

		 var htmlData='<div>Este es un header appendeado</div>';
        $('#idFlip').append(htmlData);
        	 var htmlData='<div>Este es un header appendeado</div>';
        $('#idFlip').append(htmlData);        


$a=$a+1;

}

else{
$("#flipbook").turn("destroy");
loadApp();
 var htmlData='<div>Nuevo Catalogo</div>';
        $('#idFlip').append(htmlData);
        	 var htmlData='<div>Nuevo 2</div>';
        $('#idFlip').append(htmlData);
	
}


});


  
 

// Load the HTML4 version if there's not CSS transform



//Arrastrado de imagenes
  
            $("#dvSource img").draggable({
                revert: "valid",
				 helper: 'clone',
                refreshPositions: true,
                drag: function (event, ui) {
                    ui.helper.addClass("draggable");
                },
           
            });
            $("#AreaTrabajo").droppable({
                drop: function (event, ui) {
	
				var draggableId = ui.draggable.attr("id");
				   var src = $("#"+draggableId).attr('src'); 
					$('#AreaTrabajo').css('background-image', 'url(' + src + ')');
					$('#AreaTrabajo').css('background-size', '100%');
                }
            });
			
		
			

	
    });//fin funciont main



	