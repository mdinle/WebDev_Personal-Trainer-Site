<?php
namespace App\Repositories;

use PDO;

class TrainingSessionRepo extends Repository
{
    public function insert($trainingsession)
    {
        $user_id = $trainingsession->user_id;
        $start_time = $trainingsession->start_time;
        $end_time = $trainingsession->end_time;
        $trainer_id = $trainingsession->trainer_id;
        
        // Check if the time range already exists
        $checkQuery = "SELECT COUNT(*) as count FROM training_sessions 
                       WHERE user_id = :user_id 
                       AND (start_time <= :end_time AND end_time >= :start_time)";
        
        $checkStatement = $this->db->prepare($checkQuery);
        $checkStatement->execute([
            ':user_id' => $user_id,
            ':start_time' => $start_time,
            ':end_time' => $end_time,
        ]);
        
        $result = $checkStatement->fetch(PDO::FETCH_ASSOC);
        
        if ($result['count'] > 0) {
            // The time range already exists, handle it as an error
            echo json_encode(['error' => 'Time range already exists']);
        } else {
            // Proceed with the insertion
            $insertQuery = "INSERT INTO training_sessions (user_id, trainer_id, start_time, end_time) 
                            VALUES (:user_id, :trainer_id, :start_time, :end_time)";
        
            $insertStatement = $this->db->prepare($insertQuery);
            $insertStatement->execute([
                ':user_id' => $user_id,
                ':start_time' => $start_time,
                ':end_time' => $end_time,
                ':trainer_id' => $trainer_id,
            ]);
        
            echo json_encode(['success' => true]);
        }
    }

    public function getAllUpcomingById($user_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM training_sessions WHERE user_id = :user_id AND start_time > NOW()");
        $stmt->execute([
            ':user_id' => $user_id,
        ]);

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'App\\Models\\TrainingSession');
        $trainingsession = $stmt->fetchAll();

        return $trainingsession;
    }

    public function getAllCompletedById($user_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM training_sessions WHERE user_id = :user_id AND start_time < NOW()");
        $stmt->execute([
            ':user_id' => $user_id,
        ]);

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'App\\Models\\TrainingSession');
        $trainingsession = $stmt->fetchAll();

        return $trainingsession;
    }

    public function getAllUpcomingByIdForTrainer($user_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM training_sessions WHERE trainer_id = :user_id AND start_time > NOW()");
        $stmt->execute([
            ':user_id' => $user_id,
        ]);

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'App\\Models\\TrainingSession');
        $trainingsession = $stmt->fetchAll();

        return $trainingsession;
    }

    public function deleteSession($session_id, $user_id)
    {
        $stmt = $this->db->prepare("DELETE FROM training_sessions WHERE id = :id AND user_id = :user_id");

        $results = $stmt->execute([
            ':id' => $session_id,
            ':user_id' => $user_id,
        ]);

        return $results;
    }

    public function getAllTrainers()
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE role = 'trainer'");
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'App\\Models\\User');
        $trainers = $stmt->fetchAll();

        return $trainers;
    }
}
