if (window.location.pathname === "/") {
    const joinRoomBtn = document.getElementById("btn-join");

    joinRoomBtn.addEventListener('click', joinRoom);

    function joinRoom(){
        const roomCode = document.getElementById("roomCode").value;
        if (roomCode !== ""){
           window.location.pathname = `/play/${roomCode}`;
        }
    }
}