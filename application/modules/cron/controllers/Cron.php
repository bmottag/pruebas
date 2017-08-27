<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends MX_Controller {
	
    public function __construct() {
        parent::__construct();
		$this->load->model("cron_model");
    }
	
	/**
	 * Controlador para delegados
	 */
	public function index()
	{	
			
			$arrParam = array();
			$infoAlerta = $this->cron_model->get_alerta_email($arrParam);
			


			$subjet = "Alertas - Coltrol operativo ICFES";				

if($infoAlerta){
		foreach ($infoAlerta as $lista):					
				
					if($lista['fk_id_rol']==4){
						$user = $lista["representante"];
						$to = $lista["email_representante"];
					}else{
						$user = $lista["operador"];
						$to = $lista["email_operador"];
					}

					//mensaje del correo
					$msj = "<strong>Sitio:</strong>" . $lista['nombre_sitio'];
					$msj .= "<br><strong>Código DANE:</strong>" . $lista['codigo_dane'];
					$msj .= "<br><strong>Departamento:</strong>" . $lista['dpto_divipola_nombre'];
					$msj .= "<br><strong>Municipio:</strong>" . $lista['mpio_divipola_nombre'];
					$msj .= "<br><strong>Tipo de Alerta:</strong>" . $lista['nombre_tipo_alerta'];
					$msj .= "<br><strong>Mensaje Alerta: </strong>" . $lista["mensaje_alerta"];
					$msj .= "<br><strong>Nombre de Prueba: </strong>" . $lista["nombre_prueba"];
					$msj .= "<br><strong>Grupo Instrumentos: </strong>" . $lista["nombre_grupo_instrumentos"];
					$msj .= "<br><strong>Fecha: </strong>" . $lista["fecha"];
					$msj .= "<br><strong>Sesión Prueba: </strong>" . $lista["sesion_prueba"];
					
					$mensaje = "<html>
					<head>
					  <title> $subjet </title>
					</head>
					<body>
						<p>Señor(a)	$user:</p>
						<p>$msj</p>
						<p>Cordialmente,</p>
						<p><strong>Administrador aplicativo de Control Operativo pruebas ICFES</strong></p>
					</body>
					</html>";

					if($user){
		
						$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
						$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						$cabeceras .= 'To: ' . $user . '<' . $to . '>' . "\r\n";
						$cabeceras .= 'From: ICFES <administrador@operativoicfes.com>' . "\r\n";

						//enviar correo
						$success = mail($to, $subjet, $mensaje, $cabeceras);
					}
					
		endforeach;
}
			
	}
	
	
	/**
	 * Controlador para enviar correo de ingreso al aplicativo por rol
	 */
	public function aplicativo($idRol)
	{				
			$this->load->model("general_model");
			$arrParam = array(
				"table" => "usuario",
				"order" => "id_usuario",
				"column" => "fk_id_rol",
				"id" => $idRol
			);
			$information = $this->general_model->get_basic_search($arrParam);
			
			$subjet = "Ingreso aplicativo - Control operativo ICFES";

			if($information){
				foreach ($information as $lista):					
					
					$user = $lista["nombres_usuario"] . " " . $lista["apellidos_usuario"];
					$to = $lista["email"];

					//mensaje del correo
					$msj = "<p>Los datos para ingresar al APP de Control Operativo Pruebas ICFES, son los siguientes:</p>";
					$msj .= "<br><strong>Usuario: </strong>" . $lista["numero_documento"];
					$msj .= "<br><strong>Contraseña: </strong>" . $lista["clave"];
					$msj .= "<br><br><strong><a href='" . base_url() . "'>Enlace Aplicación </a></strong><br>";

					
					$mensaje = "<html>
					<head>
					  <title> $subjet </title>
					</head>
					<body>
						<p>Señor(a)	$user:</p>
						<p>$msj</p>
						<p>Cordialmente,</p>
						<p><strong>Administrador aplicativo de Control Operativo pruebas ICFES</strong></p>
					</body>
					</html>";
if($lista["email"]!="grupoasd123@grupoasd.com.co" and $lista["id_usuario"]<1550 and  $lista["id_usuario"]>=1450){		
					$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
					$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					$cabeceras .= 'To: ' . $user . '<' . $to . '>' . "\r\n";
					$cabeceras .= 'From: ICFES <administrador@operativoicfes.com>' . "\r\n";

					//enviar correo
					$success = mail($to, $subjet, $mensaje, $cabeceras);
}
				endforeach;
			}
	}

	
}

