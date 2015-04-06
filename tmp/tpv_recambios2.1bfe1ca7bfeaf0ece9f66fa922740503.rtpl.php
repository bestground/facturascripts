<?php if(!class_exists('raintpl')){exit;}?><script type="text/javascript" src="view/js/tpv_recambios.js"></script>
<script type="text/javascript">
   fs_nf0 = <?php  echo FS_NF0;?>;
   tpv_url = '<?php echo $fsc->url();?>';
</script>

<div class="container-fluid" style="margin-top: 10px; margin-bottom: 10px;">
   <div class="row">
      <div class="col-md-6">
         <div class="btn-group">
            <a class="btn btn-sm btn-default" href="<?php echo $fsc->url();?>" title="recargar la página">
               <span class="glyphicon glyphicon-refresh"></span>
            </a>
            <?php if( $fsc->page->show_on_menu ){ ?>

               <?php if( $fsc->page->is_default() ){ ?>

               <a class="btn btn-sm btn-default active" href="<?php echo $fsc->url();?>&amp;default_page=FALSE" title="desmarcar como página de inicio">
                  <span class="glyphicon glyphicon-home"></span>
               </a>
               <?php }else{ ?>

               <a class="btn btn-sm btn-default" href="<?php echo $fsc->url();?>&amp;default_page=TRUE" title="marcar como página de inicio">
                  <span class="glyphicon glyphicon-home"></span>
               </a>
               <?php } ?>

            <?php } ?>

         </div>
         
         <div class="btn-group">
            <a href="#" id="b_reticket" class="btn btn-sm btn-default">
               <span class="glyphicon glyphicon-print"></span> &nbsp; Reimprimir ticket
            </a>
            <a href="#" id="b_borrar_ticket" class="btn btn-sm btn-warning">
               <span class="glyphicon glyphicon-trash"></span> &nbsp; Borrar ticket
            </a>
         </div>
      </div>
      <div class="col-md-6 text-right">
         <div class="btn-group">
            <a href="<?php echo $fsc->url();?>&abrir_caja=TRUE" id="b_abrir_caja" class="btn btn-sm btn-default">
               <span class="glyphicon glyphicon-inbox"></span> &nbsp; Abrir caja
            </a>
            <a href="#" id="b_cerrar_caja" class="btn btn-sm btn-danger">
               <span class="glyphicon glyphicon-lock"></span> &nbsp; Cerrar caja
            </a>
         </div>
      </div>
   </div>
</div>

