

// Obtenir les éléments de la modale et du bouton d'ouverture
var modal = document.getElementById("myModal");
var btn = document.getElementById("menu-item-15");
var btn2 = document.getElementById("btn");

// Lorsque l'utilisateur clique sur le bouton, ouvrir la modale
btn.onclick = function() {
  modal.style.display = "block";
}

btn2.onclick = function() {
  modal.style.display = "block";
}


// Lorsque l'utilisateur clique en dehors de la modale, fermer la modale
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}