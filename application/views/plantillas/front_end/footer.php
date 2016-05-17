<div id="sc">
<a href="#" title="Ir al Top" class="scrollup">
  <img class="circle" src="<?php echo base_url()?>assets/imagenes/up.png">
</a>
</div>
<footer class="page-footer grey darken-4">
  <div class="footer-copyright">
    <div class="container">
    <center><span class="copy_foo">© <?php echo date("Y")?> KM-Telecomunicaciones</span></center>
    </div>
  </div>
</footer>       
<script>
 $(document).ready(function($) {

 wow = new WOW(
  {
  boxClass:     'wow',      // default
  animateClass: 'animated', // default
  offset:       0,          // default
  mobile:       true,       // default
  live:         true        // default
  }
  )
  wow.init();

  $('a.gallery').featherlightGallery({
    previousIcon: '«',
    nextIcon: '»',
    galleryFadeIn: 300,
    openSpeed: 300
  });

  $(".button-collapse").sideNav();
  $('.modal-trigger').leanModal();
  $('.materialboxed').materialbox();
  $('.light').nivoLightbox({
      effect: 'fadeScale',                        // The effect to use when showing the lightbox
      theme: 'default',                           // The lightbox theme to use
      keyboardNav: true,                          // Enable/Disable keyboard navigation (left/right/escape)
      clickOverlayToClose: true,                  // If false clicking the "close" button will be the only way to close the lightbox
      errorMessage: 'Problemas cargando la imagen.' // Error message when content can't be loaded
  });

});
</script>

</body>
</html>