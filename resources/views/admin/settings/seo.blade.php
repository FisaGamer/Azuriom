@extends('admin.layouts.admin')

@section('title', trans('admin.settings.seo.title'))

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.settings.update-seo') }}" method="POST">
                @csrf

                <div class="form-group mb-0">
                    <label for="keyInput">{{ trans('admin.settings.seo.google-analytics') }}</label>
                    <input type="text" class="form-control @error('g-analytics-id') is-invalid @enderror" id="keyInput" name="g-analytics-id" placeholder="UA-XXXXXXXX-1" value="{{ old('g-analytics-id', setting('g-analytics-id', '')) }}">

                    @error('g-analytics-id')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror

                    <small>@lang('admin.settings.seo.google-analytics-info')</small>
                </div>

                <div class="form-group">
                    <label for="keywordsInput">{{ trans('admin.settings.seo.meta') }}</label>
                    <input type="text" class="form-control @error('keywords') is-invalid @enderror" id="keywordsInput" name="keywords" placeholder="word1, word2" value="{{ old('keywords', setting('keywords', '')) }}">
                    <small>{{ trans('admin.settings.seo.meta-info') }}</small>

                    @error('keywords')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="htmlHeadArea">{{ trans('admin.settings.seo.html-head-code') }}</label>
                    <textarea class="form-control @error('html-head') is-invalid @enderror" id="htmlHeadArea" name="html-head" rows="4">{{ old('html-head', $htmlHead) }}</textarea>

                    @error('html-head')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="htmlBodyArea">{{ trans('admin.settings.seo.html-body-code') }}</label>
                    <textarea class="form-control @error('html-body') is-invalid @enderror" id="htmlBodyArea" name="html-body" rows="4">{{ old('html-body', $htmlBody) }}</textarea>

                    @error('html-body')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror

                    <small>{{ trans('admin.settings.seo.html-code-info') }}</small>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> {{ trans('messages.actions.save') }}
                </button>
            </form>
        </div>
    </div>
@endsection
