<?php 

	class Categoria{

		private $db_;

		public function __construct($db){

			$this->db_ =  $db;

		}


		public function registrar($nombre,$descripcion){

			try {

					$stmt = $this->db_->prepare("INSERT INTO categoria(nombre,descripcion) VALUES (:nombre,:descripcion)");
					$stmt->bindparam(":nombre",$nombre);
					$stmt->bindparam(":descripcion",$descripcion);
					$stmt->execute();
					return true;
				
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
					      <td style="text-align: center;"><?php if(isset($row['descripcion'])){ echo $row['descripcion']; }else{ echo "-";} ?></td>
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


	}





 ?>