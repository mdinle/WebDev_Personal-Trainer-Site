<?php
namespace App\Services;

class BookingService
{
    public function createBooking($trainingsession)
    {
        $repository = new \App\Repositories\TrainingSessionRepo();
        return $repository->insert($trainingsession);
    }

    public function getAllUpcomingById($user_id)
    {
        $repository = new \App\Repositories\TrainingSessionRepo();
        return $repository->getAllUpcomingById($user_id);
    }

    public function getAllCompletedById($user_id)
    {
        $repository = new \App\Repositories\TrainingSessionRepo();
        return $repository->getAllCompletedById($user_id);
    }

    public function deleteSession($session_id, $user_id)
    {
        $repository = new \App\Repositories\TrainingSessionRepo();
        return $repository->deleteSession($session_id, $user_id);
    }

    public function getAllUpcomingByIdForTrainer($user_id)
    {
        $repository = new \App\Repositories\TrainingSessionRepo();
        return $repository->getAllUpcomingByIdForTrainer($user_id);
    }

    public function getAllTrainers()
    {
        $repository = new \App\Repositories\TrainingSessionRepo();
        return $repository->getAllTrainers();
    }
}
