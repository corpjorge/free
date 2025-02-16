<?php
function current_page($url = '/'){
  return request()->path() == $url;
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CoopFon 2 | Documentación</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{ asset('lte/bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('lte/dist/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{ asset('lte/dist/css/skins/_all-skins.min.css')}}">
		<link rel="stylesheet" href="{{ asset('lte/style.css')}}">

    <!-- <link rel="stylesheet" href="style.css"> -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-blue fixed" data-spy="scroll" data-target="#scrollspy">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <!-- Logo -->
        <a href="{{url('admin_home')}}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>C</b>F</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Coop</b>Fon</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <div class="sidebar" id="scrollspy">

          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="nav sidebar-menu">
            <li class="header">TABLA DE CONTENIDO</li>
            <li class="active"><a href="#introduction"><i class="fa fa-circle-o"></i> INTRODUCCIÓN</a></li>
						@if (Auth::guard("admin_user")->user())
              @if(Auth::guard('admin_user')->user()->role_id == '2' OR Auth::guard('admin_user')->user()->role_id == '1')
                  @foreach ($menu_admins as $menu_admin)
                    @if ($menu_admin->estado->id == '1' )
						        <li class="treeview
                    <?php
                      foreach ($menu_admin_subs as $menu_admin_sub)
                        {
                          if ($menu_admin_sub->menu_admin_id == $menu_admin->area_admin_id){
                            if (current_page($menu_admin_sub->ruta)){
                                echo ' active ';
                              }
                          }
                        }
                    ?>"
                     id="scrollspy-components">
						          <a href="javascript:void(0)"><i class="fa {{$menu_admin->icono}}"></i> {{$menu_admin->area_admin->name}}</a>
						          <ul class="nav treeview-menu">
												@foreach ($menu_admin_subs as $menu_admin_sub)
													@if ($menu_admin_sub->estado->id == '1' )
														@if ($menu_admin_sub->menu_admin_id == $menu_admin->area_admin_id)
								            <li class="{{ current_page('#'.$menu_admin_sub->ruta) ? 'active': '' }}"><a href="#{{$menu_admin_sub->ruta}}">{{$menu_admin_sub->areas_item_admin->name}}</a></li>
														@endif
													@endif
												@endforeach
						          </ul>
						        </li>
										@endif
	              @endforeach
            		<li><a href="#license"><i class="fa fa-copyright"></i> LICENCIA</a></li>
	            @else


							@foreach ($adminpermisos as $adminpermiso)
	              @foreach ($menu_admins as $menu_admin)
	                @if ($menu_admin->estado->id == '1' )
	                  @if ($adminpermiso->permiso_area_admin->id == $menu_admin->id )
							        <li class="treeview <?php
                        foreach ($menu_admin_subs as $menu_admin_sub)
                          {
                            if ($menu_admin_sub->menu_admin_id == $menu_admin->area_admin_id){
                              if (current_page($menu_admin_sub->ruta)){
                                  echo ' active ';
                                }
                            }
                          }
                      ?>" id="scrollspy-components">
							          <a href="javascript:void(0)"><i class="fa {{$menu_admin->icono}}"></i> {{$menu_admin->area_admin->name}}</a>
							          <ul class="nav treeview-menu">
													@foreach ($menu_admin_subs as $menu_admin_sub)
														@if ($menu_admin_sub->estado->id == '1' )
															@if ($menu_admin_sub->role_id > Auth::guard('admin_user')->user()->role_id )
																@if ($menu_admin_sub->menu_admin_id == $menu_admin->area_admin_id)
										            <li class="{{ current_page('#'.$menu_admin_sub->ruta) ? 'active': '' }}"><a href="#{{$menu_admin_sub->ruta}}">{{$menu_admin_sub->areas_item_admin->name}}</a></li>
																@endif
															@endif
														@endif
													@endforeach
							          </ul>
							        </li>
											@endif
		                @endif
		              @endforeach
		            @endforeach
            		<li><a href="#license"><i class="fa fa-copyright"></i> LICENCIA</a></li>
		           @endif

@endif



          </ul>
        </div>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <h1>
           CoopFon Documentación
            <small>Version 2.2</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{url('admin_home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Documentación</li>
          </ol>
        </div>

        <!-- Main content -->
        <div class="content body">

			<section id="introduction">
			  <h2 class="page-header"><a href="#introduction">Introduction</a></h2>
			  <p class="lead">
			    <b>CoopFon</b> es una aplicación web destinada a suplir las necesidades
					 de comunicación de las cooperativas o fondos hacia los asociados, con el fin de
					 mantener una fiel integridad entre ciertas solicitudes que se requieren por parte
					 de los asociados, además la posibilidad de realizar dichas solicitudes en línea
					 para la disponibilidad y agilidad de los servicios que ofrece la entidad.
			  </p>
			</section>



			@if (Auth::guard("admin_user")->user())
				@if(Auth::guard('admin_user')->user()->role_id == '2' OR Auth::guard('admin_user')->user()->role_id == '1')
						@foreach ($menu_admins as $menu_admin)
							@if ($menu_admin->estado->id == '1' )
							<section id="components" data-spy="scroll" data-target="#scrollspy-components">
								<h2 id="{{$menu_admin->ruta}}" class="page-header"><a href="#{{$menu_admin->ruta}}">{{$menu_admin->area_admin->name}}</a></h2>
									@foreach ($menu_admin_subs as $menu_admin_sub)
										@if ($menu_admin_sub->estado->id == '1' )
											@if ($menu_admin_sub->menu_admin_id == $menu_admin->area_admin_id)

												<h3 id="{{$menu_admin_sub->ruta}}">	{{$menu_admin_sub->areas_item_admin->name}}</h3>

												<?php
												$menu = strtolower($menu_admin->area_admin->name);
												$menusub = strtolower($menu_admin_sub->areas_item_admin->name);
												?>

												@include("admin.manual.$menu.$menusub")

											@endif
										@endif
									@endforeach
								</section>
							@endif
					@endforeach


				@else


				@foreach ($adminpermisos as $adminpermiso)
					@foreach ($menu_admins as $menu_admin)
						@if ($menu_admin->estado->id == '1' )
							@if ($adminpermiso->permiso_area_admin->id == $menu_admin->id )
							<section id="components" data-spy="scroll" data-target="#scrollspy-components">
								<h2 id="{{$menu_admin->ruta}}" class="page-header"><a href="#{{$menu_admin->ruta}}">{{$menu_admin->area_admin->name}}</a></h2>
										@foreach ($menu_admin_subs as $menu_admin_sub)
											@if ($menu_admin_sub->estado->id == '1' )
												@if ($menu_admin_sub->role_id > Auth::guard('admin_user')->user()->role_id )
													@if ($menu_admin_sub->menu_admin_id == $menu_admin->area_admin_id)
													<h3 id="{{$menu_admin_sub->ruta}}">	{{$menu_admin_sub->areas_item_admin->name}}</h3>


														<?php
														$menu = strtolower($menu_admin->area_admin->name);
														$menusub = strtolower($menu_admin_sub->areas_item_admin->name);
														?>

														@include("admin.manual.$menu.$menusub")


													@endif
												@endif
											@endif
										@endforeach
									</section>
								@endif
							@endif
						@endforeach
					@endforeach

				 @endif

@endif



<section id="license">
	<h2 class="page-header"><a href="#license">License</a></h2>
	<h3>CoopFon</h3>
	<p class="lead">
		Texto de licencia.
	</p>
</section>




        </div><!-- /.content -->
      </div><!-- /.content-wrapper -->

			<footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Versión</b> 2.2
        </div>
        <strong>Copyright &copy; 2017 <a href="http://fyclsingenieria.com">fyclsingenieria.com</a>.</strong> All rights reserved.
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <div class="pad">
          -
        </div>
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>

      <!-- Control Sidebar -->

      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->


    </div><!-- ./wrapper -->
    <!-- jQuery 2.2.3 -->
		<script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="{{ asset('lte/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{ asset('plugins/fastclick/fastclick.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('lte/app.js') }}" type="text/javascript"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
    <script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>
    <script src="{{ asset('lte/docs.js') }}"></script>
  </body>
</html>
