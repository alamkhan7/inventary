<?php 

	class Responsable{

		private $db_;

		public function __construct($db){

			$this->db_ =  $db;

		}


		public function registrar($nombre,$cargo,$dni,$telefono,$id_a){

			try {

				$stmt = $this->db_->prepare("SELECT * FROM area");
				$stmt->execute();

				if($stmt->rowCount()>0){

					$stmt = $this->db_->prepare("INSERT INTO responsable(nombre,cargo,dni,telefono,id_a) VALUES (:nombre,:cargo,:dni,:telefono,:id_a)");
					$stmt->bindparam(":nombre",$nombre);
					$stmt->bindparam(":cargo",$cargo);
					$stmt->bindparam(":dni",$dni);
					$stmt->bindparam(":telefono",$telefono);
					$stmt->bindparam(":id_a",$id_a);
					$stmt->execute();
					return true;

				}else{

					printf('<script type="text/javascript">alert("Debe registrar un area previamente. Gracias.")</script>');

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
					      <td style="text-align: center;"><?php if(isset($row['nombre'])){ echo $row['nombre']; }else{ echo "-";} ?></td>
					      <td style="text-align: center;"><?php if(isset($row['cargo'])){ echo $row['cargo']; }else{ echo "-";} ?></td>
					      <td style="text-align: center;"><?php if(isset($row['dni'])){ echo $row['dni']; }else{ echo "-";} ?></td>
					      <td style="text-align: center;"><?php if(isset($row['telefono'])){ echo $row['telefono']; }else{ echo "-";} ?></td>
					      <td style="text-align: center;"><?php if(isset($row['id_a'])){ echo $row['id_a']; }else{ echo "-";} ?></td>
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



	}





 ?>