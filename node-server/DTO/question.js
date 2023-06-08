class questionDTO {
    type;
    url;

    constructor(url) {
        this.type = "newQuestion";
        this.url = url;
    }

    toJSON() {
        return JSON.stringify({
            "type": this.type,
            "url": this.url
        });
    }
}
module.exports = questionDTO;