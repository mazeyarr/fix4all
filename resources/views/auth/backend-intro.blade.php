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
    @elseif(Session::has('success'))
        <div class="row">
            <div class="col-md-10 col-md-push-1">
                <div class="alert alert-success">
                    <strong>Success!</strong> {{ Session::get('success') }}
                </div>
            </div>
        </div>
        <hr>
    @endif
    <div class="row">
        <div class="col-md-10 col-md-push-1">
            {{ Form::open(['route' => 'user_intro_save', 'id' => 'form']) }}
            <div class="form-group">
                {!! Form::textarea('intro', $intro, ['id' => 'intro', 'class' => 'form-control', 'placeholder' => 'Intro', 'style' => 'display:none;']) !!}
                <div id="editor"></div>
            </div>
            <button id="btnSaveIntro" class="btn btn-success btn-block" data-form="form-upload">Opslaan</button>
            {{ Form::close() }}
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {

            $('#editor').summernote('code',  $('#intro').val());

            $('#btnSaveIntro').click(function (e) {
                e.preventDefault();
                var form = $('#form');

                $('#intro').val($('#editor').summernote('code'));

                form.submit();
            });
        })
    </script>
@endsection