<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<script type="text/javascript">
   function delete_pais(url)
   {
      if( confirm("¿Realmente desea eliminar este país?") )
         window.location.href = url;
   }
   $(document).ready(function() {
      
   });
</script>

<div class="table-responsive">
   <table class="table table-hover">
      <thead>
         <tr>
            <th class="text-left">
               <a href="http://es.wikipedia.org/wiki/ISO_3166-1#C.C3.B3digos_ISO_3166-1" target="_blank">Código Alfa-3</a>
            </th>
            <th class="text-left">
               <a href="http://es.wikipedia.org/wiki/ISO_3166-1#C.C3.B3digos_ISO_3166-1" target="_blank">Código Alfa-2</a>
            </th>
            <th class="text-left">Nombre</th>
            <th align="right" width="140">Acciones</th>
         </tr>
      </thead>
      <?php $loop_var1=$fsc->pais->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

      <form action="<?php echo $fsc->url();?>" method="post" class="form" role="form">
         <tr>
            <td>
               <input type="hidden" name="scodpais" value="<?php echo $value1->codpais;?>"/>
               <div class="form-control"><?php echo $value1->codpais;?></div>
            </td>
            <td>
               <input class="form-control" type="text" name="scodiso" value="<?php echo $value1->codiso;?>" autocomplete="off"/>
            </td>
            <td>
               <input class="form-control" type="text" name="snombre" value="<?php echo $value1->nombre;?>" autocomplete="off"/>
            </td>
            <td class="text-right">
               <div class="btn-group">
                  <a class="btn btn-sm btn-danger" onclick="delete_pais('<?php echo $fsc->url();?>&delete=<?php echo $value1->codpais;?>')" title="Eliminar">
                     <span class="glyphicon glyphicon-trash"></span>
                  </a>
                     
                  <button class="btn btn-sm btn-primary" type="submit" title="Guardar">
                     <span class="glyphicon glyphicon-floppy-disk"></span>
                  </button>
               </div>
            </td>
         </tr>
      </form>
      <?php } ?>

      <form class="form" role="form" name="f_nuevo_pais" action ="<?php echo $fsc->url();?>" method="post">
         <tr class="bg-info">
            <td>
               <input class="form-control" type="text" name="scodpais" placeholder="Nuevo código Alfa-3" autocomplete="off"/>
            </td>
            <td>
               <input class="form-control" type="text" name="scodiso" placeholder="Código Alfa-2" autocomplete="off"/>
            </td>
            <td>
               <input class="form-control" type="text" name="snombre" placeholder="Nuevo nombre" autocomplete="off"/>
            </td>
            <td class="text-right">
               <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();" title="Guardar">
                  <span class="glyphicon glyphicon-floppy-disk"></span>
               </button>
            </td>
         </tr>
      </form>
   </table>
</div>

<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>