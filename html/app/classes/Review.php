<?php 
class Review 
{
    public static function create($userId, $text){
        $pdo = Database::get();
        $stmt = $pdo -> prepare("INSERT INTO reviews (user_id,textReview) VALUES (?, ?)");
        return $stmt->execute([$userId, $text]);
    }
    

}