$(document).ready(function(){
	
	$('.eliminar').on('click', function (e) {
	e.preventDefault(); // Evitar que el enlace realice su acción predeterminada
        
	const nombreProducto = $(this).data('nombre');
      
	    $.ajax({
            type: "GET",
	    	url: 'controller/eliminar.php',
	    	data: {
	    		nombreProducto:nombreProducto,
	    	},
	    	success: function (res) {
                
                if (res == "1") {
                    alert("eliminado correctamente.");
                    window.location = 'dashboard.php';
                    window.location.href = window.location.href;

                } else {
                    alert("Error al eliminar el producto. Intente de nuevo.");
                }

                
            },
            error: function (xhr, status, error) {
                console.error("Error en la solicitud AJAX: ", status, error);
                alert("Ocurrió un error. Por favor, intente más tarde.");
            }
        });
    });
    
});
