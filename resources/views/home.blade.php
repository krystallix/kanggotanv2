@extends('layout.main')

@section('content')
<div class="banner-area banner-2">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 m-auto text-center col-sm-12 col-md-12">
                        <div class="banner-content content-padding">
                            <h1 class="banner-title">RISMA KANGGOTAN LOR</h1>
                            <blockquote class="blockquote">
                                <p class="mb-0" id='kutipan-ayat'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                                <footer class="my-2 blockquote-footer text-white fst-italic" id='kutipan-surah'></footer>
                              </blockquote>
                            <a href="#" class="btn btn-white btn-circled">lets start</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('single-page-js')
<script src="{{asset('js/login.js')}}"></script>
<script src="{{asset('js/home.js')}}"></script>
@endsection