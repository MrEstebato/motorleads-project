import Utils from './Utils.js';

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
        valorMedio[key] = calcularPromedio(valorVenta[key], valorCompra[key]);
    }
}

const plazos = [Utils.months({count: 3}),
    Utils.months({count: 6}),
    Utils.months({count: 12}),
    Utils.months({count: 24})];       // plazos para graficacion (variable independiente)

const precios = [valorVenta,valorMedio,valorCompra];
            // obtener los precios para graficacion (var. dependientes)
                        // desde la API por medio de PHP

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

const grafica = new Chart(document.getElementById('grafica'), config);

const data = {
  labels: plazos,
  datasets: [
    {
      label: 'Valor a la venta',
      data: valorVenta,
      borderColor: Utils.CHART_COLORS.green,
      fill: {
        target: origin,
        below: 'rgba(124, 238, 55, 0.2)'
      },
      order: 1
    },
    {
      label: 'Valor medio',
      data: valorMedio,
      borderColor: Utils.CHART_COLORS.orange,
      fill: {
        target: origin,
        below: 'rgba(253, 163, 33, 0.2)'
      },
      order: 2
    },
    {
      label: 'Valor a la compra',
      data: valorCompra,
      borderColor: Utils.CHART_COLORS.blue,
      fill: {
        target: origin,
        below: 'rgba(33, 176, 253, 0.2)'
      },
      order: 3
    }
  ]
};

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
                            datos.datasets[index].data.push(Utils.rand(-100, 100));
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
                                dataset.data.push(Utils.rand(-100, 100));
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
                            dataset.data.push(Utils.rand(-100, 100));
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