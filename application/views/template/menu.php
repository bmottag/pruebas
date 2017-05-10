<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="<?php echo base_url("dashboard"); ?>"><img src="<?php echo base_url("images/logo.png"); ?>" class="img-rounded" width="87" height="32" /></a>
	</div>
	<!-- /.navbar-header -->




	<ul class="nav navbar-top-links navbar-right">
		<!-- /.dropdown -->	
<?php
/**
 * Special MENU for ADMIN
 * @author BMOTTAG
 * @since  18/11/2016
 */
	$userRol = $this->session->rol;
	if($userRol==1){ //If it is an ADMIN user, show an special menu
?>				

		<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">
				<i class="fa fa-list-alt"></i> Reportes <i class="fa fa-caret-down"></i>
			</a>
			<ul class="dropdown-menu dropdown-messages">
				<li>
					<a href="<?php echo base_url("report/searchByDateRange/payrollByAdmin"); ?>"><i class="fa fa-book fa-fw"></i> Auditoria</a>
				</li>
				<li>
					<a href="<?php echo base_url("report/searchByDateRange/safety"); ?>"><i class="fa fa-life-saver fa-fw"></i> Alertas</a>
				</li>
			</ul>
		</li>

		<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">
				<i class="fa fa-gear fa-fw"></i>Configuraciones <i class="fa fa-caret-down"></i>
			</a>
			<ul class="dropdown-menu dropdown-messages">
				<li>
					<a href="<?php echo base_url("admin/users"); ?>"><i class="fa fa-users fa-fw"></i> Usuarios</a>
				</li>
								
				<li class="divider"></li>
				
				<li>
					<a href="<?php echo base_url("admin/tipo_alertas"); ?>"><i class="fa fa-ticket fa-fw"></i> Tipo de Alertas</a>
				</li>
				
				<li>
					<a href="<?php echo base_url("admin/pruebas"); ?>"><i class="fa fa-star fa-fw"></i> Pruebas</a>
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
					<a href="#">
					
					<?php if($this->session->photo){ ?>
					<img src="<?php echo base_url($this->session->photo); ?>" class="img-rounded" width="26" height="26" />
					<?php }else{?>
					<i class="fa fa-child fa-fw"></i>
					<?php } ?>
					Hi <?php echo $this->session->firstname; ?>!!!<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">

						<li>
							<a href="<?php echo base_url("employee/photo"); ?>">User Photo</a>
						</li>
						
					</ul>
					<!-- /.nav-second-level -->
				</li>
				<li>
					<a href="<?php echo base_url("dashboard"); ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
				</li>
				<li>
					<a href="#"><i class="fa fa-edit fa-fw"></i> Record Task(s)<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
						<li>
							<a href="<?php echo base_url("payroll/add_payroll"); ?>"> Payroll</a>
						</li>

						<li>
							<a href="<?php echo base_url("safety/add_safety"); ?>"> Safety</a>
						</li>

						<li>
							<a href="<?php echo base_url("hauling/add_hauling"); ?>"> Hauling</a>
						</li>
						
					</ul>
					<!-- /.nav-second-level -->
				</li>

			</ul>
		</div>
		<!-- /.sidebar-collapse -->
	</div>
	<!-- /.navbar-static-side -->
</nav>