@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('message.home') }}
@endsection

@section('main-content')
<section class="content-header">
    <h1>Productos Editar
    <small>Editar producto</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> {{ trans('Paginal') }}</li>
		<li><a href="{{ url('/admin_boleteria')}}">Boletería</a></li>
			  <li><a href="{{ url ('admin_boleteria/productos')}}">Productos</a></li>
        <li class="active"><a href="#">Editar</a></li>
    </ol>
</section>
<br>
	<div class="container-fluid spark-screen">
		<div class="row">


			@include('admin_boleteria.productos.atras')



		<div class="">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Actualizar Producto</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ url('admin_boleteria/productos/'.$producto->id)}}" method="post">
							@if (count($errors) > 0)
			            <div class="alert alert-danger">
			                <strong>Whoops!</strong> {{ trans('message.someproblems') }}<br><br>
			                <ul>
			                    @foreach ($errors->all() as $error)
			                        <li>{{ $error }}</li>
			                    @endforeach
			                </ul>
			            </div>
			        @endif

							@if(session()->has('message'))
						 	 <div class="alert alert-success alert-dismissible">
						 						 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						 						 <h4><i class="icon fa fa-check"></i> Correcto!</h4>
						 						 {{session()->get('message')}}
						 					 </div>
						  @endif

							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							{{method_field('PUT')}}
              <div class="box-body">
								<div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input style="color:#555555"  value="{{$producto->nombre}}" type="text" class="form-control" id="Input1" name="nombre" placeholder="Nombre del Producto">
                </div>

								<div class="form-group">
								 <label>Proveedor</label>
									 <select style="color:#555555" name="proveedor" class="form-control">
										 	<option value="{{$producto->producto_provedor->id}}">{{$producto->producto_provedor->name}}</option>
										 @foreach ($proveedores as $proveedor)
								 		 	<option style="color:#555555" value="{{$proveedor->id}}">{{$proveedor->name}}</option>
								 		 @endforeach
									 </select>
							 </div>


              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
            </form>
          </div>

		</div>






		</div>
	</div>
@endsection
