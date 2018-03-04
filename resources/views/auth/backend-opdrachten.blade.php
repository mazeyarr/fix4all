@extends('layout.auth-layout')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-push-1">
            <div class="panel panel-default">
                <div class="panel-heading">Recente opdrachten</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('user_opdrachten_create') }}" class="btn btn-block btn-info">Opdracht toevoegen</a>
                        </div>
                    </div>

                    <hr>

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
                        @foreach($projects as $project)
                        <div class="col-sm-3 sm-margin-b-50">
                            <div class="margin-b-20">
                                <div class="wow zoomIn" data-wow-duration=".3" data-wow-delay=".1s">
                                    <img class="img-responsive" src="{{ asset('uploads/thumbnails/' . $project->thumbnail) }}" alt="Latest Products Image">
                                </div>
                            </div>

                            {!! Form::open(['route' => array('user_opdrachten_save', $project->id), 'id' => 'form-'.$project->id]) !!}
                            <div class="form-group">
                                {!! Form::text('title', $project->title, ['class' => 'form-control', 'placeholder' => 'Titel']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::textarea('discription', $project->discription, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Omschrijving']) !!}
                            </div>
                            <div>
                                {!! Form::textarea('discription_long', $project->discription_long, ['id' => 'discription-long-'.$project->id, 'class' => 'form-control', 'style' => 'display:none;']) !!}
                            </div>

                            <div class="discription-editor" id="editor-{{$project->id}}"> {!! $project->discription_long !!} </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-success btn-block btnSave" id="{{$project->id}}" type="submit">Opslaan</button>
                                </div>
                            </div>
                            {!! Form::close() !!}

                            <hr>

                            {{Form::open(['route' => array('user_opdrachten_upload', $project->id), 'files' => true, 'id' => 'form-' . $project->id])}}

                            {{Form::label('thumbnail', 'Thumbnail Foto',['class' => 'control-label'])}}
                            {{Form::file('thumbnail')}} <br>

                            {{Form::label('img_before', 'Foto Voor',['class' => 'control-label'])}}
                            {{Form::file('img_before')}} <br>

                            {{Form::label('img_after', 'Foto Na',['class' => 'control-label'])}}
                            {{Form::file('img_after')}} <br>
                            <div style="margin-bottom: 5rem;">
                                <button class="btn btn-success btn-block btnUploadImages" data-form="">Afbeeldingen Uploaden</button>
                            </div>
                            {{Form::close()}}
                            <hr>

                            <a class="btn btn-danger" href="{{ route('user_opdrachten_delete', $project->id) }}">Verwijderen</a>
                        </div>
                        @endforeach
                    </div>
                    <!--// end row -->
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {

            $('.discription-editor').summernote();

            $('body').on('click', '.btnSave', function (e) {
                var btnId = e.target.id;

                var form = $('#form-' + btnId);
                var editor = $('#editor-' + btnId);

                $('#discription-long-' + btnId).val(editor.summernote('code'));

                form.submit();
            });
        })
    </script>
@endsection
