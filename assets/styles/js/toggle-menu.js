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


document.addEventListener("DOMContentLoaded", function () {
  const deleteButtons = document.querySelectorAll(".delete");

  deleteButtons.forEach((button) => {
    button.addEventListener("click", function (event) {
      event.preventDefault(); // Empêcher le comportement par défaut du lien

      const productId = this.getAttribute("data-id");
      const confirmation = confirm("Êtes-vous sûr de vouloir supprimer ce produit ?");

      if (confirmation) {
        // Si l'utilisateur confirme, rediriger vers la page de suppression
        window.location.href = `/afrostyle/index.php?route=delete-product&id=${productId}`;
      } else {
        // Sinon, annuler l'action
        return false;
      }
    });
  });
});

//confirmation suppression de user

document.addEventListener("DOMContentLoaded", function () {
  const deleteButtons = document.querySelectorAll(".delete-user");

  deleteButtons.forEach((button) => {
    button.addEventListener("click", function (event) {
      event.preventDefault(); // Empêcher le comportement par défaut du lien

      const userId = this.getAttribute("data-id");
      const confirmation = confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ?");

      if (confirmation) {
        // Si l'utilisateur confirme, rediriger vers la page de suppression
        window.location.href = `index.php?route=delete-user&id=${userId}`;
      } else {
        // Sinon, annuler l'action
        return false;
      }
    });
  });
});


