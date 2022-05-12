const express = require('express');
const app = express();
const server = require('http').createServer(app);
const io = require('socket.io')(server, {
    cors: { origin: "*"}
});

io.on('connection', (socket) => {
    //console.log('Conectado');

    socket.on('updateOntology', (ontologyID) => {
        //console.log(ontologyID);

        //io.sockets.emit('updateOntology', ontologyID)
        socket.broadcast.emit('updateOntology', ontologyID)
    });

    socket.on('updateChat', (ontologyID) => {
        //console.log(ontologyID);

        //io.sockets.emit('updateOntology', ontologyID)
        socket.broadcast.emit('updateChat', ontologyID)
    });

    socket.on('disconnect',  (socket) => {
        //console.log('Desconectado');
    });
})

server.listen(3000, () => {
    console.log('Servidor iniciado.');
})