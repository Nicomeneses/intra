<!-- SECCION IZQUIERDA -->

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
                     <img src="<?php base_url()?>../assets/imagenes/user-ico.png" alt="" class="circle">
                    <?php      
                    }

                    if($dia_actual==$dia_bd){
                      ?>
                      <span class="title" style="color:rgba(0,0,0,0.85);font-size:13px;font-weight:bold;margin-bottom:7px;margin-top:3px;"><?php echo $key["primer_nombre"]." ".$key["apellido_paterno"]." ".$key["apellido_materno"]?></span>
                      <span style="margin-top:-7px;" class="secondary-content">
                      <img style="margin-top:-3px;margin-right:6px;" src="<?php echo base_url()?>assets/imagenes/hoy.png" alt="" width="30px">
                      </span>
                    </li>
                    </a>
                      <?php
                    } else{
                      ?>
                      <span class="title title2"><?php echo $key["primer_nombre"]." ".$key["apellido_paterno"]." ".$key["apellido_materno"]?></span>
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
                          <center><h5>Feliz Cumplea&ntilde;os <?php echo $key["primer_nombre"]." ".$key["apellido_paterno"]." ".$key["apellido_materno"]?></h5></center>
                          <div class="divider" style="margin-top:10px;margin-bottom:10px;"></div>

                          <?php
                        }else{
                          ?>
                          <center><h5>Cumplea&ntilde;os de <?php echo $key["primer_nombre"]." ".$key["apellido_paterno"]." ".$key["apellido_materno"]?></h5></center>
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
                                  <div class="col s6">
                                   <div class="col s4">
                                     Cumplea&ntilde;os  
                                   </div>
                                   <div class="col s8">
                                     <?php echo date_to_str($key["fecha_nacimiento"])?>
                                   </div>
                                   <div class="col s12">
                                      <div class="divider" style="margin-top:10px;margin-bottom:10px;"></div>
                                   </div>

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
                                   
                                   </div>

                                   <div class="col s6">

                                   <div class="col s4">
                                     Proyecto 
                                   </div>
                                   <div class="col s8"> 
                                     <?php echo $key["proyecto"]?>  
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

                                   <div class="col s12 m12 l12 modal-texto"><br>
                                     <div class="divider" style="margin-top:10px;margin-bottom:10px;"></div>
                                     <div class="row">
                                     <div class="col l12">
                                     <div class="top_coments">
                                        <div class="col l6 top_coment">
                                         <center><a href="#!" data-rut="<?php echo $key["rut"]?>" class="btn_coment_cumple"><i class="material-icons left" style="margin-top:-7px;">comment</i>Ver Comentarios</a></center>
                                        </div>
                                        <div class="col l6 top_coment">
                                         <center><a href="#!" data-rut="<?php echo $key["rut"]?>" class="btn_comentar_cumple"><i class="material-icons left" style="margin-top:-7px;">chat_bubble_outline</i>Comentar</a></center>
                                        </div>
                                     </div>
                                     </div>
                                     </div>
                                    <div class="row">
                                    <div class="col l12">
                                      <div class="col l12">
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
                     <img src="<?php base_url()?>../assets/imagenes/user-ico.png" alt="" class="circle">
                    <?php      
                    }
                    ?>
                    <span class="title title2"><?php echo $key["primer_nombre"]." ".$key["apellido_paterno"]." ".$key["apellido_materno"]?></span>
                    <span class="title3"><?php echo $key["cargo"]?></span>
               </li>
                 </a>

               <div id="modal2<?php echo $key["rut"]?>" class="modal modal-fixed-footer">
                        <div class="modal-content" style="padding: 6px 24px;">
                           <center><h5>Bienvenido a KM <?php echo $key["primer_nombre"]." ".$key["apellido_paterno"]." ".$key["apellido_materno"]?></h5></center>
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
                                <div class="col l6">
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
                                    <div class="col l6 top_coment">
                                     <center><a href="#!" data-rut="<?php echo $key["rut"]?>" class="btn_coment_ing"><i class="material-icons left" style="margin-top:-7px;">comment</i>Ver Comentarios</a></center>
                                    </div>
                                    <div class="col l6 top_coment">
                                     <center><a href="#!" data-rut="<?php echo $key["rut"]?>" class="btn_comentar_ing"><i class="material-icons left" style="margin-top:-7px;">chat_bubble_outline</i>Comentar</a></center>
                                    </div>
                                 </div>
                                 </div>
                                 </div>
                                <div class="row">
                                <div class="col l12">
                                  <div class="col l12">
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
                <span  class="title title2"><?php echo $key["primer_nombre"]?> <?php echo $key["apellido_paterno"]." ".$key["apellido_materno"]?></span>
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
                             <div class="col s12 m12 l6">
                              <a style="display:block;margin-left:10px;" class="thumbnail gallery" href="http://intranet.km-telecomunicaciones.cl/mantenedor_usuarios/<?php echo $key["foto"]?>">
                               <center><img style="margin-top:20px;" class="img_modal_nac z-depth-2" src="http://intranet.km-telecomunicaciones.cl/mantenedor_usuarios/<?php echo $key["foto"]?>" alt="" ></center>
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
                             <div class="col s12 m12 l6">
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
                              <div class="col l12">
                              <h6 style="font-size:17px;">
                              Felicidades  a <?php echo $key["primer_nombre"]." ".$key["apellido_paterno"]." ".$key["apellido_materno"]?> 
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


                              <div class="col l12" style="word-wrap:break-word;">
                                <b>Detalles </b> <p><?php echo nl2br($key["comentarios"])?></p>
                               <div class="divider" style="margin-top:10px;margin-bottom:10px;"></div>
                              </div>  

                              <div class="col l6">
                                <b>Area KM </b>  <p><?php echo $key["area"]?></p>
                             </div>

                             <div class="col l6">
                                <b>Proyecto </b>  <p><?php echo $key["proyecto"]?></p>
                             </div>
                        
                     </div>
                        
                       <div class="col s12 m12 l12 modal-texto"><br>
                         <div class="divider" style="margin-top:10px;margin-bottom:10px;"></div>
                         <div class="row">
                         <div class="col l12">
                         <div class="top_coments">
                            <div class="col l6 top_coment">
                             <center><a href="#!" data-id="<?php echo $key["id"]?>" class="btn_coment"><i class="material-icons left" style="margin-top:-7px;">comment</i>Ver Comentarios</a></center>
                            </div>
                            <div class="col l6 top_coment">
                             <center><a href="#!" data-id="<?php echo $key["id"]?>" class="btn_comentar"><i class="material-icons left" style="margin-top:-7px;">chat_bubble_outline</i>Comentar</a></center>
                            </div>
                         </div>
                         </div>
                         </div>
                        <div class="row">
                        <div class="col l12">
                          <div class="col l12">
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
</div><!-- FIN DIV SECTION -->
</div><!-- FIN CONTAINER -->
</section><br><br>