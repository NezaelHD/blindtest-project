class createdDTO {
    type;

    constructor() {
        this.type = "created";
    }

    toJSON() {
        return JSON.stringify({
            "type": this.type
        });
    }
}

module.exports = createdDTO;