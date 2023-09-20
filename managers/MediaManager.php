<?php

class MediaManager extends AbstractManager
{

    public function createMedia(Media $media) : Media
    {
        $query = $this->db->prepare('INSERT INTO media (name, url) VALUES (:name, :url)');
        $parameters = [
            'name' => $media->getName(),
            'url' => $media->getUrl()
        ];
        $query->execute($parameters);
        $lastInsertId = $this->db->lastInsertId();
        $media->setId($lastInsertId);
        return $media;
    }
    
    public function editMedia(Media $media) : Media
    {
        $query = $this->db->prepare('UPDATE media SET name = :name, url = :url WHERE id =:id');
        $parameters = [
                "name" => $media->getName(),
                "url" => $media->getUrl(),
                "id" => $media->getId()
            ];
        $query->execute($parameters);
        return $media;
    }
    
    public function getMediaNameById($mediaId)
    {
        $query = $this->db->prepare("SELECT name FROM media WHERE id = :mediaId");
        $parameters = [
                "mediaId" => $mediaId
            ];
        $query->execute($parameters);
        $media = $query->fetch(PDO::FETCH_ASSOC);  
        return $media;
    }
    
    public function getMediaById($mediaId)
    {
        $query = $this->db->prepare("SELECT * FROM media WHERE id = :mediaId");
        $parameters = [
                "mediaId" => $mediaId
            ];
        $query->execute($parameters);
        $mediaData = $query->fetch(PDO::FETCH_ASSOC);
        $media = new Media($mediaData['name'], $mediaData['url']);
        $media->setId($mediaData['id']);
        return $media;
    }
    // Autres méthodes pour récupérer, mettre à jour et supprimer des médias...
}


?>

?>