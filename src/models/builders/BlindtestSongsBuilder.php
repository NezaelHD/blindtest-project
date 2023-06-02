<?php

namespace Models\Builders;

use Models\BlindtestSongs;

class BlindtestSongsBuilder
{
    private int $id = -1;
    private string $answer;
    private string $url;
    private int $blindtestId;

    public function setAnswer(string $answer): BlindtestSongsBuilder
    {
        $this->answer = $answer;
        return $this;
    }

    public function setUrl(string $url): BlindtestSongsBuilder
    {
        $this->url = $url;
        return $this;
    }

    public function setBlindtestId(int $blindtestId): BlindtestSongsBuilder
    {
        $this->blindtestId = $blindtestId;
        return $this;
    }

    public function setId(int $id): BlindtestSongsBuilder
    {
        $this->id = $id;
        return $this;
    }

    public function build(): BlindtestSongs
    {
        return new BlindtestSongs($this->url, $this->answer, $this->blindtestId, $this->id);
    }
}