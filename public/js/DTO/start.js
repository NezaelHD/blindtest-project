class startDTO {
    type;
    roomId;

    constructor(roomId) {
        this.type = "start";
        this.roomId = roomId;
    }

    toJSON() {
        return JSON.stringify({
          "type": this.type,
          "roomId": this.roomId
        });
    }
}

