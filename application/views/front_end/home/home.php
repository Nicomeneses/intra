<section class="home">
<div class="container">
<div class="section">
<div class="row">

<!-- SECCION NOTICIAS -->

    <div class="col s12 m12 l8 content"> 
      <?php
      if(false!= $listado){
   
      foreach($listado as $key){
      ?>
 
        <div class="card z-depth-1 hoverable">
          <div class="card-image">
              <a href="<?php echo base_url()?>noticias/<?php echo $key["url"]?>">
              <img src="<?php echo base_url()?>assets/imagenes/noticias/min_<?php echo $key["imagen"]?>" width="520px" height="260px">
              </a>
              <span class="card-title"><?php echo $key["titulo"]?></span>    
          </div>

          <div class="card-content">
              <div class="row">
                <div class="col s12 m12 l12">
                <?php echo cortarTexto($key["descripcion"],230) ?>
                </div>
              </div>

              <div class="row" style="margin-bottom:0px;">
                 <div class="col s12 l5 btn_leer_mas">
                 <a href="<?php echo base_url()?>noticias/<?php echo $key["url"]?>" class="btn " style="color: rgba(0, 0, 0, 0.6);background-color: #E4E4E4;height: 32px;font-weight: 500;line-height: 32px;border-radius: 16px;box-shadow:0px 1px 2px 0px rgba(0, 0, 0, 0.16), 0px 1px 3px 0px rgba(0, 0, 0, 0.12);">
                 <i class="material-icons left">info</i>
                 Leer M&aacute;s
                 </a>  
                </div>
                <div class="col s12 l7 chip btn_fecha_info" style="margin-top:4px;text-align:center;box-shadow:0px 1px 2px 0px rgba(0, 0, 0, 0.16), 0px 1px 3px 0px rgba(0, 0, 0, 0.12);">
                 <i class="material-icons left">today</i> 
                 <?php 
                  echo fecha_to_str($key["fecha"]);
                 ?>
                </div>
              </div>

             <div class="divider" style="margin-bottom:15px;"></div>
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
             </div>
          </div>

        </div>
        <?php
        $id = $key["id"];
        }
        }else{
          ?>
        <br><div class='z-depth-1' style='padding:13px;'><blockquote><h6>No se han encontrado noticias.</h6></blockquote></div>
          <?php
        }
    ?> 
    </div><!-- FIN SECCION NOTICIAS-->

    <!-- SECCION IZQUIERDA -->

    <div class="col s12 m12 l4">
    <div class="buscador-us collection hoverable z-depth-1" style="border-radius:10px;border:0!important;margin-bottom:3px!important;text-align:center;">
      <div class="col s4 m2 l2 cont_lupa">
        <a class="modal-trigger" href="#modal1">
        <img src="<?php echo base_url()?>assets/imagenes/lupa.png">
        </a>
      </div>
      <div class="col s8 m10 l10 cont_lupa_enlace">
       <a class="modal-trigger" href="#modal1">
      Buscador de Telefonos y correos
      </a>
      </div>
    </div>
    </div>

    <div class="col s12 m12 l4 izq_secc" dat-rut="<?php echo $this->session->userdata('rutUsuario');?>" dat-us="<?php echo $this->session->userdata('tipo');?>">

    <!-- SECCION CUMPLEAÑOS -->

      <div class="tarjeta1 hoverable">
         <ul class="collection with-header z-depth-1">
              
              <li class="collection-header">
              <img class="chinche" src="<?php echo base_url()?>assets/imagenes/chinche.png" width="53px" alt="">
              <h6> 
                  Cumplea&ntilde;os</h6> 
              </li>    

              <?php

                $fecha_actual=date("Y-m-d");
                $f=explode("-",$fecha_actual);
                $mes_actual=$f[1];
                $dia_actual=$f[2];
              
                foreach($cumpleanios as $key){
                $fecha_usuario=$key["fecha_nacimiento"];
                $ff=explode('-',$fecha_usuario);
                $mes_bd=$ff[1];
                $dia_bd=$ff[2];

                  ?>
                    <a data-rut="<?php echo $key["rut"]?>" href=""  data-target="modal1<?php echo $key["rut"]?>" class="s modal-trigger list_a modal_cumple">
                    <li class="collection-item avatar" style="padding-left:50px;padding-top:7px;padding-bottom:7px;">
                    <?php
                    if($key["adjuntar_foto"]!=""){
                    ?>
                     <img src="http://intranet.km-telecomunicaciones.cl/mantenedor_usuarios/<?php echo $key["adjuntar_foto"]?>" alt="" class="circle">
                    <?php
                    }else{
                    ?>
                     <img src="<?php base_url()?>assets/imagenes/user-ico.png" alt="" class="circle">
                    <?php      
                    }

                    if($dia_actual==$dia_bd){
                      ?>
                      <span class="title" style="color:rgba(0,0,0,0.85);font-size:13px;font-weight:bold;margin-bottom:7px;margin-top:3px;"><?php echo $key["primer_nombre"]." ".$key["apellido_paterno"]?></span>
                      <span style="margin-top:-7px;" class="secondary-content">
                      <img style="margin-top:-3px;margin-right:6px;" src="<?php echo base_url()?>assets/imagenes/hoy.png" alt="" width="30px">
                      </span>
                    </li>
                    </a>
                      <?php
                    } else{
                      ?>
                      <span class="title title2"><?php echo $key["primer_nombre"]." ".$key["apellido_paterno"]?></span>
                      <span class="title3"><?php echo date_to_str($key["fecha_nacimiento"])?></span>
                      </li>
                      </a>
                      <?php
                    }  
                    ?>

                     <div id="modal1<?php echo $key["rut"]?>" class="modal modal-fixed-footer">
                        <div class="modal-content" style="padding: 6px 24px;">
                        <?php
                        if($dia_actual==$dia_bd){
                          ?>
                          <center><h5>Feliz Cumplea&ntilde;os <?php echo $key["primer_nombre"]." ".$key["apellido_paterno"]?></h5></center>
                          <div class="divider" style="margin-top:10px;margin-bottom:10px;"></div>

                          <?php
                        }else{
                          ?>
                          <center><h5>Cumplea&ntilde;os de <?php echo $key["primer_nombre"]." ".$key["apellido_paterno"]?></h5></center>
                          <div class="divider" style="margin-top:10px;margin-bottom:10px;"></div>

                          <?php
                        }
                        ?>
                            <div class="row">
                               <div class="col s12 m3 l3">
                                 <div class="modalc-img">
                                 <?php 
                                  if($key["adjuntar_foto"]==""){
                                    ?>
                                  <img style="margin-top:25px;" src="<?php echo base_url()?>assets/imagenes/no-imagen.png" alt="" class="responsive-img">
                                    <?php
                                  }else{
                                    ?><center>
                                     <a class="thumbnail gallery" href="http://intranet.km-telecomunicaciones.cl/mantenedor_usuarios/<?php echo $key["adjuntar_foto"]?>">
                                      <img class="z-depth-2" style="margin-top:10px;" src="http://intranet.km-telecomunicaciones.cl/mantenedor_usuarios/<?php echo $key["adjuntar_foto"]?>" width="150px">
                                     </a></center>
                                    <?php
                                  }
                                 ?>
                                 </div>
                               </div>
                               <div class="col s12 m9 l9 modal-texto" style="margin-top:20px;">
                                  <div class="col s12 l6">
                                   <div class="col s6 l4">
                                     Cumplea&ntilde;os  
                                   </div>
                                   <div class="col s6 l8">
                                     <?php echo date_to_str($key["fecha_nacimiento"])?>
                                   </div>
                                   <div class="col s12 l12">
                                      <div class="divider" style="margin-top:10px;margin-bottom:10px;"></div>
                                   </div>

                                   <div class="col s6 l4">
                                     Area KM 
                                   </div>
                                   <div class="col s6 l8">
                                    <?php echo $key["area_km"]?>
                                   </div>
                                    <div class="col s12 l12">
                                      <div class="divider" style="margin-top:10px;margin-bottom:10px;"></div>
                                   </div>

                                   <div class="col s6 l4">
                                     Cargo
                                   </div>
                                   <div class="col s6 l8">
                                   <?php echo $key["cargo"]?>
                                   </div>
                                   
                                   </div>

                                   <div class="col s12 l6">

                                   <div class="col s6 l4">
                                     Proyecto 
                                   </div>
                                   <div class="col s6 l8"> 
                                     <?php echo $key["proyecto"]?>  
                                   </div>  
                                    <div class="col s12 l12">
                                      <div class="divider" style="margin-top:10px;margin-bottom:10px;"></div>
                                   </div>

                                     <div class="col s6 l4">
                                     Jefatura 
                                     </div>
                                     <div class="col s6 l8">
                                      <?php echo $key["jefe"]?>
                                     </div>
                                     <div class="col s12 l12">
                                      <div class="divider" style="margin-top:10px;margin-bottom:10px;"></div>
                                     </div>

                                     <div class="col s6 l4">
                                     Sucursal
                                     </div>
                                     <div class="col s6 l8">
                                      <?php echo $key["ciudad"]?>
                                     </div>
                                    </div>

                                   <div class="col s12 m12 l12 modal-texto"><br>
                                     <div class="divider" style="margin-top:10px;margin-bottom:10px;"></div>
                                     <div class="row">
                                     <div class="col l12">
                                     <div class="top_coments">
                                        <div class="col s12 l6 top_coment">
                                         <center><a href="#!" data-rut="<?php echo $key["rut"]?>" class="btn_coment_cumple"><i class="material-icons left" style="margin-top:-7px;">comment</i>Ver Comentarios</a></center>
                                        </div>
                                        <div class="col s12 l6 top_coment">
                                         <center><a href="#!" data-rut="<?php echo $key["rut"]?>" class="btn_comentar_cumple"><i class="material-icons left" style="margin-top:-7px;">chat_bubble_outline</i>Comentar</a></center>
                                        </div>
                                     </div>
                                     </div>
                                     </div>
                                    <div class="row">
                                    <div class="col s12 l12">
                                      <div class="col s12 l12">
                                      <span class="validation_coment"></span>
                                      </div>
                                      <div class="connt">
                                      <div class="comentarios_cumple"></div>
                                      </div>
                                    </div>
                                    </div>
                                  </div> 

                               </div>   
                            </div>  
                        </div>
                        <div class="modal-footer">
                          <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
                        </div>
                      </div>      
                       <?php 
                    }
              ?>    
         </ul>
      </div><!-- FIN SECCION CUMPLEAÑOS -->

      <!-- SECCION ULTIMOS INGRESOS -->

      <div class="tarjeta1 hoverable">    
         <ul class="collection  with-header z-depth-1 ">
               <li class="collection-header">
               <img class="chinche" src="<?php echo base_url()?>assets/imagenes/chinche.png" width="53px" alt="">
                 <h6>&Uacute;ltimos Ingresos </h6>
              </li>   
        <?php 
         foreach($contratos as $key){
        ?>
            <a data-rut="<?php echo $key["rut"]?>" href=""  data-target="modal2<?php echo $key["rut"]?>" class="s modal-trigger list_a modal_ing">

              <li class="collection-item avatar" style="padding-left:50px;padding-top:7px;padding-bottom:7px;">
                    <?php
                    if($key["adjuntar_foto"]!=""){
                    ?>
                     <img src="http://intranet.km-telecomunicaciones.cl/mantenedor_usuarios/<?php echo $key["adjuntar_foto"]?>" alt="" class="circle">
                    <?php
                    }else{
                    ?>
                     <img src="<?php base_url()?>assets/imagenes/user-ico.png" alt="" class="circle">
                    <?php      
                    }
                    ?>
                    <span class="title title2"><?php echo $key["primer_nombre"]." ".$key["apellido_paterno"]?></span>
                    <span class="title3"><?php echo $key["cargo"]?></span>
               </li>
                 </a>

               <div id="modal2<?php echo $key["rut"]?>" class="modal modal-fixed-footer">
                        <div class="modal-content" style="padding: 6px 24px;">
                           <center><h5>Bienvenido a KM <?php echo $key["primer_nombre"]." ".$key["apellido_paterno"]?></h5></center>
                           <div class="divider" style="margin-top:10px;margin-bottom:10px;"></div>
                            <div class="row">
                               <div class="col s12 m3 l3">
                                 <div class="modalc-img" >
                                 <?php 
                                  if($key["adjuntar_foto"]==""){
                                    ?>
                                     <center><img style="margin-top:2px;" src="<?php echo base_url()?>assets/imagenes/no-imagen.png" alt="" class="responsive-img"> </center>
                                    <?php
                                  }else{
                                    ?>
                                      <center><a class="thumbnail gallery" href="http://intranet.km-telecomunicaciones.cl/mantenedor_usuarios/<?php echo $key["adjuntar_foto"]?>">
                                      <img class="z-depth-2" style="margin-top:10px;" src="http://intranet.km-telecomunicaciones.cl/mantenedor_usuarios/<?php echo $key["adjuntar_foto"]?>" width="150px">
                                      </a></center>
                                    <?php
                                  }
                                 ?>
                                 </div>
                               </div>

                               <div class="col s12 m9 l9 modal-texto" style="margin-top:50px;">
                                <div class="col s12 l6">
                                   <div class="col s4">
                                     Area KM
                                   </div>
                                   <div class="col s8">
                                    <?php echo $key["area_km"]?>
                                   </div>
                                    <div class="col s12">
                                      <div class="divider" style="margin-top:10px;margin-bottom:10px;"></div>
                                   </div>

                                   <div class="col s4">
                                     Cargo 
                                   </div>
                                   <div class="col s8">
                                    <?php echo $key["cargo"]?>
                                   </div>
                                    <div class="col s12">
                                      <div class="divider" style="margin-top:10px;margin-bottom:10px;"></div>
                                   </div>

                                   <div class="col s4">
                                    Proyecto
                                   </div>
                                   <div class="col s8">
                                    <?php echo $key["proyecto"]?>
                                   </div>
                                    
                                  </div>

                                  <div class="col l6">

                                   <div class="col s4">
                                      Fecha Ingreso
                                   </div>
                                   <div class="col s8">
                                    <?php echo date_to_str_full($key["fecha_ingreso_km"])?>
                                   </div>
                                    <div class="col s12">
                                      <div class="divider" style="margin-top:10px;margin-bottom:10px;"></div>
                                   </div>

                                   <div class="col s4">
                                     Jefatura 
                                    </div>
                                    <div class="col s8">
                                      <?php echo $key["jefe"]?>
                                    </div>
                                     <div class="col s12">
                                      <div class="divider" style="margin-top:10px;margin-bottom:10px;"></div>
                                   </div>

                                    <div class="col s4">
                                     Sucursal
                                    </div>
                                    <div class="col s8">
                                      <?php echo $key["ciudad"]?>
                                    </div>
                                  </div>
                               </div>  
                              
                               <div class="col s12 m12 l12 modal-texto"><br>
                                 <div class="divider" style="margin-top:10px;margin-bottom:10px;"></div>
                                 <div class="row">
                                 <div class="col l12">
                                 <div class="top_coments">
                                    <div class="col s12 l6 top_coment">
                                     <center><a href="#!" data-rut="<?php echo $key["rut"]?>" class="btn_coment_ing"><i class="material-icons left" style="margin-top:-7px;">comment</i>Ver Comentarios</a></center>
                                    </div>
                                    <div class="col s12 l6 top_coment">
                                     <center><a href="#!" data-rut="<?php echo $key["rut"]?>" class="btn_comentar_ing"><i class="material-icons left" style="margin-top:-7px;">chat_bubble_outline</i>Comentar</a></center>
                                    </div>
                                 </div>
                                 </div>
                                 </div>
                                <div class="row">
                                <div class="col s12 l12">
                                  <div class="col s12 l12">
                                  <span class="validation_coment"></span>
                                  </div>
                                  <div class="connt">
                                  <div class="comentarios_ing"></div>
                                  </div>
                                </div>
                                </div>
                              </div> 

                          </div>  
                         </div>
                        <div class="modal-footer">
                          <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
                        </div>
                      </div>
        <?php
        }
        ?>
         </ul>
      </div><!--FIN SECCION ULTIMOS INGRESOS -->

      <!-- SECCION NACIMIENTOS -->

      <div class="tarjeta1 hoverable">    
         <ul class="collection  with-header z-depth-1">
              <li class="collection-header">
              <img class="chinche" src="<?php echo base_url()?>assets/imagenes/chinche.png" width="53px" alt="">

               <h6> 
                 Nacimientos</h6>
              </li>   
          
              <?php
                foreach($nacimientos as $key){

              ?>
               <a data-id="<?php echo $key["id"]?>" href="" data-target="modal3<?php echo $key["id"]?>" class="s modal-trigger modal_nac list_a">
                <li class="collection-item avatar" style="padding-top: 5px;padding-bottom: 5px;">
                <img style="margin-top:9px;" src="<?php echo base_url()?>assets/imagenes/bebe.png" alt="" class="circle">
                <span  class="title title2"><?php echo $key["primer_nombre"]?> <?php echo $key["apellido_paterno"]?></span>
                <span class="title5">  <?php echo date_to_str($key["fecha"])?></span>
              </li>
              </a>
              <div id="modal3<?php echo $key["id"]?>" class="modal modal-fixed-footer" style="top: 5%;">
                  <div class="modal-content" style="padding: 6px 24px;">
                  <center><h5> Nacimiento de <?php echo "<b>".$key["hijo"]."</b>";?></h5></center>
                  <div class="divider"></div>
                      <div class="row">

                         <div class="col s12 m12 l4">
                           <div class="modalc-img">
                           <?php 
                            if($key["foto"]==""){
                              ?>
                             <div class="col s12 m12 l6">
                              <img style="margin-top:10px;" src="<?php echo base_url()?>assets/imagenes/no-imagen.png" alt="" width="200px">
                             </div>
                              <?php
                            }else{
                              ?>
                             <div class="col s12 m12 l6 img_nac_us">
                              <a style="display:block;margin-left:10px;" class="thumbnail gallery" href="http://intranet.km-telecomunicaciones.cl/mantenedor_usuarios/<?php echo $key["foto"]?>">
                               <center><img style="margin-top:20px;" class="z-depth-2" src="http://intranet.km-telecomunicaciones.cl/mantenedor_usuarios/<?php echo $key["foto"]?>" width="150px" alt="" ></center>
                              </a>                             
                             </div>
                              <?php
                            }

                             if($key["imagen"]==""){
                              ?>
                             <div class="col s12 m12 l6">
                              <img style="margin-top:10px;" src="<?php echo base_url()?>assets/imagenes/no-imagen.png" alt="" width="200px">
                             </div>
                              <?php
                            }else{
                              ?>
                             <div class="col s12 m12 l6 img_nac_hi">
                              <a style="display:block;margin-left:10px;" class="thumbnail gallery" href="<?php echo base_url()?>assets/imagenes/nacimientos/<?php echo $key["imagen"]?>">
                                <center><img style="margin-top:50px;" class="img_modal_nac z-depth-2" src="<?php echo base_url()?>assets/imagenes/nacimientos/min_<?php echo $key["imagen"]?>"></center>
                              </a>
                             </div>
                              <?php
                            }
        
                           ?>
                           </div>
                         </div>
          
                       <div class="col s12 m12 l8">
                        <br>
                              <div class="col s12 l12">
                              <h6 style="font-size:17px;">
                              Felicidades  a <?php echo $key["primer_nombre"]." ".$key["apellido_paterno"]?> 
                              <?php
                             if($key["esposa"]!=""){
                                echo " junto a su pareja <b>".$key["esposa"]."</b>";
                              }else{
                                echo "";
                              }  
                            ?>  
                            por el nacimiento de <?php echo "<b>".$key["hijo"]."</b>";
                             
                              ?></h6>
                              <div class="divider" style="margin-top:20px;margin-bottom:10px;"></div>
                            </div>


                              <div class="col s12 l12" style="word-wrap:break-word;">
                                <b>Detalles </b> <p><?php echo nl2br($key["comentarios"])?></p>
                               <div class="divider" style="margin-top:10px;margin-bottom:10px;"></div>
                              </div>  

                              <div class="col s6 l6">
                                <b>Area KM </b>  <p><?php echo $key["area"]?></p>
                             </div>

                             <div class="col s6 l6">
                                <b>Proyecto </b>  <p><?php echo $key["proyecto"]?></p>
                             </div>
                        
                     </div>
                        
                       <div class="col s12 m12 l12 modal-texto"><br>
                         <div class="divider" style="margin-top:10px;margin-bottom:10px;"></div>
                         <div class="row">
                         <div class="col l12">
                         <div class="top_coments">
                            <div class="col s12 l6 top_coment">
                             <center><a href="#!" data-id="<?php echo $key["id"]?>" class="btn_coment"><i class="material-icons left" style="margin-top:-7px;">comment</i>Ver Comentarios</a></center>
                            </div>
                            <div class="col s12 l6 top_coment">
                             <center><a href="#!" data-id="<?php echo $key["id"]?>" class="btn_comentar"><i class="material-icons left" style="margin-top:-7px;">chat_bubble_outline</i>Comentar</a></center>
                            </div>
                         </div>
                         </div>
                         </div>
                        <div class="row">
                        <div class="col s12 l12">
                          <div class="col s12 l12">
                          <span class="validation_coment"></span>
                          </div>
                          <div class="connt">
                            <div class="comentarios_nac" data-id="<?php echo $key["id"]?>" data-user="<?php echo $this->session->userdata('rutUsuario');?>"></div>
                          </div>
                        </div>
                        </div>
                      </div> 
                      </div>  
                  </div>

                  <div class="modal-footer">
                     <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
                  </div>
                </div>

              <?php
              }
              ?>

         </ul>
       
      </div><!--FIN SECCION NACIMIENTOS -->
   </div><!--FIN SECCION IZQUIERDA -->
