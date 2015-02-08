<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<?php if( $fsc->albaran ){ ?>

<?php if( $fsc->albaran->ptefactura ){ ?>

<script type="text/javascript" src="view/js/nueva_venta.js"></script>
<script type="text/javascript">
   numlineas = <?php echo count($fsc->albaran->get_lineas()); ?>;
   fs_nf0 = <?php  echo FS_NF0;?>;
   all_impuestos = <?php echo json_encode($fsc->impuesto->all()); ?>;
   all_series = <?php echo json_encode($fsc->serie->all()); ?>;
   cliente = <?php echo json_encode($fsc->cliente_s); ?>;
   nueva_venta_url = '<?php echo $fsc->nuevo_albaran_url;?>';
   fs_community_url = '<?php  echo FS_COMMUNITY_URL;?>';
   
   $(document).ready(function() {
      $("#numlineas").val(numlineas);
      usar_serie();
      recalcular();
      $("#ac_cliente").autocomplete({
         serviceUrl: nueva_venta_url,
         paramName: 'buscar_cliente',
         onSelect: function (suggestion) {
            if(suggestion)
            {
               if(document.f_albaran.cliente.value != suggestion.data && suggestion.data != '')
               {
                  document.f_albaran.cliente.value = suggestion.data;
                  usar_cliente(suggestion.data);
               }
            }
         }
      });
   });
</script>
<?php }else{ ?>

<script type="text/javascript">
   $(document).ready(function() {
      <?php if( $fsc->albaran->totalrecargo==0 ){ ?>

      $(".recargo").hide();
      <?php } ?>

      <?php if( $fsc->albaran->totalirpf==0 ){ ?>

      $(".irpf").hide();
      <?php } ?>

   });
</script>
<?php } ?>

<script type="text/javascript">
   $(document).ready(function() {
      $("#b_imprimir").click(function(event) {
         event.preventDefault();
         $("#modal_imprimir_albaran").modal('show');
      });
      $("#b_enviar").click(function(event) {
         event.preventDefault();
         $("#modal_enviar").modal('show');
         document.enviar_email.email.select();
      });
      $("#b_eliminar").click(function(event) {
         event.preventDefault();
         $("#modal_eliminar").modal('show');
      });
   });
</script>

<form name="f_albaran" action="<?php echo $fsc->albaran->url();?>" method="post" class="form">
   <input type="hidden" name="idalbaran" value="<?php echo $fsc->albaran->idalbaran;?>"/>
   <input type="hidden" name="cliente" value="<?php echo $fsc->albaran->codcliente;?>"/>
   <input type="hidden" id="numlineas" name="numlineas" value="0"/>
   <div class="container-fluid">
      <div class="row" style="margin-top: 10px;">
         <div class="col-md-8 col-sm-8">
            <a class="btn btn-sm btn-default" href="<?php echo $fsc->url();?>" title="Recargar la página">
               <span class="glyphicon glyphicon-refresh"></span>
            </a>
            
            <div class="btn-group">
               <a id="b_imprimir" class="btn btn-sm btn-default">
                  <span class="glyphicon glyphicon-print"></span> &nbsp; Imprimir
               </a>
               <?php if( $fsc->empresa->can_send_mail() ){ ?>

               <a id="b_enviar" class="btn btn-sm btn-default" href="#">
                  <span class="glyphicon glyphicon-envelope"></span> &nbsp; Enviar
               </a>
               <?php } ?>

               <?php if( $fsc->albaran->ptefactura ){ ?>

               <!--
               <a class="btn btn-sm btn-default" href="<?php echo $fsc->url();?>&facturar=TRUE&petid=<?php echo $fsc->random_string();?>">
                  <span class="glyphicon glyphicon-paperclip"></span> &nbsp; Aprobar
               </a>
               -->
               <?php }else{ ?>

               <a class="btn btn-sm btn-default text-capitalize" href="<?php echo $fsc->albaran->factura_url();?>">
                  <span class="glyphicon glyphicon-eye-open"></span> &nbsp; Ver Factura
               </a>
               <?php } ?>

               
               <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                  <?php if( $value1->type=='button' ){ ?>

                  <a href="index.php?page=<?php echo $value1->from;?>&id=<?php echo $fsc->albaran->idalbaran;?>" class="btn btn-sm btn-default">
                     <?php echo $value1->text;?>

                  </a>
                  <?php } ?>

               <?php } ?>

            </div>
         </div>
         <div class="col-md-4 col-sm-4 text-right">
            <div class="btn-group">
               <a id="b_eliminar" class="btn btn-sm btn-danger" href="#">
                  <span class="glyphicon glyphicon-trash"></span> &nbsp; Eliminar
               </a>
               <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">
                  <span class="glyphicon glyphicon-floppy-disk"></span> &nbsp; Guardar
               </button>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <h3 class="text-capitalize" style="margin-bottom: 0px;">
               <a href="<?php echo $fsc->ppage->url();?>"><?php  echo FS_ALBARANES;?></a> /
               <a href="<?php echo $fsc->albaran->cliente_url();?>"><?php echo $fsc->albaran->nombrecliente;?></a> /
               <?php echo $fsc->albaran->codigo;?>

            </h3>
            <?php if( $fsc->agente ){ ?>

            <p>
               <span class="text-capitalize"><?php  echo FS_ALBARAN;?></span> creado por
               <a href="<?php echo $fsc->agente->url();?>"><?php echo $fsc->agente->get_fullname();?></a>.
            </p>
            <?php } ?>

         </div>
      </div>
      <div class="row">
         <?php if( $fsc->albaran->ptefactura ){ ?>

         <div class="col-md-5 col-sm-12">
            <div class="form-group">
               Cliente actual:
               <div class="input-group">
                  <input class="form-control" type="text" name="ac_cliente" id="ac_cliente" value="<?php echo $fsc->albaran->nombrecliente;?>" placeholder="Buscar" autocomplete="off"/>
                  <span class="input-group-btn">
                     <button class="btn btn-default" type="button" onclick="document.f_albaran.ac_cliente.value=''; document.f_albaran.ac_cliente.focus();">
                        <span class="glyphicon glyphicon-edit"></span>
                     </button>
                  </span>
               </div>
            </div>
         </div>
         <?php } ?>

         
         <div class="col-md-2 col-sm-2">
         <!--
            <div class="form-group">
               Número 2:
               <input class="form-control" type="text" name="numero2" value="<?php echo $fsc->albaran->numero2;?>"/>
            </div>
                     -->
         </div>

         
         <div class="col-md-2 col-sm-2">
         <!--
            <div class="form-group">
               <a href="<?php echo $fsc->serie->url();?>">Serie</a>:
               <?php if( $fsc->albaran->ptefactura ){ ?>

               <select class="form-control" name="serie" id="codserie" onchange="usar_serie();recalcular();">
               <?php $loop_var1=$fsc->serie->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                  <?php if( $value1->codserie==$fsc->albaran->codserie ){ ?>

                  <option value="<?php echo $value1->codserie;?>" selected="selected"><?php echo $value1->descripcion;?></option>
                  <?php }else{ ?>

                  <option value="<?php echo $value1->codserie;?>"><?php echo $value1->descripcion;?></option>
                  <?php } ?>

               <?php } ?>

               </select>
               <?php }else{ ?>

               <div class="form-control"><?php echo $fsc->albaran->codserie;?></div>
               <?php } ?>

            </div>
            -->
         </div>
         <div class="col-md-2 col-sm-2">
            <div class="form-group">
               Fecha:
               <input class="form-control datepicker" type="text" name="fecha" value="<?php echo $fsc->albaran->fecha;?>" autocomplete="off"/>
            </div>
         </div>
         <div class="col-md-1 col-sm-2">
            <div class="form-group">
               Hora:
               <input class="form-control" type="text" name="hora" value="<?php echo $fsc->albaran->hora;?>" autocomplete="off"/>
            </div>
         </div>
      </div>
   </div>
   
   <div role="tabpanel">
      <ul class="nav nav-tabs" role="tablist">
         <li role="presentation" class="active">
            <a href="#lineas_a" aria-controls="lineas_a" role="tab" data-toggle="tab">Líneas</a>
         </li>
         <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

            <?php if( $value1->type=='tab' ){ ?>

            <li role="presentation">
               <a href="#ext_<?php echo $value1->name;?>" aria-controls="ext_<?php echo $value1->name;?>" role="tab" data-toggle="tab"><?php echo $value1->text;?></a>
            </li>
            <?php } ?>

         <?php } ?>

      </ul>
      <div class="tab-content">
         <div role="tabpanel" class="tab-pane active" id="lineas_a">
            <div class="table-responsive">
               <?php if( $fsc->albaran->ptefactura ){ ?>

               <table class="table table-condensed">
                  <thead>
                     <tr>
                        <th class="text-left">Referencia</th>
                        <th class="text-left">Descripción</th>
                        <th class="text-right" width="90">Cantidad</th>
                        <th></th>
                        <th class="text-right">PVP</th>
                        <th class="text-right" style="color:red;">% COMISIÓN</th>
                        <th class="text-right" style="color:red;">&euro; COMISIÓN</th>
                        <th class="text-right" style="color:red;">TOTAL &euro;</th>
                        <th class="text-right" style="color:red;" width="115">IVA COMISIÓN</th>
                        <th class="text-right">Neto Real</th>
                     </tr>
                  </thead>
                  <tbody id="lineas_albaran">
                     <?php $loop_var1=$fsc->albaran->get_lineas(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <tr id="linea_<?php echo $counter1;?>">
                        <td>
                           <input type="hidden" name="idlinea_<?php echo $counter1;?>" value="<?php echo $value1->idlinea;?>"/>
                           <input type="hidden" name="referencia_<?php echo $counter1;?>" value="<?php echo $value1->referencia;?>"/>
                           <div class="form-control">
                              <a target="_blank" href="<?php echo $value1->articulo_url();?>"><?php echo $value1->referencia;?></a>
                           </div>
                        </td>
                        <td><input type="text" class="form-control" name="desc_<?php echo $counter1;?>" value="<?php echo $value1->descripcion;?>" onclick="this.select()"/></td>
                        <td>
                           <input type="number" step="any" id="cantidad_<?php echo $counter1;?>" class="form-control text-right" name="cantidad_<?php echo $counter1;?>"
                                  value="<?php echo $value1->cantidad;?>" onchange="recalcular()" onkeyup="recalcular()" autocomplete="off" value="1"/>
                        </td>
                        <td>
                           <button class="btn btn-sm btn-danger" type="button" onclick="$('#linea_<?php echo $counter1;?>').remove();recalcular();">
                              <span class="glyphicon glyphicon-trash"></span>
                           </button>
                        </td>
                        
                        <td>
                           <input type="text" class="form-control text-right" id="pvp_<?php echo $counter1;?>" name="pvp_<?php echo $counter1;?>" value="<?php echo $fsc->_pc($value1->pvpunitario);?>"
                                  onkeyup="recalcular()" onclick="this.select()" autocomplete="off"/>
                        </td>
                        
                        <td>
                           <input type="text" id="com_porcentaje_<?php echo $counter1;?>" name="com_porcentaje_<?php echo $counter1;?>" value="<?php echo $value1->com_porcentaje;?>" class="form-control text-right"
                                  onkeyup="recalcular()" onclick="this.select()" autocomplete="off"/>
                        </td>
                        <td>
                           <input type="text" class="form-control text-right" id="com_total_<?php echo $counter1;?>" name="com_total_<?php echo $counter1;?>"
                                  onchange="recalcular()" onclick="this.select()" autocomplete="off"/>
                        </td>
                        <td>
                           <input type="text" class="form-control text-right" id="total_menos_comision_<?php echo $counter1;?>" name="total_menos_comision_<?php echo $counter1;?>"
                                  onchange="recalcular()" onclick="this.select()" autocomplete="off"/>
                        </td>
                        <td>
                           <input type="text" class="form-control text-right" id="com_iva_<?php echo $counter1;?>" name="com_iva_<?php echo $counter1;?>"
                                  onchange="recalcular()" onclick="this.select()" autocomplete="off"/>                        </td>

                        <td>
                           <input type="text" class="form-control text-right" id="neto_real_<?php echo $counter1;?>" name="neto_real_<?php echo $counter1;?>"
                                  onchange="recalcular()" onclick="this.select()" autocomplete="off"/>
                        </td>
                     </tr>
                     <?php } ?>

                  </tbody>
                  <tbody>
                     <tr class="bg-info">
                        	<td><input id="i_new_line" class="form-control" type="text" placeholder="Buscar para añadir..." autocomplete="off"/></td>
						   <td colspan="5" class="text-right"><strong>TOTALES:</strong></td>
						   <td> <strong>Total Bruto</strong>
								<!--
								<div id="total_bruto" class="form-control text-right" style="font-weight: bold;"><?php echo $fsc->show_numero(0);?></div>
								-->
								<input type="text" readonly name="total_bruto" id="total_bruto" class="form-control text-right" style="font-weight: bold;"
									 value="<?php echo $fsc->show_numero(0);?>" autocomplete="off"/>      		
						   </td>

						   <td class="recargo"> <strong>Importe IVA</strong>
								<!--
								<div id="importe_iva" class="form-control text-right" style="font-weight: bold;"><?php echo $fsc->show_numero(0);?></div>
								-->
								<input type="text" readonly name="importe_iva" id="importe_iva" class="form-control text-right" style="font-weight: bold;"
									 value="<?php echo $fsc->show_numero(0);?>" autocomplete="off"/>                 		
						   </td>
						   <td class="irpf"> <strong>Total Factura</strong>
								<!--
								<div id="total_factura" class="form-control text-right" style="font-weight: bold;"><?php echo $fsc->show_numero(0);?></div>
								-->
								<input type="text" readonly name="total_factura" id="total_factura" class="form-control text-right" style="font-weight: bold;"
									 value="<?php echo $fsc->show_numero(0);?>" autocomplete="off"/>          		
			   
						   </td>
						   <td> <strong>Pago Señor</strong>
							  <input type="text" readonly name="pago_senor" id="pago_senor" class="form-control text-right" style="font-weight: bold;"
									 value="0" onchange="recalcular()" autocomplete="off"/>
						   </td>
                     </tr>

                  </tbody>
               </table>
               <?php }else{ ?>

               <table class="table table-hover">
                  <thead>
                     <tr>
                        <th class="text-left">Artículo</th>
                        <th class="text-right">Cantidad</th>
                        <th class="text-right">PVP</th>
                        <th class="text-right">Dto</th>
                        <th class="text-right">Neto</th>
                        <th class="text-right">IVA</th>
                        <th class="text-right recargo">RE</th>
                        <th class="text-right irpf">IRPF</th>
                        <th class="text-right">Total</th>
                     </tr>
                  </thead>
                  <?php $loop_var1=$fsc->albaran->get_lineas(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                  <tr<?php if( $value1->cantidad<1 ){ ?> class="bg-warning"<?php } ?>>
                     <td><a href="<?php echo $value1->articulo_url();?>"><?php echo $value1->referencia;?></a> <?php echo $value1->descripcion;?></td>
                     <td class="text-right"><?php echo $value1->cantidad;?></td>
                     <td class="text-right"><?php echo $fsc->show_precio($value1->pvpunitario, $fsc->albaran->coddivisa);?></td>
                     <td class="text-right"><?php echo $fsc->show_numero($value1->dtopor, 2);?> %</td>
                     <td class="text-right"><?php echo $fsc->show_precio($value1->pvptotal, $fsc->albaran->coddivisa);?></td>
                     <td class="text-right"><?php echo $fsc->show_numero($value1->iva, 2);?> %</td>
                     <td class="text-right recargo"><?php echo $fsc->show_numero($value1->recargo, 2);?> %</td>
                     <td class="text-right irpf"><?php echo $fsc->show_numero($value1->irpf, 2);?> %</td>
                     <td class="text-right"><?php echo $fsc->show_precio($value1->total_iva(), $fsc->albaran->coddivisa);?></td>
                  </tr>
                  <?php } ?>

                  <tr>
                     <td colspan="4"></td>
                     <td class="text-right"><b><?php echo $fsc->show_precio($fsc->albaran->neto, $fsc->albaran->coddivisa);?></b></td>
                     <td class="text-right"><b><?php echo $fsc->show_precio($fsc->albaran->totaliva, $fsc->albaran->coddivisa);?></b></td>
                     <td class="text-right recargo"><b><?php echo $fsc->show_precio($fsc->albaran->totalrecargo, $fsc->albaran->coddivisa);?></b></td>
                     <td class="text-right irpf"><b>-<?php echo $fsc->show_precio($fsc->albaran->totalirpf, $fsc->albaran->coddivisa);?></b></td>
                     <td class="text-right"><b><?php echo $fsc->show_precio($fsc->albaran->total, $fsc->albaran->coddivisa);?></b></td>
                  </tr>
               </table>
               <?php } ?>

            </div>
         </div>
         <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

            <?php if( $value1->type=='tab' ){ ?>

            <div role="tabpanel" class="tab-pane" id="ext_<?php echo $value1->name;?>">
               <iframe src="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>&id=<?php echo $fsc->albaran->idalbaran;?>" width="100%" height="600" frameborder="0"></iframe>
            </div>
            <?php } ?>

         <?php } ?>

      </div>
   </div>
   
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <div class="form-group">
               Observaciones:
               <textarea class="form-control" name="observaciones" rows="3"><?php echo $fsc->albaran->observaciones;?></textarea>
            </div>
         </div>
      </div>
   </div>
