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
            {{ Form::open(['route' => 'user_about_save', 'id' => 'form']) }}
            <div class="form-group">
                {!! Form::textarea('about', $about, ['id' => 'about', 'class' => 'form-control', 'placeholder' => 'Vertel wat over Fix4all', 'style' => 'display:none;']) !!}
                <div id="editor"></div>
            </div>
            <button id="btnSaveAbout" class="btn btn-success btn-block">Opslaan</button>
            {{ Form::close() }}
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {

            $('#editor').summernote('code',  $('#about').val());

            $('#btnSaveAbout').click(function (e) {
                e.preventDefault();
                var form = $('#form');

                $('#about').val($('#editor').summernote('code'));

                form.submit();
            });
        })
    </script>
@endsection