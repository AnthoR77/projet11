// jQuery(document).ready(function ($) {
//   // Sélectionnez le conteneur des éléments .photo
//   const photoContainer = document.querySelector('#phoapp');

//   // Ajoutez un écouteur d'événements de clic à chaque image
//   photoContainer.addEventListener('click', async e => {
//     const target = e.target;
//     if (target.tagName === 'IMG' && target.hasAttribute('data-image') && target.closest('.photo')) {
//       // Récupérez l'URL de l'image à partir de l'attribut "data-image"
//       const imgSrc = target.dataset.image;

//       // Récupérez l'ID de la publication associée à l'image cliquée
//       const postId = target.closest('.photo').dataset.id;

//       // Affichez la lightbox et l'image sélectionnée
//       const lightbox = document.getElementById('lightbox');
//       const lightboxImg = document.getElementById('lightbox_img');
//       lightbox.style.display = 'flex';
//       lightboxImg.src = imgSrc;

//       // Récupérez la référence et la catégorie de l'image cliquée
//       const response = await fetch(`http://localhost/Projet11/wordpress/wp-json/wp/v2/photo/${postId}?categories`);
//       const postData = await response.json();

//       console.log(postData.categorie)
//       const ref = postData.acf.Reference;
//       const categorieId = postData.categorie[0];
//       const categorieResponse = await fetch(`http://localhost/Projet11/wordpress/wp-json/wp/v2/categorie/${categorieId}`);
//       const categorieData = await categorieResponse.json();
//       const cat = categorieData.name;
//       console.log(cat);

//       const lightboxRef = lightbox.querySelector('.lightboxText .lightbox_ref');
//       const lightboxCat = lightbox.querySelector('.lightboxText .lightbox_cat');

//       if (lightboxRef) {
//         lightboxRef.textContent = ref;
//       }

//       if (lightboxCat) {
//         lightboxCat.textContent = cat;
//       }
//     }
//   });

//   // Ajoutez un écouteur d'événements de clic au bouton de fermeture
//   const lightboxClose = document.getElementById('lightbox_close');
//   lightboxClose.addEventListener('click', () => {
//     const lightbox = document.getElementById('lightbox');
//     lightbox.style.display = 'none';
//   });
// });

// jQuery(document).ready(function ($) {
//     // Sélectionnez le conteneur des éléments .photo
//     const photoContainer = document.querySelector('#phoapp');
  
//     // Ajoutez un écouteur d'événements de clic à chaque image
//     photoContainer.addEventListener('click', async e => {
//       const target = e.target;
//       if (target.tagName === 'IMG' && target.hasAttribute('data-image') && target.closest('.photo')) {
//         // Récupérez l'URL de l'image à partir de l'attribut "data-image"
//         const imgSrc = target.dataset.image;
  
//         // Récupérez l'ID de la publication associée à l'image cliquée
//         const postId = target.closest('.photo').dataset.id;
  
//         // Affichez la lightbox et l'image sélectionnée
//         const lightbox = document.getElementById('lightbox');
//         const lightboxImg = document.getElementById('lightbox_img');
//         lightbox.style.display = 'flex';
//         lightboxImg.src = imgSrc;
  
//         // Récupérez la référence et la catégorie de l'image cliquée
//         const response = await fetch(`http://localhost/Projet11/wordpress/wp-json/wp/v2/photo/${postId}?categories`);
//         const postData = await response.json();
  
//         console.log(postData.categorie)
//         const ref = postData.acf.Reference;
//         const categorieId = postData.categorie[0];
//         const categorieResponse = await fetch(`http://localhost/Projet11/wordpress/wp-json/wp/v2/categorie/${categorieId}`);
//         const categorieData = await categorieResponse.json();
//         const cat = categorieData.name;
//         console.log(cat);
  
//         const lightboxRef = lightbox.querySelector('.lightboxText .lightbox_ref');
//         const lightboxCat = lightbox.querySelector('.lightboxText .lightbox_cat');
  
//         if (lightboxRef) {
//           lightboxRef.textContent = ref;
//         }
  
//         if (lightboxCat) {
//           lightboxCat.textContent = cat;
//         }
//       }
//     });
  
//     // Ajoutez un écouteur d'événements de clic au bouton de fermeture
//     const lightboxClose = document.getElementById('lightbox_close');
//     lightboxClose.addEventListener('click', () => {
//       const lightbox = document.getElementById('lightbox');
//       lightbox.style.display = 'none';
//     });
//   });
  



document.addEventListener('DOMContentLoaded', function() {
let targetOverlay

  if(document.querySelector('#phoapp')){
     targetOverlay = document.querySelector('#phoapp')
  }
  else{
     targetOverlay = document.querySelector('#phoappsingle')
  }
console.log(targetOverlay);

  targetOverlay.addEventListener('click', function(e) {
    if (e.target.matches('.overlay-btn') || e.target.matches('.overlay-btn img')) {
      var lightbox = document.getElementById('lightbox');
      var lightboxImg = document.getElementById('lightbox_img');

      // Mettre à jour la source de l'image dans la lightbox
      if (e.target.matches('.overlay-btn')) {
        lightboxImg.src = e.target.dataset.lightbox;
      } else if (e.target.matches('.overlay-btn img')) {
        lightboxImg.src = e.target.parentElement.dataset.lightbox;
      }

      // Mettre à jour la catégorie et la référence dans la lightbox
      var lightboxCat = document.querySelector('.lightboxText .lightbox_cat');
      var lightboxRef = document.querySelector('.lightboxText .lightbox_ref');
      lightboxCat.textContent = this.parentNode.querySelector('.overlay-cat').textContent;
      lightboxRef.textContent = this.parentNode.querySelector('.overlay-ref').textContent;

      // Afficher la lightbox
      lightbox.style.display = 'block';
    };
  });

  

  document.getElementById('prev').addEventListener('click', function() {
    changeImage(-1);
  });
  
  document.getElementById('next').addEventListener('click', function() {
    changeImage(1);
  });
  
  function changeImage(direction) {
    var lightboxImg = document.getElementById('lightbox_img');
    var currentImgIndex = parseInt(lightboxImg.dataset.index || '0');
    var imgCount = document.querySelectorAll('.overlay-btn').length;
  
    currentImgIndex += direction;
  
    if (currentImgIndex < 0) {
      currentImgIndex = imgCount - 1;
    } else if (currentImgIndex >= imgCount) {
      currentImgIndex = 0;
    }
  
    var newImgUrl = document.querySelectorAll('.overlay-btn')[currentImgIndex].dataset.lightbox;
    var newImgCat = document.querySelectorAll('.overlay-btn')[currentImgIndex].closest('.image-container').querySelector('.overlay-cat').textContent;
    var newImgRef = document.querySelectorAll('.overlay-btn')[currentImgIndex].closest('.image-container').querySelector('.overlay-ref').textContent;
  
    lightboxImg.src = newImgUrl;
    lightboxImg.dataset.index = currentImgIndex;
    document.querySelector('.lightboxText .lightbox_cat').textContent = newImgCat;
    document.querySelector('.lightboxText .lightbox_ref').textContent = newImgRef;
  }

  document.getElementById('lightbox_close').addEventListener('click', function() {
    var lightbox = document.getElementById('lightbox');
    lightbox.style.display = 'none';
  });


});
