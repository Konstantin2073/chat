import WebSocket, { WebSocketServer } from 'ws';

const wss = new WebSocketServer({ port: 6001 });

let clients = {};

wss.on('connection', (ws, req) => {
    const params = new URLSearchParams(req.url.replace('/', ''));
    const userKey = params.get('key');
    if (userKey) clients[userKey] = ws;

    ws.on('close', () => { delete clients[userKey]; });
});

globalThis.broadcastToUser = (userKey, data) => {
    if (clients[userKey]) clients[userKey].send(JSON.stringify(data));
};

console.log('WebSocket load ws://127.0.0.1:6001');