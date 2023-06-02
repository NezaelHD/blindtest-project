<?php
namespace Controllers;

use App\Repository\BlindtestRepository;
use App\Repository\BlindtestSongsRepository;
use Models\Builders\BlindtestBuilder;
use Models\Builders\BlindtestSongsBuilder;
use mysql_xdevapi\Exception;
use Router;

class Blindtest extends Controller {

    public function findAll(){
        $blindtestRepo = new BlindtestRepository();
        $blindtestSongsRepo = new BlindtestSongsRepository();
        $blindtests = $blindtestRepo->findAll();
        $response = [];

        if ($blindtests) {
            foreach ($blindtests as $blindtest) {
                $songs = $blindtestSongsRepo->findBy('blindtest_id', $blindtest->getId());
                $songs = array_map(fn($song) => $song->toArray(), $songs);
                $blindtest->setSongs($songs);
                $response[] = $blindtest->toArray();
            }
            http_response_code(200);
            echo json_encode($response);

        } else {
            http_response_code(404);
            echo json_encode([
                'error' => 'Blindtests non trouvés.'
            ]);
        }
    }

    public function find($id) {
        $blindtestRepo = new BlindtestRepository();
        $blindtestSongsRepo = new BlindtestSongsRepository();
        $blindtest = $blindtestRepo->find($id);

        if ($blindtest) {
            $songs = $blindtestSongsRepo->findBy('blindtest_id', $blindtest->getId());
            $songs = array_map(fn($song) => $song->toArray(), $songs);
            $blindtest->setSongs($songs);
            http_response_code(200);
            echo json_encode($blindtest->toArray());
        } else {
            http_response_code(404);
            echo json_encode("Blindtest not found.");
        }
    }

    public function edit($id) {
        $blindtestRepo = new BlindtestRepository();
        $blindtestSongsRepo = new BlindtestSongsRepository();
        $request = getRequest();

        if (isset($request['name']) && isset($request['description']) && isset($request['author']) && isset($request['songs'])) {
            $blindtest = $blindtestRepo->find($id);

            if ($blindtest) {
                $blindtestBuilder = new BlindtestBuilder();
                $blindtestBuilder
                    ->setId($blindtest->getId())
                    ->setName($request['name'])
                    ->setDescription($request['description'])
                    ->setAuthor($request['author'])
                    ->build();

                try {
                    $blindtestRepo->update($blindtest);
                } catch (Exception $e) {
                    http_response_code(500);
                    echo json_encode("Error updating blindtest.");
                    return;
                }

                $blindtestSongsRepo->removeBy('blindtest_id', $blindtest->getId());

                $blindtestSongs = [];
                foreach ($request['songs'] as $songData) {
                    if (isset($songData['songUrl']) && isset($songData['answer'])) {
                        $blindtestSongsBuilder = new BlindtestSongsBuilder();
                        $blindtestSong = $blindtestSongsBuilder
                            ->setId(-1)
                            ->setBlindtestId($blindtest->getId())
                            ->setUrl($songData['songUrl'])
                            ->setAnswer($songData['answer'])
                            ->build();
                        try {
                            $blindtestSong = $blindtestSongsRepo->persist($blindtestSong);
                        } catch (Exception $e) {
                            http_response_code(500);
                        }
                        $blindtestSongs[] = $blindtestSong->toArray();
                    }
                }

                $blindtest->setSongs($blindtestSongs);
                http_response_code(200);
                echo json_encode($blindtest->toArray());
            } else {
                http_response_code(404);
                echo json_encode("Blindtest not found.");
            }
        } else {
            http_response_code(400);
            echo json_encode("Invalid data");
        }
    }

    public function delete($id)
    {
        $blindtestRepo = new BlindtestRepository();
        $blindtestSongsRepo = new BlindtestSongsRepository();

        try {
            $blindtestSongsRepo->removeBy('blindtest_id', $id);
            $blindtestRepo->remove($id);

            http_response_code(200);
            echo json_encode("Blindtest and associated songs deleted successfully.");
            return;
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode("Error deleting blindtest and associated songs.");
            return;
        }
    }

    public function create()
    {
        $blindtestRepo = new BlindtestRepository();
        $blindtestSongsRepo = new BlindtestSongsRepository();
        $request = getRequest();

        if (isset($request['name']) && isset($request['description']) && isset($request['author']) && isset($request['songs'])) {
            $blindtestBuilder = new BlindtestBuilder();
            $blindtest = $blindtestBuilder
                ->setId(-1)
                ->setName($request['name'])
                ->setDescription($request['description'])
                ->setAuthor($request['author'])
                ->build();

            try {
                $blindtest = $blindtestRepo->persist($blindtest);
            } catch (Exception $e) {
                http_response_code(500);
            }

            $blindtestSongs = [];
            foreach ($request['songs'] as $songData) {
                if (isset($songData['songUrl']) && isset($songData['answer'])) {
                    $blindtestSongsBuilder = new BlindtestSongsBuilder();
                    $blindtestSong = $blindtestSongsBuilder
                        ->setId(-1)
                        ->setBlindtestId($blindtest->getId())
                        ->setUrl($songData['songUrl'])
                        ->setAnswer($songData['answer'])
                        ->build();
                    try {
                        $blindtestSongsRepo->persist($blindtestSong);
                    } catch (Exception $e) {
                        http_response_code(500);
                    }
                    $blindtestSongs[] = $blindtestSong;
                }
            }

            $blindtest->setSongs($request['songs']);
            http_response_code(200);
            echo json_encode($blindtest->toArray());
        } else {
            http_response_code(400);
            echo json_encode("Invalid data");
        }
    }
}