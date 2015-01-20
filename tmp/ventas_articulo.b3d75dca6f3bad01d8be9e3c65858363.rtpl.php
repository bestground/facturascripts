<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<?php if( $fsc->articulo ){ ?>

<script type="text/javascript">
<?php if( $GLOBALS['config2']['margin_method'] == 'CST' ){ ?> 
   function margencalc(icst, ipvp)
   {
      if(icst == 0)
      {
         return '-';
      }
      else
      {
         return (ipvp-icst)/icst;
      }
   }
   function pvpcalc(icst, imc)
   {
      return icst*(1+imc);
   }
<?php }else{ ?> 
   function margencalc(icst, ipvp)
   {
      if(ipvp == 0)
      {
         return '-';
      }
      else
      {
         return (ipvp-icst)/ipvp;
      }
   }
   function pvpcalc(icst, imv)
   {
      if( (1-imv) == 0)
      {
         return '-';
      }
      else
      {
         return icst/(1-imv);
      }
   }
<?php } ?>

   function recalcular()
   {
      var coste = parseFloat( $("#coste").val() );
      var iva = parseFloat( $("#iva").val() );
      var pvp = parseFloat( $("#pvp").val() );
      var npvp = 0;
      var dto = 0;
      for(var i=0; i<100; i++)
      {
         if( $("#dto_"+i) )
         {
            dto = parseFloat( $("#dto_"+i).val() );
            if( isNaN(dto) )
               dto = 0;
            
            npvp = pvp * (100 - dto)/100;
            $("#pvp_"+i).val( npvp );
            $("#pvpi_"+i).val( pvp * (100 - dto)/100 * (100 + iva)/100 );
            $("#margen_"+i).val( margencalc( coste, npvp ) * 100  );
         }
      }
   }
   function cambiar_pvp()
   {
      var coste = parseFloat( $("#coste").val() );
      var iva = parseFloat( $("#iva").val() );
      var pvp = parseFloat( $("#pvp").val() );
      $("#pvpi").val( pvp * (100 + iva)/100 );
      
      var margen = 0;
      if(pvp != 0)
      {
         margen = margencalc(coste, pvp) * 100;
      }
      
      if( isNaN(margen) )
         margen = 0;
      
      $("#margen").val(margen);
      
      recalcular();
   }
   function cambiar_margen()
   {
      var margen = parseFloat( $("#margen").val() );
      var coste = parseFloat( $("#coste").val() );
      var iva = parseFloat( $("#iva").val() );
      var pvp = pvpcalc(coste, margen/100.0);
      $("#pvp").val( pvp );
      $("#pvpi").val( pvp * (100 + iva)/100 );
      
      recalcular();
   }
   function cambiar_pvpi()
   {
      var coste = parseFloat( $("#coste").val() );
      var iva = parseFloat( $("#iva").val() );
      var pvpi = parseFloat( $("#pvpi").val() );
      $("#pvp").val( (100 * pvpi) / (100 + iva) );
      var pvp = parseFloat( $("#pvp").val() );
      $("#margen").val( margencalc( coste, pvp ) * 100 );
      recalcular();
   }
   function ajustar_dto()
   {
      var coste = parseFloat( $("#coste").val() );
      var pvp = parseFloat( $("#pvp").val() );
      var iva = parseFloat( $("#iva").val() );
      var npvp = 0;
      var dto = 0;
      for(var i=0; i<100; i++)
      {
         if( $("#dto_"+i) )
         {
            dto = parseFloat( $("#dto_"+i).val() );
            npvp = pvp * (100 - dto)/100;
            $("#pvp_"+i).val( npvp );
            $("#pvpi_"+i).val( npvp * (100 + iva)/100 );
            $("#margen_"+i).val( ( margencalc(coste, npvp) ) * 100  );
         }
      }
   }
   function ajustar_margen()
   {
      var coste = parseFloat( $("#coste").val() );
      var pvp = parseFloat( $("#pvp").val() );
      var iva = parseFloat( $("#iva").val() );
      var margen = 0;
      var npvp = 0;
      for(var i=0; i<3; i++)
      {
         if( $("#margen_"+i) )
         {
            margen = parseFloat( $("#margen_"+i).val() );
            npvp = parseFloat( pvpcalc(coste, margen/100.0) );
            $("#pvp_"+i).val( npvp );
            $("#pvpi_"+i).val( npvp * (100 + iva)/100 );
            $("#dto_"+i).val( 100 * ( pvp - npvp ) / pvp );
         }
      }
   }
   function ajustar_pvp()
   {
      var coste = parseFloat( $("#coste").val() );
      var pvp = parseFloat( $("#pvp").val() );
      var iva = parseFloat( $("#iva").val() );
      var npvp = 0;
      for(var i=0; i<100; i++)
      {
         if( $("#pvp_"+i) )
         {
            npvp = parseFloat( $("#pvp_"+i).val() );
            
            if(pvp == 0)
            {
               $("#pvp").val(npvp);
               cambiar_pvp();
               pvp = parseFloat( $("#pvp").val() );
               iva = parseFloat( $("#iva").val() );
            }
            
            $("#dto_"+i).val( 100 - (100*npvp)/pvp );
            $("#pvpi_"+i).val( npvp * (100 + iva)/100 );
            $("#margen_"+i).val( margencalc(coste, npvp) * 100  );
         }
      }
   }
   function ajustar_pvpi()
   {
      var coste = parseFloat( $("#coste").val() );
      var pvp = parseFloat( $("#pvp").val() );
      var iva = parseFloat( $("#iva").val() );
      var npvp = 0;
      var npvpi = 0;
      for(var i=0; i<100; i++)
      {
         if( $("#pvp_"+i) )
         {
            npvpi = parseFloat( $("#pvpi_"+i).val() );
            
            if(parseFloat($("#pvpi").val()) == 0)
            {
               $("#pvpi").val(npvpi);
               cambiar_pvpi();
               pvp = parseFloat( $("#pvp").val() );
               iva = parseFloat( $("#iva").val() );
            }
            
            npvp = (100*npvpi)/(100+iva);
            $("#pvp_"+i).val( npvp );
            $("#dto_"+i).val( 100 - (100*npvp)/pvp );
            $("#margen_"+i).val( margencalc(coste, npvp) * 100  );
         }
      }
   }
   function show_div(name)
   {
      $("#div_generales").hide();
      $("#div_precios").hide();
      $("#div_stock").hide();
      $("#div_equivalentes").hide();
      $("#b_generales").removeClass('active');
      $("#b_precios").removeClass('active');
      $("#b_stock").removeClass('active');
      $("#b_equivalentes").removeClass('active');
      
      if(name == 'precios')
      {
         $("#div_precios").show();
         $("#b_precios").addClass('active');
         cambiar_pvp();
      }
      else if(name == 'stock')
      {
         $("#div_stock").show();
         $("#b_stock").addClass('active');
      }
      else if(name == 'equivalentes')
      {
         $("#div_equivalentes").show();
         $("#b_equivalentes").addClass('active');
      }
      else
      {
         $("#div_generales").show();
         $("#b_generales").addClass('active');
      }
   }
   $(document).ready(function() {
      show_div(window.location.hash.substring(1));
      $("#b_generales").click(function(event) {
         event.preventDefault();
         show_div('generales');
      });
      $("#b_precios").click(function(event) {
         event.preventDefault();
         show_div('precios');
      });
      $("#b_stock").click(function(event) {
         event.preventDefault();
         show_div('stock');
      });
      $("#b_equivalentes").click(function(event) {
         event.preventDefault();
         show_div('equivalentes');
      });
      $("#b_eliminar_articulo").click(function(event) {
         event.preventDefault();
         if( confirm("¿Estas seguro de que deseas eliminar este articulo?") )
            window.location.href = "<?php echo $fsc->ppage->url();?>&delete=<?php echo urlencode($fsc->articulo->referencia); ?>";
      });
      $("#b_imagen").click(function(event) {
         event.preventDefault();
         $("#modal_articulo_imagen").modal('show');
      });
   });
</script>

<div class="container-fluid" style="margin-top: 10px; margin-bottom: 10px;">
   <div class="row">
      <div class="col-sm-10">
         <a href="<?php echo $fsc->url();?>" class="btn btn-sm btn-default" title="Recargar la página">
            <span class="glyphicon glyphicon-refresh"></span>
         </a>
         <a href="<?php echo $fsc->ppage->url();?>" class="btn btn-sm btn-default">
            <span class="glyphicon glyphicon-arrow-left"></span> &nbsp; Todos los artículos
         </a>
         <a href="#" id="b_imagen" class="btn btn-sm btn-default">
            <span class="glyphicon glyphicon-picture"></span> &nbsp; Imagen
         </a>
      </div>
      <div class="col-sm-2 text-right">
         <a href="#" id="b_eliminar_articulo" class="btn btn-sm btn-danger">
            <span class="glyphicon glyphicon-trash"></span> &nbsp; Eliminar
         </a>
      </div>
   </div>
</div>

<ul class="nav nav-tabs" role="tablist">
   <li id="b_generales"><a href="#">Datos generales</a></li>
   <li id="b_precios"><a href="#precios">Precios</a></li>
   <li id="b_stock"><a href="#stocks">Stock</a></li>
   <?php if( $fsc->equivalentes ){ ?>

   <li id="b_equivalentes"><a href="#equivalentes">Equivalentes</a></li>
   <?php } ?>

   <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown">
         Buscar en... <span class="caret"></span>
      </a>
      <ul class="dropdown-menu" role="menu">
      <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

         <?php if( $value1->type=='button' ){ ?>

         <li>
            <a href="index.php?page=<?php echo $value1->from;?>&ref=<?php echo urlencode($fsc->articulo->referencia); ?>">
               <span class="glyphicon glyphicon-list"></span> &nbsp; <?php echo $value1->text;?>

            </a>
         </li>
         <?php } ?>

      <?php } ?>

      </ul>
   </li>
