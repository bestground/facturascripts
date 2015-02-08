<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
   // Load the Visualization API and the piechart package.
   google.load('visualization', '1.0', {'packages':['corechart']});
   
   // Set a callback to run when the Google Visualization API is loaded.
   google.setOnLoadCallback(drawChart);
   
   // Callback that creates and populates a data table,
   // instantiates the pie chart, passes in the data and
   // draws it.
   function drawChart()
   {
      // Create the data table.
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'día');
      data.addColumn('number', 'ventas <?php echo $fsc->simbolo_divisa();?>');
      data.addColumn('number', 'compras <?php echo $fsc->simbolo_divisa();?>');
      data.addRows([
      <?php $loop_var1=$fsc->stats_last_days(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

         ['<?php echo $value1['day'];?>', <?php echo $value1['total_cli'];?>, <?php echo $value1['total_pro'];?>],
      <?php } ?>

      ]);
      
      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.ColumnChart(document.getElementById('chart_facturas_day'));
      chart.draw(data);
      
      // Create the data table.
      var data2 = new google.visualization.DataTable();
      data2.addColumn('string', 'mes');
      data2.addColumn('number', 'ventas <?php echo $fsc->simbolo_divisa();?>');
      data2.addColumn('number', 'compras <?php echo $fsc->simbolo_divisa();?>');
      data2.addColumn('number', 'beneficios <?php echo $fsc->simbolo_divisa();?>');
      data2.addRows([
      <?php $loop_var1=$fsc->stats_last_months(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

         ['<?php echo $value1['month'];?>', <?php echo $value1['total_cli'];?>, <?php echo $value1['total_pro'];?>, <?php echo $value1['beneficios'];?>],
      <?php } ?>

      ]);
      
      // Instantiate and draw our chart, passing in some options.
      var chart2 = new google.visualization.AreaChart(document.getElementById('chart_facturas_month'));
      chart2.draw(data2);
      
      // Create the data table.
      var data3 = new google.visualization.DataTable();
      data3.addColumn('string', 'año');
      data3.addColumn('number', 'ventas <?php echo $fsc->simbolo_divisa();?>');
      data3.addColumn('number', 'compras <?php echo $fsc->simbolo_divisa();?>');
      data3.addColumn('number', 'beneficios <?php echo $fsc->simbolo_divisa();?>');
      data3.addRows([
      <?php $loop_var1=$fsc->stats_last_years(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

         ['<?php echo $value1['year'];?>', <?php echo $value1['total_cli'];?>, <?php echo $value1['total_pro'];?>, <?php echo $value1['beneficios'];?>],
      <?php } ?>

      ]);
      
      // Instantiate and draw our chart, passing in some options.
      var chart3 = new google.visualization.AreaChart(document.getElementById('chart_facturas_year'));
      chart3.draw(data3);
   }
</script>

<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
   <li class="active"><a href="#home" role="tab" data-toggle="tab">Gráficos</a></li>
   <li><a href="#listados" role="tab" data-toggle="tab">Listados</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
   <div class="tab-pane active" id="home">
      <div class="container-fluid" style="margin-top: 15px;">
         <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h3 class="panel-title">Facturación de los últimos días</h3>
                  </div>
                  <div class="panel-body">
                     <div id="chart_facturas_day"></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h3 class="panel-title">Facturación de los últimos meses</h3>
                  </div>
                  <div class="panel-body">
                     <div id="chart_facturas_month"></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h3 class="panel-title">Facturación de los últimos años</h3>
                  </div>
                  <div class="panel-body">
                     <div id="chart_facturas_year"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="tab-pane" id="listados">
      <div class="container-fluid" style="margin-top: 15px;">
         <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
               <form action="<?php echo $fsc->url();?>" method="post" target="_blank" class="form">
                  <input type="hidden" name="listado" value="facturasprov"/>
                  <div class="panel panel-info">
                     <div class="panel-heading">
                        <h3 class="panel-title">Facturas de compras</h3>
                     </div>
                     <div class="panel-body">
                        <div class="form-group col-md-3">
                           Desde:
                           <input class="form-control datepicker" type="text" name="dfecha" value="<?php echo $fsc->desde;?>"/>
                        </div>
                        <div class="form-group col-md-3">
                           Hasta:
                           <input class="form-control datepicker" type="text" name="hfecha" value="<?php echo $fsc->hasta;?>"/>
                        </div>
                        <div class="form-group col-md-3">
                           <a href="<?php echo $fsc->serie->url();?>">Serie</a>:
                           <select class="form-control" name="codserie">
                              <option value="---">Todas</option>
                              <option value="---">-----</option>
                              <?php $loop_var1=$fsc->serie->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                              <option value="<?php echo $value1->codserie;?>"><?php echo $value1->descripcion;?></option>
                              <?php } ?>

                           </select>
                        </div>
                        <div class="form-group col-md-3">
                           Generar:
                           <select name="generar" class="form-control">
                              <option value="pdf">PDF</option>
                              <option value="csv">CSV</option>
                           </select>
                        </div>
                     </div>
                     <div class="panel-footer">
                        <button class="btn btn-sm btn-primary" type="submit">
                           <span class="glyphicon glyphicon-eye-open"></span> &nbsp; Mostrar
                        </button>
                     </div>
                  </div>
               </form>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
               <form action="<?php echo $fsc->url();?>" method="post" target="_blank" class="form">
                  <input type="hidden" name="listado" value="facturascli"/>
                  <div class="panel panel-info">
                     <div class="panel-heading">
                        <h3 class="panel-title">Facturas de ventas</h3>
                     </div>
                     <div class="panel-body">
                        <div class="form-group col-md-3">
                           Desde:
                           <input class="form-control datepicker" type="text" name="dfecha" value="<?php echo $fsc->desde;?>" size="12"/>
                        </div>
                        <div class="form-group col-md-3">
                           Hasta:
                           <input class="form-control datepicker" type="text" name="hfecha" value="<?php echo $fsc->hasta;?>" size="12"/>
                        </div>
                        <div class="form-group col-md-3">
                           <a href="<?php echo $fsc->serie->url();?>">Serie</a>:
                           <select class="form-control" name="codserie">
                              <option value="---">Todas</option>
                              <option value="---">-----</option>
                              <?php $loop_var1=$fsc->serie->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                              <option value="<?php echo $value1->codserie;?>"><?php echo $value1->descripcion;?></option>
                              <?php } ?>

                           </select>
                        </div>
                        <div class="form-group col-md-3">
                           Generar:
                           <select name="generar" class="form-control">
                              <option value="pdf">PDF</option>
                              <option value="csv">CSV</option>
                           </select>
                        </div>
                     </div>
                     <div class="panel-footer">
                        <button class="btn btn-sm btn-primary" type="submit">
                           <span class="glyphicon glyphicon-eye-open"></span> &nbsp; Mostrar
                        </button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>

<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>