<form id="f_new_albaran" name="f_new_albaran" action="<?php echo $fsc->url();?>" method="post" class="form">
   <input type="hidden" name="petition_id" value="<?php echo $fsc->random_string();?>"/>
   <input type="hidden" id="numlineas" name="numlineas" value="0"/>
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
               Cliente:
               <select class="form-control" name="cliente" id="cliente_select">
               <?php $loop_var1=$fsc->cliente->all_full(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                  <?php if( $value1->is_default() ){ ?>

                  <option value="<?php echo $value1->codcliente;?>" selected="selected"><?php echo $value1->nombre;?></option>
                  <?php }else{ ?>

                  <option value="<?php echo $value1->codcliente;?>"><?php echo $value1->nombre;?></option>
                  <?php } ?>

               <?php }else{ ?>

                  <option value="">¡¡¡No tienes clientes!!!</option>
               <?php } ?>

               </select>
            </div>
         </div>
         <div class="col-lg-3 col-md-3 col-sm-3">
            <div class="form-group">
               Fecha:
               <input class="form-control datepicker" type="text" name="fecha" value="<?php echo $fsc->today();?>"/>
            </div>
         </div>
         <div class="col-lg-3 col-md-3 col-sm-3">
            <div class="form-group">
               Atiende:
               <div class="form-control">
                  <a href="<?php echo $fsc->agente->url();?>"><?php echo $fsc->agente->get_fullname();?></a>
               </div>
            </div>
         </div>
      </div>
   </div>
   
   <ul class="nav nav-tabs" role="tablist">
      <li class="active"><a href="#tab_lineas" role="tab" data-toggle="tab">Líneas</a></li>
      <li><a href="#tab_opciones" role="tab" data-toggle="tab">Más opciones...</a></li>
      <li>
         <a href="#tab_tickets" role="tab" data-toggle="tab">
            <span class="glyphicon glyphicon-print"></span> &nbsp; Tickets
         </a>
      </li>
   </ul>
   
   <div class="tab-content">
      <div class="tab-pane active" id="tab_lineas">
         <div class="table-responsive">
            <table class="table table-condensed">
               <thead>
                  <tr>
                     <th class="text-left">Referencia</th>
                     <th class="text-left">Descripción</th>
                     <th class="text-right">Cantidad</th>
                     <th></th>
                     <th class="text-right">PVP</th>
                     <th class="text-right">Dto. %</th>
                     <th class="text-right">Neto</th>
                     <th class="text-right">IVA %</th>
                     <th class="text-right">Total</th>
                  </tr>
               </thead>
               <tbody id="lineas_albaran">
                  <tr class="bg-info">
                     <td><input id="i_new_line" class="form-control" type="text" placeholder="Buscar para añadir..." autocomplete="off"/></td>
                     <td colspan="5" class="text-right">Totales:</td>
                     <td>
                        <div id="aneto" class="form-control text-right" style="font-weight: bold;"><?php echo $fsc->show_numero(0);?></div>
                     </td>
                     <td>
                        <div id="aiva" class="form-control text-right" style="font-weight: bold;"><?php echo $fsc->show_numero(0);?></div>
                     </td>
                     <td>
                        <div id="atotal" class="form-control text-right" style="font-weight: bold;"><?php echo $fsc->show_numero(0);?></div>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
      <div class="tab-pane" id="tab_opciones">
         <div class="container-fluid" style="margin-top: 10px; margin-bottom: 20px;">
            <div class="row">
               <div class="col-md-3">
                  <div class="form-group">
                     <a href="<?php echo $fsc->almacen->url();?>">Almacén</a>:
                     <select name="almacen" class="form-control">
                        <?php $loop_var1=$fsc->almacen->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                           <?php if( $value1->is_default() ){ ?>

                           <option value="<?php echo $value1->codalmacen;?>" selected='selected'><?php echo $value1->nombre;?></option>
                           <?php }else{ ?>

                           <option value="<?php echo $value1->codalmacen;?>"><?php echo $value1->nombre;?></option>
                           <?php } ?>

                        <?php } ?>

                     </select>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="form-group">
                     <a href="<?php echo $fsc->serie->url();?>">Serie</a>:
                     <select name="serie" class="form-control">
                        <?php $loop_var1=$fsc->serie->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                           <?php if( $value1->is_default() ){ ?>

                           <option value="<?php echo $value1->codserie;?>" selected='selected'><?php echo $value1->descripcion;?></option>
                           <?php }else{ ?>

                           <option value="<?php echo $value1->codserie;?>"><?php echo $value1->descripcion;?></option>
                           <?php } ?>

                        <?php } ?>

                     </select>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="form-group">
                     <a href="<?php echo $fsc->forma_pago->url();?>">Forma de pago</a>:
                     <select name="forma_pago" class="form-control">
                        <?php $loop_var1=$fsc->forma_pago->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                           <?php if( $value1->is_default() ){ ?>

                           <option value="<?php echo $value1->codpago;?>" selected="selected"><?php echo $value1->descripcion;?></option>
                           <?php }else{ ?>

                           <option value="<?php echo $value1->codpago;?>"><?php echo $value1->descripcion;?></option>
                           <?php } ?>

                        <?php } ?>

                     </select>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="form-group">
                     <a href="<?php echo $fsc->divisa->url();?>">Divisa</a>:
                     <select name="divisa" class="form-control">
                        <?php $loop_var1=$fsc->divisa->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                           <?php if( $value1->is_default() ){ ?>

                           <option value="<?php echo $value1->coddivisa;?>" selected="selected"><?php echo $value1->descripcion;?></option>
                           <?php }else{ ?>

                           <option value="<?php echo $value1->coddivisa;?>"><?php echo $value1->descripcion;?></option>
                           <?php } ?>

                        <?php } ?>

                     </select>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="form-group">
                     Número 2:
                     <input class="form-control" type="text" name="numero2" autocomplete="off"/>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="tab-pane" id="tab_tickets">
         <div class="container-fluid" style="margin-top: 10px; margin-bottom: 20px;">
            <div class="row">
               <div class="col-md-2">
                  <div class="form-group">
                     Nº de tickets:
                     <input class="form-control" type="number" name="num_tickets" value="1"/>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="checkbox">
                     <label>
                        <input type="checkbox" name="imprimir_desc" value="TRUE"<?php if( $fsc->imprimir_descripciones ){ ?> checked="checked"<?php } ?>/>
                        Imprimir descripciones
                     </label>
                  </div>
                  <div class="checkbox">
                     <label>
                        <input type="checkbox" name="imprimir_obs" value="TRUE"<?php if( $fsc->imprimir_observaciones ){ ?> checked="checked"<?php } ?>/>
                        Imprimir observaciones
                     </label>
                  </div>
               </div>
               <div class="col-md-6">
                  <p>
                     <b>Recuarda</b> que para poder imprimir tickets necesitas estar ejecutando la aplicación Remote printer.
                  </p>
                  <a target="_blank" href="http://www.facturascripts.com/community/item/imprimir-tickets-desde-windows-llevo-toda-la-tarde-programando-para-poder-618.html" class="btn btn-sm btn-default">
                     <span class="glyphicon glyphicon-download"></span> &nbsp; Remote printer
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>
   
   <div class="container-fluid">
      <div class="row" style="margin-bottom: 30px;">
         <div class="col-lg-6 col-md-6 col-sm-6">
            <button class="btn btn-sm btn-default" type="button" onclick="window.location.href='<?php echo $fsc->url();?>';">
               <span class="glyphicon glyphicon-refresh"></span> &nbsp; Reiniciar...
            </button>
         </div>
         <div class="col-lg-6 col-md-6 col-sm-6 text-right">
            <button target="_blank" class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true; this.form.target = '_blank'; this.form.submit();">
               <span class="glyphicon glyphicon-floppy-disk"></span> &nbsp; Guardar
            </button>
         </div>
      </div>
      <div class="row">
         <div class="col-lg-12">
            <div class="form-group">
               Observaciones:
               <textarea class="form-control" name="observaciones" rows="4"></textarea>
            </div>
         </div>
      </div>
   </div>
