<?php if(!class_exists('raintpl')){exit;}?><?php if( !$fsc->informe['started'] ){ ?>

   <?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>

   
   <form action="<?php echo $fsc->url();?>" method="post" class="form-inline">
      <div class="panel panel-info" style="margin: 5px;">
         <div class="panel-heading">
            <h3 class="panel-title">Opciones</h3>
         </div>
         <div class="panel-body">
            <div class="form-group">
               Comprobar
               <select class="form-control" name="modelo">
                  <option value="todo">Todo</option>
                  <option value="">-------</option>
                  <option value="asiento">Asientos</option>
                  <option value="factura cliente">Facturas de cliente</option>
                  <option value="factura proveedor">Facturas de proveedor</option>
                  <option value="albaran cliente"><span class="text-capitalize"><?php  echo FS_ALBARANES;?></span> de cliente</option>
                  <option value="albaran proveedor"><span class="text-capitalize"><?php  echo FS_ALBARANES;?></span> de proveedor</option>
               </select>
            </div>
            <div class="form-group">
               Hasta el ejercicio
               <select class="form-control" name="ejercicio">
                  <?php $loop_var1=$fsc->ejercicio->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                  <option value="<?php echo $value1->codejercicio;?>"><?php echo $value1->nombre;?></option>
                  <?php } ?>

                  <option value="">---</option>
                  <option value="">Todos</option>
               </select>
            </div>
            <div class="form-group">
               <label>
                  <input type="checkbox" name="duplicados" value="TRUE"/>
                  Detectar duplicados
               </label>
            </div>
         </div>
         <div class="panel-footer">
            <button class="btn btn-sm btn-primary" type="submit" onclick="this.form.submit();">
               <span class="glyphicon glyphicon-eye-open"></span>
               &nbsp; Mostrar
            </button>
         </div>
      </div>
   </form>
   
   <?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>

<?php }elseif( !$fsc->ajax ){ ?>

   <?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>

   
   <script type="text/javascript">
      var show_page = "<?php echo $fsc->informe['show_page'];?>";
      var timeout = false;
      function load_errors(page)
      {
         show_page = page;
         $.ajax({
            type: 'POST',
            url: '<?php echo $fsc->url();?>',
            dataType: 'html',
            data: 'ajax=TRUE&show_page='+show_page,
            success: function(datos) {
               clearTimeout(timeout);
               var re = /<!--(.*?)-->/g;
               var m = re.exec(datos);
               if(m[1] == 'FIN_PROCESO')
               {
                  $("#informe_errores").html(datos);
               }
               else if(m[1] == show_page)
               {
                  $("#informe_errores").html(datos);
                  timeout = setTimeout("load_errors(show_page);", 500);
               }
            }
         });
      }
      $(document).ready(function() {
         timeout = setTimeout("load_errors(show_page);", 500);
      });
   </script>
   
   <div id="informe_errores">
      <div class="alert alert-info" role="alert">Cargando...</div>
   </div>
   
   <?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>

<?php }else{ ?>

   <?php if( $fsc->informe['model']=='fin' ){ ?>

      <!--FIN_PROCESO-->
      <div class="alert alert-info" role="alert">Comprobación finalizada.</div>
   <?php }else{ ?>

      <!--<?php echo $fsc->informe['show_page'];?>-->
      <div class="alert alert-info" role="alert">
         Comprobado hasta <?php echo $fsc->informe['model'];?> <?php echo $fsc->informe['offset'];?>...
         <?php echo $fsc->duration();?>

      </div>
   <?php } ?>

   
   <div class="table-responsive">
      <table class="table table-hover">
         <thead>
            <tr>
               <th class="text-left"></th>
               <th class="text-left">Modelo</th>
               <th class="text-left">Ejercicio</th>
               <th class="text-left">Identificador</th>
               <th class="text-right">Fecha</th>
            </tr>
         </thead>
         <?php $loop_var1=$fsc->errores; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

         <tr>
            <td><?php if( $value1["fix"] ){ ?>Corregido<?php }else{ ?>-<?php } ?></td>
            <td><?php echo $value1["model"];?></td>
            <td><?php echo $value1["ejercicio"];?></td>
            <td><a href="<?php echo $value1["url"];?>"><?php echo $value1["id"];?></a></td>
            <td class="text-right"><?php echo $value1["fecha"];?></td>
         </tr>
         <?php }else{ ?>

         <tr class="bg-warning">
            <td></td>
            <td colspan="4">Nada que mostrar.</td>
         </tr>
         <?php } ?>

      </table>
   </div>
   
   <div style="text-align: center;">
      <ul class="pagination">
      <?php $loop_var1=$fsc->all_pages(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

         <li<?php if( $value1["selected"] ){ ?> class="active"<?php } ?>>
            <a href="<?php echo $fsc->url();?>&show_page=<?php echo $value1["page"];?>"><?php echo $value1["num"];?></a>
         </li>
      <?php } ?>

      </ul>
   </div>
<?php } ?>