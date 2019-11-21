@extends('layouts.student')
@section('pageContent')

</div>
	<div class="container">
	    <div class="row">

	    	@if(Session::has('password_error'))
	    		<div class='aler alert-danger container panel-heading col-md-9 col-md-offset-2'>
	    			{{ Session::get('password_error') }}
	    		</div>
	    	@elseif(Session::has('is_done_error'))
        		<div class='aler alert-danger container panel-heading col-md-9 col-md-offset-2'>
            		{{ Session::get('is_done_error') }}
        		</div>
	    	@endif

	        <div class="col-md-9 col-md-offset-2">
	            <div class="panel panel-default">
	                <div class="panel-heading"><h2>Dane testu</h2></div>
		                <div class="panel-body">
							<table class="table" align="left" cellspacing="0" cellpadding="0">
		                        <tr>
		                            <td>Przedmiot:</td><td><b>{{ $subjects->find($testTemplate->subject_id)->name }}</b></td>
		                        </tr>
		                        <tr>
		                            <td>Liczba pytań:</td><td><b>{{ $testTemplate->number_of_questions }}</b></td>
		                        </tr>
		                        <tr>
		                            <td>Czas trwania:</td><td><b>{{ $testTemplate->time }}</b></td>
		                        </tr>
                    		</table>
                    		
                    			{!!  Form::open(['url'=>'availableTests/{id}','class'=>'form-horizontal', 'method'=>"POST", 'url'=>action('StudentController@createTest')]) !!}
                    			<center>
                    			<tr>
		                        	<td><b>Podaj hasło do kursu:</b></td>
									<td>{!! Form::password('testTemplatePassword',null,['class'=>'form-control']) !!}</td>
									<td>{!! Form::hidden('testID',$testTemplate->id) !!}</td>
                    				<td class="col-md-4 control-label">{!! Form::submit('Zatwierdź hasło i przejdz do testu',['class'=>'btn btn-primary']) !!}</td>
                            	</tr>
                            	{!! Form::close() !!}
                    			</center>
						</div>
				</div>
	        </div>

	        
	</div>
</div>

@endsection