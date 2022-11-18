@section('title')
    Login Page
@endsection

@include('layouts._top')
<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center" style="margin-top: 220px;">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                </div>
                                <form class="user" method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" name="email" id="email" class="form-control form-control-user @error('email') is-invalid @enderror" value="{{ old('email') }}" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                        @error('email')  
                                            <div class="invalid-feedback font-italic mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" id="password" class="form-control form-control-user @error('password') is-invalid @enderror" placeholder="Password">
                                         @error('password')  
                                            <div class="invalid-feedback font-italic mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts._bottom')