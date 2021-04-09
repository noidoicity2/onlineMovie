
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('/css/login.css')}}">
{{--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">--}}
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

    <!-- Sing in  Form -->
    <section class="sign-in">
        <div class="container">
            <div class="signin-content">
                <div class="signin-image">
                    <figure><img src="/images/12.jpg" alt="sing up image"></figure>
                    <a href="#" class="signup-image-link">Create an account</a>
                </div>

                <div class="signin-form">

                    <h2 class="form-title">Sign in</h2>
                    <form method="POST"  action="{{route('post_login')}}" class="register-form" id="login-form">
                        @csrf
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="email" id="email" placeholder="Your Name"/>
                        </div>
                        <div class="form-group">
                            <label for="password"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" id="password" placeholder="Password"/>
                        </div>
{{--                        <div class="form-group">--}}
{{--                            <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />--}}
{{--                            <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>--}}
{{--                        </div>--}}
                        <div class="form-group form-button">
                            <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>

</div>
</body>
</html>
