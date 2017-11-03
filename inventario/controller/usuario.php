<?php 

	class Usuario{

		private $db_;

		public function __construct($db){

			$this->db_ =  $db;

		}


		public function login($usuario,$contrasena){

			$stmt = $this->db_->prepare("SELECT usuario.usuario,usuario.contrasena,usuario.estado,usuario.privilegio,responsable.nombre,responsable.id FROM usuario,responsable WHERE usuario.id_r = responsable.id AND (usuario=:usuario AND contrasena=sha1(:contrasena))");
			$stmt->bindparam(":usuario",$usuario);
			$stmt->bindparam(":contrasena",$contrasena);
			$stmt->execute();

			if($stmt->rowCount()>0){

				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				return $row;

			}else{

				printf('<script type="text/javascript">alert("Usuario u contraseña incorrecta. Intentelo nuevamente.")</script>');
			}

		}

		public function registrar_user($usuario,$contrasena,$estado,$privilegio,$responsable){

			try {

				$stmt = $this->db_->prepare("SELECT * FROM responsable");
				$stmt->execute();

				if($stmt->rowCount()>0){

					$stmt = $this->db_->prepare("INSERT INTO usuario(usuario,contrasena,estado,privilegio,id_r) VALUES (:usuario,sha1(:contrasena),:estado,:privilegio,:id_r)");
					$stmt->bindparam(":usuario",$usuario);
					$stmt->bindparam(":contrasena",$contrasena);
					$stmt->bindparam(":estado",$estado);
					$stmt->bindparam(":privilegio",$privilegio);
					$stmt->bindparam(":id_r",$responsable);
					$stmt->execute();
					return true;

				}else{

					printf('<script type="text/javascript">alert("Debe registrar un responsable previamente. Gracias.")</script>');

				}
					
				
			} catch (Exception $e) {

				echo "Error en: ".$e->getMessage();

			}

		}

		public function logout(){

			session_unset();
			header("Location:../../index.php");

		}

		public function logout_admin(){

			session_unset();
			header("Location:../index.php");

		}

		public function logout_user(){

			session_unset();
			header("Location:../index.php");

		}

		public function view_responsable(){
			$stmt = $this->db_->prepare("SELECT * FROM responsable");
			$stmt->execute();
			if($stmt->rowCount()>0){
				while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) { ?>
				<option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
			  <?php	}
			}
		}

		public function view_register($query){

			$stmt =  $this->db_->prepare($query);
			$stmt->execute();
			if($stmt->rowCount()>0){

				while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) { ?>
					<tr>
					      <th scope="row" style="text-align: center;"><?php if(isset($row['id'])){ echo $row['id']; }else{ echo "-";} ?></th>
					      <td style="text-align: center;"><?php if(isset($row['usuario'])){ echo $row['usuario']; }else{ echo "-";} ?></td>
					      <td style="text-align: center;"><?php if(isset($row['estado'])){ echo $row['estado']; }else{ echo "-";} ?></td>
					      <td style="text-align: center;"><?php if(isset($row['privilegio'])){ echo $row['privilegio']; }else{ echo "-";} ?></td>
					      <td style="text-align: center;"><?php if(isset($row['id_r'])){ echo $row['id_r']; }else{ echo "-";} ?></td>
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