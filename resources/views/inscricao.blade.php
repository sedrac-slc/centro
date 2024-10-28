@extends('layouts.template')
@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
@endsection
@section('content')
    @include('menu.welcome')
    <section class="container mb-4">

    </section>
    <footer class="text-center text-lg-start">
        <div class="container d-flex justify-content-center py-5">
            <button type="button" class="btn btn-warning btn-lg btn-floating mx-2">
                <i class="fab fa-facebook-f"></i>
            </button>
            <button type="button" class="btn btn-warning btn-lg btn-floating mx-2">
                <i class="fab fa-youtube"></i>
            </button>
            <button type="button" class="btn btn-warning btn-lg btn-floating mx-2">
                <i class="fab fa-instagram"></i>
            </button>
            <button type="button" class="btn btn-warning btn-lg btn-floating mx-2">
                <i class="fab fa-twitter"></i>
            </button>
        </div>
        <div class="text-center text-white p-2 bg-warning">
            &copy; {{ date('Y') }} Copyright:
            <a class="text-white" href="#">CentroSmarth</a>
        </div>
    </footer>
@endsection
