const pestanas = document.querySelectorAll('.pestana');
const btnModal = document.querySelectorAll('[role="button"]');
const contenedor = document.getElementById('contenedor');
const discos = document.querySelectorAll('#update-chart .js-easy-pie-chart');
const cerrarModal = document.querySelectorAll('.btn-close');
//El base_url() de javacristo para todos los ajax
const getUrl = () =>{
    let url = window.location.href;
    url = url.split('?')[0];
    return url;
}
//Fin del base_url() de javacristo para todos los ajax
/*
    Autoactualizador de los gráficos de discos
*/
const graficosDiscos = () =>{
    const discos = document.querySelectorAll('.js-easy-pie-chart');
    discos.forEach(async(ele)=>{
        const url = getUrl();
        const conn = await fetch(url+'?monitoring&datos=1');
        const json = await conn.text();
        const data = JSON.parse(json.split('<')[0]);
        let grafico =  $(`#${ele.getAttribute('id')}`).data('easyPieChart');
        grafico.options.barColor = data.color;
        if(data.percent==-1){
            grafico.update(-100); 
        }else{
            grafico.update(data.percent);
        }
    })
}
/*
    Fin autocambiador de colores de gráficos
*/

/*

    Inicio conteo de warnings, ko, cr

*/

const numeroProblemas = async()=>{
    const ko = document.querySelectorAll('[data-ko]');
    const wr = document.querySelectorAll('[data-wr]');
    const cr = document.querySelectorAll('[data-cr]');
    let url = getUrl();
    const conn = await fetch(url+'?monitoring&datos=4');
    const json = await conn.text();
    const data = JSON.parse(json.split('<')[0]);
    for(let x=0; x<data.length; x++){
        ko[x].innerHTML=data[x].KO;
        wr[x].innerHTML=data[x].WR;
        cr[x].innerHTML=data[x].CR;
    }
}

/*

    Fin conteo de warnings, ko, cr

*/
//Autolanzador de todas las funciones de inicio
const lanzamientoInicio = () =>{
    numeroProblemas();
    graficosDiscos();
}
lanzamientoInicio();
setInterval(()=>{
    lanzamientoInicio(); 
}, 10000)
//Fin autolanzador de las funcione de inicio

/*
    Contenido Modal 
*/
const obtenerColorStatus = (status) =>{
    switch(status){
        case 'KO':
            return 'rounded bg-secondary';
        case 'WR':
            return 'rounded bg-warning';
        case 'CR':
            return 'rounded bg-danger';
        case 'OK':
            return 'rounded bg-susccess';
    }
}
const datosModal = async(servidor) =>{
    let url = window.location.href;
    url = url.split('?')[0];
    const conn = await fetch(url+'?monitoring&datos=2&servidor='+servidor);
    const json = await conn.text();
    const datos = JSON.parse(json.split('<')[0]);
    const config = {
        type: 'pie',
        data: {
            labels: [
                "En uso",
                "Libre"
            ],
            datasets: [
                {
                    data: [
                        datos.graficos.usado,
                        datos.graficos.libre,
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                    ],
                }]
        },
        options:
        {
            responsive: true,
            legend:
            {
                display: true,
                position: 'bottom',
            }
        },
    };
    const otros = {
        alertas: datos.alertas,
        servicios: datos.servicios
    }
    return {config, otros};
}

const renderModales = async(idServidor) =>{
    const servidor = parseInt(idServidor);
    const config = await datosModal(servidor);
    //console.log(servidor);
    var ctx = document.getElementById('pieChart-'+servidor).getContext('2d');
    new Chart(ctx, config.config);
    const alertas = document.getElementById('alertas');
    const renderAlertas = config.otros.alertas;
    alertas.innerHTML = '';
    renderAlertas.forEach((ele)=>{
        alertas.innerHTML+=`
        <tr>
            <td><p>${ele.descripcion}</p></td>
            <td><p class="${obtenerColorStatus(ele.status)}">${ele.status}</p></td>
            <td><p>${ele.tiempo}</p></td>                                    
        </tr>`;
    })
    const servicios = document.getElementById('servicios');
    const renderServicios = config.otros.servicios;
    servicios.innerHTML='';
    let cont =1;
    renderServicios.forEach((elem)=>{
        servicios.innerHTML+=` <tr>
            <td><p>${elem.nombre}</p></td>
            <td><p>${elem.descripcion}</p></td>
            <td><p class="${obtenerColorStatus(elem.status)}">${elem.status}</p></td>
            <td data-idservicio=${cont}><button class="btn btn-primary grafico" data-idservicio=${cont}><i data-idservicio=${cont} class="fa-solid fa-chart-line"></i></button></td>
        </tr>`;
        cont++;
    })
    const btns = document.querySelectorAll('.grafico');
    btns.forEach((ele)=>{
        ele.addEventListener('click', async(event)=>{
            const idServicio = event.target.attributes[1].value;
            const idServidor = servicios.attributes[2].value;
            let config = await configPingServicio(idServicio, idServidor);
            new Chart($("#areaChart > canvas").get(0).getContext("2d"), config);
        });
    })
}