</ul>

<form action="<?php echo $fsc->url();?>" method="post" class="post">
   <input type="hidden" name="referencia" value="<?php echo $fsc->articulo->referencia;?>"/>
   <div id="div_generales" class="container-fluid">
      <div class="row" style="padding-top: 10px;">
         <div class="form-group col-lg-3 col-md-3 col-sm-3">
            Referencia:
            <input class="form-control" type="text" name="nreferencia" value="<?php echo $fsc->articulo->referencia;?>" maxlength="18" autocomplete="off"/>
         </div>
         <div class="form-group col-lg-6 col-md-6 col-sm-6">
            Descripción:
            <input class="form-control" type="text" name="descripcion" value="<?php echo $fsc->articulo->descripcion;?>" autocomplete="off"/>
         </div>
         <div class="form-group col-lg-3 col-md-3 col-sm-3">
            <a href="<?php echo $fsc->familia->url();?>">Familia</a>:
            <select class="form-control" name="codfamilia">
            <?php $loop_var1=$fsc->familia->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <?php if( $value1->codfamilia===$fsc->articulo->codfamilia ){ ?>

               <option value="<?php echo $value1->codfamilia;?>" selected="selected"><?php echo $value1->descripcion;?></option>
               <?php }else{ ?>

               <option value="<?php echo $value1->codfamilia;?>"><?php echo $value1->descripcion;?></option>
               <?php } ?>

            <?php } ?>

            </select>
         </div>
         <div class="form-group col-lg-4 col-md-4 col-sm-4">
            Código de barras:
            <input class="form-control" type="text" name="codbarras" value="<?php echo $fsc->articulo->codbarras;?>" autocomplete="off"/>
         </div>
         
         <!-- CAMPOS NUEVOS -->
		<div class="form-group col-lg-4 col-md-4 col-sm-4">
           	<span style="color:#ff0000; ">Due&ntildeo:</span>
			<input class="form-control" type="text" name="dueno" value="<?php echo $fsc->articulo->dueno;?>" autocomplete="off"/>
        </div>         
        
		<div class="form-group col-lg-4 col-md-4 col-sm-4">
            <span style="color:#ff0000; "> <?php  echo FS_CIFNIF;?>:</span>
            <input class="form-control"  type="text" name="tipodni" value="<?php echo $fsc->articulo->tipodni;?>" autocomplete="off"/>
        </div>
        
		<div class="form-group col-lg-4 col-md-4 col-sm-4">
            <span style="color:#ff0000; "> Teléfono :</span>
            <input class="form-control" type="text" name="telefonodueno" value="<?php echo $fsc->articulo->telefonodueno;?>" autocomplete="off"/>
        </div>
		
		<div class="form-group col-lg-4 col-md-4 col-sm-4">
		   <span style="color:#ff0000; ">Fecha de entrada:</span>
			<input class="form-control datepicker" style="width:44%" type="text" name="fentrada" value="<?php echo $fsc->articulo->fentrada;?>" autocomplete="off"/>
        </div>        
 
		<div class="form-group col-lg-4 col-md-4 col-sm-4">
			<span style="color:#ff0000; ">Fecha de salida:</span>
			<input class="form-control datepicker" style="width:44%" type="text" name="fsalida" value="<?php echo $fsc->articulo->fsalida;?>" autocomplete="off"/>
        </div>
        <!-- FIN CAMPOS NUEVOS -->   
                    
         <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="checkbox-inline">
               <label>
                  <input type="checkbox" name="bloqueado" value="TRUE"<?php if( $fsc->articulo->bloqueado ){ ?> checked="checked"<?php } ?>/>
                  Bloqueado
               </label>
            </div>
            <div class="checkbox-inline">
               <label>
                  <input type="checkbox" name="secompra" value="TRUE"<?php if( $fsc->articulo->secompra ){ ?> checked="checked"<?php } ?>/>
                  Se compra
               </label>
            </div>
            <div class="checkbox-inline">
               <label>
                  <input type="checkbox" name="sevende" value="TRUE"<?php if( $fsc->articulo->sevende ){ ?> checked="checked"<?php } ?>/>
                  Se vende
               </label>
            </div>
            <div class="checkbox-inline">
               <label>
                  <input type="checkbox" name="publico" value="TRUE"<?php if( $fsc->articulo->publico ){ ?> checked="checked"<?php } ?>/>
                  Público
               </label>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="form-group col-lg-6 col-md-6 col-sm-6">
            Código de equivalencia:
            <input class="form-control" type="text" name="equivalencia" value="<?php echo $fsc->articulo->equivalencia;?>" autocomplete="off"/>
            <p class="help-block">Dos o más artículos son equivalentes si tienen el mismo código de equivalencia.</p>
         </div>
         <div class="form-group col-lg-6 col-md-6 col-sm-6">
            <label>
               <input type="checkbox" name="destacado" value="TRUE"<?php if( $fsc->articulo->destacado ){ ?> checked="checked"<?php } ?>/>
               Destacar frente a productos equivalentes
            </label>
         </div>
      </div>
      <div class="row">
         <div class="form-group col-lg-3 col-md-3 col-sm-3">
            Stock:
            <input class="form-control" type="text" name="stockfis" value="<?php echo $fsc->articulo->stockfis;?>" disabled="disabled"/>
         </div>
         <div class="form-group col-lg-3 col-md-3 col-sm-3">
            Stock mínimo:
            <input class="form-control" type="number" name="stockmin" value="<?php echo $fsc->articulo->stockmin;?>" autocomplete="off"/>
         </div>
         <div class="form-group col-lg-3 col-md-3 col-sm-3">
            Stock máximo:
            <input class="form-control" type="number" name="stockmax" value="<?php echo $fsc->articulo->stockmax;?>" autocomplete="off"/>
         </div>
         <div class="form-group col-lg-3 col-md-3 col-sm-3">
            <label>
               <input type="checkbox" name="controlstock" value="TRUE"<?php if( $fsc->articulo->controlstock ){ ?> checked="checked"<?php } ?>/>
               Permitir ventas sin stock
            </label>
         </div>
         <div class="form-group col-lg-10 col-md-10 col-sm-10">
            Observaciones:
            <textarea class="form-control" name="observaciones" rows="3"><?php echo $fsc->articulo->observaciones;?></textarea>
         </div>
         <div class="col-lg-2 col-md-2 col-sm-2 text-right">
            <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">
               <span class="glyphicon glyphicon-floppy-disk"></span> &nbsp; Guardar
            </button>
         </div>
      </div>
   </div>
