<form id="modal-form">
    <div class="mb-4">
        <label for="nameRegistro" class="form-label">Nombres</label>
        <input type="text" class="form-control" id="nameRegistro" name="nameRegistro"
            placeholder="Escribe acá tus nombres" required>
    </div>
    <div class="mb-4">
        <label for="apellidosRegistro" class="form-label">Apellidos</label>
        <input type="text" class="form-control" id="apellidosRegistro" name="apellidosRegistro"
            placeholder="Escribe acá tus apellidos" required>
    </div>
    <div class="mb-4">
        <label for="mailRegistro" class="form-label">Correo Electronico</label>
        <input type="email" class="form-control" id="mailRegistro" name="mailRegistro"
            placeholder="name@example.com"
            oninvalid="alert('Ingrese un correo electrónico válido');" required
            pattern="^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$">
    </div>
    <div class="mb-4">
        <label for="registroPass" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="registroPass" name="registroPass"
            placeholder="Almenos una mayúscula, una minúscula y un número"
            oninvalid="alert('Ingrese una contraseña válida');" required
            pattern="^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$">
    </div>
    <div class="mb-4">
        <label for="registroPass2" class="form-label">Confirmar contraseña</label>
        <input type="password" class="form-control" id="registroPass2" name="registroPass2"
            placeholder="Vuelva a escribir la contraseña" required
            pattern="^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$"
            oninvalid="alert('Ingrese una contraseña válida');">
    </div>
    <div class="mb-4">
        <label for="documento" class="form-label fw-bolder">RUC</label>
        <input type="text" class="form-control" id="documento" name="documento"
            placeholder="Indique el número del RUC" required>
    </div>
    <div class="mb-4">
        <label for="nroCelular" class="form-label">N° de celular</label>
        <input type="text" class="form-control" id="nroCelular" name="nroCelular" placeholder=""
            required pattern="[0-9]{9}" oninvalid="alert('Ingrese un número de celular válido');">
    </div>
</form>