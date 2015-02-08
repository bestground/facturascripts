<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<?php if( $fsc->cliente_s ){ ?>

<script type="text/javascript" src="view/js/nueva_venta.js"></script>
<script type="text/javascript">
   fs_nf0 = <?php  echo FS_NF0;?>;
   all_impuestos = <?php echo json_encode($fsc->impuesto->all()); ?>;
   all_series = <?php echo json_encode($fsc->serie->all()); ?>;
   cliente = <?php echo json_encode($fsc->cliente_s); ?>;
   nueva_venta_url = '<?php echo $fsc->url();?>';
   fs_community_url = '<?php  echo FS_COMMUNITY_URL;?>';
   
   $(document).ready(function() {
      usar_serie();
      
      $("#b_lineas").click(function(event) {
         event.preventDefault();
         $("#li_opciones").removeClass('active');
         $("#li_lineas").addClass('active');
         $("#div_opciones").hide();
         $("#div_lineas").show();
      });
      
      $("#b_opciones").click(function(event) {
         event.preventDefault();
         $("#li_lineas").removeClass('active');
         $("#li_opciones").addClass('active');
         $("#div_lineas").hide();
         $("#div_opciones").show();
      });
   });
</script>

<div class="modal" id="modal_articulos">
   <div class="modal-dialog" style="width: 99%; max-width: 1000px;">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Buscar artículos</h4>
         </div>
         <div class="modal-body">
            <form id="f_buscar_articulos" name="f_buscar_articulos" action="<?php echo $fsc->url();?>" method="post" class="form">
               <input type="hidden" name="codcliente" value="<?php echo $fsc->cliente_s->codcliente;?>"/>
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

<form id="f_new_albaran" class="form" name="f_new_albaran" action="<?php echo $fsc->url();?>" method="post">
   <input type="hidden" name="petition_id" value="<?php echo $fsc->random_string();?>"/>
   <input type="hidden" id="numlineas" name="numlineas" value="0"/>
   <input type="hidden" name="cliente" value="<?php echo $fsc->cliente_s->codcliente;?>"/>
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-8 col-md-8 col-sm-8">
            <h1>
               <a href="<?php echo $fsc->cliente_s->url();?>"><?php echo $fsc->cliente_s->nombre;?></a>
            </h1>
         </div>
         <div class="col-lg-2 col-md-2 col-sm-2">
            <div class="form-group">
               Fecha:
               <input type="text" name="fecha" class="form-control datepicker" value="<?php echo $fsc->today();?>" autocomplete="off"/>
            </div>
         </div>
         <div class="col-lg-2 col-md-2 col-sm-2">
            <div class="form-group">
               Hora:
               <input type="text" name="hora" class="form-control" value="<?php echo $fsc->hour();?>" autocomplete="off"/>
            </div>
         </div>
      </div>
   </div>
   
   <ul class="nav nav-tabs" role="tablist">
      <li class="active" id="li_lineas"><a href="#" id="b_lineas">Líneas</a></li>
      <li id="li_opciones"><a href="#" id="b_opciones">Más opciones...</a></li>
   </ul>
   
   <div class="table-responsive" id="div_lineas">
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
<!--               
               <th class="text-right" width="90">Dto. %</th>
               <th class="text-right">Neto</th>
               <th class="text-right" width="115">IVA</th>
               <th class="text-right recargo">RE %</th>
               <th class="text-right irpf">IRPF %</th>
               <th class="text-right" width="90">Dto. %</th>	
-->
				               
               <th class="text-right">Neto Real</th>
            </tr>
         </thead>
         <tbody id="lineas_albaran"></tbody>
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
   </div>
   
   <div class="container-fluid">
      <div class="row" id="div_opciones" style="display: none; padding-top: 20px;">
         <div class="col-lg-3 col-md-3 col-sm-3">
            <div class="form-group">
               <a href="<?php echo $fsc->agente->url();?>">Empleado</a>:
               <select name="codagente" class="form-control">
                  <option value="<?php echo $fsc->agente->codagente;?>"><?php echo $fsc->agente->get_fullname();?></option>
                  <?php if( $fsc->user->admin ){ ?>

                     <option value="<?php echo $fsc->agente->codagente;?>">-----</option>
                     <?php $loop_var1=$fsc->agente->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <option value="<?php echo $value1->codagente;?>"><?php echo $value1->get_fullname();?></option>
                     <?php } ?>

                  <?php } ?>

               </select>
            </div>
         </div>
         <div class="col-lg-3 col-md-3 col-sm-3">
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
         <div class="col-lg-3 col-md-3 col-sm-3">
            <div class="form-group">
               <a href="<?php echo $fsc->serie->url();?>">Serie</a>:
               <select name="serie" class="form-control" id="codserie" onchange="usar_serie();recalcular();">
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
         <div class="col-lg-3 col-md-3 col-sm-3">
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
         <div class="col-lg-3 col-md-3 col-sm-3">
            <div class="form-group">
               Número 2:
               <input class="form-control" type="text" name="numero2" autocomplete="off"/>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-lg-6 col-md-6 col-sm-6">
            <button class="btn btn-sm btn-default" type="button" onclick="window.location.href='<?php echo $fsc->url();?>';">
               <span class="glyphicon glyphicon-refresh"></span> &nbsp; Reiniciar
            </button>
         </div>
         <div class="col-lg-6 col-md-6 col-sm-6 text-right">
            <button class="btn btn-sm btn-primary" type="button" onclick="$('#modal_guardar').modal('show');">
               <span class="glyphicon glyphicon-floppy-disk"></span> &nbsp; Guardar...
            </button>
         </div>
      </div>
      <div class="row">
         <div class="col-lg-12" style="margin-top: 20px;">
            <div class="form-group">
               Observaciones:
               <textarea class="form-control" name="observaciones" rows="3"></textarea>
            </div>
         </div>
      </div>
   </div>
   
   <div class="modal fade" id="modal_guardar">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">Guardar como...</h4>
            </div>
            <div class="modal-body">
               <!--
               <?php $loop_var1=$fsc->tipos_a_guardar(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <div class="radio">
                  <label>
                     <input type="radio" name="tipo" value="<?php echo $value1['tipo'];?>"<?php if( $value1['tipo']==$fsc->tipo ){ ?> checked="checked"<?php } ?>/>
                     <?php echo $value1['nombre'];?>

                  </label>
               </div>
               <?php } ?>

               -->
               <div class="radio">
               		<label>
               		<input type="radio" name="tipo" value="albaran" checked="checked"> Factura de Cliente
               		</label>
               </div>
               
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
            <div class="modal-footer">
               <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">
                  <span class="glyphicon glyphicon-floppy-disk"></span> &nbsp; Guardar
               </button>
            </div>
         </div>
      </div>
   </div>
