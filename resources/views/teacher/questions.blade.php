@extends('layouts.teacher')
@section('pageContent')
<div class="container">

    <div class="panel-body">
        @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
         @endif
    </div>


    @if(Session::has('subject_added'))
        <div class='alert alert-success panel-body'>
            {{ Session::get('subject_added') }}
        </div>
    @elseif(Session::has('category_added'))
        <div class='alert alert-success panel-body'>
            {{ Session::get('category_added') }}
        </div>
    @elseif(Session::has('answers_added'))
        <div class='alert alert-success panel-body'>
            {{ Session::get('answers_added') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Dodaj pytanie</strong>
                </div>
                
                <div class="panel-body">
                    {!!  Form::open(['url'=>'questions','class'=>'form-horizontal', 'method'=>"GET", 'url'=>action('TeacherController@addQuestion')]) !!}
                    <div class="form-group">
                        <table class="table" align="left" cellspacing="0" cellpadding="0">
                           
                            <tr>
                                <td class="col-md-8" colspan="2">Tutaj możesz dodać pytanie. Jeśli w listach rozwijanych brakuje odpowiedniego przedmiotu lub kategorii, możesz je dodać oknach znajdujących się poniżej. Podaj minimum 3 odpowiedzi, z czego co najmniej jedną prawidłową. Maksymalnie możesz podać 6 odpowiedzi, jednak nie jest to wymagane. Zbędne pola po prostu pozostaw puste.</td>
                            </tr>
                            <tr>
                                <td class="col-md-4 control-label">{!! Form::label('questionSubject','Przedmiot: ') !!}</td>
                                <td class="col-md-8">
                                    {!! Form::select('subject_id', $subjects, null, array('class' => 'subject_id')) !!}
                                </td>
                            </tr>
                            <tr>
                                <td class="col-md-4 control-label">{!! Form::label('questionCategory','Kategoria: ') !!}</td>
                                <td class="col-md-8">
                                    {!! Form::select('category_id', [null => 'Wybierz kategorie'], null, array('class' => 'category_id')) !!}
                                </td>
                            </tr>
                            <tr>
                                <td class="col-md-4 control-label">{!! Form::label('studentsGruop','Grupa studentów: ') !!}</td>
                                <td class="col-md-8">
                                    {!! Form::select('group_of_students', array('stacjonarne'=>'stacjonarne','zaoczne'=>'zaoczne', 'zaoczne,stacjonarne'=>'zaoczne+stacjonarne')) !!}
                                </td>
                            </tr>
                            <tr>
                                <td class="col-md-4 control-label">{!! Form::label('points','Punkty za pytanie: ') !!}</td>
                                    <td class="col-md-8">{!! Form::text('points',null,['class'=>'form-control']) !!}</td>
                            </tr>
                            <tr>
                                <td class="col-md-4 control-label">{!! Form::label('questionContent','Treść pytania: ') !!}</td>
                                    <td class="col-md-8">{!! Form::textarea('question_content',null,['class'=>'form-control', 'size' => '35x2']) !!}</td>
                            </tr>
                            <tr>
                                <td class="col-md-4 control-label">{!! Form::submit('Dodaj pytanie',['class'=>'btn btn-primary']) !!}</td>
                            </tr>
                            {!! Form::close() !!}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Dodaj kategorie</strong>
                </div>

                <div class="panel-body">
                    {!!  Form::open(['url'=>'questions','class'=>'form-horizontal', 'method'=>"POST", 'url'=>action('TeacherController@addCategory')]) !!}
                    <div class="form-group">
                        <table class="table" align="left" cellspacing="0" cellpadding="0">
                           
                            <tr>
                                <td colspan="2">W tym oknie możesz dodać kategorie pytań, należącą do istniejącego przedmiotu. </td>
                            </tr>
                                <td class="col-md-4 control-label">{!! Form::label('questionSubject','Przedmiot: ') !!}</td>
                                <td class="col-md-8">
                                    {!! Form::select('subject_id', $subjects, null) !!}
                                </td>
                            <tr>
                                <td class="col-md-4 control-label">{!! Form::label('categoryName','Nazwa kategorii: ') !!}</td>
                                    <td class="col-md-8">{!! Form::text('name',null,['class'=>'form-control']) !!}</td>
                            </tr>
                            <tr>
                                <td class="col-md-4 control-label">{!! Form::submit('Dodaj kategorie',['class'=>'btn btn-primary']) !!}</td>
                            </tr>
                            {!! Form::close() !!}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Dodaj przedmiot</strong>
                </div>
                <div class="panel-body">
                    {!!  Form::open(['url'=>'questions','class'=>'form-horizontal', 'method'=>"POST", 'url'=>action('TeacherController@addSubject')]) !!}
                    <div class="form-group">
                        <table class="table" align="left" cellspacing="0" cellpadding="0">
                           
                            <tr>
                                <td colspan="2">Jeśli w bazie nie ma przedmiotu,z którego chcesz zorganizować test, możesz go dodać: </td>
                            </tr>
                            <tr>
                                <td class="col-md-4 control-label">{!! Form::submit('Dodaj przedmiot',['class'=>'btn btn-primary']) !!}</td>
                                <td class="col-md-8">{!! Form::text('name',null,['class'=>'form-control']) !!}</td>
                                {!! Form::hidden('user_id', Auth::user()->id) !!}
                            </tr>
                            {!! Form::close() !!}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">

    $(document).ready(function(){

        $(document).on('change', '.subject_id', function(){
            //console.log("look");

            var sub_id=$(this).val();
            //console.log(sub_id);
            var div=$(this).parent().parent().parent();

            var op=" ";

            $.ajax({
                type:'get',
                url:'{!!URL::to('findCategory')!!}',
                data:{'id':sub_id},
                success:function(data){
                    //console.log('success');
                    //console.log(data);
                    //console.log(data.length);

                    op+='<option value="0" selected disabled> </option>';
                    for(var i=0;i<data.length;i++){
                        op+='<option value="'+data[i].id+'">'+data[i].name+'</option>';
                    }

                    div.find('.category_id').html(" ");
                    div.find('.category_id').append(op);

                },
                error:function(){

                }
            });
        });
    });

</script>

@endsection