@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{--                    {{ __('You are logged in!') }}--}}
                        @if(session()->has('post-success'))
                            <div class="alert alert-success">
                                {{session()->get('post-success')}}
                            </div>
                        @endif
                        <div class="row">
                            @foreach($posts as $post)

                                <div class="col-10 bg-dark text-white">
                                    {{$post->post}}<br>
                                </div>

                                <div class="col-2">
                                    <button id="edit-btn{{$post->id}}" class="edit-btn btn btn-info">Edit</button>
                                    <button class="btn btn-danger">x</button>
                                </div>

                            @endforeach
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $.('.edit-btn').click(function () {
            // alert('edit');
        });
    </script>
@endpush
