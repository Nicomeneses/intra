<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(

	      'admin_webkm/nuevanoticia' => array(

               array(
                     'field'   => 'titulo',
                     'label'   => 'Titulo',
                     'rules'   => 'required|trim|min_length[5]|callback_not_check'
                    ),
               array(
                     'field'   => 'descripcion',
                     'label'   => 'Descripci&oacute;n',
                     'rules'   => 'required|trim|min_length[5]'
                    ),
                array(
                     'field'   => 'string_file',
                     'label'   => 'Imagen',
                     'rules'   => 'required'
                    )
        ),
          'admin_webkm/modificarnoticia' => array(

               array(
                     'field'   => 'titulo_mod',
                     'label'   => 'Titulo',
                     'rules'   => 'required|trim|min_length[5]|callback_not_check_mod'
                    ),
               array(
                     'field'   => 'descripcion_mod',
                     'label'   => 'Descripci&oacute;n',
                     'rules'   => 'required|trim|min_length[5]'
                    )
        ),
          'admin_webkm/nuevonacimiento' => array(

               array(
                     'field'   => 'rut',
                     'label'   => 'Rut',
                     'rules'   => 'required|trim|min_length[9]'
                    ),
               array(
                     'field'   => 'esposa',
                     'label'   => 'Esposa',
                     'rules'   => 'trim'
                    ),
                array(
                     'field'   => 'hijo',
                     'label'   => 'Hijo',
                     'rules'   => 'required|trim'
                    ),
                array(
                     'field'   => 'anio',
                     'label'   => 'A&ntilde;o',
                     'rules'   => 'required|numeric'
                    ),
                array(
                     'field'   => 'mes',
                     'label'   => 'Mes',
                     'rules'   => 'required|numeric'
                    ),
                array(
                     'field'   => 'dia',
                     'label'   => 'Dia',
                     'rules'   => 'required|numeric'
                    )

        ),
          'admin_webkm/modificarnacimiento' => array(

               array(
                     'field'   => 'rut',
                     'label'   => 'Rut',
                     'rules'   => 'required|trim|min_length[9]'
                    ),
               array(
                     'field'   => 'esposa',
                     'label'   => 'Esposa',
                     'rules'   => 'trim'
                    ),
                array(
                     'field'   => 'hijo',
                     'label'   => 'Hijo',
                     'rules'   => 'required|trim'
                    ),
                array(
                     'field'   => 'anio',
                     'label'   => 'A&ntilde;o',
                     'rules'   => 'required|numeric'
                    ),
                array(
                     'field'   => 'mes',
                     'label'   => 'Mes',
                     'rules'   => 'required|numeric'
                    ),
                array(
                     'field'   => 'dia',
                     'label'   => 'Dia',
                     'rules'   => 'required|numeric'
                    )

        )


 );
?>