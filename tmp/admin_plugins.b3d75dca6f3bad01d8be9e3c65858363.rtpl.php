<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<script type="text/javascript">
   function eliminar(name)
   {
      if( confirm("¿Realmente desea eliminar este plugin?") )
      {
         window.location.href = '<?php echo $fsc->url();?>&delete='+name;
      }
   }
</script>

<div class="container-fluid" style="margin-top: 10px;">
   <div class="row">
      <div class="col-md-9">
         <h2 style="margin-top: 0px;">Plugins</h2>
      </div>
      <div class="col-md-3">
         <form class="form" action="https://www.facturascripts.com/store/" target="_blank">
            <input type="hidden" name="post_type" value="product"/>
            <div class="input-group">
               <input type="text" name="s" class="form-control">
               <span class="input-group-btn">
                  <button class="btn btn-primary" type="button">
                     <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                  </button>
               </span>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="visible-sm visible-xs" style="margin-bottom: 10px;">
</div>

<div role="tabpanel">
   <ul class="nav nav-tabs" role="tablist">
      <?php if( $fsc->unstables ){ ?>

      <li><a href="<?php echo $fsc->url();?>">Estables</a></li>
      <li role="presentation" class="active">
         <a href="#home" aria-controls="home" role="tab" data-toggle="tab">
            <span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> &nbsp; Inestables
         </a>
      </li>
      <?php }else{ ?>

      <li role="presentation" class="active">
         <a href="#home" aria-controls="home" role="tab" data-toggle="tab">Estables</a>
      </li>
      <li>
         <a href="<?php echo $fsc->url();?>&unstable=TRUE">
            <span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> &nbsp; Inestables
         </a>
      </li>
      <?php } ?>

      <li role="presentation">
         <a href="#store" aria-controls="store" role="tab" data-toggle="tab">Más...</a>
      </li>
   </ul>
   <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="home" style="margin-top: 10px;">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-6">
               <!--<?php $total=$this->var['total']=count($fsc->plugins());?>-->
               <?php $loop_var1=$fsc->plugins(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                  <div class="panel<?php if( $value1['enabled'] ){ ?> panel-success<?php }else{ ?> panel-default<?php } ?>">
                     <div class="panel-heading">
                        <h3 class="panel-title">
                           <?php if( $fsc->unstables ){ ?>

                           <span class="glyphicon glyphicon-warning-sign" aria-hidden="true" title="Esta plugin está en desarrollo y puede dar probemas"></span> &nbsp;
                           <?php } ?>

                           <?php echo $value1['name'];?>

                        </h3>
                     </div>
                     <div class="panel-body">
                        <div class="pull-right">
                        <?php if( $fsc->unstables ){ ?>

                           <?php if( $value1['enabled'] ){ ?>

                           <a class="btn btn-sm btn-danger" type="button" value="Desactivar" title="Desactivar" href="<?php echo $fsc->url();?>&unstable=TRUE&disable=<?php echo $value1['name'];?>">
                              <span class="glyphicon glyphicon-remove"></span> &nbsp; Desactivar
                           </a>
                           <?php }else{ ?>

                           <div class="btn-group">
                              <a class="btn btn-sm btn-default" type="button" value="Activar" title="Activar" href="<?php echo $fsc->url();?>&unstable=TRUE&enable=<?php echo $value1['name'];?>">
                                 <span class="glyphicon glyphicon-ok"></span> &nbsp; Activar
                              </a>
                              <a class="btn btn-sm btn-default" onclick="eliminar('<?php echo $value1['name'];?>')" title="eliminar plugin">
                                 <span class="glyphicon glyphicon-trash"></span>
                              </a>
                           </div>
                           <?php } ?>

                        <?php }else{ ?>

                           <?php if( $value1['enabled'] ){ ?>

                           <a class="btn btn-sm btn-danger" type="button" value="Desactivar" title="Desactivar" href="<?php echo $fsc->url();?>&disable=<?php echo $value1['name'];?>">
                               <span class="glyphicon glyphicon-remove"></span> &nbsp; Desactivar
                           </a>
                           <?php }else{ ?>

                           <div class="btn-group">
                              <a class="btn btn-sm btn-default" type="button" value="Activar" title="Activar" href="<?php echo $fsc->url();?>&enable=<?php echo $value1['name'];?>">
                                  <span class="glyphicon glyphicon-ok"></span> &nbsp; Activar
                              </a>
                              <a class="btn btn-sm btn-default" onclick="eliminar('<?php echo $value1['name'];?>')" title="eliminar plugin">
                                 <span class="glyphicon glyphicon-trash"></span>
                              </a>
                           </div>
                           <?php } ?>

                        <?php } ?>

                        </div>
                        <div><?php echo $value1['description'];?></div>
                     </div>
                  </div>
                  <?php if( $counter1+1==intval($total/2) ){ ?>

                  </div><div class="col-md-6">
                  <?php } ?>

               <?php } ?>

               </div>
            </div>
         </div>
      </div>
      <div role="tabpanel" class="tab-pane" id="store">
         <div class="container-fluid" style="margin-top: 10px;">
            <div class="row">
               <div class="col-md-4">
                  <div class="panel panel-default">
                     <div class="panel-heading">
                        <h3 class="panel-title">Subir plugin</h3>
                     </div>
                     <div class="panel-body">
                        <p>Si tienes un plugin en un archivo .zip, puedes subirlo e instalarlo desde aquí.</p>
                        <form class="form" action="<?php echo $fsc->url();?>" enctype="multipart/form-data" method="post">
                           <input type="hidden" name="install" value="TRUE"/>
                           <div class="form-group">
                              <input type="file" name="fplugin" accept="application/zip"/>
                           </div>
                           <button type="submit" class="btn btn-default">
                              <span class="glyphicon glyphicon-import" aria-hidden="true"></span> &nbsp; Instalar
                           </button>
                        </form>
                     </div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="panel panel-default">
                     <div class="panel-heading">
                        <h3 class="panel-title">Tienda de plugins</h3>
                     </div>
                     <div class="panel-body">
                        <p>Consigue más plugins en la tienda oficial de plugins de FacturaScripts.</p>
                        <a href="https://www.facturascripts.com/store/" target="_blank" class="btn btn-primary">
                           <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> &nbsp; Tienda oficial
                        </a>
                     </div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="panel panel-default">
                     <div class="panel-heading">
                        <h3 class="panel-title">¿Necesitas una personalización?</h3>
                     </div>
                     <div class="panel-body">
                        <p>Podemos crearte uno a medida. Para que FacturaScripts se adapte exáctamente a lo que buscas, y no al contrario.</p>
                        <a href="//www.facturascripts.com/community/premium.php" target="_blank" class="btn btn-info">
                           <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> &nbsp; Personalizar
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>