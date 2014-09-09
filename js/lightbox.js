(function($) {

  // Initialize the Lightbox and add rel="gallery" to all gallery images when the gallery is set up using [gallery link="file"] so that a Lightbox Gallery exists
  $(".gallery dl.gallery-item dt.gallery-icon.landscape a[href$='.jpg'], .gallery a[href$='.png'], .gallery a[href$='.jpeg'], .gallery a[href$='.gif']").attr('rel','gallery').fancybox();

})(jQuery);