</form>

<form action="<?php echo $fsc->url();?>#precios" method="post" class="form">
   <input type="hidden" name="referencia" value="<?php echo $fsc->articulo->referencia;?>"/>
   <input type="hidden" id="iva" name="iva" value="<?php echo $fsc->articulo->get_iva();?>"/>
   <div id="div_precios">
      <div class="container-fluid" style="margin-top: 10px;">
         <div class="row">
            <div class="col-md-4">
               <div class="form-group">
                  PVP:
                  <input type="text" class="form-control" id="pvp" name="pvp" value="<?php echo $fsc->articulo->pvp;?>" autocomplete="off" onkeyup="cambiar_pvp()" onclick="this.select()"/>
                  <p class="help-block">Último cambio de precio: <?php echo $fsc->articulo->factualizado;?></p>
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <a href="<?php echo $fsc->impuesto->url();?>">IVA</a>:
                  <select class="form-control" name="codimpuesto">
                  <?php $loop_var1=$fsc->impuesto->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <?php if( $value1->codimpuesto==$fsc->articulo->codimpuesto ){ ?>

                     <option value="<?php echo $value1->codimpuesto;?>" selected="selected"><?php echo $value1->descripcion;?></option>
                     <?php }else{ ?>

                     <option value="<?php echo $value1->codimpuesto;?>"><?php echo $value1->descripcion;?></option>
                     <?php } ?>

                  <?php } ?>

                  </select>
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  PVP+IVA:
                  <input type="text" class="form-control" id="pvpi" name="pvpiva" value="<?php echo $fsc->articulo->pvp_iva();?>" autocomplete="off" onkeyup="cambiar_pvpi()" onclick="this.select()"/>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-4">
               <div class="form-group">
                  Precio de Coste:
                  <?php if( $fsc->articulo->secompra AND $GLOBALS['config2']['cost_is_average'] ){ ?>

                  <input type="text" name="coste" id="coste" class="form-control" value="<?php echo $fsc->articulo->preciocoste();?>" disabled="disabled">
                  <?php }else{ ?>

                  <input type="text" name="preciocoste" id="coste" class="form-control" value="<?php echo $fsc->articulo->preciocoste();?>">
                  <?php } ?>

                  <p class="help-block">
                     Puede cambiar la configuración de precio de coste desde la <a href="index.php?page=admin_config2">configuración avanzada</a>.
                  </p>
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  Margen de ganancia:
                  <input type="text" class="form-control" id="margen" name="margen" value="0" autocomplete="off" onkeyup="cambiar_margen()" onclick="this.select()"/>
               </div>
            </div>
         </div>
      </div>
      
      <div class="table-responsive">
         <table class="table table-hover">
            <thead>
               <tr>
                  <th class="text-left">Tarifa</th>
                  <th class="text-right">Dto (%)</th>
                  <th class="text-right">
                     <?php if( $GLOBALS['config2']['margin_method'] == 'CST' ){ ?>

                     Margen (% sobre Coste)
                     <?php }else{ ?>

                     Margen (% de Ventas)
                     <?php } ?>

                  </th>
                  <th class="text-right">PVP</th>
                  <th class="text-right">PVP+IVA</th>
               </tr>
            </thead>
            <?php $loop_var1=$fsc->articulo->get_tarifas(TRUE); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

            <tr>
               <td>
                  <div class="form-control"><a href="<?php echo $value1->url();?>"><?php echo $value1->nombre;?></a></div>
               </td>
               <td>
                  <input type="hidden" name="id_<?php echo $counter1;?>" value="<?php echo $value1->id;?>"/>
                  <input type="hidden" name="codtarifa_<?php echo $counter1;?>" value="<?php echo $value1->codtarifa;?>"/>
                  <input type="number" step="any" class="form-control text-right" id="dto_<?php echo $counter1;?>" name="dto_<?php echo $counter1;?>" value="<?php echo $value1->descuento;?>" autocomplete="off" onchange="ajustar_dto()" onkeyup="ajustar_dto()" onclick="this.select()"/>
               </td>
               <td>
                  <input type="number" step="any" class="form-control text-right" id="margen_<?php echo $counter1;?>" name="margen_<?php echo $counter1;?>" value="" autocomplete="off" onchange="ajustar_margen()" onkeyup="ajustar_margen()" onclick="this.select()"/>
               </td>
               <td>
                  <input type="number" step="any" class="form-control text-right" id="pvp_<?php echo $counter1;?>" name="pvp_<?php echo $counter1;?>" value="<?php echo $value1->pvp();?>" autocomplete="off" onchange="ajustar_pvp()" onkeyup="ajustar_pvp()" onclick="this.select()"/>
               </td>
               <td>
                  <input type="number" step="any" class="form-control text-right" id="pvpi_<?php echo $counter1;?>" name="pvpiva_<?php echo $counter1;?>" value="<?php echo $value1->pvp_iva();?>" autocomplete="off" onchange="ajustar_pvpi()" onkeyup="ajustar_pvpi()" onclick="this.select()"/>
               </td>
            </tr>
            <?php } ?>

            <tr>
               <td colspan="6" class="text-center">
                  <a class="btn btn-sm btn-block btn-success" href="<?php echo $fsc->ppage->url();?>#tarifas">Nueva tarifa</a>
               </td>          
            </tr>
         </table>
      </div>
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12 text-right">
               <br />
               <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">
                  <span class="glyphicon glyphicon-floppy-disk"></span> &nbsp; Guardar
               </button>
            </div>
         </div>
      </div>
   </div>
