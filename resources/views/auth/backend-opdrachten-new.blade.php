@extends('layout.auth-layout')

@section('content')
    @if(!empty($errors->first()))
        @foreach ($errors->all() as $error)
            <div class="row">
                <div class="col-md-10 col-md-push-1">
                    <div class="alert alert-danger">
                        <strong>Error!</strong> {{ $error }}
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    <div class="row">
        <div class="col-md-10 col-md-push-1">
            {{Form::open(['route' => array('user_opdrachten_create_save'), 'files' => true, 'id' => 'form-upload'])}}
            <div class="form-group">
                {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Titel']) !!}
            </div>
            <div class="form-group">
                {!! Form::textarea('discription', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Omschrijving']) !!}
            </div>
            <div>
                {!! Form::textarea('discription_long', null, ['id' => 'discription-long', 'class' => 'form-control', 'style' => 'display:none;']) !!}
            </div>

            <div id="editor"></div>

            <hr>

            {{Form::label('thumbnail', 'Thumbnail Foto',['class' => 'control-label'])}}
            {{Form::file('thumbnail')}} <br>

            {{Form::label('img_before', 'Foto Voor',['class' => 'control-label'])}}
            {{Form::file('img_before')}} <br>

            {{Form::label('img_after', 'Foto Na',['class' => 'control-label'])}}
            {{Form::file('img_after')}} <br>
            <div style="margin-bottom: 5rem;">
                <button class="btn btn-success btn-block btnUploadImages" type="submit" data-form="form-upload">Opslaan</button>
            </div>
            {{Form::close()}}
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {

            $('#editor').summernote();

            $('.btnUploadImages').click(function (e) {
                e.preventDefault();
                var form = $('#' + $(this).attr('data-form'));;

                $('#discription-long').val($('#editor').summernote('code'));

                form.submit();
            });
        })
    </script>
@endsection