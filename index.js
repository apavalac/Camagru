const http = require('http');

const requestListener = function (req, res) {
    res.write('HelloWorld');
    res.end();
}

const listeningListener = function () {
    console.log('started listening on port ', port);
}

const server = http.createServer(requestListener);

const port = Number.parseInt(process.env.PORT) || 3000;
server.listen(port, listeningListener);