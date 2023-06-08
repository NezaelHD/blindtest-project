<?php
namespace Controllers;

use App\Repository\BlindtestRepository;
use App\Repository\RoomRepository;
use Models\Builders\RoomBuilder;
use mysql_xdevapi\Exception;

class Room extends Controller
{

    public function create($id) {
        $blindtestRepository = new BlindtestRepository();

        $blindtest = $blindtestRepository->find($id);

        if($blindtest) {
            $roomRepository = new RoomRepository();
            $roomBuilder = new RoomBuilder();
            $newRoom = $roomBuilder
                ->setId(-1)
                ->setBlindtestId($blindtest->getId())
                ->build();
            try{
                $newRoom = $roomRepository->persist($newRoom);
            } catch(Exception $e) {
                http_response_code(500);
            }
            redirect('/play/' . $newRoom->getId());
        }
        else {
            http_response_code(404);
        }

    }

    public function join($roomId) {
        $roomRepository = new RoomRepository();
        $roomToJoin = $roomRepository->find($roomId);
        if($roomToJoin) {
            $blindtestRepository = new BlindtestRepository();
            $blindtest = $blindtestRepository->find($roomToJoin->getBlindtestId());
            $data = [
                'room_id' => $roomToJoin->getId(),
                'blindtest' => $blindtest,
            ];

            $this->view('play', $data);
        }
    }

    public function delete($id) {
        $roomRepository = new RoomRepository();
        try {
            $roomRepository->remove($id);
        }catch(Exception $e){
            echo json_encode($e);
        }
    }
}