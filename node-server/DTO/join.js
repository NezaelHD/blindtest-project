class joinDTO {
    type;
    userId;

    constructor(userId) {
        this.type = "newPlayer";
        this.userId = userId;
    }

    toJSON() {
        return JSON.stringify({
            "type": this.type,
            "userId": this.userId
        });
    }
}
module.exports = joinDTO;