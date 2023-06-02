<?php

namespace Models;

     class Blindtest extends Model {
        protected int $id = -1;
        protected string $name;
        protected string $description;
        protected int $author;
        protected array $songs;

        public function __construct(string $name, string $description, int $author, int $id){
            $this->name = $name;
            $this->description = $description;
            $this->author = $author;
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
         public function getName(): string
         {
             return $this->name;
         }

         /**
          * @return string
          */
         public function getDescription(): string
         {
             return $this->description;
         }

         /**
          * @return int
          */
         public function getAuthor(): int
         {
             return $this->author;
         }

         public function setSongs($songs): void {
             $this->songs = $songs;
         }
     }