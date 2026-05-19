@extends('frontend.master')

@section('content')

<x-frontend.hero-slider :sliders="$all_slider" />

@include('frontend.section.feature')

@include('frontend.section.category')

@include('frontend.section.about')

@include('frontend.section.course-area-first')

@include('frontend.section.course-area')

<x-frontend.why-choose-us />

@include('frontend.section.funfact')

<x-frontend.instructors />

@include('frontend.section.client-logo-area')

@include('frontend.section.cta')

@include('frontend.section.testmonial')

@include('frontend.section.register-area')

@include('frontend.section.blog')

@include('frontend.section.subscribe')

@endsection
