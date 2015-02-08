<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<script type="text/javascript">
   function buscar_lineas()
   {
      if(document.f_buscar_lineas.buscar_lineas.value == '')
      {
         $("#search_results").html('');
      }
      else
      {
         $.ajax({
            type: 'POST',
            url: '<?php echo $fsc->url();?>',
            dataType: 'html',
            data: $("form[name=f_buscar_lineas]").serialize(),
            success: function(datos) {
               var re = /<!--(.*?)-->/g;
               var m = re.exec( datos );
               if( m[1] == document.f_buscar_lineas.buscar_lineas.value )
               {
                  $("#search_results").html(datos);
               }
            }
         });
      }
   }
   $(document).ready(function() {
      $("#b_buscar_lineas").click(function(event) {
         event.preventDefault();
         $("#modal_buscar_lineas").modal('show');
         document.f_buscar_lineas.buscar_lineas.focus();
      });
      $("#f_buscar_lineas").keyup(function() {
         buscar_lineas();
      });
      $("#f_buscar_lineas").submit(function(event) {
         event.preventDefault();
         buscar_lineas();
      });
   });
</script>

<div class="container-fluid" style="margin-top: 10px;">
   <div class="row">
      <div class="col-lg-10">
         <h2 style="margin-top: 0px;">
            <span class="text-capitalize"><?php  echo FS_ALBARANES;?></span> de <a href="<?php echo $fsc->cliente->url();?>"><?php echo $fsc->cliente->nombre;?></a>
         </h2>
      </div>
      <div class="col-lg-2 text-right">
         <a id="b_buscar_lineas" class="btn btn-sm btn-primary">
            <span class="glyphicon glyphicon-search"></span> &nbsp; líneas
         </a>
      </div>
   </div>
</div>

<div class="table-responsive">
   <table class="table table-hover">
      <thead>
         <tr>
            <th></th>
            <th class="text-left">Código + Número 2</th>
            <th class="text-left">Observaciones</th>
            <th class="text-right">Total</th>
            <th class="text-right">Fecha</th>
            <th class="text-right">Hora</th>
         </tr>
      </thead>
      <?php $loop_var1=$fsc->resultados; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

      <tr class="clickableRow<?php if( $value1->total<=0 ){ ?> bg-warning<?php } ?>" href="<?php echo $value1->url();?>">
         <td class="text-center">
            <?php if( !$value1->ptefactura ){ ?>

            <span class="glyphicon glyphicon-paperclip" title="El <?php  echo FS_ALBARAN;?> tiene vinculado una factura"></span>
            <?php } ?>

         </td>
         <td><a href="<?php echo $value1->url();?>"><?php echo $value1->codigo;?></a> <?php echo $value1->numero2;?></td>
         <td><?php echo $value1->observaciones_resume();?></td>
         <td class="text-right"><?php echo $fsc->show_precio($value1->total, $value1->coddivisa);?></td>
         <td class="text-right"><?php echo $value1->fecha;?></td>
         <td class="text-right"><?php echo $value1->hora;?></td>
      </tr>
      <?php }else{ ?>

      <tr class="bg-warning">
         <td></td>
         <td colspan="5">Ningún <?php  echo FS_ALBARAN;?> encontrado.</td>
      </tr>
      <?php } ?>

   </table>
</div>

<ul class="pager">
   <?php if( $fsc->anterior_url()!='' ){ ?>

   <li class="previous">
      <a href="<?php echo $fsc->anterior_url();?>">
         <span class="glyphicon glyphicon-chevron-left"></span> &nbsp; Anteriores
      </a>
   </li>
   <?php } ?>

   
   <?php if( $fsc->siguiente_url()!='' ){ ?>

   <li class="next">
      <a href="<?php echo $fsc->siguiente_url();?>">
         Siguientes &nbsp; <span class="glyphicon glyphicon-chevron-right"></span>
      </a>
   </li>
   <?php } ?>

</ul>

<form id="f_buscar_lineas" name="f_buscar_lineas" action="<?php echo $fsc->url();?>" method="post" class="form">
   <input type="hidden" name="codcliente" value="<?php echo $fsc->cliente->codcliente;?>"/>
   <div class="modal" id="modal_buscar_lineas">
      <div class="modal-dialog" style="width: 99%; max-width: 950px;">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">Buscar en las líneas de los <?php  echo FS_ALBARANES;?> de <?php echo $fsc->cliente->nombre;?></h4>
            </div>
            <div class="modal-body">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="input-group">
                           <input class="form-control" type="text" name="buscar_lineas" placeholder="Referencia" autocomplete="off"/>
                           <span class="input-group-btn">
                              <button class="btn btn-primary" type="submit">
                                 <span class="glyphicon glyphicon-search"></span>
                              </button>
                           </span>
                        </div>
                     </div>
                     <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                           <input class="form-control" type="text" name="buscar_lineas_o" placeholder="Observaciones" autocomplete="off"/>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div id="search_results" class="table-responsive"></div>
         </div>
      </div>
   </div>
</form>

<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>