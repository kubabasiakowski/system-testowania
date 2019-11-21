@extends('layouts.admin')
@section('pageContent')
<div class="col-md-8 col-md-offset-2">
    
</div>
	<div class="container">
	    <div class="row">

	    	@if(Session::has('admin_status_error'))
	    		<div class='aler alert-danger container panel-heading col-md-9 col-md-offset-2'>
	    			{{ Session::get('admin_status_error') }}
	    		</div>
	    	@elseif(Session::has('user_status_changed'))
	    		<div class='aler alert-success container panel-heading col-md-9 col-md-offset-2'>
	    			{{ Session::get('user_status_changed') }}
	    		</div>
	    	@elseif(Session::has('admin_delete_error'))
	    		<div class='aler alert-danger container panel-heading col-md-9 col-md-offset-2'>
	    			{{ Session::get('admin_delete_error') }}
	    		</div>
	    	@endif

	        <div class="col-md-9 col-md-offset-2">
	            <div class="panel panel-default">
	                <div class="panel-heading"><h2>Użytkownik {{ $user->surname }} {{ $user->name }}</h2></div>
		                <div class="panel-body">
							<table class="table">

								{!!  Form::open(['url'=>'allUsers/{id}','class'=>'form-horizontal', 'method'=>"POST"]) !!}
								{!! Form::hidden('id',$user->id) !!}
								<tr>
									<td>Imię: </td><td colspan="2">{{ $user->name }}</td>
								</tr>
								<tr>
									<td>Nazwisko: </td><td colspan="2">{{ $user->surname }}</td>
								</tr>
								<tr>
									<td>ID: </td><td colspan="2">{{ $user->id }}</td>
								</tr>
								<tr>
									<td>Adres E-Mail: </td><td colspan="2">{{ $user->email }}</td>
								</tr>
								<tr>
									<td>Login: </td><td colspan="2">{{ $user->login }}</td>
								</tr>
								<tr>
									<td>Numer indeksu: </td><td colspan="2">{{ $user->index_number }}</td>
								</tr>
								<tr>
									<td>Status konta: </td><td colspan="2">
										{!! Form::select('status', array('student'=>'student','prowadzacy'=>'prowadzący', 'administrator'=>'administrator'), [$user->status] ) !!}
									</td>
								</tr>
								<tr>
									<td>Aktywność konta: </td><td colspan="2">{!! Form::select('is_active', array('true'=>'aktywne','false'=>'nieaktywne'), [$user->is_active] ) !!}</td>
								</tr>
								<tr>
									<td><a href="{{ url('allUsers') }}" class="btn btn-primary">Wróć</a></td>
									<td>
		                            	{!! Form::submit('Zapisz zmiany',['class'=>'btn btn-primary']) !!}
		                            	{!! Form::close() !!}
		                        	</td>
		                        	<td>
		                				{!!  Form::open(['url'=>'deleteUser','class'=>'form-horizontal', 'method'=>"POST"]) !!}
										{!! Form::hidden('id',$user->id) !!}
										{!! Form::submit('Usuń użytkownika',['class'=>'btn btn-danger']) !!}
		                        		<!--<a href="{{action('AdminController@deleteUser')}}" class="btn btn-danger">Usuń użytkownika</a>-->
		                        		{!! Form::close() !!}
		                        	</td>
								</tr>

								

							</table>
						</div>
				</div>
	        </div>
	    </div>
	</div>
</div>
@endsection