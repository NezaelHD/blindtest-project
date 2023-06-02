<?php

namespace Models\Builders;

use Models\Scoreboard;

class ScoreboardBuilder
{
    private int $id = -1;
    private int $score;
    private int $blindtestId;
    private int $userId;

    public function setScore(int $score): ScoreboardBuilder
    {
        $this->score = $score;
        return $this;
    }

    public function setBlindtestId(int $blindtestId): ScoreboardBuilder
    {
        $this->blindtestId = $blindtestId;
        return $this;
    }

    public function setUserId(int $userId): ScoreboardBuilder
    {
        $this->userId = $userId;
        return $this;
    }

    public function setId(int $id): ScoreboardBuilder
    {
        $this->id = $id;
        return $this;
    }

    public function build(): Scoreboard
    {
        return new Scoreboard($this->score, $this->blindtestId, $this->userId, $this->id);
    }
}