document.addEventListener("DOMContentLoaded", function () {
  const deleteButtons = document.querySelectorAll(".delete");

  deleteButtons.forEach((button) => {
    button.addEventListener("click", function (event) {
      event.preventDefault(); // Empêcher le comportement par défaut du lien

      const dataId = this.getAttribute("data-id");

      let confirmationMessage = "";

      if (this.classList.contains("delete-user")) {
        confirmationMessage = "Êtes-vous sûr de vouloir supprimer cet utilisateur ?";
      } else if (this.classList.contains("delete-product")) {
        confirmationMessage = "Êtes-vous sûr de vouloir supprimer ce produit ?";
      } else {
        // Classe inconnue, ne pas confirmer la suppression
        return false;
      }

      const confirmation = confirm(confirmationMessage);

      if (confirmation) {
        const route = this.classList.contains("delete-user")
          ? `index.php?route=delete-user&id=${dataId}`
          : `/afrostyle/index.php?route=delete-product&id=${dataId}`;
        // Rediriger vers la page de suppression appropriée
        window.location.href = route;
      } else {
        // Sinon, annuler l'action
        return false;
      }
    });
  });
});



// menu humburger
const icons = document.querySelector('#icons');
const menu = document.querySelector('#header-admin-menu');
const menuItems = document.querySelectorAll('.menu-item');

icons.addEventListener("click", () => {
  menu.classList.toggle("active");
});

menuItems.forEach((link) => {
  link.addEventListener("click", () => {
    menu.classList.remove("active");
  });
});


