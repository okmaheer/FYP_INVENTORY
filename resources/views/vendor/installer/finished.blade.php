@extends('vendor.installer.layouts.master')

@section('template_title')
    {{ trans('installer_messages.final.templateTitle') }}
@endsection

@section('title')
    <i class="fa fa-flag-checkered fa-fw" aria-hidden="true"></i>
    {{ trans('installer_messages.final.title') }}
@endsection

@section('container')

	<div class="container row">
		<div class="col-12">
			<h6>
				System's Default Credentials are
			</h6>
			<p>
				Username: admin@gmail.com
				<br>
				Password: 123456
			</p>
		</div>	
	</div>

	@if(session('message')['dbOutputLog'])
		<p><strong><small>{{ trans('installer_messages.final.migration') }}</small></strong></p>
		<pre><code>{{ session('message')['dbOutputLog'] }}</code></pre>
	@endif

	<p><strong><small>{{ trans('installer_messages.final.console') }}</small></strong></p>
	<pre><code>{{ $finalMessages }}</code></pre>

	<p><strong><small>{{ trans('installer_messages.final.log') }}</small></strong></p>
	<pre><code>{{ $finalStatusMessage }}</code></pre>

	<p><strong><small>{{ trans('installer_messages.final.env') }}</small></strong></p>
	<pre><code>{{ $finalEnvFile }}</code></pre>

    <div class="buttons">
        <a href="{{ url('/') }}" class="button">{{ trans('installer_messages.final.exit') }}</a>
    </div>

@endsection
