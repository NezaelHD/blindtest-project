require('dotenv').config()
const WebSocket = require('ws');
const axios = require('axios');
const questionDTO = require("./DTO/question");
const createdDTO = require("./DTO/created");
const finishedDTO = require("./DTO/finished");
const joinDTO = require("./DTO/join");

const wss = new WebSocket.Server({ port: process.env.SERVER_PORT });
const rooms = {};

wss.on('connection', (ws, req) => {
    let urlParams = req.url.replace('/', '').split('/');
    let roomId = urlParams[0];
    let userId = urlParams[1];

    if (rooms[roomId]) {
        rooms[roomId].clients.push({'ws': ws, 'userId': userId});
        rooms[roomId].scores.push({'userId': userId, 'score': 0});
        ws.send(JSON.stringify(`Vous êtes connecté à la room ${roomId}`));
        ws.send(new joinDTO(rooms[roomId].clients.map(elem => elem.userId)).toJSON())
    } else {
        rooms[roomId] = { clients: [{'ws': ws, 'userId': userId}] };
        rooms[roomId].responded = [];
        rooms[roomId].goodResponse = 0;
        rooms[roomId].scores = [{'userId': userId, 'score': 0}];
        rooms[roomId].currentQuestionIndex = 0;
        ws.send(new joinDTO(rooms[roomId].clients.map(elem => elem.userId)).toJSON())
        ws.send(new createdDTO().toJSON());
    }

    ws.on('message', async (message) => {
       const data = JSON.parse(message);
        roomId = data.roomId;
        switch (data.type) {
            case "init":
               let blindtestId = data.blindtestId;
               rooms[roomId].blindtestId = blindtestId;
               axios.get(`${process.env.CLIENT_URL}/blindtest/${blindtestId}`)
                   .then((response) => {
                       questions = [];
                       response.data.songs.forEach(song => {
                           song['isCurrent'] = false;
                           questions.push(song);
                       });
                       rooms[roomId].questions = questions;
                       ws.send(JSON.stringify(rooms[roomId].questions));
                   })
                   .catch(error => {
                       ws.send(error.message);
                   });
               break;
            case "answer":
                if(!rooms[roomId].responded.includes(data.userId)) {
                    let points = 0;
                    if(isApproximatelyEqual(data.answer, rooms[roomId].questions[rooms[roomId].currentQuestionIndex].answer)){
                        switch (rooms[roomId].goodResponse) {
                            case 0:
                                points = 4;
                                break;
                            case 1:
                                points = 2;
                                break;
                            case 2:
                                points = 1
                                break
                            default:
                                break;
                        }
                    }
                    rooms[roomId].scores = incrementScore(rooms[roomId].scores, data.userId, points);
                    rooms[roomId].responded.push(data.userId);
                    rooms[roomId].goodResponse += 1;
                    if(rooms[roomId].responded.length === rooms[roomId].clients.length){
                        if(rooms[roomId].currentQuestionIndex + 1 !== rooms[roomId].questions.length)
                        {
                            rooms[roomId].responded = [];
                            rooms[roomId].goodResponse = 0;
                            rooms[roomId].currentQuestionIndex += 1;
                            rooms[roomId].clients.forEach(client => {
                                client.ws.send(new questionDTO(rooms[roomId].questions[rooms[roomId].currentQuestionIndex].url).toJSON());
                            });
                        }
                        else {
                            axios.post('http://app/scoreboard', {
                                blindtestId: rooms[roomId].blindtestId,
                                scores: rooms[roomId].scores
                            }).then(response => {
                                rooms[roomId].clients.forEach(client => {
                                    client.ws.send(new finishedDTO(`${process.env.CLIENT_URL}/scoreboard/${response.data.blindtestId}`).toJSON());
                                });
                            }).catch(error => {
                                console.log(error);
                            });

                            axios.delete(`${process.env.CLIENT_URL}/room/${roomId}`).then(response => {
                                console.log(response);
                            });
                        }
                    }
                }
                break;
            case "start":
                rooms[roomId].questions[0].isCurrent = true;
                rooms[roomId].clients.forEach(client => {
                    client.ws.send(new questionDTO(rooms[roomId].questions[0].url).toJSON());
                });
                break;
       }
    });

    ws.on('close', () => {
        if (rooms[roomId]) {
            rooms[roomId].clients = rooms[roomId].clients.filter((client) => client !== ws);
            if (rooms[roomId].clients.length === 0) {
                delete rooms[roomId];
            }
        }
    });
});

function isApproximatelyEqual(str1, str2) {
    str1 = str1.toLowerCase();
    str2 = str2.toLowerCase();
    if (Math.abs(str1.length - str2.length) > 1) {
        return false;
    }

    let differences = 0;

    for (let i = 0; i < str1.length; i++) {
        if (str1[i] !== str2[i]) {
            differences++;
            if (differences > 1) {
                return false;
            }
        }
    }
    return true;
}

function incrementScore(scores, userId, points) {
    return scores.map(item => {
        if (item.userId === userId) {
            return {...item, score: item.score + points};
        }
        return item;
    });
}