$(document).ready(function() { 
    var today = new Date().toISOString().split('T')[0];
    // Establecer el valor mínimo del campo de fecha en la fecha actual
    $('#fecha').attr('min', today);
    //validar longitud del nro de telefono
    $('#telefono').on('input', function() {
        var nroContacto = $(this).val();
        if (nroContacto.length > 9) {
            $(this).val(nroContacto.substring(0, 9));
        }
    });
    $('#ruc').on('input', function() {
        var ruc = $(this).val();
        if (ruc.length > 20) {
            $(this).val(ruc.substring(0, 20));
        }
    });
    $('#registroForm').on('submit', function(e) {
        var nombre = $('#nombre').val();
        var ruc = $('#ruc').val();
        var correo = $('#correo').val();

        // Validar que el nombre solo contenga letras y espacios
        if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(nombre)) {
            alert('El campo Nombre solo debe contener letras.');
            e.preventDefault(); // Previene el envío del formulario
        }
        // Validar el formato del correo
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(correo)) {
            alert('Por favor, ingresa un formato de correo válido.');
            e.preventDefault(); // Previene el envío del formulario
        }
        
    });
    

    // Función genérica para manejar el envío de formularios mediante AJAX 
    /*function handleFormSubmit(form, url) {
        var formData = $(form).serialize();
    
        $.ajax({
            url: url,
            method: 'POST',
            data: formData,
            success: function(response) {
                var jsonResponse = JSON.parse(response);
                if (jsonResponse.status === 'success') {
                    alert(jsonResponse.message);
                    $('#registroForm').trigger("reset"); // Limpiar el formulario
                    $('button[type="submit"]').prop('disabled', false);
                    $('#mensajeRegistro').hide();
                } else {
                    alert('Error: ' + jsonResponse.message);
                }
            },
            error: function(xhr, status, error) {
                alert('Error en la operación: ' + xhr.responseText);
            }
        });
    }*/
    
    function clearForm(form, url) {
        $('#clearForm').click(function() {
            $('#registroForm').trigger("reset");
        });
    }
    // Manejar todos los formularios con la clase .ajaxForm
    $('.ajaxForm').submit(function(event) {
        event.preventDefault();
        var form = this;
        var url = $(form).data('url'); // Obtener la URL del atributo data-url
        //var x =$("#ruc_cliente").val();
        //console.log(555,x);
        
        $('#mensajeRegistro').show();
        $('button[type="submit"]').prop('disabled', true);
        handleFormSubmit(form, url);
    });


    //cargarProvincias();
    //cargarVendedor();
    //cargarMotivo()
    //clearForm();
});