</form>

<div class="modal" id="modal_articulos">
   <div class="modal-dialog" style="width: 99%; max-width: 1000px;">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Buscar artículos</h4>
         </div>
         <div class="modal-body">
            <form id="f_buscar_articulos" name="f_buscar_articulos" action="<?php echo $fsc->url();?>" method="post" class="form">
               <input type="hidden" name="codcliente" value="<?php echo $fsc->albaran->codcliente;?>"/>
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
         <ul class="nav nav-tabs" id="nav_articulos" style="display: none;">
            <li id="li_mis_articulos"><a href="#" id="b_mis_articulos">Mi catálogo</a></li>
            <li id="li_kiwimaru"><a href="#" id="b_kiwimaru">Internet</a></li>
            <li id="li_nuevo_articulo"><a href="#" id="b_nuevo_articulo">Nuevo...</a></li>
         </ul>
         <div id="search_results"></div>
         <div id="kiwimaru_results"></div>
         <div id="nuevo_articulo" class="modal-body" style="display: none;">
            <form name="f_nuevo_articulo" action="<?php echo $fsc->url();?>" method="post" class="form">
               <div class="form-group">
                  Referencia:
                  <input class="form-control" type="text" name="referencia" maxlength="18" autocomplete="off"/>
               </div>
               <div class="form-group">
                  Descripción:
                  <input class="form-control" type="text" name="descripcion" autocomplete="off"/>
               </div>
               <div class="form-group col-lg-6 col-md-6 col-sm-6">
                  <a href="<?php echo $fsc->familia->url();?>">Familia</a>:
                  <select name="codfamilia" class="form-control">
                  <?php $loop_var1=$fsc->familia->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <option value="<?php echo $value1->codfamilia;?>"><?php echo $value1->descripcion;?></option>
                  <?php } ?>

                  </select>
               </div>
               <div class="form-group col-lg-6 col-md-6 col-sm-6">
                  <a href="<?php echo $fsc->impuesto->url();?>">IVA</a>:
                  <select name="codimpuesto" class="form-control">
                     <?php $loop_var1=$fsc->impuesto->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <option value="<?php echo $value1->codimpuesto;?>"<?php if( $value1->is_default() ){ ?> selected="selected"<?php } ?>><?php echo $value1->descripcion;?></option>
                     <?php } ?>

                  </select>
               </div>
               <div class="text-right">
                  <button class="btn btn-sm btn-primary" type="submit" onclick="new_articulo();return false;">
                     <span class="glyphicon glyphicon-floppy-disk"></span> &nbsp; Guardar y seleccionar
                  </button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="modal_imprimir_albaran">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Imprimir <?php  echo FS_ALBARAN;?></h4>
         </div>
         <div class="modal-body">
            <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <?php if( $value1->type=='pdf' ){ ?>

               <a href="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>&id=<?php echo $fsc->albaran->idalbaran;?>" target="_blank" class="btn btn-block btn-default">
                  <span class="glyphicon glyphicon-print"></span> &nbsp; <?php echo $value1->text;?>

               </a>
               <?php } ?>

            <?php } ?>

         </div>
      </div>
   </div>
