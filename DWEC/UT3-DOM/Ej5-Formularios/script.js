'use strict';

let formulario=document.getElementById('formulario');
let nombre=document.getElementById('nombre');
let email=document.getElementById('email');
let password=document.getElementById('password');
let confirmPassword=document.getElementById('confirmPassword');
let fechaNac=document.getElementById('fechaNacimiento');
let telefono=document.getElementById('telefono');
let genero=document.getElementById('genero');
let terminos=document.getElementById('terminos');
let btnRegistrarse=document.getElementById('registrarse');
let resultado=document.getElementById('resultado');
//errores
let errorNombre=document.getElementById('errorNombre');

//Validaciones ->
function validarNombre(){
    let valor=nombre.value.trim();
    let mensaje='';

    if(valor===''){
        mensaje='El nombre es obligatorio';
    }else if(valor.length<3){
        mensaje='El nombre es demasiado corto (min 3 caracteres)';
    }else{
        for(let i=0;i<valor.length;i++){
            if(valor[i]>='0' && valor[i]<='9'){
                mensaje='El nombre no puede tener numeros'
            }
        }
    }
    errorNombre.textContent=mensaje;
    if(mensaje===''){

    }
    
}

function validarCorreo(){
    let valor=email.value.trim();
    let mensaje='';

    if(valor===''){
        mensaje='El nombre es obligatorio';

    }
}

function validarPassword(){
    let valor=password.value.trim();
    let mensaje='';
    
    if(valor===''){
        mensaje='El nombre es obligatorio';
    }else if(valor.length<8){
        mensaje='La contraseña es demasiado corta (min 8 caracteres)';
    }else{

    }
}

function confirmarPassword(){
    let valor=confirmPassword.value.trim();
    let mensaje='';

    if(valor!==password){
        mensaje='Las contraseñas deben coincidir'
    }
}

function validarFecha(){

}

function validarTelefono(){
    let valor=telefono.value.trim();
    let mensaje='';

    if(valor.length!==9){
        mensaje='El telefono debe contener 9 caracteres';
    }
}