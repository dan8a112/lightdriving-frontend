
    let btnInfo = document.getElementById('btn_info');

    btnInfo.addEventListener('click', async (event) => {
        let conductorId = btnInfo.dataset.idConductor;
        console.log(conductorId);

            const response = await fetch('/lightdriving-frontend/public/uber/historico/obtener/' + conductorId);
            const data = await response.json();

            // Asegúrate de que data contenga la estructura correcta
            mostrarInformacionModal(data);

            let Rmodal = new bootstrap.Modal('info');
            Rmodal.show();
        
    });


function mostrarInformacionModal(data) {
    
    let marca = document.getElementById('marca');
    let color = document.getElementById('color');
    let placa = document.getElementById('placa');
    let anio = document.getElementById('anio');
    let fechaInicio = document.getElementById('fechaInicio');
    
    

    marca.textContent = `Marca: ${data.marca}`;
    color.textContent = `Color: ${data.color}`;
    placa.textContent = `Placa: ${data.placa}`;
    anio.textContent = `Año: ${data.anio}`;
    fechaInicio.textContent = `Fecha Inicio: ${data.fechaInicio}`;
   
}

