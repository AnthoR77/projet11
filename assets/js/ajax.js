jQuery(document).ready(function($) {

var currentPage = 1;

function loadPhotos() {
  var category = jQuery('#photoCategory').val();
  var format = jQuery('#photoFormat').val();
  var orderby = jQuery('#photoOrderby').val();
  var order = jQuery('#photoOrder').val();

  jQuery.ajax({
    type: 'GET',
    url: ajaxurl,
    data: {
      action: 'load_more_photos',
      page: currentPage,
      category: category,
      format: format,
      orderby: orderby,
      order: order
    },
    dataType: 'json',
    beforeSend: function() {
      jQuery('#loadMore').prop('disabled', true);
    },
    success: function(data) {
      jQuery('#loadMore').prop('disabled', false);
      
      if (data.photos && data.photos.length > 0) {
        currentPage++;
        for (var i = 0; i < data.photos.length; i++) {
          jQuery('#phoapp').append(data.photos[i]);
        }
      } else {
        jQuery('#loadMore').hide();
      }
    },
    error: function(xhr, textStatus, errorThrown) {
      console.log(textStatus + ': ' + errorThrown);
    }
  });
}

loadPhotos();


  jQuery('#loadMore').click(function() {
    loadPhotos();
   
  });
  

  jQuery('#photoFilter').change(function() {
    currentPage = 1;
    $('#phoapp').empty();
    loadPhotos();
  });
});

