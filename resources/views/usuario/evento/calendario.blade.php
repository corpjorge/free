@extends('layouts.app')

@section('htmlheader_title')
 {{ trans('message.home') }}
@endsection

<link href="{{asset('plugins/fullcalendar/fullcalendar.min.css')}}" rel='stylesheet' />
<link href="{{asset('plugins/fullcalendar/fullcalendar.print.min.css')}}" rel='stylesheet' media='print' />

@section('main-content')
<h2> &nbsp;&nbsp;En este momento no se encuentran eventos disponibles</h2><br>
	<div class="container-fluid spark-screen">
		<div class="row">
      <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-body no-padding">
                <div id='calendar'></div>
            </div>
          </div>
        </div>
		</div>
	</div>
@endsection
