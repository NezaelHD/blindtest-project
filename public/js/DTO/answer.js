class answerDTO {
    type;
    roomId;
    userId;
    answer;

    constructor(roomId, userId, answer) {
        this.roomId = roomId;
        this.userId = userId;
        this.type = "answer";
        this.answer = answer;
    }

    toJSON() {
        return JSON.stringify({
            "type": this.type,
            "roomId": this.roomId,
            "userId": this.userId,
            "answer": this.answer
        });
    }
}

