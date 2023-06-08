<?php

namespace Models\Builders;

use Models\Room;

class RoomBuilder
{
    private string $id = "";
    private int $blindtestId;

    public function setId(string $id): RoomBuilder {
        $this->id = $id;
        return $this;
    }

    public function setBlindtestId(int $blindtestId): RoomBuilder {
        $this->blindtestId = $blindtestId;
        return $this;
    }

    public function build(): Room {
        return new Room($this->id, $this->blindtestId);
    }
}