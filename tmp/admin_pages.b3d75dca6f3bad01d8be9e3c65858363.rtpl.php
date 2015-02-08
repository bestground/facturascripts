<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<?php if( $fsc->first_time ){ ?>

<div class="jumbotron">
  <h1>¡Bienvenido a FacturaScripts!</h1>
  <p>
     FacturaScripts tiene un montón de funciones, agrupadas en páginas. Lo mejor
     es que lo actives todo, lo pruebes, y si hay algo que no necesitas y no quieres
     que moleste, simplemente lo desactivas. Recuerda que siempre puedes volver aquí
     desde <b>Admin</b> &gt; <b>Páginas</b>.
  </p>
  <p>
     Y si quieres más, recuerda que tienes los
     <a href="index.php?page=admin_plugins" target="_blank">plugins</a> ;-)
  </p>
  <a href="#" class="btn btn-sm btn-info" onclick="fs_marcar_todo();f_enable_pages.submit();">
     <span class="glyphicon glyphicon-check"></span> &nbsp; Activar todo
  </a>
</div>
<?php } ?>


<script type="text/javascript">
   function fs_marcar_todo()
   {
      $('#f_enable_pages input:checkbox').prop('checked', true);
   }
   function fs_marcar_nada()
   {
      $('#f_enable_pages input:checkbox').prop('checked', false);
   }
</script>

<form id="f_enable_pages" action="<?php echo $fsc->url();?>" method="post" class="form">
   <input type="hidden" name="modpages" value="TRUE"/>
   <div class="container-fluid" style="margin-top: 10px; margin-bottom: 20px;">
      <div class="row">
         <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="btn-group">
               <button class="btn btn-sm btn-default" type="button" onclick="fs_marcar_todo()" title="Marcar todo">
                  <span class="glyphicon glyphicon-check"></span>
               </button>
               <button class="btn btn-sm btn-default" type="button" onclick="fs_marcar_nada()" title="Desmarcar todo">
                  <span class="glyphicon glyphicon-unchecked"></span>
               </button>
            </div>
            
            <a href="index.php?page=admin_plugins" class="btn btn-sm btn-default">
               <span class="glyphicon glyphicon-list-alt"></span> &nbsp; Plugins
            </a>
            
            <a class="btn btn-sm btn-default" href="<?php echo $fsc->url();?>" title="recargar la página">
               <span class="glyphicon glyphicon-refresh"></span>
            </a>
         </div>
         <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right">
            <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">
               <span class="glyphicon glyphicon-floppy-disk"></span> &nbsp; Guardar
            </button>
         </div>
      </div>
   </div>
   
   <div class="table-responsive">
      <table class="table table-hover">
         <thead>
            <tr>
               <th class="text-left">Página</th>
               <th class="text-left">Menú</th>
               <th class="text-left">Versión</th>
               <th>Importante</th>
               <th>Existe</th>
            </tr>
         </thead>
         <?php $loop_var1=$fsc->paginas; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

         <tr<?php if( !$value1->exists ){ ?> class="bg-danger"<?php } ?>>
            <td>
               <input class="checkbox-inline" type="checkbox" name="enabled[]" value="<?php echo $value1->name;?>"<?php if( $value1->enabled ){ ?> checked="checked"<?php } ?>/>
               &nbsp; <a target="_blank" href="<?php echo $value1->url();?>"><?php echo $value1->name;?></a>
            </td>
            <td>
               <?php if( $value1->show_on_menu ){ ?>

                  <?php echo $value1->folder;?> » <?php echo $value1->title;?>

               <?php }else{ ?>

                  -
               <?php } ?>

            </td>
            <td><?php echo $value1->version;?></td>
            <td class="text-center">
               <?php if( $value1->important ){ ?><span class="glyphicon glyphicon-ok"></span><?php } ?>

            </td>
            <td class="text-center">
               <?php if( $value1->exists ){ ?><span class="glyphicon glyphicon-ok"></span><?php } ?>

            </td>
         </tr>
         <?php } ?>

      </table>
   </div>
   
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-10 col-md-10 col-sm-10">
            <div class="btn-group">
               <button class="btn btn-sm btn-default" type="button" onclick="fs_marcar_todo()" title="Marcar todo">
                  <span class="glyphicon glyphicon-check"></span>
               </button>
               <button class="btn btn-sm btn-default" type="button" onclick="fs_marcar_nada()" title="Desmarcar todo">
                  <span class="glyphicon glyphicon-unchecked"></span>
               </button>
            </div>
         </div>
         <div class="col-lg-2 col-md-2 col-sm-2 text-right">
            <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">
               <span class="glyphicon glyphicon-floppy-disk"></span> &nbsp; Guardar
            </button>
         </div>
      </div>
   </div>
</form>

<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>