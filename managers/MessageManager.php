<?php

class MessageManager extends AbstractManager {
    public function addMessage(Message $message) {
        $query = $this->db->prepare('INSERT INTO messages (name, email, message, product_id) VALUES (:name, :email, :message, :product_id)');
        $parameters = [
            ":name" => $message->getName(),
            ":email" => $message->getEmail(),
            ":message" => $message->getMessage(),
            ":product_id" => $message->getProductId(),
        ];

        $query->execute($parameters);
    }

    public function getMessageById($id) {
        $query = $this->db->prepare('SELECT id, name, email, message, product_id FROM messages WHERE id = :id');
        $query->execute([":id" => $id]);

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteMessageById($id) {
        $query = $this->db->prepare('DELETE FROM messages WHERE id = :id');
        $query->execute([":id" => $id]);
    }

    public function getMessagesByProduct($product_id) {
        $query = $this->db->prepare('SELECT id, name, email, message, product_id FROM messages WHERE product_id = :product_id');
        $query->execute([":product_id" => $product_id]);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }



    public function getAllMessages() {
        $query = $this->db->prepare("SELECT * FROM messages");
        $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
}