</form>
<?php }elseif( !$fsc->user->get_agente() ){ ?>

<div class="well well-lg">
   <h1>No puedes entrar aquí</h1>
   <p>
      No tienes un emleado asociado a tu <a href="<?php echo $fsc->user->url();?>">usuario</a>.
      Habla con el administrador para que te asigne un empleado.
   </p>
   <p>Si crees que es un error de FacturaScripts, haz clic en el botón de ayuda, arriba a la derecha, e infórmanos del error.</p>
</div>
<?php }else{ ?>

<script type="text/javascript">
   $(document).ready(function() {
      $("#modal_cliente").modal('show');
      document.f_nueva_venta.ac_cliente.focus();
      $("#ac_cliente").autocomplete({
         serviceUrl: '<?php echo $fsc->url();?>',
         paramName: 'buscar_cliente',
         onSelect: function (suggestion) {
            if(suggestion)
            {
               if(document.f_nueva_venta.cliente.value != suggestion.data)
               {
                  document.f_nueva_venta.cliente.value = suggestion.data;
               }
            }
         }
      });
   });
</script>

<form name="f_nueva_venta" class="form" action="<?php echo $fsc->url();?>" method="post">
   <input type="hidden" name="cliente"/>
   <div class="modal" id="modal_cliente">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">Selecciona el cliente</h4>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  <input class="form-control" type="text" name="ac_cliente" id="ac_cliente" placeholder="Buscar" autocomplete="off"/>
                  <p class="help-block"><a href="<?php echo $fsc->cliente->url();?>#nuevo" target="_blank">Nuevo cliente</a>.</p>
               </div>
            </div>
            <div class="modal-footer">
               <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">
                  <span class="glyphicon glyphicon-play"></span> &nbsp; Seleccionar
               </button>
            </div>
         </div>
      </div>
   </div>
</form>

<div class="container" style="margin-top: 10px; margin-bottom: 100px;">
   <div class="row">
      <div class="col-lg-12">
         <h1>Paso 1:</h1>
         <p>Selecciona el cliente al que quieres realizar la venta.</p>
         <a href="#" class="btn btn-block btn-default" data-toggle="modal" data-target="#modal_cliente">Selecciona el cliente</a>
         <h2>Paso 2:</h2>
         <p>Introduce línea a línea todos los artículos de la venta.</p>
         <h2>Paso 3:</h2>
         <p>Pulsa el botón guardar.</p>
      </div>
   </div>
</div>
<?php } ?>


<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>