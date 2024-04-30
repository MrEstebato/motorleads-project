function validar_formulario() {
    correo = document.formaInicio.email.value;
    contrasena = document.formaInicio.password.value;

    // Validar el formato del correo
    var correoValido = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(correo);

    // Validar la longitud de la contraseña
    var contrasenaValida = contrasena.length >= 6 && contrasena.length <= 64;

    console.log("Correo válido:", correoValido);
    console.log("Contraseña válida:", contrasenaValida);

    if (!correoValido) {
        alert("Por favor ingresa una dirección de correo válida.");
        return false;
    } else if (!contrasenaValida) {
        alert("La contraseña debe tener entre 6 y 64 caracteres.");
        return false;
    } else if (correoValido && contrasenaValida) {
        var url = "http://localhost/MotorLeads/menu.php";
        window.location.href = url;
    }
    return true;
}


function agregarEventListenersListas(){
    obtenerCamposFormulario();
    for(let elemento of camposFormulario){
    if (elemento.id == "vehicles" || elemento.id =="km" || elemento.id=="color"|| elemento.id=="boton"){
        continue;
    }
    else{
        elemento.addEventListener(
            "input",
            function (e) {
                var isInputEvent =
                Object.prototype.toString.call(e).indexOf("InputEvent") > -1;
                // If the type is not InputEvent, then an option was selected from the datalist
                if (!isInputEvent){
                    
                    obtenerDatos(elemento, enlaceActual);
                };
            },
            false
            );

    }
}
    
}

function setEnlaceActual(enlace){
    enlaceActual = enlace;
}


function desplegarDatos(datos, listaId,datosForm, elementosVisisblesPHP){
    const lista = document.createElement("datalist");
    lista.id = listaId;
    datos = JSON.parse(datos);
    
    elementosDisponibles = JSON.parse(elementosVisisblesPHP);

    ids = [];
    names = [];

    for(let info of datos){
        if (info["version"]!=null){
            console.log(info["version"]);
            ids.push(info["id"]);
            names.push(info["version"]);

            const listItem = document.createElement("option");
            listItem.value = info["version"];

            lista.appendChild(listItem);
            console.log(names);
        }
        else{
        ids.push(info["id"]);
        names.push(info["name"]);

        const listItem = document.createElement("option");
        listItem.value = info["name"];

        lista.appendChild(listItem);

        }

    }
    document.body.appendChild(lista);
    llenarFormulario(datosForm);
}

function obtenerCamposFormulario(){

    camposFormulario = document.APIForm.elements;
}

function llenarFormulario(datos){

    if(datos.length == 0){
        return;
    }

    datos = JSON.parse(datos);

    if(Object.keys.length == 0){
        return;
    }

    obtenerCamposFormulario();

    camposRestantes = Object.keys(datos).length+1;

    for(let campo of camposFormulario){
        try{
            campo.value = datos[campo.id]["name"];
        }
        catch{

        }
        
        if(elementosDisponibles.indexOf(campo.id) != "-1"){
            const disableID = campo.id;
           

            document.getElementById(disableID).disabled = false;

        }

        camposRestantes-=1;
        if(camposRestantes == 0) break;

    }

}

function obtenerDatos(elementoForm,enlaceActualAPI){

    datosFormulario = {};

    for(let campo of camposFormulario){
        if(!campo.value.length == 0){
            datosFormulario[campo.id] = {};
            datosFormulario[campo.id]["name"] = campo.value;
        }
       
    }

    datosFormulario = JSON.stringify(datosFormulario);

    elementosDisponibles.push(relacionesDatos[elementoForm.id]);

    if(casosEspeciales.indexOf(elementoForm.id) == "-1"){

        enlaceActualAPI = enlaceActualAPI + "/" + ids[names.indexOf(elementoForm.value)]+"/"+relacionesDatos[elementoForm.id];

    }
    else{
        enlaceActualAPI = "https://MotorLeads-api-d3e1b9991ce6.herokuapp.com/api/v1/" + elementoForm.id + "/" + ids[names.indexOf(elementoForm.value)] + "/" + relacionesDatos[elementoForm.id];    
    }

    enlace = "http://localhost/MotorLeads/menu.php?enlaceAPI="+enlaceActualAPI+"&datosFormulario="+datosFormulario+"&nombreLista="+relacionesDatos[elementoForm.id]+"L"+"&elementosDisponibles="+JSON.stringify(elementosDisponibles);
    location.href = enlace;

}

function enviaDatos(datos){
    console.log(document.APIForm.km.value);
    if(document.APIForm.km.value=="" || document.APIForm.color.value==""){
        alert("Todos los campos deben contener información");
    }
    else{
    datos = JSON.parse(datos);
    aux = document.APIForm.vehicles.value;
    year = document.APIForm.years.value;
    kilometraje = document.APIForm.km.value;

    console.log(year);
    for(let info of datos){
        if (info["version"]==aux){
            urlHistoricos = "https://motorleads-api-d3e1b9991ce6.herokuapp.com/api/v1/vehicles/"+info["id"].toString()+"/pricings?filter[since]=3";
            ventana = "http://localhost/MotorLeads/graficas.php?enlaceAPI="+urlHistoricos+"&anio="+year+"&kilometraje="+kilometraje
            console.log(ventana);
            window.location.replace(ventana);
            
        }
    }
    
}
}

let camposFormulario = null;
let ids = null;
let names = null;
let enlaceActual = null;

let relacionesDatos = {
    "makes":"models",
    "models":"years",
    "years":"vehicles",
    "vehicles":"pricings?filter[since]=3"
    
};

let casosEspeciales = ["models","vehicles"];

let elementosDisponibles = [];
