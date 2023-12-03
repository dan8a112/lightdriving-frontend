// Suponiendo que el botón tiene un ID 'btn_historial'
let infoHistorial = document.getElementById('btn_historial');

// Agregar un evento de clic al botón
infoHistorial.addEventListener('click', async (event)=> {
    // Obtener el ID del conductor desde el atributo de datos del botón
    let conductorIdH = infoHistorial.dataset.idConducto;
    console.log(conductorIdH);

    // Hacer la solicitud a la API
    fetch('/lightdriving-frontend/public/uber/historico/obtener/Todos/' + conductorIdH)
        .then(response => response.json())
        .then(data => {
            // Asegurarse de que data contenga la estructura correcta
            mostrarTodosHistorial(data);
        })
        .catch(error => {
            console.error('Error al obtener datos de la API', error);
        });
});

function mostrarTodosHistorial(data) {
 

    //UBER ACTUAL
    let nombreApellido = document.getElementById('nombreApellidoTotal');
    //let uberActual = document.getElementById('uberActualTotal');
    let titulo = document.getElementById('tituloTotal');
    let marca = document.getElementById('marcaTotal');
    let color = document.getElementById('colorTotal');
    let placa = document.getElementById('placaTotal');
    let anio = document.getElementById('anioTotal');
    let fechaInicio = document.getElementById('fechaInicioTotal');  

    nombreApellido.textContent = `Nombre conductor: ${data.nombre} ${data.apellido}`;
    //uberActual.textContent = `Uber actual: ${JSON.stringify(data.uberActual)}`;
    marca.textContent = `Marca: ${data.uberActual.marca}`;
    color.textContent = `Color: ${data.uberActual.color}`;
    placa.textContent = `Placa: ${data.uberActual.placa}`;
    anio.textContent = `Año: ${data.uberActual.anio}`;
    fechaInicio.textContent = `Fecha Inicio: ${data.uberActual.fechaInicio}`;

    //UBER HISTORICO
    let nombreApellidoH = document.getElementById('nombreApellidoTotal');
    //let uberActual = document.getElementById('uberActualTotal');
    let tituloH = document.getElementById('tituloTotal');
    let marcaH = document.getElementById('marcaHistorial');
    let colorH = document.getElementById('colorHistorial');
    let placaH = document.getElementById('placaHistorial');
    let anioH = document.getElementById('anioHistorial');
    let fechaInicioH = document.getElementById('fechaInicioHistorial');
    let fechaFinalH = document.getElementById('fechaFinalHistorial');
    
    
    nombreApellidoH.textContent = `Nombre conductor: ${data.nombre} ${data.apellido}`;
    //uberActual.textContent = `Uber actual: ${JSON.stringify(data.uberActual)}`;
    marcaH.textContent = `Marca: ${data.historicoUbers.marca}`;
    colorH.textContent = `Color: ${data.historicoUbers.color}`;
    placaH.textContent = `Placa: ${data.historicoUbers.placa}`;
    anioH.textContent = `Año: ${data.historicoUbers.anio}`;
    fechaInicioH.textContent = `Fecha Inicio: ${data.uberActual.fechaInicio}`;
}
