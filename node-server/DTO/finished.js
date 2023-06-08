class finishedDTO {
    type;
    url;

    constructor(url) {
        this.type = "gameEnded";
        this.url = url;
    }

    toJSON() {
        return JSON.stringify({
            "type": this.type,
            "url": this.url
        });
    }
}
module.exports = finishedDTO;