btnModal.forEach((ele)=>{
    ele.addEventListener('click', ()=>{
        const idServidor = ele.attributes[4].value;
        console.log(idServidor);
        renderModales(idServidor);
    });
})

/*
    Fin contenido Modal
*/

/*

    Grafico del ping

*/
const getDataPingServicio = (status, data) => {
    let array = [];
    if(status==true){
        data.forEach((ele)=>{
            array.push(ele.pingmax);
        })
    }else{
        data.forEach((ele)=>{
            array.push(ele.pingmin);
        })
    }
    return array; 
}


const configPingServicio = async(servicio, servidor)=>{
    const url = getUrl();
    const conn = await fetch(url+'?monitoring&datos=5&servidor='+servidor+'&servicio='+servicio);
    const json = await conn.text();
    const data = JSON.parse(json.split('<')[0]);
    //console.log(data);
    var config = {
        type: 'line',
        data:
        {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [
            {
                label: "Primary",
                backgroundColor: 'rgba(136,106,181, 0.2)',
                borderColor: 'rgba(136,106,181, 0.2)',
                pointBackgroundColor: 'rgba(136,106,181, 0.2)',
                pointBorderColor: 'rgba(0, 0, 0, 0)',
                pointBorderWidth: 1,
                borderWidth: 1,
                pointRadius: 3,
                pointHoverRadius: 4,
                data: getDataPingServicio(true, data),
                fill: true
            },
            {
                label: "Success",
                backgroundColor: 'rgba(29,201,183, 0.2)',
                borderColor: 'rgba(136,106,181, 0.2)',
                pointBackgroundColor: 'rgba(136,106,181, 0.2)',
                pointBorderColor: 'rgba(0, 0, 0, 0)',
                pointBorderWidth: 1,
                borderWidth: 1,
                pointRadius: 3,
                pointHoverRadius: 4,
                data: getDataPingServicio(false, data),
                fill: true
            }]
        },
        options:
        {
            responsive: true,
            title:
            {
                display: false,
                text: 'Area Chart'
            },
            tooltips:
            {
                mode: 'index',
                intersect: false,
            },
            hover:
            {
                mode: 'nearest',
                intersect: true
            }
        }
    };
    return config;
}
/*
    Fin grafico ping
*/

/*

    Inicio gestion cerrados de las modales

*/

cerrarModal.forEach((ele)=>{
    ele.addEventListener('click', ()=>{
        const alertas = document.getElementById('alertas');
        const servicios = document.getElementById('servicios');
        const graficos = document.getElementById('areaChart');
        alertas.innerHTML='';
        servicios.innerHTML = '';
        graficos.innerHTML = '<canvas class="chartjs-render-monitor graph"></canvas>';
    })
})


window.addEventListener('click', (event)=>{
    const clase = event.target.getAttribute('class');
    if(clase=='modal fade'){
        const alertas = document.querySelectorAll('#alertas');
        const servicios = document.querySelectorAll('#servicios');
        const graficos = document.querySelectorAll('#areaChart');
        alertas.forEach((ele)=>{
            ele.innerHTML='';
        });
        servicios.forEach((ele)=>{
            ele.innerHTML='';
        });
        graficos.forEach((ele)=>{
            ele.innerHTML='<canvas class="chartjs-render-monitor graph"></canvas>';
        })
    }
    //console.log(alertas, servicios, graficos);
})


/*

    Fin gestion cerrados de las modales

*/
