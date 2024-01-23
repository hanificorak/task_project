@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-group mb-0">
                    <div class="card p-4">
                        <div class="card-body">
                            <h1>Login</h1>
                            <p class="text-muted">Sign In to your account</p>
                            <form action="{{ route('login_user') }}" method="POST">
                                @csrf
                                <div class="input-group mb-3">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="email" class="form-control" name="email" required
                                        placeholder="E-Mail" />
                                </div>
                                <div class="input-group mb-4">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input type="password" class="form-control" name="password" required
                                        placeholder="Password" />
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-primary px-4">Login</button>
                                    </div>
                                    <div class="col-6 text-right">

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card text-white bg-primary py-5 d-md-down-none"
                        style="width:44%;background:#FFC107 !important">
                        <div class="card-body text-center">
                            <div>
                                <h2>Sign up</h2>
                                <p>If you do not have an account, please register for free now and start sharing.</p>
                                <a href="{{ route('register') }}">
                                    <button type="button" class="btn btn-primary active mt-3"
                                        style="    background: white;color: black; border: none;">Register Now!</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
