<!DOCTYPE html>
<html>
<head>
    <title>Ped Mats LogIn</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

     <link rel="stylesheet" href="{{asset('theme/vendor/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('theme/styles/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('theme/styles/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('theme/styles/animate.css')}}">
    <link rel="stylesheet" href="{{asset('theme/styles/sublime.css')}}">


    <style type="text/css">
        .box{
            width:600px;
            margin:0 auto;

}
.overlay {


    bottom: 0;
    left: 0;
    right: 0;
    opacity: 0.95;
    filter: alpha(opacity=95);
    z-index: 0;
}


    </style>

</head>
<body>

    <body class="bg-primary">

    <div class="cover" style="background-image: url({{asset('images/bg.jpg')}})"></div>



<br />
<div class="container box">
    <h3 align="center">Vuesik  Login</h3><br />


    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ url('/admin/checklogin') }}">
        {{ csrf_field() }}
        <div class="form-group">
            <label>Enter Email</label>
            <input type="email" name="email" class="form-control" />
        </div>
        <div class="form-group">
            <label>Enter Password</label>
            <input type="password" name="password" class="form-control" />
        </div>
        <div class="form-group">
            <input type="submit" name="login" class="btn btn-primary" value="Login" />
        </div>
    </form>
</div>
</body>
</html>
