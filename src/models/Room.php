<?php
namespace Models;

class Room extends Model
{
    protected string $id = "";
    protected int $blindtestId;

    public function __construct(string $id, int $blindtestId)
    {
        $this->id = $id;
        $this->blindtestId = $blindtestId;
    }
    
    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getBlindtestId(): int
    {
        return $this->blindtestId;
    }
}