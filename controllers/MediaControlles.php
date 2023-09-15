<?php

class MediaController extends AbstractController {
    
    private MediaManager $mediaManager;
    
    public function __construct() {
        $this->mediaManager = new MediaManager(); // Remplacez MediaManager par le nom réel de votre classe
    }
    
    public function mediaList() : void {
        // Implémentez la logique pour obtenir la liste des médias à partir de MediaManager
        // Utilisez la méthode $this->mediaManager->getAllMedia() ou similaire
        // Puis, passez les médias à la vue appropriée en utilisant $this->render()
    }
    
    public function createMedia() : void {
        // Implémentez la logique pour créer un nouveau média
        // Puis, redirigez l'utilisateur vers une page appropriée
    }
    
    public function editMedia(int $mediaId) : void {
        // Implémentez la logique pour afficher et éditer un média spécifique
        // Utilisez la méthode $this->mediaManager->getMediaById($mediaId) ou similaire
        // Puis, passez le média à la vue appropriée en utilisant $this->render()
    }
    
    public function updateMedia(array $post, int $mediaId) : void {
        // Implémentez la logique pour mettre à jour les détails d'un média
        // Puis, redirigez l'utilisateur vers une page appropriée
    }
    
    public function deleteMedia(int $mediaId) : void {
        // Implémentez la logique pour supprimer un média
        // Puis, redirigez l'utilisateur vers une page appropriée
    }
    
    // Vous pouvez également implémenter d'autres actions spécifiques liées aux médias

}