</div>

<form class="form" role="form" name="enviar_email" action="<?php echo $fsc->url();?>" method="post">
   <div class="modal" id="modal_enviar">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">Enviar <?php  echo FS_ALBARAN;?></h4>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  Email del cliente:
                  <input class="form-control" type="text" name="email" value="<?php echo $fsc->cliente_s->email;?>" autocomplete="off"/>
               </div>
               <div class="form-group">
                  Mensaje:
                  <textarea class="form-control" name="mensaje" rows="6">Buenos días, le adjunto su <?php  echo FS_ALBARAN;?> <?php echo $fsc->albaran->codigo;?>.
<?php echo $fsc->empresa->email_firma;?></textarea>
               </div>
            </div>
            <div class="modal-footer">
            <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <?php if( $value1->type=='email' ){ ?>

               <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.action='index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>&id=<?php echo $fsc->albaran->idalbaran;?>';this.form.submit();">
                  <span class="glyphicon glyphicon-send"></span> &nbsp; Enviar <?php echo $value1->text;?>

               </button>
               <?php } ?>

            <?php } ?>

            </div>
         </div>
      </div>
   </div>
</form>

<form action="<?php echo $fsc->ppage->url();?>" method="post">
   <input type="hidden" name="delete" value="<?php echo $fsc->albaran->idalbaran;?>"/>
   <div class="modal fade" id="modal_eliminar">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">¿Realmente desea eliminar este <?php  echo FS_ALBARAN;?>?</h4>
            </div>
            <div class="modal-footer">
               <div class="pull-left">
                  <label>
                     <input type="checkbox" name="stock" value="TRUE" checked="checked"/>
                     Actualizar el stock
                  </label>
               </div>
               <button class="btn btn-sm btn-danger" onclick="this.disabled=true;this.form.submit();">
                  <span class="glyphicon glyphicon-trash"></span> &nbsp; Eliminar
               </button>
            </div>
            <?php if( $fsc->albaran->idfactura ){ ?>

            <div class="alert alert-info">
               Hay una factura asociada que será eliminada junto con este <?php  echo FS_ALBARAN;?>.
            </div>
            <?php } ?>

         </div>
      </div>
   </div>
</form>
<?php }else{ ?>

<div class="text-center">
   <img src="view/img/fuuu_face.png" alt="fuuuuu"/>
</div>
<?php } ?>


<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>