</form>

<div class="modal" id="modal_articulos">
   <div class="modal-dialog" style="width: 99%; max-width: 950px;">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Buscar artículos</h4>
         </div>
         <div class="modal-body">
            <form id="f_buscar_articulos" name="f_buscar_articulos" action="<?php echo $fsc->url();?>" method="post" class="form">
               <input type="hidden" name="codcliente"/>
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="input-group">
                           <input class="form-control" type="text" name="query" autocomplete="off"/>
                           <span class="input-group-btn">
                              <button class="btn btn-primary" type="submit">
                                 <span class="glyphicon glyphicon-search"></span>
                              </button>
                           </span>
                        </div>
                        <label>
                           <input type="checkbox" name="con_stock" value="TRUE" onchange="buscar_articulos()"/>
                           sólo con stock
                        </label>
                     </div>
                     <div class="col-lg-6 col-md-6 col-sm-6">
                        <select class="form-control" name="codfamilia" onchange="buscar_articulos()">
                           <option value="">Todas las familias</option>
                           <option value="">------</option>
                           <?php $loop_var1=$fsc->familia->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                           <option value="<?php echo $value1->codfamilia;?>"><?php echo $value1->descripcion;?></option>
                           <?php } ?>

                        </select>
                     </div>
                  </div>
               </div>
            </form>
         </div>
         <div id="search_results"></div>
      </div>
   </div>
</div>

<script>
	$(document).ready(function() {
		$("#cliente_select").select2();
	});
</script>>