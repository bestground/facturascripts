<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<script type="text/javascript">
   function buscar_lineas()
   {
      if(document.f_buscar_lineas.buscar_lineas.value == '')
      {
         $('#search_results').html('');
      }
      else
      {
         $.ajax({
            type: 'POST',
            url: '<?php echo $fsc->url();?>',
            dataType: 'html',
            data: $('form[name=f_buscar_lineas]').serialize(),
            success: function(datos) {
               var re = /<!--(.*?)-->/g;
               var m = re.exec( datos );
               if( m[1] == document.f_buscar_lineas.buscar_lineas.value )
               {
                  $('#search_results').html(datos);
               }
            }
         });
      }
   }
   $(document).ready(function() {
      document.f_custom_search.query.focus();
      $('#b_buscar_lineas').click(function(event) {
         event.preventDefault();
         $('#modal_buscar_lineas').modal('show');
         document.f_buscar_lineas.buscar_lineas.focus();
      });
      $('#f_buscar_lineas').keyup(function() {
         buscar_lineas();
      });
      $('#f_buscar_lineas').submit(function(event) {
         event.preventDefault();
         buscar_lineas();
      });
   });
</script>

<div class="container-fluid" style="margin-top: 10px; margin-bottom: 10px;">
   <div class="row">
      <div class="col-md-8 col-sm-7 col-xs-8">
         <div class="btn-group hidden-xs">
            <a class="btn btn-sm btn-default" href="<?php echo $fsc->url();?>" title="Recargar la página">
               <span class="glyphicon glyphicon-refresh"></span>
            </a>
            <?php if( $fsc->page->is_default() ){ ?>

            <a class="btn btn-sm btn-default active" href="<?php echo $fsc->url();?>&amp;default_page=FALSE" title="desmarcar como página de inicio">
               <span class="glyphicon glyphicon-home"></span>
            </a>
            <?php }else{ ?>

            <a class="btn btn-sm btn-default" href="<?php echo $fsc->url();?>&amp;default_page=TRUE" title="marcar como página de inicio">
               <span class="glyphicon glyphicon-home"></span>
            </a>
            <?php } ?>

         </div>
         
         <div class="btn-group">
            <a class="btn btn-sm btn-success" href="index.php?page=nueva_venta&tipo=albaran">
               <span class="glyphicon glyphicon-plus"></span> &nbsp; Nuevo
            </a>
            
            <!-- CAMBIO
            <a class="btn btn-sm btn-default" href="index.php?page=ventas_agrupar_albaranes">
               <span class="glyphicon glyphicon-tasks"></span> &nbsp; Agrupar
            </a>
            -->
            
            <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <?php if( $value1->type=='button' ){ ?>

               <a href="index.php?page=<?php echo $value1->from;?>" class="btn btn-sm btn-default"><?php echo $value1->text;?></a>
               <?php } ?>

            <?php } ?>

         </div>
      </div>
      <div class="col-md-2 col-sm-2 col-xs-4 text-right">
         <a id="b_buscar_lineas" class="btn btn-sm btn-info" title="Buscar en las líneas">
            <span class="glyphicon glyphicon-search"></span> &nbsp; Líneas
         </a>
      </div>
      <div class="col-md-2 col-sm-3 col-xs-12">
         <div class="visible-xs"><br/></div>
         <form name="f_custom_search" action="<?php echo $fsc->url();?>" method="post" class="form">
            <div class="input-group">
               <input class="form-control" type="text" name="query" value="<?php echo $fsc->query;?>" autocomplete="off" placeholder="Buscar">
               <span class="input-group-btn">
                  <button class="btn btn-primary hidden-sm" type="submit">
                     <span class="glyphicon glyphicon-search"></span>
                  </button>
               </span>
            </div>
         </form>
      </div>
   </div>
</div>

<?php if( $fsc->query!='' ){ ?>

<h3 class="text-center">Resultados de "<?php echo $fsc->query;?>":</h3>
<?php } ?>


<ul class="nav nav-tabs" role="tablist">
   <li<?php if( !$fsc->pendientes ){ ?> class="active"<?php } ?>>
      <a href="<?php echo $fsc->url();?>&ptefactura=FALSE">Todos los <?php  echo FS_ALBARANES;?></a>
   </li>
   <!-- CAMBIO
   <li<?php if( $fsc->pendientes ){ ?> class="active"<?php } ?>>
      <a href="<?php echo $fsc->url();?>&ptefactura=TRUE">
         <span class="glyphicon glyphicon-time"></span> &nbsp; Pendientes
      </a>
   </li>
   -->
</ul>

<div class="table-responsive">
   <table class="table table-hover">
      <thead>
         <tr>
            <th></th>
            <th class="text-left">Código + Número 2</th>
            <th class="text-left">Cliente</th>
            <th class="text-left">Observaciones</th>
            <th class="text-right">Total Bruto</th>
            <th class="text-right">Importe IVA</th>
            <th class="text-right">Total Factura</th>
            <th class="text-right">Pago Señor</th>
            <th class="text-right">Fecha</th>
            <th class="text-right">Hora</th>
         </tr>
      </thead>
      <?php $loop_var1=$fsc->resultados; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

      <tr class='clickableRow<?php if( $value1->total<=0 ){ ?> bg-warning<?php } ?>' href="<?php echo $value1->url();?>">
         <td class="text-center">
            <?php if( !$value1->ptefactura ){ ?>

            <span class="glyphicon glyphicon-paperclip" title="El <?php  echo FS_ALBARAN;?> tiene vinculado una factura"></span>
            <?php } ?>

         </td>
         <td><a href="<?php echo $value1->url();?>"><?php echo $value1->codigo;?></a> <?php echo $value1->numero2;?></td>
         <td><?php echo $value1->nombrecliente;?></td>
         <td><?php echo $value1->observaciones_resume();?></td>
         <td class="text-right"><?php echo $fsc->_pc($value1->total_bruto);?></td>
         <td class="text-right"><?php echo $fsc->_pc($value1->importe_iva);?></td>
         <td class="text-right"><?php echo $fsc->_pc($value1->total_factura);?></td>
         <td class="text-right"><?php echo $fsc->_pc($value1->pago_senor);?></td>
         <td class="text-right"><?php echo $value1->fecha;?></td>
         <td class="text-right"><?php echo $value1->hora;?></td>
      </tr>
      <?php }else{ ?>

      <tr class="bg-warning">
         <td></td>
         <td colspan="6">Ningún <?php  echo FS_ALBARAN;?> encontrado. Pulsa el botón <b>Nuevo</b> para crear uno.</td>
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

<form class="form" role="form" id="f_buscar_lineas" name="f_buscar_lineas" action ="<?php echo $fsc->url();?>" method="post">
   <div class="modal" id="modal_buscar_lineas">
      <div class="modal-dialog" style="width: 99%; max-width: 950px;">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">Buscar en las líneas</h4>
            </div>
            <div class="modal-body">
               <div class="input-group">
                  <input class="form-control" type="text" name="buscar_lineas" placeholder="Referencia" autocomplete="off"/>
                  <span class="input-group-btn">
                     <button class="btn btn-primary" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                     </button>
                  </span>
               </div>
            </div>
            <div id="search_results" class="table-responsive"></div>
         </div>
      </div>
   </div>
</form>

<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>