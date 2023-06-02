<?php

namespace Models;

     class BlindtestSongs extends Model {
        protected int $id = -1;
        protected string $answer;
        protected string $url;
        protected int $blindtestId;

        public function __construct(string $url, string $answer, int $blindtestId, int $id){
            $this->url = $url;
            $this->answer = $answer;
            $this->blindtestId = $blindtestId;
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
         public function getAnswer(): string
         {
             return $this->answer;
         }

         /**
          * @return string
          */
         public function getUrl(): string
         {
             return $this->url;
         }

         /**
          * @return int
          */
         public function getBlindtestId(): int
         {
             return $this->blindtestId;
         }
     }