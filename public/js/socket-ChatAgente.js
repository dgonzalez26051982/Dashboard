var socket = io.connect( 'http://34.233.69.204:3000' );
var dataEntraChat = {
    nombre: "Agente1",
    correo: "agente@gmail.com",
    tipoUsuario: "Agente"
}



socket.on('connect', function() {
    console.log('Conectado al servidor');
    socket.emit('clienteEntraChat', dataEntraChat);
    socket.emit('ActivarAsignador');
});



// escuchar
socket.on('disconnect', function() {
    console.log('Perdimos conexión con el servidor');

});


socket.on('reconectar', function() {
    socket.emit('ActivarAsignador');
})

// Enviar información
/* socket.emit('enviarMensaje', {
    usuario: 'Fernando',
    mensaje: 'Hola Mundo'
}, function(resp) {
    console.log('respuesta server: ', resp);
}); */



// Escuchar información
/* socket.on('crearMensaje', function(mensaje) {

    console.log('Servidor:', mensaje);

}); */