</form>

<div id="div_stock">
   <div class="table-responsive">
      <table class="table table-hover">
         <thead>
            <tr>
               <th class="text-left">Almacén</th>
               <th class="text-right">Cantidad</th>
               <th class="text-right">Reservada</th>
               <th class="text-right">Disponible</th>
               <th class="text-right">Pendiente de recibir</th>
               <th class="text-right">Acción</th>
            </tr>
         </thead>
         <?php $loop_var1=$fsc->stocks; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

         <tr>
            <form action="<?php echo $fsc->url();?>#stock" method="post" class="form">
               <input type="hidden" name="idstock" value="<?php echo $value1->idstock;?>"/>
               <input type="hidden" name="almacen" value="<?php echo $value1->codalmacen;?>"/>
               <input type="hidden" name="referencia" value="<?php echo $fsc->articulo->referencia;?>"/>
               <td><div class="form-control"><?php echo $value1->codalmacen;?> <?php echo $value1->nombre;?></div></td>
               <td>
                  <input type="number" step="any" class="form-control text-right" name="cantidad" value="<?php echo $value1->cantidad;?>" autocomplete="off"/>
               </td>
               <td><div class="form-control text-right"><?php echo $value1->reservada;?></div></td>
               <td><div class="form-control text-right"><?php echo $value1->disponible;?></div></td>
               <td><div class="form-control text-right"><?php echo $value1->pterecibir;?></div></td>
               <td class="text-right">
                  <button class="btn btn-sm btn-primary" type="submit" title="Guardar" onclick="this.disabled=true;this.form.submit();">
                     <span class="glyphicon glyphicon-floppy-disk"></span>
                  </button>
               </td>
            </form>
         </tr>
         <?php } ?>

         <?php if( $fsc->nuevos_almacenes ){ ?>

         <tr class="bg-info">
            <form action="<?php echo $fsc->url();?>#stock" method="post" class="form">
               <input type="hidden" name="referencia" value="<?php echo $fsc->articulo->referencia;?>"/>
               <td>
                  <select class="form-control" name="almacen">
                     <?php $loop_var1=$fsc->nuevos_almacenes; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <option value="<?php echo $value1->codalmacen;?>"><?php echo $value1->nombre;?></option>
                     <?php } ?>

                  </select>
               </td>
               <td><input class="form-control text-right" type="number" step="any" name="cantidad" value="1" autocomplete="off"/></td>
               <td><div class="form-control text-right">0</div></td>
               <td><div class="form-control text-right">0</div></td>
               <td><div class="form-control text-right">0</div></td>
               <td class="text-right">
                  <button class="btn btn-sm btn-primary" type="submit" title="Guardar" onclick="this.disabled=true;this.form.submit();">
                     <span class="glyphicon glyphicon-floppy-disk"></span>
                  </button>
               </td>
            </form>
         </tr>
         <?php } ?>

      </table>
   </div>
