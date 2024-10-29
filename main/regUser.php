<?php include 'head.php'; ?>

<div class="container d-flex align-items-center justify-content-center ">
    <div class="card text-center shadow-lg p-3 mb-5 bg-white rounded" style="max-width: 900px;">
        <div class="card-body">
            <h3 class="card-title">Registro de usuario</h3>
            <form id="RegUserForm" class="ajaxForm" data-url="../controller/controler.php">
                <input type="hidden" name="accion" value="regUser">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group md-6 mt-3">
                            <label for="cia">Empresa</label>
                            <select id="cia" name="cia" class="form-control" required>
                                <option value="">Seleccionar...</option>
                                <!-- Agrega las opciones de motivos -->
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group md-6 mt-3">
                            <label for="usuario">Usuario</label>
                            <input type="text" name="usuario" class="form-control" id="usuario" placeholder="Usuario" required>
                        </div>
                    </div>          
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mt-3">
                            <label for="contraseña">Contraseña</label>
                            <input type="password" name="contraseña" class="form-control" id="contraseña" placeholder="Contraseña" required>

                        </div>
                        <div class="form-group mt-3">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="nrodocu">Nro documento</label>
                            <input type="number" name="nrodocu" class="form-control" id="nrodocu" placeholder="Nro documento" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mt-3">
                            <label for="confirma_contraseña">Confirma Contraseña</label>
                            <div class="input-group">
                                <input type="password" name="confirma_contraseña" class="form-control" id="confirma_contraseña" placeholder="Confirma Contraseña" required>
                                <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label for="apellidos">Apellidos</label>
                            <input type="text" name="apellidos" class="form-control" id="apellidos" placeholder="Apellidos" required>
                        </div>
                        
                        <div class="form-group mt-3">
                            <label for="telefono">Teléfono</label>
                            <input type="number" name="telefono" class="form-control" id="telefono" placeholder="Teléfono" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mt-3">
                            <label for="correo">Correo</label>
                            <input type="email" name="correo" class="form-control" id="correo" placeholder="Correo" required>
                        </div>
                    </div>        
                </div>
                <button type="submit" class="btn btn-primary mt-4 w-100">Registrar</button>
            </form>
            <a href="../main/login.php" class="d-block mt-3">¿Ya tienes una cuenta? Inicia sesión aquí.</a>
            <div id="mensajeRegistro" style="display:none; margin-top: 10px;" class="alert alert-info">Registrando...</div>
            <span id="error-message" style="color: red; display: none;">Las contraseñas no coinciden</span>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
