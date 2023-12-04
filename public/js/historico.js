// Elimina el evento de clic y la creación de la instancia del modal al cargar la página
// No necesitas esperar a un clic si deseas mostrar la información directamente

document.addEventListener('DOMContentLoaded', async () => {
    let btnInfo = document.getElementById('btn_info');
    let conductorId = btnInfo.dataset.idConductor;

    try {
        let response = await fetch('/lightdriving-frontend/public/uber/historico/obtener/Todos/' + conductorId);
        let data = await response.json();
        mostrarInformacionModal(data);

        // Crea la instancia del modal directamente
        let Rmodal = new bootstrap.Modal(document.getElementById('info'));
        Rmodal.show();
    } catch (error) {
        console.error('Error al obtener datos de la API', error);
    }
});

function mostrarInformacionModal(data) {
    let marca = document.getElementById('marca');
    let color = document.getElementById('color');
    let placa = document.getElementById('placa');
    let anio = document.getElementById('anio');
    let fechaInicio = document.getElementById('fechaInicio');

    marca.textContent = `Marca: ${data.uberActual.marca}`;
    color.textContent = `Color: ${data.uberActual.color}`;
    placa.textContent = `Placa: ${data.uberActual.placa}`;
    anio.textContent = `Año: ${data.uberActual.anio}`;
    fechaInicio.textContent = `Fecha Inicio: ${data.uberActual.fechaInicio}`;
}
