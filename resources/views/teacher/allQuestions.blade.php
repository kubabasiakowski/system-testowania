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
	                <div class="panel-heading"><strong><h3>Pytania</h3></strong></div>
	                	<div class="row">
    						<div class="col-md-8 col-md-offset-1">
        						<div class="card">
            						<div class="panel-body">
            							<!-- Formularz -->
            							{!!  Form::open(['url'=>'allQuestions','class'=>'form-horizontal', 'method'=>"GET", 'url'=>action('TeacherController@searchQuestion')]) !!}
            		
            							<div class="form-group">
            								<table class="table" align="left" cellspacing="0" cellpadding="0">
            									<tr>
		                        					<td class="col-md-4 control-label">
		                        						{!! Form::label('search','Szukaj pytania przez: ') !!}
		                        					</td>
		                        					<td>
		                            					{!! Form::select('searchBy', array('1'=>'Treść','2'=>'Liczbę punktów', '3'=>'Kategorie')) !!}
		                        					</td>
		                        					<td>
		                            					{!! Form::text('search',null,['class'=>'form-control']) !!}
		                        					</td>
		                        					<td>
		                            					{!! Form::submit('Szukaj',['class'=>'btn btn-primary', 'onclick'=>route('searchQuestion')]) !!}
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
												<th><b>Treść pytania</b></th>
												<th><b>Punkty</b></th>
												<th><b>Kategoria</b></th>
												<th><b></b></th>
											</thead>

											<tbody>
											@foreach($questions as $question)
										    <!-- Single user -->
											<tr>
												<td><?php $i=$i+1; echo $i; ?></td>
												<td>{{ $question->question_content }}</td>
												<td>{{ $question->points }}</td>
												<td>{{ $categories->find($question->category_id)->name }}</td>
												<td><a href="{{ url('allQuestions', $question->id) }}" class="btn btn-danger">
			                                    Usuń
			                                </a></td>
											</tr>

											@endforeach
											</tbody>
										</table>

										<div class="text-center">
											{!! $questions->links(); !!}
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