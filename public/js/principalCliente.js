/**
 * Selecciona todos los botones con la class verDetalle_button y les agrega el evento para ver detalle
 */
let verDetalleButtons = document.getElementsByClassName('verDetalle_button');

Array.from(verDetalleButtons).forEach( (button) => {

    button.addEventListener('click',(event) => {

        let facturaId = button.dataset.facturaId;

        fetch('/lightdriving-frontend/public/cliente/obtenerCarrera/'+facturaId)
        .then(response=>response.json()).
        then(data=>{
            mostrarFacturaEnModal(data);
        });

        let modalUber = new bootstrap.Modal('#facturaModal');
        modalUber.show();

    });
});

/**
 * Llena la modal con los datos de la respuesta a la peticion de obtener carrera
 * @param {} data 
 */
function mostrarFacturaEnModal(data){
    let titulo = document.getElementById('idCarreraTitulo');
    let nombreApellido = document.getElementById('nombreApellido');
    let marcaColor = document.getElementById('marcaColor');
    let placaUber = document.getElementById('placaUber');
    let telUber = document.getElementById('telUber');
    let tipoUber = document.getElementById('tipoUber');
    let origenCarrera = document.getElementById('origenCarrera');
    let destinoCarrera = document.getElementById('destinoCarrera');
    let totalPagar = document.getElementById('totalPagar');
    let fecha = document.getElementById('fechaCarrera');
    let metodoPago = document.getElementById('metodoPago');

    titulo.textContent = `Carrera No. ${data.idCarrera}`;

    nombreApellido.textContent = `${data.conductor.nombre} ${data.conductor.apellido}`;
    marcaColor.textContent = `${data.conductor.marca}, ${data.conductor.color}`;
    placaUber.textContent = `Placa No. ${data.conductor.placa}`;
    telUber.textContent = `Telefono ${data.conductor.telefono}`;

    tipoUber.textContent = data.conductor.tipoUber;
    fecha.textContent = data.fecha;
    origenCarrera.textContent = data.ubicacionInicial;
    destinoCarrera.textContent = data.ubicacionFinal;
    metodoPago.textContent = data.metodoPago;

    totalPagar.textContent = `L. ${data.total}`;
}