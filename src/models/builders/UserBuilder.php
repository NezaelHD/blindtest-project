<?php

namespace Models\Builders;

use Models\User;

class UserBuilder {
    private int $id = -1;
    private string $email;
    private string $name;
    private string $password;
    private bool $isAdmin;
    private string $avatar;

    public function setEmail(string $email): UserBuilder{
        $this->email = $email;
        return $this;
    }
    public function setName(string $name): UserBuilder{
        $this->name = $name;
        return $this;
    }
    public function setPassword(string $password): UserBuilder{
        $this->password = $password;
        return $this;
    }
    public function setIsAdmin(bool $isAdmin): UserBuilder{
        $this->isAdmin = $isAdmin;
        return $this;
    }
    public function setAvatar(string $avatar): UserBuilder{
        $this->avatar = $avatar;
        return $this;
    }

    public function setId(int $id){
        $this->id = $id;
        return $this;
    }

    public function build(): User{
        return new User($this->email, $this->name, $this->password, $this->isAdmin, $this->avatar, $this->id);
    }
}