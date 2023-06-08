if (!window.location.toString().includes('play')) {
} else {
    const gameInstance = document.querySelector('#game-instance');
    const serverUrl = 'ws://localhost:3000';
    const roomId = gameInstance.dataset.room_id;
    const blindtestId = gameInstance.dataset.blindtest_id;
    const userId = gameInstance.dataset.user_id;


    const ws = new WebSocket(`${serverUrl}/${roomId}/${userId}`);

    ws.onopen = () => {
        console.log('Connecté au serveur WebSocket');
        ws.onmessage = (event) => {
            const datas = JSON.parse(event.data);
            switch (datas.type) {
                case "created":
                    let button = document.createElement("button");
                    button.innerHTML = "Lancer le blindtest";
                    button.addEventListener("click", startGame);
                    gameInstance.appendChild(button);
                    ws.send(new initDTO(roomId, blindtestId).toJSON());
                    break;
                case "newQuestion":
                    initializeGameScene();
                    let youtubeParams = "?autoplay=1&showinfo=0&controls=0";
                    let url = datas.url;
                    if(url.includes('watch?v=')) {
                        url = url.replace('watch?v=', 'embed/') + youtubeParams;
                    } else {
                        url = url + youtubeParams;
                    }
                    let youtubePlayer = document.querySelector('#youtube-player')
                    youtubePlayer.setAttribute("src", url);
                    break;
                case "gameEnded":
                    window.location.href = datas.url;
                    break;
            }
        };
    };

    ws.onclose = () => {
        console.log('Déconnecté du serveur WebSocket');
    };

    function startGame(event) {
        event.target.remove();
        ws.send(new startDTO(roomId).toJSON());
    }

    function sendAnswer() {
        let answer = document.querySelector('#blindtest-answer').value;
        ws.send(new answerDTO(roomId, userId, answer).toJSON());
    }

    function initializeGameScene(){
        if(!document.querySelector("#blindtest-answer")){
            let answerContainer = document.createElement("div");
            answerContainer.id = "answer-container";
            let input = document.createElement("input");
            input.setAttribute("type", "text");
            input.id="blindtest-answer";
            let button = document.createElement("button");
            button.addEventListener("click", sendAnswer);
            button.innerHTML = "Envoyer";
            answerContainer.appendChild(input);
            answerContainer.appendChild(button);

            let div = document.createElement("div");
            div.classList = "iframe-container";
            let iframe = document.createElement("iframe");
            iframe.setAttribute("src", "about:blank");
            iframe.setAttribute("allow", "autoplay");
            iframe.style.display = 'none';
            iframe.id = 'youtube-player';
            div.appendChild(iframe);
            gameInstance.appendChild(div);

            gameInstance.appendChild(answerContainer);
        }
    }
}