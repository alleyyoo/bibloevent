@extends('layouts.app')

@section('layouts.app.section')
    @include('components.slider.index')
    @include('components.projects.index')
    @include('components.references.index')
    <div id="teams">
        @include('components.teams.index')
    </div>
    <div id="contact">
        @include('components.contact.index')
    </div>
@endsection