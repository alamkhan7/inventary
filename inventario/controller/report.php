<?php


class Report{

		private $db_;

		public function __construct($db){

			$this->db_ =  $db;

		}


		public function generar_pdf($inicio,$fin,$area,$responsable){

			try {

					$query = "SELECT i.id,p.nombre,p.id_c,p.caracteristicas,p.cantidad,i.n_inventario,p.estado,p.uso FROM area AS a INNER JOIN responsable AS r ON a.id=r.id_a INNER JOIN inventario AS i ON r.id=i.id_r INNER JOIN producto AS p ON i.id_p=p.id WHERE (a.id=:area AND date(i.fecha) BETWEEN :inicio AND :fin) OR (r.id=:responsable AND date(i.fecha) BETWEEN :inicio AND :fin)";
					$stmt = $this->db_->prepare($query);	
					$stmt->bindparam(":area",$area);
					$stmt->bindparam(":responsable",$responsable);
					$stmt->bindparam(":inicio",$inicio);
					$stmt->bindparam(":fin",$fin);
					$stmt->execute();

					$pdf = new PDF();
					$pdf->AliasNbPages();
					$pdf->AddPage();
					$pdf->SetFillColor(232,232,232);
					$pdf->SetFont('Arial','B',7);
					$pdf->Cell(25);
					$pdf->Cell(22,6,'AREA:',1,0,'C',1);
					$pdf->Cell(50,6,$area,1,0,'C',0);
					$pdf->Cell(17);
					$pdf->Cell(15,6,'DEL:',1,0,'C',1);
					$pdf->Cell(36,6,$inicio,1,1,'C',0);
					$pdf->Cell(25);
					$pdf->Cell(22,6,'RESPONSABLE:',1,0,'C',1);
					$pdf->Cell(50,6,$responsable,1,0,'C',0);
					$pdf->Cell(17);
					$pdf->Cell(15,6,'AL:',1,0,'C',1);
					$pdf->Cell(36,6,$fin,1,1,'C',0);
					$pdf->Ln(10);
					$pdf->SetFillColor(232,232,232);
					$pdf->SetFont('Arial','B',7);
					$pdf->Cell(10);
					$pdf->Cell(10,6,utf8_decode('N°'),1,0,'C',1);
					$pdf->Cell(40,6,utf8_decode('Descripcion'),1,0,'C',1);
					$pdf->Cell(10,6,'Marca',1,0,'C',1);
					$pdf->Cell(40,6,'Caracteristicas',1,0,'C',1);
					$pdf->Cell(12,6,'Cantidad',1,0,'C',1);
					$pdf->Cell(20,6,utf8_decode('N° Inventario'),1,0,'C',1);
					$pdf->Cell(20,6,'Estado',1,0,'C',1);
					$pdf->Cell(20,6,'Uso',1,1,'C',1);
					
					$pdf->SetFont('Arial','',7);
					
					while($row = $stmt->fetch(PDO::FETCH_ASSOC))
					{	
						$pdf->Cell(10);
						$pdf->Cell(10,6,$row['id'],1,0,'C');
						$pdf->Cell(40,6,utf8_decode($row['nombre']),1,0,'C');
						$pdf->Cell(10,6,$row['id_c'],1,0,'C');
						$pdf->Cell(40,6,utf8_decode($row['caracteristicas']),1,0,'C');
						$pdf->Cell(12,6,$row['cantidad'],1,0,'C');
						$pdf->Cell(20,6,utf8_decode($row['n_inventario']),1,0,'C');
						$pdf->Cell(20,6,utf8_decode($row['estado']),1,0,'C');
						$pdf->Cell(20,6,utf8_decode($row['uso']),1,1,'C');
					}
					$pdf->Output();
					return true;
					
				
			} catch (Exception $e) {

				echo "Error en: ".$e->getMessage();

			}

		}


		public function view_area($query){

			$stmt =  $this->db_->prepare($query);
			$stmt->execute();
			if($stmt->rowCount()>0){

				while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) { ?>
					<option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
				<?php
				}


			}else{
					printf('<script type="text/javascript">alert("No se encuentran registros en la BD. Gracias.")</script>');
			}

		}

		public function view_responsable($query){

			$stmt =  $this->db_->prepare($query);
			$stmt->execute();
			if($stmt->rowCount()>0){

				while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) { ?>
					<option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
				<?php
				}


			}else{
					printf('<script type="text/javascript">alert("No se encuentran registros en la BD. Gracias.")</script>');
			}

		}



	}

