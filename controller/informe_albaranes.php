<?php
/*
 * This file is part of FacturaSctipts
 * Copyright (C) 2014  Carlos Garcia Gomez  neorazorx@gmail.com
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 * 
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

require_once 'base/fs_pdf.php';
require_model('albaran_cliente.php');
require_model('albaran_proveedor.php');

class informe_albaranes extends fs_controller
{
	public $desde;
	public $hasta;
	public $albaran_cli;
	
	public function __construct()
	{
	  parent::__construct(__CLASS__, ucfirst(FS_ALBARANES), 'informes', FALSE, TRUE);
	}
   
	protected function process() {
		$this->show_fs_toolbar = FALSE;  

		$this->desde = Date('1-m-Y');
		$this->hasta = Date('d-m-Y', mktime(0, 0, 0, date("m")+1, date("1")-1, date("Y")));

		$this->albaran_cli = new albaran_cliente();	  
		/// declaramos los objetos sólo para asegurarnos de que existen las tablas
		$albaran_pro = new albaran_proveedor();

		if( isset($_POST['listado']) ) {
			if($_POST['listado'] == 'albaranescli') {
				if($_POST['generar'] == 'pdf') {
					$this->pdf_albaranes_cli();
				}
			}
		}
	}

	public function stats_last_days()
	{
	  $stats = array();
	  $stats_cli = $this->stats_last_days_aux('albaranescli');
	  $stats_pro = $this->stats_last_days_aux('albaranesprov');
  
	  foreach($stats_cli as $i => $value)
	  {
		 $stats[$i] = array(
			 'day' => $value['day'],
			 'total_cli' => $value['total'],
			 'total_pro' => 0
		 );
	  }
  
	  foreach($stats_pro as $i => $value)
		 $stats[$i]['total_pro'] = $value['total'];
  
	  return $stats;
	}

	public function stats_last_days_aux($table_name='albaranescli', $numdays = 25)
	{
	  $stats = array();
	  $desde = Date('d-m-Y', strtotime( Date('d-m-Y').'-'.$numdays.' day'));
  
	  foreach($this->date_range($desde, Date('d-m-Y'), '+1 day', 'd') as $date)
	  {
		 $i = intval($date);
		 $stats[$i] = array('day' => $i, 'total' => 0);
	  }
  
	  if( strtolower(FS_DB_TYPE) == 'postgresql')
		 $sql_aux = "to_char(fecha,'FMDD')";
	  else
		 $sql_aux = "DATE_FORMAT(fecha, '%d')";
  
	  $data = $this->db->select("SELECT ".$sql_aux." as dia, sum(total) as total
		 FROM ".$table_name." WHERE fecha >= ".$this->empresa->var2str($desde)."
		 AND fecha <= ".$this->empresa->var2str(Date('d-m-Y'))."
		 GROUP BY ".$sql_aux." ORDER BY dia ASC;");
	  if($data)
	  {
		 foreach($data as $d)
		 {
			$i = intval($d['dia']);
			$stats[$i] = array(
				'day' => $i,
				'total' => floatval($d['total'])
			);
		 }
	  }
	  return $stats;
	}

	public function stats_last_months()
	{
	  $stats = array();
	  $stats_cli = $this->stats_last_months_aux('albaranescli');
	  $stats_pro = $this->stats_last_months_aux('albaranesprov');
	  $meses = array(
		  1 => 'ene',
		  2 => 'feb',
		  3 => 'mar',
		  4 => 'abr',
		  5 => 'may',
		  6 => 'jun',
		  7 => 'jul',
		  8 => 'ago',
		  9 => 'sep',
		  10 => 'oct',
		  11 => 'nov',
		  12 => 'dic'
	  );
  
	  foreach($stats_cli as $i => $value)
	  {
		 $stats[$i] = array(
			 'month' => $meses[ $value['month'] ],
			 'total_cli' => round($value['total'], 2),
			 'total_pro' => 0
		 );
	  }
  
	  foreach($stats_pro as $i => $value)
		 $stats[$i]['total_pro'] = round($value['total'], 2);
  
	  return $stats;
	}

	public function stats_last_months_aux($table_name='albaranescli', $num = 11)
	{
	  $stats = array();
	  $desde = Date('d-m-Y', strtotime( Date('01-m-Y').'-'.$num.' month'));
  
	  foreach($this->date_range($desde, Date('d-m-Y'), '+1 month', 'm') as $date)
	  {
		 $i = intval($date);
		 $stats[$i] = array('month' => $i, 'total' => 0);
	  }
  
	  if( strtolower(FS_DB_TYPE) == 'postgresql')
		 $sql_aux = "to_char(fecha,'FMMM')";
	  else
		 $sql_aux = "DATE_FORMAT(fecha, '%m')";
  
	  $data = $this->db->select("SELECT ".$sql_aux." as mes, sum(total) as total
		 FROM ".$table_name." WHERE fecha >= ".$this->empresa->var2str($desde)."
		 AND fecha <= ".$this->empresa->var2str(Date('d-m-Y'))."
		 GROUP BY ".$sql_aux." ORDER BY mes ASC;");
	  if($data)
	  {
		 foreach($data as $d)
		 {
			$i = intval($d['mes']);
			$stats[$i] = array(
				'month' => $i,
				'total' => floatval($d['total'])
			);
		 }
	  }
	  return $stats;
	}

	public function stats_last_years()
	{
	  $stats = array();
	  $stats_cli = $this->stats_last_years_aux('albaranescli');
	  $stats_pro = $this->stats_last_years_aux('albaranesprov');
  
	  foreach($stats_cli as $i => $value)
	  {
		 $stats[$i] = array(
			 'year' => $value['year'],
			 'total_cli' => round($value['total'], 2),
			 'total_pro' => 0
		 );
	  }
  
	  foreach($stats_pro as $i => $value)
		 $stats[$i]['total_pro'] = round($value['total'], 2);
  
	  return $stats;
	}

	public function stats_last_years_aux($table_name='albaranescli', $num = 4)
	{
	  $stats = array();
	  $desde = Date('d-m-Y', strtotime( Date('d-m-Y').'-'.$num.' year'));
  
	  foreach($this->date_range($desde, Date('d-m-Y'), '+1 year', 'Y') as $date)
	  {
		 $i = intval($date);
		 $stats[$i] = array('year' => $i, 'total' => 0);
	  }
  
	  if( strtolower(FS_DB_TYPE) == 'postgresql')
		 $sql_aux = "to_char(fecha,'FMYYYY')";
	  else
		 $sql_aux = "DATE_FORMAT(fecha, '%Y')";
  
	  $data = $this->db->select("SELECT ".$sql_aux." as ano, sum(total) as total
		 FROM ".$table_name." WHERE fecha >= ".$this->empresa->var2str($desde)."
		 AND fecha <= ".$this->empresa->var2str(Date('d-m-Y'))."
		 GROUP BY ".$sql_aux." ORDER BY ano ASC;");
	  if($data)
	  {
		 foreach($data as $d)
		 {
			$i = intval($d['ano']);
			$stats[$i] = array(
				'year' => $i,
				'total' => floatval($d['total'])
			);
		 }
	  }
	  return $stats;
	}

	private function date_range($first, $last, $step = '+1 day', $format = 'd-m-Y' )
	{
	  $dates = array();
	  $current = strtotime($first);
	  $last = strtotime($last);
  
	  while( $current <= $last )
	  {
		 $dates[] = date($format, $current);
		 $current = strtotime($step, $current);
	  }
  
	  return $dates;
	}
	
   private function pdf_albaranes_cli()
   {
   		$sum_total_bruto = 0;
   		$sum_importe_iva = 0;
   		$sum_total_factura = 0;
   		$sum_pago_senor = 0;
   		
		/// desactivamos el motor de plantillas
      	$this->template = FALSE;
      
      	$pdf_doc = new fs_pdf('a4', 'landscape', 'Courier');
      	$pdf_doc->pdf->addInfo('Title', 'Facturas emitidas del '.$_POST['dfecha'].' al '.$_POST['hfecha'] );
      	$pdf_doc->pdf->addInfo('Subject', 'Facturas emitidas del '.$_POST['dfecha'].' al '.$_POST['hfecha'] );
      	$pdf_doc->pdf->addInfo('Author', $this->empresa->nombre);      

      	$albaranes = $this->albaran_cli->all_desde($_POST['dfecha'], $_POST['hfecha']);
      	
      	
      	if($albaranes) {
    		$total_lineas = count($albaranes);
         	$linea_actual = 0;
         	$lppag = 31;
         	$pagina = 1;
         
         	while($linea_actual < $total_lineas) {
            	if($linea_actual > 0) {
               		$pdf_doc->pdf->ezNewPage();
               		$pagina++;
            	}
            
            	/// encabezado
            	$pdf_doc->pdf->ezText('<b>' . $this->empresa->nombre."</b> - Facturas de ventas del ".$_POST['dfecha']." al ".$_POST['hfecha'].":\n\n", 14);

            	/// tabla principal
            	$pdf_doc->new_table();		
            	
				$pdf_doc->add_table_header(
					array(
					   'albaran' => '<b>Alb.</b>',
					   'fecha' => '<b>Fecha</b>',
					   'total_bruto' => '<b>Total Bruto</b>',
					   'importe_iva' => '<b>Importe IVA</b>',
					   'total_factura' => '<b>Total Factura</b>',
					   'pago_senor' => '<b>Pago Señor</b>'
					)
            	);
            	
           		for($i = 0; $i < $lppag AND $linea_actual < $total_lineas; $i++) {
               		$linea = array(
                   		'albaran' => $albaranes[$linea_actual]->codigo,
                   		'fecha' => $albaranes[$linea_actual]->fecha,
                   		'total_bruto' => $this->_pc($albaranes[$linea_actual]->total_bruto),
						'importe_iva' => $this->_pc($albaranes[$linea_actual]->importe_iva),
						'total_factura' => $this->_pc($albaranes[$linea_actual]->total_factura),
						'pago_senor' => $this->_pc($albaranes[$linea_actual]->pago_senor)
               		);
               		$sum_total_bruto += $albaranes[$linea_actual]->total_bruto;
               		$sum_importe_iva += $albaranes[$linea_actual]->importe_iva;
               		$sum_total_factura += $albaranes[$linea_actual]->total_factura;
               		$sum_pago_senor += $albaranes[$linea_actual]->pago_senor;
               		
               		$pdf_doc->add_table_row($linea);
               		$linea_actual++; 
               	}			

				$pdf_doc->save_table(
				   array(
					   'fontSize' => 8,
					   'cols' => array(
						   'total_bruto' => array('justification' => 'right'),
						   'importe_iva' => array('justification' => 'right'),
						   'total_factura' => array('justification' => 'right'),
						   'pago_senor' => array('justification' => 'right')
					   ),
					   'shaded' => 0,
					   'width' => 780
				   )
				);
				$pdf_doc->pdf->ezText("\n", 10);
				
			} // fin while        
     	} else {
        	$pdf_doc->pdf->ezText($this->empresa->nombre." - Albaranes de ventas del ".$_POST['dfecha']." al ".$_POST['hfecha'].":\n\n", 14);
        	$pdf_doc->pdf->ezText("Ninguna.\n\n", 14);
      	}
      
    
      	$pdf_doc->pdf->ezText("<b>TOTALES:</b>\n", 12);
      	$pdf_doc->pdf->ezText("<b>Total Bruto:</b> " . $this->_pc($sum_total_bruto), 11);
      	$pdf_doc->pdf->ezText("<b>Importe IVA:</b> " . $this->_pc($sum_importe_iva), 11);
      	$pdf_doc->pdf->ezText("<b>Total Factura:</b> " . $this->_pc($sum_total_factura), 11);
      	$pdf_doc->pdf->ezText("<b>Pago Señor:</b> " . $this->_pc($sum_pago_senor), 11);
      	$pdf_doc->show();
   	}
   	
   	public function _pc($str) {
   		return str_replace('.',',',$str);
   }
}
