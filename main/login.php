<?php include 'head.php'; ?>

<div class="container d-flex align-items-center justify-content-center vh-100">
    <div class="card text-center shadow-lg p-3 mb-5 bg-white rounded" style="width: 20rem;">
        <div class="card-body">
            <h3 class="card-title">Login</h3>
            <form id="regLogin" class="ajaxForm" data-url="../controller/controler.php">
                <input type="hidden" name="accion" value="validlogin">
                <div class="form-group mt-3">
                    <label for="cia">Empresa</label>
                    <select id="cia" name="cia" class="form-control" required>
                        <option value="">Seleccionar...</option>
                        <!-- Agrega las opciones de motivos -->
                    </select>
                </div>
                <div class="form-group mt-3">
                    <label for="usuario">Usuario</label>
                    <input type="usuario" name="usuario" class="form-control" id="usuario" placeholder="Usuario" required>
                </div>
                <div class="form-group mt-3">
                    <label for="logincontraseña">Contraseña</label>
                    <div class="input-group">
                        <input type="password" name="logincontraseña" class="form-control" id="logincontraseña" placeholder="Contraseña" required>
                        <span class="input-group-text" id="loginPassword" style="cursor: pointer;">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-4 w-100">Ingresar</button>
            </form>
            <a href="../main/reguser.php" class="d-block mt-3">Registrate</a>
            <a href="#" class="d-block mt-3">Olvidaste tu contraseña?</a>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