</div>

<div id="div_equivalentes">
   <?php if( $fsc->equivalentes ){ ?>

   <div class="table-responsive">
      <table class="table table-hover">
         <thead>
            <tr>
               <th class="text-left">Artículo</th>
               <th class="text-right">PVP+IVA</th>
               <th class="text-right">Stock</th>
            </tr>
         </thead>
         <?php $loop_var1=$fsc->equivalentes; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

         <tr>
            <td><a href="<?php echo $value1->url();?>"><?php echo $value1->referencia;?></a></td>
            <td class="text-right"><?php echo $fsc->show_precio($value1->pvp_iva());?></td>
            <td class="text-right"><?php echo $value1->stockfis;?></td>
         </tr>
         <?php } ?>

      </table>
   </div>
   <?php }else{ ?>

   <div class="alert alert-warning">No hay artículos equivalentes.</div>
   <?php } ?>

</div>

<form action="<?php echo $fsc->url();?>" enctype="multipart/form-data" method="post" class="form">
   <input type="hidden" name="referencia" value="<?php echo $fsc->articulo->referencia;?>"/>
   <input type="hidden" name="imagen" value="TRUE"/>
   <div class="modal fade" id="modal_articulo_imagen">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">Imagen</h4>
            </div>
            <div class="modal-body">
               <?php if( $fsc->articulo->imagen_url() ){ ?>

               <div class="thumbnail">
                  <img src="<?php echo $fsc->articulo->imagen_url();?>" alt="<?php echo $fsc->articulo->referencia;?>"/>
               </div>
               <?php }else{ ?>

               <div class="form-group">
                  Selecciona una imagen en formato PNG de tamaño inferior a 1MB.<br/>
                  <input type="file" name="fimagen" accept="image/gif, image/jpeg, image/png"/>
               </div>
               <?php } ?>

            </div>
            <div class="modal-footer">
               <?php if( $fsc->articulo->imagen_url() ){ ?>

               <a class="btn btn-sm btn-danger" href="<?php echo $fsc->url();?>&delete_img=TRUE">
                  <span class="glyphicon glyphicon-trash"></span> &nbsp; Eliminar
               </a>
               <?php }else{ ?>

               <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">
                  <span class="glyphicon glyphicon-floppy-disk"></span> &nbsp; Guardar
               </button>
               <?php } ?>

            </div>
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