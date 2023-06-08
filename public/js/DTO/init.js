class initDTO {
    type;
    roomId;
    blindtestId;

    constructor(roomId, blindtestId) {
        this.type = "init";
        this.roomId = roomId;
        this.blindtestId = blindtestId;

    }

    toJSON() {
        return JSON.stringify({
            "type": this.type,
            "roomId": this.roomId,
            "blindtestId": this.blindtestId
        });
    }
}

