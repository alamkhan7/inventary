<?php
	
	class PDF extends FPDF
	{
		function Header()
		{
			$this->SetFillColor(232,232,232);
			$this->SetFont('Arial','B',15);
			$this->Cell(35);
			$this->Cell(120,10, 'REPORTE DE INVENTARIO',1,1,'C',1);
			$this->Cell(35);
			$this->Cell(120,10, 'I.E.P "Santo Toribio de Mogrovejo"',1,1,'C',1);
			$this->Cell(10);
			$this->Image('../../resource/img/logo-colegio.png', 5, 5, 30 );
			$this->Ln(20);
		}
		
		function Footer()
		{
			$this->SetY(-15);
			$this->SetFont('Arial','I', 8);
			$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
		}		
	}
?>