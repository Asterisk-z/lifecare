@inject('appConfig', 'App\Http\Controllers\Controller')

@extends('layouts.publicapp')

@section('title')

@section('content')
<?php $sessionStatus = ''; ?>
@if(session('status'))
<?php $sessionStatus = session('status'); ?>
@endif


@guest

<landing_component landing_page_header="{{ $landingPageHeader }}" landing_page_message="{{ $landingPageMessage }}" copyright_text="{{ $copyright_text }}" :checksignup="{{ $signupCheck }}" :service="{{$service}}" :user="null">
</landing_component>

@else
<landing_component landing_page_header="{{ $landingPageHeader }}" landing_page_message="{{ $landingPageMessage }}" copyright_text="{{ $copyright_text }}" :checksignup="{{ $signupCheck }}" :service="{{ $service }}" :user="{{ $user }}">
</landing_component>
@endguest

@endsection
