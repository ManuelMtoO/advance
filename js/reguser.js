$(document).ready(function() { 
    var urlController="../controller/controler.php"

    // Alternar visibilidad de la contraseña
    $('#togglePassword').on('click', function() {
        var passwordField = $('#confirma_contraseña');
        var type = passwordField.attr('type') === 'password' ? 'text' : 'password';
        passwordField.attr('type', type);
        
        // Cambia el icono según el estado
        $(this).find('i').toggleClass('fa-eye fa-eye-slash');
    });

    // Validar confirmación de contraseña en tiempo real
    $('#confirma_contraseña').on('keyup', function() {
        var password = $('#contraseña').val();
        var confirmPassword = $(this).val();

        if (password !== confirmPassword) {
            $('#confirmMessage').show(); // Mostrar mensaje de error
            $('#contraseña, #confirma_contraseña').addClass('is-invalid'); // Añadir clase de error a los inputs
        } else {
            $('#confirmMessage').hide(); // Ocultar el mensaje de error
            $('#contraseña, #confirma_contraseña').removeClass('is-invalid'); // Quitar clase de error de los inputs
        }
    });
    $('#telefono').on('input', function() {
        var nroContacto = $(this).val();
        if (nroContacto.length > 9) {
            $(this).val(nroContacto.substring(0, 9));
        }
    });
    $('#nrodocu').on('input', function() {
        var nroContacto = $(this).val();
        if (nroContacto.length > 9) {
            $(this).val(nroContacto.substring(0, 9));
        }
    });
    // Cargar cliente al cargar la página
    //console.log("1111");


    // Función genérica para manejar el envío de formularios mediante AJAX
    function handleFormSubmit(form, url) {
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
                    //$('button[type="submit"]').prop('disabled', false);
                    $('#mensajeRegistro').hide();
    
                    // Descargar el PDF después de registrar la visita
                    //downloadPdf(jsonResponse.ult_id);
                } else {
                    alert('Error: ' + jsonResponse.message);
                    $('#mensajeRegistro').hide();
                }
            },
            error: function(xhr, status, error) {
                alert('Error en la operación: ' + xhr.responseText);
            }
        });
    }

    function clearForm(form, url) {
        $('#clearForm').click(function() {
            $('#registroForm').trigger("reset");
        });
    }

    // Manejar todos los formularios con la clase .ajaxForm
    $('#RegUserForm').submit(function(event) {
        event.preventDefault();
        var form = this;
        var url = $(form).data('url'); // Obtener la URL del atributo data-url
        //var x =$("#ruc_cliente").val();
        //console.log(555,x);
        var nombre = $('#nombre').val();
        var correo = $('#correo').val();
        var apellidos = $('#apellidos').val();

        // Validar que el nombre solo contenga letras y espacios
        if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(nombre)) {
            alert('El campo Nombre solo debe contener letras.');
            e.preventDefault(); // Previene el envío del formulario
        }
        if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(apellidos)) {
            alert('El campo Nombre solo debe contener letras.');
            e.preventDefault(); // Previene el envío del formulario
        }
        // Validar el formato del correo
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(correo)) {
            alert('Por favor, ingresa un formato de correo válido.');
            e.preventDefault(); // Previene el envío del formulario
        }

        $('#mensajeRegistro').show();
        //$('button[type="submit"]').prop('disabled', true);
        handleFormSubmit(form, url);
    });


    //cargarProvincias();
    //cargarVendedor();
    //cargarMotivo()
    //clearForm();
    //getCia();
});
