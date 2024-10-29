$(document).ready(function() { 
    var urlController="../controller/controler.php"
    // Cargar cliente al cargar la página
     // Alternar visibilidad de la contraseña
     $('#loginPassword').on('click', function() {
        var passwordField = $('#logincontraseña');
        var type = passwordField.attr('type') === 'password' ? 'text' : 'password';
        passwordField.attr('type', type);
        
        // Cambia el icono según el estado
        $(this).find('i').toggleClass('fa-eye fa-eye-slash');
    });

    function getCia() {
        $.ajax({
            url: urlController,
            dataType: "json",
            data: {
                accion: 'getCia',
            },
            success: function(data) {
                var $cia = $("#cia");
                $cia.empty();
                $cia.append('<option value="">Seleccione una empresa</option>');
                $.each(data.data, function(index, item) {
                    //$.each(item, function(x, y) {
                        $cia.append($('<option>', {
                            value: item.id,
                            text: item.razonsocial
                        }));
                    //});
                });
            },
            error: function(xhr, status, error) {
                console.error("Error en la solicitud AJAX:", error);
            }
        });
    }
    

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
                    //alert(jsonResponse.message);
                    var cia=jsonResponse.cia
                    var id=jsonResponse.id
                    $('#regLogin').trigger("reset"); // Limpiar el formulario
                    $('#mensajeRegistro').hide();
                    window.location.replace('home.php?cia='+cia+'&id='+id);
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
    
    // Manejar todos los formularios con la clase .ajaxForm
    $('#regLogin').submit(function(event) {
        event.preventDefault();
        var form = this;
        var url = $(form).data('url'); // Obtener la URL del atributo data-url
        //var x =$("#ruc_cliente").val();
        //console.log(555,x);
        
        $('#mensajeRegistro').show();
        //$('button[type="submit"]').prop('disabled', true);
        handleFormSubmit(form, url);
    });

    getCia();
});
