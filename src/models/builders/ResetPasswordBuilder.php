<?php

namespace Models\Builders;

use Models\ResetPassword;

class ResetPasswordBuilder {
    private int $id = -1;
    private string $user_email;
    private string $selector;
    private string $token;
    private string $expires;

    public function setEmail(string $user_email): ResetPasswordBuilder{
        $this->user_email = $user_email;
        return $this;
    }
    public function setSelector(string $selector): ResetPasswordBuilder{
        $this->selector = $selector;
        return $this;
    }
    public function setToken(string $token): ResetPasswordBuilder{
        $this->token = $token;
        return $this;
    }
    public function setExpires(string $expires): ResetPasswordBuilder{
        $this->expires = $expires;
        return $this;
    }

    public function setId(int $id): ResetPasswordBuilder{
        $this->id = $id;
        return $this;
    }

    public function build(): ResetPassword{
        return new ResetPassword($this->user_email, $this->selector, $this->token, $this->expires, $this->id);
    }
}