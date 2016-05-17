<div id="sc">
<a href="#" title="Ir al Top" class="scrollup">
Scroll
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
<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="<?php echo base_url();?>assets/front_end/css/normalize.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/front_end/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/front_end/css/featherlight.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/front_end/css/featherlight.gallery.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/front_end/css/themes/default/default.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/front_end/css/nivo-lightbox.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/front_end/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/front_end/css/tablematerialize.min.css" rel="stylesheet">

<script src="<?php echo base_url();?>assets/front_end/js/rut.min.js"></script>
<script src="<?php echo base_url();?>assets/front_end/js/materialize.min.js"></script>
<script src="<?php echo base_url();?>assets/front_end/js/moment.min.js"></script>
<script src="<?php echo base_url();?>assets/front_end/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/front_end/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/front_end/js/featherlight.min.js"></script>
<script src="<?php echo base_url();?>assets/front_end/js/featherlight.gallery.min.js"></script>
<script src="<?php echo base_url();?>assets/front_end/js/nivo-lightbox.min.js"></script>
<script src="<?php echo base_url();?>assets/front_end/js/wow.min.js"></script>
</body>
</html>