<?php

namespace Models\Builders;

use Models\Blindtest;

class BlindtestBuilder {
    private int $id = -1;
    private string $name;
    private string $description;
    private int $author;

    public function setDescription(string $description): BlindtestBuilder{
        $this->description = $description;
        return $this;
    }
    public function setName(string $name): BlindtestBuilder{
        $this->name = $name;
        return $this;
    }
    public function setAuthor(int $author): BlindtestBuilder{
        $this->author = $author;
        return $this;
    }

    public function setId(int $id){
        $this->id = $id;
        return $this;
    }

    public function build(): Blindtest {
        return new Blindtest($this->name, $this->description, $this->author, $this->id);
    }
}