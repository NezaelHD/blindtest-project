<?php

namespace Models;

     class Scoreboard extends Model {
        protected int $id = -1;
        protected int $score;
        protected int $blindtestId;
        protected int $userId;


         public function __construct(int $score, int $blindtestId, int $userId, int $id){
            $this->score = $score;
            $this->userId = $userId;
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
          * @return int
          */
         public function getScore(): int
         {
             return $this->score;
         }

         /**
          * @return int
          */
         public function getUserId(): int
         {
             return $this->userId;
         }

         /**
          * @return int
          */
         public function getBlindtestId(): int
         {
             return $this->blindtestId;
         }
     }