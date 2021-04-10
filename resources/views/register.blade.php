
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('/css/login.css')}}">
{{--      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">--}}
    <link rel="stylesheet" href="/fonts/material-icon/css/material-design-iconic-font.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    {{--  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>--}}
    {{--  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>--}}
</head>
<body>

{{--<div class="container-fluid bg-light mt-5 " style="height: 100%">--}}
{{--  <h2 class="text-center">Login form</h2>--}}
{{--  <form class="container" method="post" action="{{route('post_login')}}">--}}
{{--      @csrf--}}
{{--    <div class="form-group">--}}
{{--      <label for="email">Email:</label>--}}
{{--      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">--}}
{{--    </div>--}}
{{--    <div class="form-group">--}}
{{--      <label for="password">Password:</label>--}}
{{--      <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">--}}
{{--    </div>--}}
{{--    <div class="form-group form-check">--}}
{{--      <label class="form-check-label">--}}
{{--        <input class="form-check-input" type="checkbox" name="remember"> Remember me--}}
{{--</label>--}}
{{--    </div>--}}
{{--    <button type="submit" class="btn btn-primary">Submit</button>--}}
{{--  </form>--}}
{{--</div>--}}
<div class="main">
    <!-- Sign up form -->
    <section class="signup">
        <div class="container">
            <div class="signup-content">
                <div class="signup-form">
                    <h2 class="form-title">Sign up</h2>
                    <div class="col-xl-12 col-md-12">
                        @if(session('message'))
                            <div class="" style="color: red">
                                {{session('message')}}
                            </div>
                        @endif
                    </div>
                    <form method="POST" action="{{route('post_register')}}" class="register-form" id="register-form">
                        @csrf
                        <div class="form-group">
                            <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="name" id="name" placeholder="Your Name"/>
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-email"></i></label>
                            <input type="email" name="email" id="email" placeholder="Your Email"/>
                        </div>
                        <div class="form-group">
                            <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" id="password" placeholder="Password"/>
                        </div>
                        <div class="form-group">
                            <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                            <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password"/>
                        </div>

                        <div class="form-group form-button">
                            <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                        </div>
                    </form>
                </div>
                <div class="signup-image">
                    <figure><img src="/images/0.jpg" alt="sing up image"></figure>
                    <a href="{{route('login')}}" class="signup-image-link">I am already member</a>
                </div>
            </div>
        </div>
    </section>


</div>
</body>
</html>
