<?php 

	class Colegio{

		private $db_;

		public function __construct($db){

			$this->db_ =  $db;

		}


		public function registrar($tipo,$nombre,$direccion,$ciudad){

			try {

				$stmt = $this->db_->prepare("SELECT * FROM colegio");
				$stmt->execute();

				if($stmt->rowCount()<1){

					$stmt = $this->db_->prepare("INSERT INTO colegio(tipo,nombre,direccion,ciudad) VALUES (:tipo,:nombre,:direccion,:ciudad)");
					$stmt->bindparam(":tipo",$tipo);
					$stmt->bindparam(":nombre",$nombre);
					$stmt->bindparam(":direccion",$direccion);
					$stmt->bindparam(":ciudad",$ciudad);
					$stmt->execute();
					return true;

				}else{

					printf('<script type="text/javascript">alert("Solo puede registrar una escuela. Gracias.")</script>');

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
					      <td style="text-align: center;"><?php if(isset($row['tipo'])){ echo $row['tipo']; }else{ echo "-";} ?></td>
					      <td style="text-align: center;"><?php if(isset($row['nombre'])){ echo $row['nombre']; }else{ echo "-";} ?></td>
					      <td style="text-align: center;"><?php if(isset($row['direccion'])){ echo $row['direccion']; }else{ echo "-";} ?></td>
					      <td style="text-align: center;"><?php if(isset($row['ciudad'])){ echo $row['ciudad']; }else{ echo "-";} ?></td>
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