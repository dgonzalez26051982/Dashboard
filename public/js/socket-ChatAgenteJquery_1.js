function newMessage() {
    message = $(".message-input input").val();
    if ($.trim(message) == '') {
        return false;
    }
    socket.emit('enviarMensajeAgente_Cliente', {
        tipoUsuario: "Agente",
        mensaje: message
    });

    $('<li class="sent"><img src="images/agente.png" alt="" /><p>' + message + '</p></li>').appendTo($('.messages ul'));
    $('.message-input input').val(null);

    //$('.contact.active .preview').html('<span>You: </span>' + message);
    $(".messages").animate({ scrollTop: $(document).height() }, "fast");
};

$('.submit').click(function() {
    newMessage();
});
/**Esta es una funcion que escucha el evento enter del tecclado*/
$(window).on('keydown', function(e) {
    if (e.which == 13) {
        newMessage();
        return false;
    }
});

var ulClienteChatbox = $('#ulClienteChatbox');

function renderizarMensajeCliente(mensaje) {

    $('<li class="replies"><img src="images/Cliente.png" alt="" /><p>' + mensaje + '</p></li>').appendTo($('.messages ul'));
    //$(".messages").animate({ scrollTop: $(document).height() }, "fast");
    $('.messages ul').scrollTop($('messages ul').prop('scrollHeight'));
}

socket.on('AsignarIdCliente_Al_Agente', (nombreClienteAsigando) => {
    console.log("* *Te ha sido asignado un Cliente * *");
    $('<li class="contact"><div class="wrap" ><span class="contact-status online"></span><img src="images/Cliente.png" alt="" /><div class="meta"><p class="name">Cliente:' + nombreClienteAsigando + '</p><button class="BtnTerminar" >Terminar <i class="fa fa-window-close" aria-hidden="true"></i></button></div></div></li>').appendTo($('.contacts ul'));
    $('.BtnTerminar').click(function() {
        socket.emit('agente_emite_desconectar_cliente');
    });
    $('<img src="images/Cliente.png" alt="" /><p>Cliente</p>').appendTo($('#content .contact-profile'));
    $("#inputText").removeAttr("readonly");
});

/* socket.on('mensajePrivadoAgente_Cliente', function(msg) {
    console.log("Agente escucha el mensaje ", msg);
    $('#messages').append($('<li>').text(msg));
}); */

socket.on('mensajePrivadoCliente_Agente', function(msg) {
    console.log("Agente escucha el mensaje ", msg);
    renderizarMensajeCliente(msg);
});

socket.on('clienteAsignadoDesconectado', () => {
    console.log("cliente se salio");
    $('.contacts ul').empty();
    $('#content .contact-profile').empty();
    $('.messages ul').empty();
    $('#inputText').replaceWith('<input id="inputText" type="text" placeholder="Ingrese su mensaje aqui..." readonly/>');
});

socket.on('connect', () => {
    console.log("cliente se salio");
    $('.contacts ul').empty();
    $('#content .contact-profile').empty();
    $('.messages ul').empty();
    $('#inputText').replaceWith('<input id="inputText" type="text" placeholder="Ingrese su mensaje aqui..." readonly/>');
});