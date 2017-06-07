        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				
<?php
		$userRol = $this->session->userdata("rol");
		
		if($userRol==4){ //USUARIOS DELEGADOS
			$enlace = base_url("dashboard/delegados");
		}elseif($userRol==6){ //USUARIOS OPERADOR
			$enlace = base_url("dashboard/operador");
		}elseif($userRol==3){ //USUARIOS DELEGADOS
			$enlace = base_url("dashboard/coordinador");
		}elseif($userRol==2){ //USUARIOS DIRECTIVO
			$enlace = base_url("dashboard/directivo");
		}else{
			$enlace = base_url("dashboard");
		}
?>

		<a class="navbar-brand" href="<?php echo $enlace; ?>"><img src="<?php echo base_url("images/logo.png"); ?>" class="img-rounded" width="87" height="32" /></a>
				
            </div>
            <!-- /.navbar-header -->

		


            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->	
				
				
				
				
<?php 
if($userRol==2){ //If it is an ADMIN user, show an special menu
?>				
		<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">
				<i class="fa fa-list-alt"></i> Reportes <i class="fa fa-caret-down"></i>
			</a>
			<ul class="dropdown-menu dropdown-messages">
			
				<li>
					<a href="<?php echo base_url("report/searchBy"); ?>"><i class="fa fa-list-alt fa-fw"></i> Información Alertas - Representantes</a>
				</li>
				
			</ul>
		</li>
<?php 
}
?>
				
				
				
				
				
				
				
				
				
				
				
				
<?php 
if($userRol==1){ //If it is an ADMIN user, show an special menu
?>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-gear"></i> Configuraciones <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
				
						<li>
							<a href="<?php echo base_url("admin/users"); ?>"><i class="fa fa-users fa-fw"></i> Usuarios</a>
						</li>
						
						<li class="divider"></li>
						
						<li>
							<a href="<?php echo base_url("admin/pruebas"); ?>"><i class="fa fa-star fa-fw"></i> Pruebas</a>
						</li>

						<li>
							<a href="<?php echo base_url("admin/grupo_instrumentos"); ?>"><i class="fa fa-bullseye fa-fw"></i> Grupo Instrumentos</a>
						</li>
													
						<li class="divider"></li>

						<li>
							<a href="<?php echo base_url("admin/sitios"); ?>"><i class="fa fa-building-o fa-fw"></i> Sitios</a>
						</li>
						
						<li>
							<a href="<?php echo base_url("admin/coordinador"); ?>"><i class="fa fa-building-o fa-fw"></i> Coordinadores</a>
						</li>
						
						<li>
							<a href="<?php echo base_url("admin/operador"); ?>"><i class="fa fa-building-o fa-fw"></i> Operadores</a>
						</li>
						
						<li class="divider"></li>

						<li>
							<a href="<?php echo base_url("admin/tipo_alertas"); ?>"><i class="fa fa-ticket fa-fw"></i> Tipo de Alertas</a>
						</li>
						
						<li>
							<a href="<?php echo base_url("admin/alertas"); ?>"><i class="fa fa-bell fa-fw"></i> Alertas</a>
						</li>
						
						<li class="divider"></li>

						<li>
							<a href="<?php echo base_url("public/reportico/run.php?execute_mode=MENU&project=ICFES"); ?>"><i class="fa fa-search fa-fw"></i> Ver Listados</a>
						</li>
						
						<li class="divider"></li>
						
						<li>
							<a href="<?php echo base_url("admin/atencion_eliminar"); ?>"><i class="fa fa-ban fa-fw"></i> Eliminar Registros de la BD</a>
						</li>

                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
<?php
}
?>


<?php 
if($userRol==4){ 
?>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-warning"></i> Novedades <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
				
						<li>
							<a href="<?php echo base_url("anulaciones"); ?>"><i class="fa fa-legal fa-fw"></i> Anulaciones</a>
						</li>
						
						<li>
							<a href="<?php echo base_url("novedades/cambio_cuadernillo"); ?>"><i class="fa fa-bug fa-fw"></i> Cambio de cuadernillo</a>
						</li>
						
						<li>
							<a href="<?php echo base_url("novedades/holgura"); ?>"><i class="fa fa-download fa-fw"></i> Holguras</a>
						</li>

                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
<?php
}
?>


<?php 
if($userRol==3){//COORDINADOR 
?>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-warning"></i> Novedades <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
				
						<li>
							<a href="<?php echo base_url("anulaciones/anulaciones_coordinador"); ?>"><i class="fa fa-legal fa-fw"></i> Lista Anulaciones</a>
						</li>
						
						<li>
							<a href="<?php echo base_url("novedades/cambio_cuadernillo_coordinador"); ?>"><i class="fa fa-bug fa-fw"></i> Lista Cambio de Cuadernillo</a>
						</li>
						
						<li>
							<a href="<?php echo base_url("novedades/holgura_coordinador"); ?>"><i class="fa fa-download fa-fw"></i> Lista Holguras</a>
						</li>

                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
				
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="fa fa-list-alt"></i> Reportes <i class="fa fa-caret-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-messages">
					
						<li>
							<a href="<?php echo base_url("report/searchByCoordinador"); ?>"><i class="fa fa-list-alt fa-fw"></i> Información Alertas - Representantes</a>
						</li>
						
					</ul>
				</li>
<?php
}
?>

				<li>
					<a href="<?php echo base_url("menu/salir"); ?>"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
				</li>
				
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->



			
			
			


            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">

                        <li>
                            <a href="#"><i class="fa fa-user fa-fw"></i> <?php echo $this->session->firstname; ?></a>
                        </li>

                        <li>
							<a href="<?php echo $enlace; ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
						

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>