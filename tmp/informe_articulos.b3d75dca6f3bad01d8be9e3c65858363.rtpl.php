<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<div class="panel panel-default" style="margin: 5px;">
   <div class="panel-heading">
      <h3 class="panel-title">Estadísticas</h3>
   </div>
   <div class="panel-body">
      Hay un total de <b><?php echo $fsc->stats['total'];?></b> artículos,
      <b><?php echo $fsc->stats['con_stock'];?></b> de ellos tienen stock,
      <b><?php echo $fsc->stats['publicos'];?></b> son públicos
      y <b><?php echo $fsc->stats['bloqueados'];?></b> están bloqueados.
      La última actualización de los artículos es del <b><?php echo $fsc->stats['factualizado'];?></b>.
   </div>
</div>

<div class="panel panel-default" style="margin: 5px;">
   <div class="panel-heading">
      <h3 class="panel-title">Top ventas (unidades)</h3>
   </div>
   <div class="panel-body">
      <div class="container-fluid">
         <div class="row">
            <?php $loop_var1=$fsc->top_ventas; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

            <div class="col-lg-3 col-md-3 col-sm-3"><a href="<?php echo $value1["0"]->url();?>"><?php echo $value1["0"]->referencia;?></a> (<?php echo $value1["1"];?>)</div>
            <?php }else{ ?>

            <div class="col-lg-12 col-md-12 col-sm-12">Sin resultados.</div>
            <?php } ?>

         </div>
      </div>
   </div>
</div>

<div class="panel panel-default" style="margin: 5px;">
   <div class="panel-heading">
      <h3 class="panel-title">Top compras (Unidades)</h3>
   </div>
   <div class="panel-body">
      <div class="container-fluid">
         <div class="row">
            <?php $loop_var1=$fsc->top_compras; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

            <div class="col-lg-3 col-md-3 col-sm-3"><a href="<?php echo $value1["0"]->url();?>"><?php echo $value1["0"]->referencia;?></a> (<?php echo $value1["1"];?>)</div>
            <?php }else{ ?>

            <div class="col-lg-12 col-md-12 col-sm-12">Sin resultados.</div>
            <?php } ?>

         </div>
      </div>
   </div>
</div>

<div class="panel panel-default" style="margin: 5px;">
   <div class="panel-heading">
      <h3 class="panel-title">Búsquedas de artículos</h3>
   </div>
   <div class="panel-body">
      <div class="container-fluid">
         <div class="row">
            <?php $loop_var1=$fsc->articulo->get_search_tags(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

            <div class="col-lg-3 col-md-3 col-sm-3"><?php echo $value1["tag"];?> (<?php echo $value1["count"];?>)</div>
            <?php }else{ ?>

            <div class="col-lg-12 col-md-12 col-sm-12">Ninguna búsqueda realizada.</div>
            <?php } ?>

         </div>
      </div>
   </div>
</div>

<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>