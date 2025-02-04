@extends('layouts.app')

@section('layouts.app.section')
    <div class="fixed-height-box"></div>
    <section class="breadcrumb-section ">
        <div class="breadcrumbs section">
            <h3>{{$page->title}}</h3>
            <ul>
                <li><a href="/">{{ __('HOME') }}</a></li>
                @foreach($breadcrumbs as $slug => $child)
                    <li><a href="{{ url($slug) }}" title="{{ $child->title }}">{{ $child->title }}</a></li>
                @endforeach
            </ul>
        </div>
    </section>

    @yield('layouts.content.section')

@endsection
