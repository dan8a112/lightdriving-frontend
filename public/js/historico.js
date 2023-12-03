
    let btnInfo = document.getElementById('btn_info');

    btnInfo.addEventListener('click', async (event) => {
        let conductorId = btnInfo.dataset.idConductor;
        console.log(conductorId);

        fetch('/lightdriving-frontend/public/uber/historico/obtener/Todos/' + conductorId)
        .then(response => response.json())
        .then(data => {
            mostrarInformacionModal(data);
        })
        .catch(error => {
            console.error('Error al obtener datos de la API', error);
        });
           
            

            let Rmodal = new bootstrap.Modal('info');
            Rmodal.show();
        
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

