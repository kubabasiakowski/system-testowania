@extends('layouts.admin')
@section('pageContent')
	<div class="container">
	    <div class="row">

	    	@if(Session::has('user_deleted'))
				<div class='aler alert-success container panel-heading col-md-10 col-md-offset-1'>
					{{ Session::get('user_deleted') }}
				</div>
			@endif

	        <div class="col-md-10 col-md-offset-1">
	            <div class="panel panel-default">
	                <div class="panel-heading"><strong><h3>Użytkownicy</h3></strong></div>
	                	<div class="row">
    						<div class="col-md-8 col-md-offset-1">
        						<div class="card">
            						<div class="panel-body">
            							<!-- Formularz -->
            							{!!  Form::open(['url'=>'allUsers','class'=>'form-horizontal', 'method'=>"GET", 'url'=>action('AdminController@searchUser')]) !!}
            		
            							<div class="form-group">
            								<table class="table" align="left" cellspacing="0" cellpadding="0">
            									<tr>
		                        					<td class="col-md-4 control-label">
		                        						{!! Form::label('search','Szukaj użytkownika przez: ') !!}
		                        					</td>
		                        					<td>
		                            					{!! Form::select('searchBy', array('1'=>'Nazwisko','2'=>'Numer indeksu', '3'=>'E-mail')) !!}
		                        					</td>
		                        					<td>
		                            					{!! Form::text('search',null,['class'=>'form-control']) !!}
		                        					</td>
		                        					<td>
		                            					{!! Form::submit('Szukaj',['class'=>'btn btn-primary', 'onclick'=>route('searchUser')]) !!}
		                        					</td>
	                        					</tr>
                    						</table>
                    					</div>
                    					{!! Form::close() !!}

                    					<?php
	                						$i=0;
	                					?>

                    					<table class="table" width="808" align="left" height="198" valign="top" cellspacing="0" cellpadding="0" >
											<thead>
												<th><b>Lp</b></th>
												<th><b>ID użytkownika</b></th>
												<th><b><b>Imię</b></th>
												<th><b>Nazwisko</b></th>
												<th><b>Status konta</b></th>
												<th><b>Adres E-mail</b></th>
												<th><b>Nr Indeksu</b></th>
												<th><b></b></th>
											</thead>

											<tbody>
											@foreach($users as $user)
										    <!-- Single user -->
											<tr>
												<td><?php $i=$i+1; echo $i; ?></td>
												<td>{{ $user->id }}</td>
												<td>{{ $user->name }}</td>
												<td>{{ $user->surname }}</td>
												<td>{{ $user->status }}</td>
												<td>{{ $user->email }}</td>
												<td>{{ $user->index_number }}</td>
												<td>@if($user->is_active=='true'){{'Aktywne'}}@else{{'Niektywne'}}@endif</td>
												<td><a href="{{ url('allUsers', $user->id) }}" class="btn btn-primary">
			                                    Zarządzaj
			                                </a></td>
											</tr>

											@endforeach
											</tbody>
										</table>

										<div class="text-center">
											{!! $users->links(); !!}
										</div>

            						</div>
        						</div>
    						</div>
						</div>
		        </div>
		    </div>
		</div>
	</div>
@endsection