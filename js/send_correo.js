$(document).ready(function() { 
    // Cargar cliente al cargar la página 
    function getData() {
        //var cia = $('#cia').val();
        $.ajax({
            url: "controler.php",
            dataType: "json",
            data: {
                accion: 'getData',
            },
            success: function(data) {
                console.log(111,data);
                
            },
            error: function(xhr, status, error) {
                console.error("Error en la solicitud AJAX:", error);
            }
        });
    }
    function cargarMotivo() {
        //var cia = $('#cia').val();
        $.ajax({
            url: "controler.php",
            dataType: "json",
            data: {
                accion: 'getMotivo',
            },
            success: function(data) {
                var $motivo = $("#motivo");
                $motivo.empty();
                $motivo.append('<option value="">Seleccione un motivo</option>');
                //console.log(111,data);
                $.each(data.data, function(index, item) {
                    //console.log(111,item);
                    $motivo.append($('<option>', {
                        value: item.id,
                        text: item.motivo
                    }));
                });
            },
            error: function(xhr, status, error) {
                console.error("Error en la solicitud AJAX:", error);
            }
        });
    }
    // Cargar provincias al cargar la página
    function cargarProvincias() {
        $.ajax({
            url: "controler.php",
            dataType: "json",
            data: {
                accion: 'getProvincia',
            },
            success: function(data) {
                var $provincia = $("#provincia");
                $provincia.empty();
                $provincia.append('<option value="">Seleccione una provincia</option>');
                $.each(data, function(index, item) {
                    //console.log(item);
                    $provincia.append($('<option>', {
                        value: item,
                        text: item
                    }));
                });
            },
            error: function(xhr, status, error) {
                console.error("Error en la solicitud AJAX:", error);
            }
        });
    }
    // Función para cargar distritos cuando se selecciona una provincia
    $("#provincia").change(function() {
        var valProv = $(this).val();
        if (valProv) {
            $.ajax({
                url: "controler.php",
                dataType: "json",
                data: {
                    accion: 'getDist',
                    prov: valProv
                },
                success: function(data) {
                    var $distrito = $("#distrito");
                    $distrito.empty();
                    $.each(data, function(index, item) {
                        $distrito.append($('<option>', {
                            value: item,
                            text: item
                        }));
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Error en la solicitud AJAX:", error);
                }
            });
        } else {
            $("#distrito").empty();
        }
    });
    // Autocompletar para el campo nombre_cliente
    $("#nombre_cliente").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "controler.php",
                dataType: "json",
                data: {
                    accion: 'getCli',
                    term: request.term  // Enviar el término de búsqueda al servidor
                },
                success: function(data) {
                    response($.map(data, function(item) {
                        return {
                            label: $.trim(item.raz_prv),
                            value: $.trim(item.raz_prv),
                            ruc: $.trim(item.ruc_prv)
                            
                        };
                        
                    }));  // Mostrar los resultados devueltos por el servidor
                },
                error: function(xhr, status, error) {
                    console.error("Error en la solicitud AJAX:", error);
                }
            });
        },
        select: function(event, ui) {
            // Asignar el valor seleccionado al campo de nombre
            $("#nombre_cliente").val(ui.item.value);
            $("#ruc_cli").val(ui.item.ruc);
            console.log('Cliente seleccionado:', ui.item.value, 'RUC:', ui.item.ruc);
            return false;
        },
        minLength: 2  // Empezar a buscar después de que el usuario ha escrito al menos 2 caracteres
    });

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
                    $('button[type="submit"]').prop('disabled', false);
                    $('#mensajeRegistro').hide();
    
                    // Descargar el PDF después de registrar la visita
                    downloadPdf(jsonResponse.ult_id);
                } else {
                    alert('Error: ' + jsonResponse.message);
                }
            },
            error: function(xhr, status, error) {
                alert('Error en la operación: ' + xhr.responseText);
            }
        });
    }
    
    function downloadPdf(ult_id) {
        
        $.ajax({
            url: "controler.php", // Cambia esta URL al script que genera el PDF
            //url: url,
            method: 'GET',
            data: {
                accion: 'gen_pdf',
                ult_id: ult_id  // Enviar el término de búsqueda al servidor
            },
            success: function() {
                // Redirigir para forzar la descarga del PDF
                //console.log('descargado');
                window.location.href = 'controler.php?accion=gen_pdf&ult_id=' + ult_id;
            },
            error: function(xhr, status, error) {
                alert('Error al generar el PDF: ' + xhr.statusText);
            }
        });
    }
    
    
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


    cargarProvincias();
    cargarVendedor();
    cargarMotivo()
    clearForm();
});
