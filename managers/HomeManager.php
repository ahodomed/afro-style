<?php

class MediaManager extends AbstractManager {

    public function createMedia(Media $media) : Media
    {
        $query = $this->db->prepare('INSERT INTO media (name, url) VALUES (:name, :url)');
        $parameters = [
            'name' => $media->getName(),
            'url' => $media->getUrl()
        ];
        $query->execute($parameters);
        // Vous pouvez gérer l'ID généré si nécessaire.
        return $media;
    }

    // Autres méthodes pour récupérer, mettre à jour et supprimer des médias...
}

