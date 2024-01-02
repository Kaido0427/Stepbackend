@extends('layouts.app', ['title' => __('FAQ')],['activePage' => 'faq'])

@section('content')
@include('layouts.headers.header',
array(
'class'=>'info',
'title'=>"FAQ",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([
'text'=>'FAQ'
],['text'=>'Edit Detail'])))


<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-12 text-right">
                            <a href="{{ route('faq.index') }}" class="btn btn-sm btn-primary">{{ __('Retour à la liste') }}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('faq.update', $faq) }}" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group{{ $errors->has('question') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="question">{{ __('Question') }}</label>
                            <input type="text" name="question" id="input-name" class="form-control form-control-alternative{{ $errors->has('question') ? ' is-invalid' : '' }}" placeholder="{{ __('question') }}" value="{{ old('question',$faq->question) }}" autofocus required>

                            @if ($errors->has('question'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('question') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('answer') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="answer">{{ __('Reponse') }}</label>
                            <textarea name="answer" class="form-control form-control-alternative{{ $errors->has('answer') ? ' is-invalid' : '' }}" cols="30" rows="7">{{$faq->answer}}</textarea>

                            @if ($errors->has('answer'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('Reponse') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mt-4 rtl_btn">{{ __('Sauvegarder') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection