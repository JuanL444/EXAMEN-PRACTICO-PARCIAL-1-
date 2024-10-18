$(document).ready(function(){
	
	// Listen to login button
	$('#guardar').click(function(){
		
	    var nomPro = $('#nomPro').val();
        var precioPro = $('#precioPro').val();
        var existenciaPro = $('#existenciaPro').val();
      
	    $.ajax({
	    	url: 'controller/registrar.php',
	    	method: 'POST',
	    	data: {
	    		nomPro:nomPro,
	    		precioPro:precioPro,
                existenciaPro:existenciaPro,
	    	},
	    	success: function (res) {
                if (res == "1") {
                    $("#nomPro").val("");
                    $("#precioP").val("");
                    $("#existenciaP").val("");

                    
                    $('#exampleModal').hide();
                    window.location = 'dashboard.php';
                    window.location.href = window.location.href;


                    
                } else {
                    alert("Error al guardar el producto. Intente de nuevo.");
                }
            },
            error: function (xhr, status, error) {
                console.error("Error en la solicitud AJAX: ", status, error);
                alert("Ocurrió un error. Por favor, intente más tarde.");
            }
        });
    });
    return false;
});
