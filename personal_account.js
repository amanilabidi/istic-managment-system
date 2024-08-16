  // JavaScript to update the current time
  function updateTime() {
    var currentTime = new Date();
    var hours = currentTime.getHours();
    var minutes = currentTime.getMinutes();
    var seconds = currentTime.getSeconds();

    // Add leading zero if needed
    minutes = (minutes < 10 ? "0" : "") + minutes;
    seconds = (seconds < 10 ? "0" : "") + seconds;

    var formattedTime = hours + ":" + minutes + ":" + seconds;

    // Update the content of the element with id "current-time"
    document.getElementById("current-time").innerText = "Current Time: " + formattedTime;
}

// Call updateTime every second (1000 milliseconds)
setInterval(updateTime, 1000);

// Call updateTime immediately to set the initial time
updateTime();
//naviger a travers le menu bar



document.addEventListener("DOMContentLoaded", function () {
  // Sélectionnez les éléments de la barre de menu
  const navItems = document.querySelectorAll(".nav-item");

  // Sélectionnez la section principale
  const mainSection = document.querySelector(".main-section");

  // Ajoutez un gestionnaire d'événements pour chaque élément de la barre de menu
  navItems.forEach((item) => {
      item.addEventListener("click", function (event) {
          // Empêchez le comportement par défaut du lien
          event.preventDefault();

          // Obtenez le chemin d'accès à partir de l'attribut href
          const path = item.querySelector("a").getAttribute("href");

          // Chargez le contenu de la section correspondante dans la section principale
          loadContent(path);
      });
  });

  // Fonction pour charger le contenu d'une section dans la section principale
  function loadContent(path) {
      // Utilisez fetch pour charger le contenu HTML de la section spécifiée
      fetch(path)
          .then((response) => response.text())
          .then((html) => {
              // Remplacez le contenu de la section principale par le contenu chargé
              mainSection.innerHTML = html;
          })
          .catch((error) => console.error("Error loading content:", error));
  }
});





  
