<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<?php if( $fsc->agente ){ ?>

   <?php if( $fsc->caja ){ ?>

      <?php if( $fsc->caja->codagente==$fsc->user->codagente ){ ?>

         <?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("tpv_recambios2") . ( substr("tpv_recambios2",-1,1) != "/" ? "/" : "" ) . basename("tpv_recambios2") );?>

      <?php }else{ ?>

      <div class="text-center">
         <img src='view/img/big_lock.png' alt="acceso denegado"/>
      </div>
      <?php } ?>

   <?php }else{ ?>

   <script type="text/javascript">
      $(document).ready(function() {
         document.f_caja.d_inicial.select();
      });
   </script>
   <form name="f_caja" action="<?php echo $fsc->url();?>" method="post" class="form">
      <div class="container">
         <div class="row">
            <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
               <div class="well">
                  <h1>Caja:</h1>
                  <p>¿Cuanto dinero hay en la caja?</p>
                  <div class="form-group">
                     <input class="form-control" type="text" name="d_inicial" value="0.00" autocomplete="off"/>
                  </div>
                  <div class="text-right">
                     <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">
                        <span class="glyphicon glyphicon-floppy-disk"></span>
                        &nbsp; Guardar
                     </button>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </form>
   <?php } ?>

<?php }else{ ?>

<div class="text-center">
   <img src='view/img/big_lock.png' alt="Acceso denegado"/>
</div>
<?php } ?>


<div class="hidden">
   <iframe src="http://localhost:10080" height="0"></iframe>
</div>

<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>