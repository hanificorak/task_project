@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="alert alert-light text-center">
            @if (Auth::check())
                Welcome {{ Auth::user()->name }} {{ Auth::user()->surname }}
            @else
                Welcome
                <hr />
                <a href="{{ route('register') }}">Register</a> | <a href="{{ route('login') }}">Login</a>
            @endif
        </div>

        @auth
            @if (\Session::has('success'))
                <hr />

                <div class="alert alert-success">
                    <ul>
                        <li>{!! \Session::get('success') !!}</li>
                    </ul>
                </div>
            @endif
            @if (\Session::has('error'))
            <hr />

            <div class="alert alert-danger">
                <ul>
                    <li>{!! \Session::get('error') !!}</li>
                </ul>
            </div>
        @endif

            <div class="row ">
                <div class="col-12">
                    <a href="{{ route('create_post') }}"><button type="button" class="btn btn-success float-end">Create
                            Post</button></a>
                </div>
            </div>
            <hr />
            <div class="row">
                <ul class="list list-inline">
                    @foreach ($posts as $item)
                        <li class="d-flex justify-content-between">
                            <div class="d-flex flex-row align-items-center"><i class="fa fa-check-circle checkicon"></i>
                                <div class="ml-2">
                                    <a href="{{ route('post_detail', [$item->id ]) }}">
                                        <h5 class="mb-0">{{ $item->title }}</h5>
                                    </a>
                                    <div class="d-flex flex-row mt-1 text-black-50 date-time">
                                        <div><i class="fa fa-calendar-o"></i><span class="ml-2">{{ $item->sub_title }}</span>
                                        </div>
                                        <div class="ml-3"><i class="fa fa-clock-o"></i><span class="ml-2"></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-row align-items-center">
                                <div class="d-flex flex-column mr-2">
                                    <span class="date-time">{{ $item->created_at }}</span>
                                </div>
                                <i class="fa fa-ellipsis-h"></i>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endauth
    </div>
@endsection


<style>
    .icons i {
        color: #b5b3b3;
        border: 1px solid #b5b3b3;
        padding: 6px;
        margin-left: 4px;
        border-radius: 5px;
        cursor: pointer;
    }

    .activity-done {
        font-weight: 600;
    }

    .list-group li {
        margin-bottom: 12px;
    }

    .list-group-item {}

    .list li {
        list-style: none;
        padding: 10px;
        border: 1px solid #e3dada;
        margin-top: 12px;
        border-radius: 5px;
        background: #fff;
    }

    .checkicon {
        color: green;
        font-size: 19px;
    }

    .date-time {
        font-size: 12px;
    }

    .profile-image img {
        margin-left: 3px;
    }
</style>
