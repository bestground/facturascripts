<?php if(!class_exists('raintpl')){exit;}?><!--<?php echo $fsc->query;?>-->

<?php if( $fsc->get_errors() ){ ?>

<div class="alert alert-danger">
   <ul><?php $loop_var1=$fsc->get_errors(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?><li><?php echo $value1;?></li><?php } ?></ul>
</div>
<?php } ?>

<?php if( $fsc->get_messages() ){ ?>

<div class="alert alert-info">
   <ul><?php $loop_var1=$fsc->get_messages(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?><li><?php echo $value1;?></li><?php } ?></ul>
</div>
<?php } ?>


<?php if( $fsc->results ){ ?>

<div class="table-responsive">
   <table class="table table-responsive">
      <thead>
         <tr>
            <th class="text-left">Referencia + Descripción</th>
            <th class="text-right">PVP</th>
            <th class="text-right">PVP+IVA</th>
            <th class="text-right">Stock</th>
         </tr>
      </thead>
      <?php $loop_var1=$fsc->results; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

         <?php if( $value1->sevende ){ ?>

         <tr<?php if( $value1->bloqueado ){ ?> class="bg-danger"<?php }elseif( $value1->stockfis<=0 ){ ?> class="bg-warning"<?php }else{ ?> class="bg-success"<?php } ?>>
            <td>
               <a href="#" onclick="get_precios('<?php echo $value1->referencia;?>')" title="más detalles"><span class="glyphicon glyphicon-eye-open"></span></a> &nbsp;
               <a href="#" onclick="add_articulo('<?php echo $value1->referencia;?>','<?php echo $value1->get_descripcion_64();?>','<?php echo $value1->pvp;?>','0','<?php echo $value1->get_iva();?>')">
                  <?php echo $value1->referencia;?></a> <?php echo $value1->descripcion;?>

            </td>
            <td class="text-right">
               <span title="actualizado el <?php echo $value1->factualizado;?>"><?php echo $fsc->show_precio($value1->pvp);?></span>
            </td>
            <td class="text-right">
               <span title="actualizado el <?php echo $value1->factualizado;?>"><?php echo $fsc->show_precio($value1->pvp_iva());?></span>
            </td>
            <td class="text-right"><?php echo $value1->stockfis;?></td>
         </tr>
         <?php } ?>

      <?php } ?>

   </table>
</div>
<?php }else{ ?>

<div class="alert alert-info">Sin resultados</div>
<?php } ?>