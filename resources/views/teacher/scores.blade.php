@extends('layouts.teacher')
@section('pageContent')
	<div class="container">
	    <div class="row">
	    	@if(Session::has('question_deleted'))
				<div class='aler alert-success container panel-heading col-md-10 col-md-offset-1'>
					{{ Session::get('question_deleted') }}
				</div>
			@endif
	        <div class="col-md-10 col-md-offset-1">
	            <div class="panel panel-default">
	                <div class="panel-heading"><strong><h3>Wyniki</h3></strong></div>
	                	<div class="row">
    						<div class="col-md-8 col-md-offset-1">
        						<div class="card">
            						<div class="panel-body">
            					
            						{!!  Form::open(['url'=>'scores','class'=>'form-horizontal', 'method'=>"GET", 'url'=>action('TeacherController@searchTest')]) !!}
            							<div class="form-group">
            								<table class="table" align="left" cellspacing="0" cellpadding="0">
            									<tr>
		                        					<td class="col-md-4 control-label">
		                        						{!! Form::label('search','Szukaj pytania przez: ') !!}
		                        					</td>
		                        					<td>
		                            					{!! Form::select('searchBy', array('1'=>'Nazwisko','2'=>'Przedmiot', '3'=>'Ocena')) !!}
		                        					</td>
		                        					<td>
		                            					{!! Form::text('search',null,['class'=>'form-control']) !!}
		                        					</td>
		                        					<td>
		                            					{!! Form::submit('Szukaj',['class'=>'btn btn-primary', 'onclick'=>route('searchTest')]) !!}
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
												<th><b>Imie</b></th>
												<th><b>Nazwisko</b></th>
												<th><b>Przedmiot</b></th>
												<th><b>Ocena</b></th>
												<th><b>Liczba punktów</b></th>
												<th><b></b></th>
											</thead>

											<tbody>
											@foreach($tests as $test)
										    <!-- Single user -->
											<tr>
												<td><?php $i=$i+1; echo $i; ?></td>
												<td>{{ $test->user->name }}</td>
												<td>{{ $test->user->surname }}</td>
												<td>{{ $test->test_template->subject->name }}</td>
												<td>{{ $test->mark }}</td>
												<td>{{ $test->points }}</td>
											</tr>

											@endforeach
											</tbody>
										</table>

										<div class="text-center">
											{!! $tests->links(); !!}
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