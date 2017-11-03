<?php 

	class Producto{

		private $db_;

		public function __construct($db){

			$this->db_ =  $db;

		}


		public function registrar($nombre,$caracteristicas,$cantidad,$estado,$uso,$categoria){

			try {

				$stmt = $this->db_->prepare("SELECT * FROM categoria");
				$stmt->execute();

				if($stmt->rowCount()>0){

					$stmt = $this->db_->prepare("INSERT INTO producto(nombre,caracteristicas,cantidad,estado,uso,id_c) VALUES (:nombre,:caracteristicas,:cantidad,:estado,:uso,:id_c)");
					$stmt->bindparam(":nombre",$nombre);
					$stmt->bindparam(":caracteristicas",$caracteristicas);
					$stmt->bindparam(":cantidad",$cantidad);
					$stmt->bindparam(":estado",$estado);
					$stmt->bindparam(":uso",$uso);
					$stmt->bindparam(":id_c",$categoria);
					$stmt->execute();
					return true;

				}else{

					printf('<script type="text/javascript">alert("Debe registrar una categoria previamente. Gracias.")</script>');

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
					      <td style="text-align: center;"><?php if(isset($row['caracteristicas'])){ echo $row['caracteristicas']; }else{ echo "-";} ?></td>
					      <td style="text-align: center;"><?php if(isset($row['cantidad'])){ echo $row['cantidad']; }else{ echo "-";} ?></td>
					      <td style="text-align: center;"><?php if(isset($row['estado'])){ echo $row['estado']; }else{ echo "-";} ?></td>
					      <td style="text-align: center;"><?php if(isset($row['uso'])){ echo $row['uso']; }else{ echo "-";} ?></td>
					      <td style="text-align: center;"><?php if(isset($row['id_c'])){ echo $row['id_c']; }else{ echo "-";} ?></td>
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

		public function view_categoria($query){

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