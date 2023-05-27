<?php

namespace Models;

     class User extends Model {
        protected int $id = -1;
        protected string $email;
        protected string $name;
        protected string $password;
        protected bool $isAdmin;
        protected string $avatar;

        public function __construct(string $email, string $name, string $password, bool $isAdmin, string $avatar, int $id){
            $this->email = $email;
            $this->name = $name;
            $this->password = $password;
            $this->isAdmin = $isAdmin;
            $this->avatar = $avatar;
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
             return $this->email;
         }

         /**
          * @return string
          */
         public function getName(): string
         {
             return $this->name;
         }

         /**
          * @return string
          */
         public function getPassword(): string
         {
             return $this->password;
         }

         /**
          * @return bool
          */
         public function isAdmin(): bool
         {
             return $this->isAdmin;
         }

         /**
          * @return string
          */
         public function getAvatar(): string
         {
             return $this->avatar;
         }

         /**
          * @param string $password
          */
         public function setPassword(string $password): void
         {
             $this->password = $password;
         }
     }