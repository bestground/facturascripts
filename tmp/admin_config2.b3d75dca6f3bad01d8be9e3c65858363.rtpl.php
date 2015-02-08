<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<form class="form" action="<?php echo $fsc->url();?>" method="post">
   <ul class="nav nav-tabs" role="tablist">
      <li class="active"><a href="#home" role="tab" data-toggle="tab">General</a></li>
      <li><a href="#beta" role="tab" data-toggle="tab">Cálculo de precios</a></li>
   </ul>
   
   <div class="tab-content">
      <div class="tab-pane active" id="home">
         <div class="container-fluid" style="margin-top: 10px;">
            <div class="row">
               <div class="col-lg-3 col-md-3 col-sm-4">
                  <div class="form-group">
                     Zona horaria:
                     <select class="form-control" name="zona_horaria">
                     <?php $loop_var1=$fsc->get_timezone_list(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <?php if( isset($GLOBALS['config2']['zona_horaria']) ){ ?>

                        <option value="<?php echo $value1['zone'];?>"<?php if( $value1['zone']==$GLOBALS['config2']['zona_horaria'] ){ ?> selected="selected"<?php } ?>>
                           <?php echo $value1['diff_from_GMT'];?> - <?php echo $value1['zone'];?>

                        </option>
                        <?php }else{ ?>

                        <option value="<?php echo $value1['zone'];?>"><?php echo $value1['diff_from_GMT'];?> - <?php echo $value1['zone'];?></option>
                        <?php } ?>

                     <?php } ?>

                     </select>
                  </div>
               </div>
               <div class="col-lg-3 col-md-3 col-sm-4">
                  <div class="form-group">
                      Nº de la primera factura de venta:
                     <input class="form-control" type="number" name="nfactura_cli" value="<?php echo $GLOBALS['config2']['nfactura_cli'];?>"/>
                  </div>
               </div>
            </div>
            
            <div class="row">
               <div class="col-lg-12">
                  <h2>Traducciones:</h2>
               </div>
            </div>
            <div class="row">
               <?php $loop_var1=$fsc->claves(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <div class="col-lg-2 col-md-2 col-sm-3">
                  <div class="form-group">
                     <span class="text-capitalize"><?php echo $value1['nombre'];?>:</span>
                     <input class="form-control" type="text" name="<?php echo $value1['nombre'];?>" value="<?php echo $value1['valor'];?>"/>
                  </div>
               </div>
               <?php } ?>      
            </div>
         </div>
      </div>
      <div class="tab-pane" id="beta">
         <div class="container-fluid" style="margin-top: 10px;">
            <div class="row">
               <div class="col-lg-3">
                  <div class="form-group">
                     Aplicar el margen:
                     <select name="margin_method" class="form-control">
                        <option value="PVP"<?php if( $GLOBALS['config2']['margin_method']=='PVP' ){ ?> selected='selected'<?php } ?>>sobre el precio de venta</option>
                        <option value="CST"<?php if( $GLOBALS['config2']['margin_method']=='CST' ){ ?> selected='selected'<?php } ?>>sobre el precio de coste</option>
                     </select>
                  </div>
               </div>
               <div class="col-lg-3">
                  <div class="form-group">
                     Precio de coste:
                     <select name="cost_is_average" class="form-control">
                        <option value="1"<?php if( $GLOBALS['config2']['cost_is_average']=='1' ){ ?> selected='selected'<?php } ?>>Calculado</option>
                        <option value="0"<?php if( $GLOBALS['config2']['cost_is_average']=='0' ){ ?> selected='selected'<?php } ?>>Editable</option>
                     </select>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="container-fluid" style="margin-top: 20px;">
      <div class="row">
         <div class="col-lg-6 col-md-6 col-sm-6">
            <button class="btn btn-sm btn-danger" type="button" onclick="window.location.href='<?php echo $fsc->url();?>&reset=TRUE'">
               <span class="glyphicon glyphicon-trash"></span>
               &nbsp; Reiniciar
            </button>
         </div>
         <div class="col-lg-6 col-md-6 col-sm-6 text-right">
            <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">
               <span class="glyphicon glyphicon-floppy-disk"></span>
               &nbsp; Guardar
            </button>
         </div>
      </div>
   </div>
</form>

<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>