/**
 * Selecciona todos los botones con la class verDetalle_button y les agrega el evento para ver detalle
 */
let verDetalleButtons = document.getElementsByClassName('verDetalle_button');

Array.from(verDetalleButtons).forEach((button) => {
    button.addEventListener('click', (event) => {
        let facturaId = button.dataset.facturaId;
        console.log(facturaId);
        fetch('/lightdriving-frontend/public/conductor/obtenerCarrera/' + facturaId)
            .then(response => response.json())
            .then(data => {
                // Asegúrate de que data contenga la estructura correcta
                mostrarFacturaEnModal(data);
            })
            .catch(error => {
                console.error('Error al obtener datos de la API', error);
            });
        
        let modalUber = new bootstrap.Modal('#facturaModal');
        modalUber.show();
    });
});

/**
 * Llena la modal con los datos de la respuesta a la peticion de obtener carrera
 * @param {} data 
 */
function mostrarFacturaEnModal(data) {
    let titulo = document.getElementById('idCarreraTitulo');
    let nombreApellido = document.getElementById('nombreApellido');
    let origenCarrera = document.getElementById('origenCarrera');
    let destinoCarrera = document.getElementById('destinoCarrera');
    let totalPagar = document.getElementById('totalPagar');
    let fecha = document.getElementById('fechaCarrera');
    let metodoPago = document.getElementById('metodoPago');
    let telefono = document.getElementById('telefono');

    titulo.textContent = `Carrera No. ${data.idCarrera}`;
    nombreApellido.textContent = `${data.cliente.nombre} ${data.cliente.apellido}`;
    fecha.textContent = data.fecha;
    origenCarrera.textContent = data.ubicacionInicial;
    destinoCarrera.textContent = data.ubicacionFinal;
    metodoPago.textContent = data.metodoPago;
    telefono.textContent = `Telefono: ${data.cliente.telefono}`;

    totalPagar.textContent = `L. ${data.total}`;
}
