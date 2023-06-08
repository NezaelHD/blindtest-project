<?php
namespace Controllers;

use App\Repository\ScoreboardRepository;
use Models\Builders\ScoreboardBuilder;
use mysql_xdevapi\Exception;

class Scoreboard extends Controller
{
    public function show($blindtestId) {
        $scoreboardRepo = new ScoreboardRepository();
        $scoreboard = $scoreboardRepo->findBy('blindtest_id', $blindtestId);

        if($scoreboard) {
            $this->view('scoreboard', [
                'scoreboard_datas' => $scoreboard,
            ]);
        }
    }

    public function create(){
        $request = getRequest();
        if($request) {
            $scoreboardBuilder = new ScoreboardBuilder();
            $scoreboardRepo = new ScoreboardRepository();
            $oldScores = $scoreboardRepo->findBy('blindtest_id', $request['blindtestId']);
            $indexedScores = [];
            foreach ($oldScores as $oldScore) {
                $indexedScores[$oldScore->getUserId()] = $oldScore;
            }

            foreach ($request['scores'] as $score) {
                $userId = $score['userId'];
                $newScore = $scoreboardBuilder
                    ->setId(-1)
                    ->setBlindtestId($request['blindtestId'])
                    ->setScore($score['score'])
                    ->setUserId($userId)
                    ->build();

                if (isset($indexedScores[$userId])) {
                    $existingScore = $indexedScores[$userId];

                    if ($existingScore->getScore() < $score['score']) {
                        try {
                            $updatedScore = $scoreboardBuilder
                                ->setBlindtestId($request['blindtestId'])
                                ->setId($existingScore->getId())
                                ->setScore($score['score'])
                                ->setUserId($userId)
                                ->build();
                            $scoreboardRepo->update($updatedScore);
                        } catch (Exception $e) {
                            echo json_encode($e);
                        }
                    }
                } else {
                    try {
                        $scoreboardRepo->persist($newScore);
                    } catch (Exception $e) {
                        echo json_encode($e);
                    }
                }
            }
            http_response_code(200);
            echo json_encode(["blindtestId" => $request['blindtestId']]);
        }
    }
}