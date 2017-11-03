<?php 

	class Inventario{

		private $db_;

		public function __construct($db){

			$this->db_ =  $db;

		}


		public function registrar($num_inventario,$fecha,$id_r,$id_p){

			try {

				$stmt = $this->db_->prepare("SELECT * FROM responsable");
				$stmt->execute();

				$stmt_2 = $this->db_->prepare("SELECT * FROM producto");
				$stmt_2->execute();

				if($stmt->rowCount()>0 && $stmt_2->rowCount()>0){

					$stmt = $this->db_->prepare("INSERT INTO inventario(n_inventario,fecha,id_r,id_p) VALUES (:n_inventario,:fecha,:id_r,:id_p)");
					$stmt->bindparam(":n_inventario",$num_inventario);
					$stmt->bindparam(":fecha",$fecha);
					$stmt->bindparam(":id_r",$id_r);
					$stmt->bindparam(":id_p",$id_p);
					$stmt->execute();
					return true;

				}else{

					printf('<script type="text/javascript">alert("Debe registrar un producto y responsable previamente. Gracias.")</script>');

				}
					
				
			} catch (Exception $e) {

				echo "Error en: ".$e->getMessage();

			}

		}

		public function view_register($query){

			$stmt =  $this->db_->prepare($query);
			$stmt->execute();
			if($stmt->rowCount()>0){

				while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) { ?>
					<tr>
					      <th scope="row" style="text-align: center;"><?php if(isset($row['id'])){ echo $row['id']; }else{ echo "-";} ?></th>
					      <td style="text-align: center;"><?php if(isset($row['n_inventario'])){ echo $row['n_inventario']; }else{ echo "-";} ?></td>
					      <td style="text-align: center;"><?php if(isset($row['fecha'])){ echo $row['fecha']; }else{ echo "-";} ?></td>
					      <td style="text-align: center;"><?php if(isset($row['id_r'])){ echo $row['id_r']; }else{ echo "-";} ?></td>
					      <td style="text-align: center;"><?php if(isset($row['id_p'])){ echo $row['id_p']; }else{ echo "-";} ?></td>
					      <td style="text-align: center;">
					      	<a href="#" class="btn btn-warning" type="button"><i class="fa fa-pencil-square-o"></i></a>
					      	<a href="#" class="btn btn-danger" type="button"><i class="fa fa-trash-o"></i></a>
					      </td>
					</tr>
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

		public function view_producto($query){

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





 ?>