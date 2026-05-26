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

    public static function getUserApps($userId) {
        $pdo = Database::get();
        $stmt = $pdo->prepare("SELECT applications.*, rooms.name as room_name FROM applications INNER JOIN rooms on applications.room_id = rooms.id WHERE applications.user_id = ?;");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getAllApps () {
        $pdo = Database::get();
        $stmt = $pdo->prepare("SELECT applications.*, rooms.name as room_name, users.full_name, users.phone FROM applications INNER JOIN rooms ON applications.room_id = rooms.id INNER JOIN users on applications.user_id = users.id");
        $stmt ->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function updateStatus ($applicationId, $newStatus) {
        $pdo = Database::get();
        $stmt = $pdo->prepare("UPDATE applications SET status = ? WHERE id =?");
        $stmt-> execute([$newStatus, $applicationId]);
    }
}