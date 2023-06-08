<?php

namespace Models;

class ResetPassword extends Model {
    protected int $id = -1;
    protected string $user_email;
    protected string $selector;
    protected string $token;
    protected string $expires;

    public function __construct(string $user_email, string $selector, string $token, string $expires, int $id){
        $this->user_email = $user_email;
        $this->selector = $selector;
        $this->token = $token;
        $this->expires = $expires;
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->user_email;
    }

    /**
     * @return string
     */
    public function getSelector(): string
    {
        return $this->selector;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @return string
     */
    public function getExpires(): string
    {
        return $this->expires;
    }
}