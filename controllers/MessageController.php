<?php
class MessageController extends AbstractController {
    private MessageManager $messageManager;

    public function __construct() {
        $this->messageManager = new MessageManager();
        
    }

    public function addMessage($productId) {
        
        
        if (isset($_POST['contact-form']) && $_POST['contact-form'] === 'submit') {
        
            $errors = [];
    
            // Récupérer les données du formulaire
            $name = $this->clean($_POST['name']);
            $email = $this->clean($_POST['email']);
            $messageText = $this->clean($_POST['message']);

            // Valider les données du formulaire
            if (empty($name)) {
                $errors[] = "Le nom est requis.";
            }
    
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "L'adresse e-mail est invalide.";
            }
    
            if (empty($messageText)) {
                $errors[] = "Le message est requis.";
            }
    
            // Si des erreurs ont été trouvées, retournez le tableau d'erreurs
            if (empty($errors)) {
                 // Créer une instance de Message avec les données du formulaire
            $message = new Message($name, $email, $messageText, $productId);
    
            // Ajouter le message en utilisant le MessageManager
            $this->messageManager->addMessage($message);
            
            $_SESSION['message'] = $name ." commandé avec succès.";
            header("location: /afrostyle/");
            
            }else{
                 $this->render("contact/contact", [
                     "errors" => $errors
                ]);
            }
        }else{
            $errors = "Formulaire non soumis";
            $this->render("contact/contact", [
             "errors" => $errors
            ]);
        }
       
    }
    public function viewMessage($id) {
        $message = $this->messageManager->getMessageById($id);

        // Afficher le message ou rediriger vers une page d'erreur si le message n'existe pas
    }

    public function deleteMessage($id) {
        $this->messageManager->deleteMessageById($id);
        header("location: /afrostyle/index.php?route=manage-message");       // Rediriger vers une page de confirmation ou de liste des messages
    }

    public function getMessagesByProduct($product_id) {
        $messages = $this->messageManager->getMessagesByProduct($product_id);

        // Afficher les messages correspondants ou une liste vide
    }


    public function messageIndex() { 
        $messages = $this->messageManager->getAllMessages();
        $this->render("admin/messages/manage-message", [
        "messages" => $messages
    ]);
}
    
    
}