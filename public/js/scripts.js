'use strict'

$(document).ready(function () {
    //alert('todo ok');
    bsCustomFileInput.init()
})

//Habilitar boton de comentarios
const inputs = document.querySelectorAll('form input');

const validar = (e) => {
    if(e.target.value.length >= 1){
        $('.comment-button').removeAttr('disabled');
    }else{
        $('.comment-button').attr('disabled', true);
    }
}

inputs.forEach((input) => {
    input.addEventListener('keyup', validar);
    input.addEventListener('blur', validar);
});

//Buscador
const buscador = document.querySelector('#buscador');

function buscar_datos(consulta){
    var url_origin = window.location.href;
    var url_array = url_origin.split("/");
    var ruta = url_array[0]+"//"+url_array[2]+"/";

    const url = ruta+'buscar/'+consulta;

    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        data: {consulta: consulta},
    })
    .done(function(respuesta){
        let dato = respuesta.users;
        let caja = document.querySelector('#users');
        caja.innerHTML = '';

        if(dato != false){

            for(let res of dato){
                caja.innerHTML += `
                <li>
                    <a href="${ruta+'perfil/'+res.id}">
                        <div class="usuario">
                            <div class="img">
                                <img src="${res.profile_photo_url}">
                                
                            </div>
                            <div class="desc">
                                <p><strong>${'@'+res.nick}</strong></p>
                                <p>${res.name+' '+res.surname}</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </li>
                `
            }
        }else{
            caja.innerHTML += '<li>No se encontraron resultados<li>';
        }
    });
}

const buscar = (e) => {

    let entrada = e.target.value;

    if(e.target.value.length >= 1){
        $('#resultado').removeClass('hidden');
        buscar_datos(entrada);
    }else{
        $('#resultado').addClass('hidden');
    }
}

buscador.addEventListener('keyup', buscar);