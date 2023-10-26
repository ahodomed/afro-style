
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById("searchInput");
        const searchButton = document.getElementById("searchButton");

        // Écoutez le clic sur le bouton de recherche
        searchButton.addEventListener("click", function() {
            searchProducts();
        });

        // Écoutez la touche "Entrée" dans la barre de recherche
        searchInput.addEventListener("keydown", function(event) {
            if (event.key === "Enter") {
                searchProducts();
            }
        });

        function searchProducts() {
            const searchTerm = searchInput.value.trim();
            if (searchTerm.length === 0) {
                // La barre de recherche est vide, ne faites rien
                return;
            }

            // Effectuez une requête AJAX pour rechercher des produits
            // Remplacez l'URL par l'URL de votre script PHP de recherche
            const url = `/votre_script_php_de_recherche.php?query=${searchTerm}`;
            const xhr = new XMLHttpRequest();
            xhr.open("GET", url, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    const products = JSON.parse(xhr.responseText);
                    displaySearchResults(products);
                } else {
                    console.error("Erreur de requête");
                }
            };
            xhr.send();
        }

        function displaySearchResults(products) {
            // Affichez les résultats de la recherche
            console.log(products); // Vous pouvez personnaliser ceci

            // Vous pouvez afficher les résultats dans une section spécifique de votre page
            // ou créer une nouvelle page pour afficher les résultats de la recherche.
        }
    });
