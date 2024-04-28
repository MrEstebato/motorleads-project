import {months} from './Utils';
import { CHART_COLORS } from './Utils';

function promedio(n1,n2) {
    return ((n1+n2)/2);
}

//ejemplo dicc. : {1: '24', 2: '0', 3: '14', 4: '52'}
//unos diccionarios
valorVenta = {};
valorCompra = {};
// promedio de valorVenta y valorCompra
valorMedio =  {};

for (key in valorVenta) {
        // verificar coincidencia de llaves (verificar la definicion de los diccionarios)
    if (valorCompra.hasOwnProperty(key)) {
        valorMedio[key] = promedio(valorVenta[key], valorCompra[key]);
    }
}

const plazos = [months({count: 3}),
    months({count: 6}),
    months({count: 12}),
    months({count: 24})];       // plazos para graficacion (variable independiente)
 
    // manipular la grafica por medio de los botones
        // cambiando los precios historicos
function actBuild(action) {
    const actions = [
                {
                    name: '3M',
                handler(grafica) {
                    const datos = grafica.data;
                    if (datos.datasets.length > 0) {
                        // si se deben quitar datos graficados
                        if (datos.labels != plazos[0]) {
                            datos.labels = plazos[0];
                            //  eliminar datos
                            while (datos.labels.length != 3) {
                                datos.datasets.forEach(dataset => {
                                    dataset.data.pop();
                                });
                            }
                            grafica.update();
                        } else {
                            datos.labels = plazos[0];
                            grafica.update();
                        }
                    }
                }
            },
            {
                name: '6M',
                handler(grafica) {
                    const datos = grafica.data;
                    if (datos.datasets.length > 0) {
                        if (datos.labels != plazos[1]) {
                            if (datos.labels.length > 6) {
                                // eliminar datos
                                while (datos.labels.length != 6) {
                                    datos.datasets.forEach(dataset => {
                                        dataset.data.pop();
                                    });
                                }
                                datos.labels = plazos[1];
                                grafica.update();
                            } else if (datos.labels.length < 6) {
                                // agregar datos (cambiar el push)
                                for (let index = 0; index < datos.datasets.length; ++index) {
                                    datos.datasets[index].data.push(/*INSERTAR AQUI LOS DATOS A AGREGAR*/);
                                }
                                datos.labels = plazos[1];
                                grafica.update();
                            }
                        } else {
                            datos.labels = plazos[1];
                            grafica.update();
                        }
                    }
                }
            },
            {
                name: '1A',
                handler(grafica) {
                    const datos = grafica.data;
                    if (datos.datasets.length > 0) {
                        if (datos.labels != plazos[2]) {
                            if (datos.labels.length > 12) {
                                    // eliminar datos
                                    datos.datasets.forEach(dataset => {
                                        dataset.data.pop();
                                    });
                                    datos.labels = plazos[2];
                                    grafica.update();
                                } else if (datos.labels.length < 12) {
                                    // agregar datos
                                while (datos.labels.length != 12) {
                                    datos.datasets.forEach(dataset => {
                                        dataset.data.push(/*INSERTAR AQUI LOS DATOS A AGREGAR*/);
                                    });
                                }
                                datos.labels = plazos[2];
                                grafica.update();
                            }
                        } else {
                            datos.labels = plazos[2]
                            grafica.update();
                        }
                    }
                }
            },
            {
                name: '2A',
                handler(grafica) {
                    const datos = grafica.data;
                    if (datos.datasets.length > 0) {
                        if (datos.labels != plazos[3]) {
                            while (datos.labels.length != 24) {
                                datos.datasets.forEach(dataset => {
                                    dataset.data.push(/*INSERTAR AQUI LOS DATOS A AGREGAR*/);
                                });
                            }
                            datos.labels = plazos[3];
                            grafica.update();
                        } else {
                            datos.labels = plazos[3];
                            grafica.update();
                        }
                    }
                }
            }
    ];
    switch (action) {
        case '3M':
            actions[0].handler(grafica);
            break;
        case '6M':
            actions[1].handler(grafica);
            break;
        case '1A':
                ctions[2].handler(grafica);
            break;
        case '2A':
            actions[3].handler(grafica);
            break;
        default:
            console.log("Acción no válida");
            alert("Acción no válida, intente de nuevo");
    }
}

const precios = [valorVenta,valorMedio,valorCompra];
            // obtener los precios para graficacion (var. dependientes)
                        // desde la API por medio de PHP

    // configuración de la gráfica
const config = {
    type: 'line',
    data: data,
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            tooltips: {
                enabled: true,
                mode: 'average',
                callbacks: {
                    label: function(context) {
                        let label = '';
                        if (context.dataset.label) {
                            label += context.dataset.label + ': '; // Añade el nombre de la base de datos como título
                        }
                        label += '$' + context.parsed.y.toFixed(2); // Añade el valor de la base de datos
                        return label;
                    }
                }
            }
        }
    }
};

    // configuración de los datos
const data = {
  labels: plazos,
  datasets: [
      {
      label: 'Valor a la venta',
      data: valorVenta,
      borderColor: CHART_COLORS.green,
      fill: {
          target: origin,
        below: 'rgba(124, 238, 55, 0.2)'
    },
      order: 1
    },
    {
      label: 'Valor medio',
      data: valorMedio,
      borderColor: CHART_COLORS.orange,
      fill: {
        target: origin,
        below: 'rgba(253, 163, 33, 0.2)'
    },
    order: 2
    },
    {
      label: 'Valor a la compra',
      data: valorCompra,
      borderColor: CHART_COLORS.blue,
      fill: {
        target: origin,
        below: 'rgba(33, 176, 253, 0.2)'
    },
    order: 3
    }
]
};

// acciones predeterminadas
window.onload = function handlerPredefined() {
    // recibir datos predeterminados desde php y procesarlos
    const grafica = new Chart(document.getElementById('grafica'), config);
    actBuild('3M');
}

const grafica = new Chart(document.getElementById('grafica'), config);


// mandar peticiones a la API con método POST
function postAPI() {
        // recibir lo mandado por el formulario de la segunda pantalla
    document.getElementById('datos').addEventListener('submit', function(event) {
        const formData = new FormData(this);

        fetch('grafica.php', {
            method: 'POST',
                // hacer post hacia php para recibir informacion
            body: JSON.stringify(Object, fromEntries(formData.entries())),
            headers: {
                'Content-Type': 'application/json'
            }
        })
            // recibir respuesta de php y la API?
        .then(response => response.json())
        .then(data => {
                // visualizar la informacion recibida
            console.log(data);
        })
        .catch(error => console.log('Error:',error));
    });
}