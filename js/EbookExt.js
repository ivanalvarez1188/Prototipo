	function loadApp() {

	// Create the flipbook

	$('.flipbook').turn({
			// Width

			width:900,
			
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

function GenerateEbook() {

    yepnope({
            test : Modernizr.csstransforms,
            yep: ['js/turn.js'],
            nope: ['js/turn.html4.min.js'],
            both: ['./css/ebook.css'],
            complete: loadApp
    });	

//Arrastrado de imagenes

    $("#dvSource img").draggable({
        revert: "valid",
                         helper: 'clone',
        refreshPositions: true,
        drag: function (event, ui) {
            ui.helper.addClass("draggable");
        }

    });
    $("#AreaTrabajo").droppable({
        drop: function (event, ui) {

                        var draggableId = ui.draggable.attr("id");
                           var src = $("#"+draggableId).attr('src'); 
                                $('#AreaTrabajo').css('background-image', 'url(' + src + ')');
                                $('#AreaTrabajo').css('background-size', '100%');
        }
    });
}
function RemoveEbook(){
    console.log($('.flipbook'));
    $('#idFlip.flipbook').turn("destroy");
    $('#idFlip.flipbook').remove();
}



	