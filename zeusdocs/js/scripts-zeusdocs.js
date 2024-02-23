/* AGREGAR UNA FLECHA A LOS ITEMS CON SUBITEMS Y EXPANDIR SUBMENÚ */

// Seleccionar todos los elementos con children
const highlightedItems = document.querySelectorAll(".page_item_has_children > a");

// Para cada uno de esos elementos
highlightedItems.forEach((userItem) => {
    // Crear un span
    let caret = document.createElement('span');

    // Agregarle esa clase
    caret.classList.add('caret');

    // Contenido del span
    caret.innerHTML = '<svg width="38" height="67" viewBox="0 0 38 67" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.48721 8.32383C-0.362923 6.4737 -0.362923 3.47405 1.48721 1.62392C3.33733 -0.226204 6.33698 -0.226204 8.18711 1.62392L36.6124 30.0492C38.4625 31.8994 38.4625 34.899 36.6124 36.7491L8.18711 65.1744C6.33698 67.0245 3.33733 67.0245 1.48721 65.1744C-0.362923 63.3243 -0.362923 60.3246 1.48721 58.4745L26.5625 33.3992L1.48721 8.32383Z" fill="#212121"/></svg>'

    // Agregar el span a los elementos seleccionados
    userItem.appendChild(caret);
});

const expandBtns = document.querySelectorAll(".page_item_has_children");

expandBtns.forEach((expandBtn) => {
    expandBtn.addEventListener('click', function (e) {
        if (expandBtn.closest('.page_item_has_children').classList.contains('current_page_parent')) {
            expandBtn.closest('.page_item_has_children').classList.remove('current_page_parent');
            expandBtn.closest('.page_item_has_children').classList.remove('current_page_ancestor');
            expandBtn.closest('.page_item_has_children').classList.remove('current_page_item');
        } else {
            expandBtn.closest('.page_item_has_children').classList.add('current_page_ancestor');
            expandBtn.closest('.page_item_has_children').classList.add('current_page_parent');
            expandBtn.closest('.page_item_has_children').classList.add('current_page_item');
        }

    })
});



/* CERRAR Y ABRIR EL MENÚ */


let triggerMenu = document.getElementById('toggle-menu');
let sidebar = document.querySelector('.menu-sidebar');

triggerMenu.addEventListener('click', function () {
    document.querySelector('body').classList.toggle('sidebar-closed');
});



/* MOSTRAR EL FORMULARIO DE FEEDBACK SI EL USUARIO DICE QUE EL ARTICULO FUE O NO UTIL.*/

const util = document.querySelector('.util');
let feedbackOpciones = document.querySelectorAll('.feedback-opcion');
const feedbackBox = document.querySelector('.feedback');
const inputUtil = document.querySelector('.uk-input');
const btnSubmit = document.getElementById('submit')

Array.from(feedbackOpciones).forEach(opcion => {
    opcion.addEventListener('click', function (event) {
        feedbackOpciones.forEach(opcion => {
            opcion.classList.remove('selected');
        });
        opcion.classList.add('selected');
        inputUtil.value = this.value;
        feedbackBox.classList.add('active');
        //  console.log(this.value);
        util.classList.add('inactive');
        btnSubmit.innerText = 'Enviar su comentario';
        btnSubmit.value = 'Enviar su comentario';
    });
});

/* MOSTRAR UNA ACLARACIÓN POR SI EL USUARIO QUIERE ENVIAR SUS DATOS */

const commentForm = document.querySelector('.comment-form-comment')
if (commentForm) {
    commentForm.insertAdjacentHTML('afterend', '<p class="aclaracion mt-2 mb-1"><strong>(Opcional) Deje sus datos si desea que nos pongamos en contacto con usted:</strong></p>')
}


/* COMENTARIOS CON AJAX PARA QUE NO CARGUE UNA NUEVA PÁGINA AL ENVIAR */

if (typeof jQuery != 'undefined') {

    jQuery('document').ready(function ($) {
        var commentform = $('.comment-respond'); // find the comment form
        var commentbox = $('.comment-form');
        commentform.append('<div id="comment-status" ></div>'); // add info panel before the form to provide feedback or errors
        var statusdiv = $('#comment-status'); // define the infopanel

        commentform.submit(function () {
            //serialize and store form data in a variable
            var formdata = commentform.serialize();
            //Add a status message
            statusdiv.html('<p>Processing...</p>');
            statusdiv.show();
            commentbox.hide();
            //Extract action URL from commentform
            var formurl = commentform.attr('action');
            //Post Form with data
            $.ajax({
                type: 'post',
                url: formurl,
                data: formdata,
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    statusdiv.html('<p class="ajax-error" >Puede haber dejado un campo vacío o haber enviado demasiado rápido.</p>');
                },
                success: function (data, textStatus) {
                    if (data == "success")
                        statusdiv.html('<p class="ajax-success" >¡Gracias por enviarnos su comentario!.</p>');
                    else
                        statusdiv.html('<p class="ajax-error" >Por favor, espere unos minutos antes de enviar un nuevo comentario.</p>');
                    commentform.find('textarea[name=comment]').val('');
                }
            });
            return false;

        });
    });

}


// FRANCISCO 02/2024
 // Desplegar las subpaginas al tocar la flecha. Le agrega una clase open al elemento principal y con css hace que se muestren.
 document.addEventListener("DOMContentLoaded", function () {
    var expandButtons = document.querySelectorAll('.expand');

    expandButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            var parentLi = this.parentElement;
            var topLevelList = parentLi.querySelector('li');

            if (topLevelList) {
                // Toggle the "open" class for the parent li
                parentLi.classList.toggle('open');

                // Remove the "open" class from other sibling lis
                var siblings = parentLi.parentElement.children;
                for (var i = 0; i < siblings.length; i++) {
                    var sibling = siblings[i];
                    if (sibling !== parentLi) {
                        sibling.classList.remove('open');
                    }
                }
            }
        });
    });
});

