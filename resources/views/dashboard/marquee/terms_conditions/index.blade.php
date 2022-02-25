@extends('layouts.dashboard')
@section('page_title',$page_title)
@section('innerStyleSheet')
@endsection
@section('content')

    @include('includes.dashboard-breadcrumbs')
    @section('body')
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                        @include('includes.messages')  <!--ALert Message--->
                            <div class="card-body">
                                {!! Form::model($model, ['route' => ['dashboard.marquee.terms.update', $model->id], 'method' => 'PUT', 'files' => true] ) !!}
                                <div class="row">
                                    <div class="col-md-3 input-group">
                                        <div class="col-sm-2">
                                            <input type="checkbox" class="form-control" id="is_urdu" name="is_urdu" value="1"{{ $model->is_urdu ? ' checked' : '' }}>
                                        </div>
                                        {!!  Form::label('is_urdu' , 'Use Urdu Font', ['class'=>'col-form-label'])   !!}
                                    </div>
                                </div>
                                <div class="row">
                                    {!!  Html::decode(Form::label('event_terms' ,'Event Booking Terms & Conditions' ,['class'=>'col-form-label text-right']))   !!}
                                    <div class="col-md-12 form-group">
                                        {!! Form::textarea('event_terms',$model->event_terms,['id'=>'event_terms','class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    {!!  Html::decode(Form::label('stage_terms' ,'Stage & Decor Terms & Conditions' ,['class'=>'col-form-label text-right']))   !!}
                                    <div class="col-md-12 form-group">
                                        {!! Form::textarea('stage_terms',$model->stage_terms,['id'=>'stage_terms','class' => 'form-control']) !!}
                                    </div>
                                </div>
                                {!! Form::submit('Update', array('class' => 'btn btn-success ')) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('includes.dashboard-footer')
        </div>
    @endsection
@endsection
@section('innerScriptFiles')
    <script src="{{ asset('dashboard/plugins/tinymce/tinymce.min.js') }}"></script>
@endsection
@section('innerScript')
    <script>
        $(document).ready(function () {
            tinymce.init({
                selector: "textarea#event_terms",
                theme: "modern",
                height:300,
                plugins: [
                    "advlist autolink lists charmap hr anchor pagebreak spellchecker",
                    "wordcount visualblocks visualchars insertdatetime nonbreaking",
                    "save table directionality template paste textcolor colorpicker"
                ],
                toolbar: "insertdatetime file undo redo | fontsizeselect bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | ltr rtl | forecolor backcolor emoticons",
                menubar: false,
            });

            tinymce.init({
                selector: "textarea#stage_terms",
                theme: "modern",
                height:300,
                plugins: [
                    "advlist autolink lists charmap hr anchor pagebreak spellchecker",
                    "wordcount visualblocks visualchars insertdatetime nonbreaking",
                    "save table directionality template paste textcolor colorpicker"
                ],
                toolbar: "insertdatetime file undo redo | fontsizeselect bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | ltr rtl | forecolor backcolor emoticons",
                menubar: false,
            });
        });
    </script>
@endsection
