<section class="home">
<div class="container">
<div class="section">
<div class="row">
<div class="col s12 m12 l12 content"> 

<?php 
foreach($noticia as $key){

?>
<div class="card z-depth-1">
    <div class="card-image">
      	 <a data-lightbox-gallery="gallery1" class="light z-depth-3" href="<?php echo base_url()?>assets/imagenes/noticias/<?php echo $key["imagen"]?>">
          <img data-caption="<?php echo $key["titulo"]?>" src="<?php echo base_url()?>assets/imagenes/noticias/<?php echo $key["imagen"]?>" width="700px" height="330px">
         </a>
          <span class="card-title card-title1"><?php echo $key["titulo"]?></span>    
    </div>

    <div class="card-content">
       <p><?php echo $key["descripcion"] ?> </p>
       <div class="row">
		<?php
		foreach($galeria as $gal){
			?>
  			<div class="col s12 m4 l4" style="padding:10px;">
  			   <a data-lightbox-gallery="gallery1" class="light " href="<?php echo base_url()?>assets/imagenes/noticias/<?php echo $gal["imagen"]?>">
       	    <center>
            <img class="z-depth-2 img_gal" src="<?php echo base_url()?>assets/imagenes/noticias/<?php echo $gal["imagen"]?>" width="200px" height="150px" alt="">
       	    </center>
           </a>
       	</div>
			<?php
			}
		?>
       </div>
  

<!--        <div class="divider" style="margin-bottom:15px;"></div>
       <div class="col l12 cont_not_coment"></div>
      
       <div class="col s12 m12 l6 btn_info btn_comentar_not" data-id="<?php echo $key["id"]?>">
         <a href="#!" class="waves-effect waves-light btn">
         <i class="material-icons left">comment</i>
         Comentar
         </a>  
       </div>

       <div class="col s12 m12 l6 btn_info ver_comentarios_not" data-id="<?php echo $key["id"]?>">
         <a href="#!" class="waves-effect waves-light btn">
         <i class="material-icons left">chat_bubble_outline</i>
         Ver Comentarios
         </a>  
       </div> -->

    </div>

    <!-- <div class="card-action">
      <div class="chip">
        <i class="material-icons left">today</i>
        <?php 
          echo fecha_to_str($key["fecha"]);
        ?>
      </div>
    </div> -->
</div>
<?php
}
?>

</div>
</div>
</section>