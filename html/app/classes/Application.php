<?php

class Application
{
    public static function getRooms() {
        $pdo = Database::get();
        $stmt = $pdo->prepare("SELECT * FROM rooms");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($userId, $roomId, $eventDate, $payment) {
        $pdo = Database::get();
        $stmt = $pdo->prepare("INSERT INTO applications (user_id, room_id, event_date, payment) VALUES (?, ?, ?, ?)");

        return $stmt->execute([$userId, $roomId, $eventDate, $payment]);
    }
}