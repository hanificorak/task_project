@extends('layouts.app')

@section('content')


    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-group mb-0">
                    <div class="card p-4">
                        <div class="card-body">
                            <h1>Register</h1>
                            <p class="text-muted">Create new account.</p>
                            <form action="{{ route('register_save') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="col-form-label">Name:</label>
                                    <input type="text" class="form-control" name="name" required placeholder="Name" />
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Surname:</label>
                                    <input type="text" class="form-control" name="surname" required placeholder="Surname" />
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">E-Mail:</label>
                                    <input type="email" class="form-control" name="email" required placeholder="E-Mail" />
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Password:</label>
                                    <input type="password" class="form-control" name="password" required placeholder="Password" />
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Password Repeat:</label>
                                    <input type="password" class="form-control" name="password_repeat" required
                                        placeholder="Password" />
                                </div>

                                <div class="row mt-3">
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-primary px-4">Register</button>
                                    </div>
                                    <div class="col-6 text-right">

                                    </div>
                                </div>
                            </form>

                            @if (\Session::has('error'))
                            <hr />
        
                            <div class="alert alert-danger">
                                <ul>
                                    <li>{!! \Session::get('error') !!}</li>
                                </ul>
                            </div>
                        @endif
                        @if (\Session::has('success'))
                            <hr />
        
                            <div class="alert alert-success">
                                <ul>
                                    <li>{!! \Session::get('success') !!}</li>
                                </ul>
                            </div>
                        @endif
                        </div>
                    </div>
                    <div class="card text-white bg-primary py-5 d-md-down-none"
                        style="width:44%;background:#FFC107 !important">
                        <div class="card-body text-center">
                            <div>
                                <h2>Register</h2>
                                <p>Becoming a member of the system is completely free. Sign up for free. Share, comment, read posts and help people. Make sure you enter the information correctly.</p>
                                <hr/>
                                <p>
                                    Check your e-mail address after becoming a member. A verification link will appear. You can verify your account with that link.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
