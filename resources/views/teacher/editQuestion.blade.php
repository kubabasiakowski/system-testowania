@extends('layouts.teacher')
@section('pageContent')
<div class="col-md-8 col-md-offset-2">
    
</div>
	<div class="container">
	    <div class="row">
	        <div class="col-md-9 col-md-offset-2">
	            <div class="panel panel-default">
	                <div class="panel-heading"><h2>Edytuj pytanie</h2></div>
		                <div class="panel-body">
							<table class="table">

								{!!  Form::open(['url'=>'allQuestions/{id}','class'=>'form-horizontal', 'method'=>"POST"]) !!}
								{!! Form::hidden('id',$question->id) !!}
								<tr>
									<td>Treść pytania: </td><td colspan="2">{{ $question->question_content }}</td>
								</tr>
								<tr>
									<td>Punkty: </td><td colspan="2">{{ $question->points }}</td>
								</tr>
								<tr>
									<td>Kategoria: </td><td colspan="2">{{ $categories->find($question->category_id)->name  }}</td>
								</tr>
								<tr>
									<td><a href="{{ url('allQuestions') }}" class="btn btn-primary">Wróć</a></td>
									<td>
		                            	{!! Form::submit('Zapisz zmiany',['class'=>'btn btn-primary']) !!}
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