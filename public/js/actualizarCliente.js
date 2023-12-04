/**
 * Cambia los inputs de la vista perfilCliente a editables
 */
function editable(){
    document.getElementById('nombre').readOnly = false;
    document.getElementById('apellido').readOnly = false;
    document.getElementById('telefono').readOnly = false;
    document.getElementById('correo').readOnly = false;
    document.getElementById('contrasena').readOnly = false;
    document.getElementById('fechaNacimiento').readOnly = false;
    document.getElementById('ubicacionNombre').readOnly =false;
    document.getElementById('enviar').hidden=false;
    document.getElementById('editar').hidden=true;
}

