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
	                <div class="panel-heading">Test z przedmiotu {{$subject->name}}</div>
		                <div class="panel-body">
							<table class="table" align="left" cellspacing="0" cellpadding="0">
								<?php $i=1; ?>
								<center>
		                        @foreach($questions as $question)
		                        	<a href="{{ url('test', $i) }}" class="btn btn-default"><?php echo $i;?></a>
			                        <?php $i=$i+1;?>
		                        @endforeach
								</center>
                    		</table>
                    		@if($id == 0)
                    		
                    			Właśnie rozpoczął się Twój test z przedmiotu <b>{{$subject->name}}</b>. Na jego rozwiązanie masz <b>{{$testTemplate->time}} min</b>. Przejdź do pytania wybierając je z górnego panelu lub przejdź do <a href="{{ url('test', 1) }}"><b>pierwszego pytania</b></a>     
                    	
                    		@else			
                    			
	                    		{!!  Form::open(['url'=>['test', $id],'class'=>'form-horizontal', 'method'=>"POST"]) !!}
								{!! Form::hidden('id',$id) !!}
								{!! Form::hidden('first_answer_id',$first_answer->id) !!}
								{!! Form::hidden('last_answer_id',$last_answer->id) !!}
	                   			<table class="table" align="left" cellspacing="0" cellpadding="0">
	                   				<thead>
	                   				<tr>
	                   					<th colspan="2"><center>{{$singleQuestion->question_content }}</center></th>
	                   				</tr>
		                   			</thead>
		                   			@foreach($answers as $answer)
		                   			<tr>
	                    				<td>{{$answer->answer_content}}</td>
		                    			<td>{{$answer->id}}</td>
		                    			{!! Form::hidden('answer_id',$answer->id) !!}
		                    			@if(Session::has($answer->id.'checkboxSelected'))
			                    			<td>{!! Form::checkbox($answer->id.'_isCorrect', 1 ,true) !!}</td>
			                    		@else
			                    			<td>{!! Form::checkbox($answer->id.'_isCorrect', 1) !!}</td>
		                    			@endif
		                    		</tr>
		                    		@endforeach
	                    		</table>
	                    		{!! Form::submit('Zapisz odpowiedzi',['class'=>'btn btn-primary']) !!}
	                    		{!! Form::close() !!}
	                    			<p>
	                    		@if($id > 1)
	                    			<div align="left"><a href="{{ url('test', $id-1) }}"><b>Poprzednie pytanie</b></a></div>
	                    		@endif
	                    		@if($id < $testTemplate->number_of_questions)
	                    			<div align="right"><a href="{{ url('test', $id+1) }}"><b>Następne pytanie </b></a></div>
	                    		@endif
	                    			</p>
	                    		<div align="center"><a href="{{ url('finish') }}" class="btn btn-danger"><b>Zakończ test</b></a></div>
                    		@endif

                  
						</div>
				</div>
	        </div>

	        
	</div>
</div>

@endsection