$(document).ready(function () {
    // Abrir el modal de modificar y cargar los datos del producto
    $('.modificar').on('click', function (e) {
        e.preventDefault();
        const idProducto = $(this).data('id');
        const nombreProducto = $(this).data('nombre');
        const precioProducto = $(this).data('precio');
        const existenciaProducto = $(this).data('existencia');

        // Cargar los datos en los campos del modal
        $('#idProducto').val(idProducto);
        $('#nombreProducto').val(nombreProducto);
        $('#precioProducto').val(precioProducto);
        $('#existenciaProducto').val(existenciaProducto);

        // Mostrar el modal
        $('#modalModificar').modal('show');
    });

    // Guardar los cambios cuando se hace clic en "Guardar Cambios"
    $('#guardarCambiosProducto').on('click', function () {
        const formData = $('#formModificarProducto').serialize(); // Serializar el formulario

        $.ajax({
            url: 'controller/actualizar.php', // Ruta del archivo PHP para actualizar el producto
            method: 'POST',
            data: formData,
            success: function (response) {
                if (response == "1") {
                    alert("Producto actualizado correctamente.");
                    location.reload(); // Recargar la página para ver los cambios
                } else {
                    alert("Error al actualizar el producto.");
                }
            },
            error: function (xhr, status, error) {
                console.error("Error en la solicitud AJAX: ", status, error);
                alert("Ocurrió un error. Por favor, intente más tarde.");
            }
        });
    });
});