</div><!--FIN ROW -->
<?php 
if(false !=$listado){
?>
<!-- LOADER -->
<div class="row">
<div class="col s12 m12 l12">
<div class="lastId" style="display:none" id="<?php echo  $id ?>"></div>  
  <br>
  <div class="col s12 l8">
   <center>
   <a id="cargarmas" class="waves-effect waves-light btn">
   <i class="material-icons right">loop</i>
   Cargar M&aacute;s
   </a>
   </center>
  </div>

  <center>
  <div class="col s12 l8 text-center">
    <div class="before">
       <div class="preloader-wrapper big active">
       <div class="spinner-layer spinner-green-only">
        <div class="circle-clipper left">
        <div class="circle"></div>
         </div><div class="gap-patch">
        <div class="circle"></div>
         </div><div class="circle-clipper right">
        <div class="circle"></div>
        </div>
        </div>
       </div>
    </div>  
  </div>
  </center>
  </div>
</div>
<?php
}
?>
</div><!-- FIN DIV SECTION -->
</div><!-- FIN CONTAINER -->
</section><br><br>

<script type="text/javascript">
$(function(){
  $(".before").hide();
function mes_to_string(mess){
    switch (mess) {
    case 1:mess="Enero";break;
    case 2:mess="Febrero";break;
    case 3:mess="Marzo";break;
    case 4:mess="Abril";break;
    case 5:mess="Mayo";break;
    case 6:mess="Junio";break;
    case 7:mess="Julio";break;
    case 8:mess="Agosto";break;
    case 9:mess="Septiembre";break;
    case 10:mess="Octubre";break;
    case 11:mess="Noviembre";break;
    case 12:mess="Diciembre";break;
  }
  return mess;
}

function fecha_to_string(fecha2){
  fecha=fecha2.split(' ');
  fecha22=fecha[0];  
  hora=fecha[1];  
  fecha3=fecha22.split('-');
  anio=fecha3[0];mes=fecha3[1];dia=fecha3[2];
  return "Creado el "+ dia + " de " + mes_to_string(parseInt(mes)) + " del " + anio + " a las " + hora;
}

function loadMore(){
    var id = $(".lastId").attr("id"), getLastId, html = "";
    var url="<?php echo base_url()?>loadMore";
    var base_url="<?php echo base_url()?>";
    if (id != "" || id != "undefined") {
        $.ajax({
            type : "POST",
            cache:false,
            url : url+"?"+$.now(),
            data : "lastId=" + id,//la última id
            beforeSend: function(){
                $(".before").fadeIn(500); 
                $("#cargarmas").hide();   

            },
            success : function(data){
                $(".before").hide();
                var json = JSON.parse(data);
                if(json.res == "success"){              

                   for(datos in json.users) {

                     html += '<div class="card z-depth-1 hoverable">'
                      + '<div class="card-image">'
                      + '<a href="' + base_url+ 'noticias/' + json.users[datos].url + '">'
                      + '<img src="' + base_url + 'assets/imagenes/noticias/' + json.users[datos].imagen + '" width="520px" height="260px">'
                      + '</a>'
                      + '<span class="card-title">' + json.users[datos].titulo + '</span>'    
                      + '</div>'
                  + '<div class="card-content">'
                      + '<div class="row">'
                        + '<div class="col s12 m12 l12">' + json.users[datos].descripcion.substr(0,250) + '...' + '</div></div>'
                      + '<div class="row" style="margin-bottom:0px;">'
                         + '<div class="col s12 l5 btn_leer_mas">'
                         + '<a href="' + base_url+ 'noticias/' + json.users[datos].url + '" class="btn" style="color: rgba(0, 0, 0, 0.6);background-color: #E4E4E4;height: 32px;font-weight: 500;line-height: 32px;border-radius: 16px;box-shadow:0px 1px 2px 0px rgba(0, 0, 0, 0.16), 0px 1px 3px 0px rgba(0, 0, 0, 0.12);">'
                         + '<i class="material-icons left">info</i>Leer M&aacute;s'
                         + '</a>'  
                        + '</div>'
                        + '<div class="col s12 l7 chip btn_fecha_info" style="margin-top:4px;text-align:center;box-shadow:0px 1px 2px 0px rgba(0, 0, 0, 0.16), 0px 1px 3px 0px rgba(0, 0, 0, 0.12);">'
                         + '<i class="material-icons left">today</i>' + fecha_to_string(json.users[datos].fecha) + ''
                        + '</div>'
                      + '</div>'
                     + '<div class="divider" style="margin-bottom:15px;"></div>'
                     + '<div class="col l12 cont_not_coment"></div>'
                     + '<div class="col s12 m12 l6 btn_info btn_comentar_not" data-id="' + json.users[datos].id + '">'
                       + '<a href="#!" class="waves-effect waves-light btn">'
                       + '<i class="material-icons left">comment</i>Comentar'
                       + '</a>'   
                     + '</div>'
                     + '<div class="col s12 m12 l6 btn_info ver_comentarios_not" data-id="' + json.users[datos].id + '">' 
                       + '<a href="#!" class="waves-effect waves-light btn">' 
                       + '<i class="material-icons left">chat_bubble_outline</i> Ver Comentarios </a>' 
                     + '</div>'
                  + '</div>'
                  + '</div>';

                   getLastId = json.users[datos].id; 

                   }
      
                   $("#cargarmas").show();  
                   $(".content").append(html);
                   $(".notic").hide();
                   $(".notic").fadeIn(3000);
               }else{
                    moreusers = false;
                    $(".content").append("<br><div class='z-depth-1' style='padding:13px;'><blockquote><h6>No se han encontrado m&aacute;s noticias.</h6></blockquote></div>");
                    $(".content blockquote").hide();
                    $(".content blockquote").fadeIn(2000);
                    $("#cargarmas").hide();    

               }
                 $(".lastId").attr("id",getLastId);
            },
            error: function(){
                alert("Error Cargando las noticias");
            }
        });
    }
}
 
var scrollLoad = true;

$(document).on('click', '#cargarmas', function(event) {
   $("#cargarmas").hide();    
    event.preventDefault();
    scrollLoad = false;
    loadMore();
});

});
</script>

