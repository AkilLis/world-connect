<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
    </head>
    <body>
        <style>
            .login-page {
              width: 360px;
              padding: 8% 0 0;
              margin: auto;
            }
            .form {
              position: relative;
              z-index: 1;
              background: #FFFFFF;
              max-width: 360px;
              margin: 0 auto 100px;
              padding: 45px;
              text-align: center;
              box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
            }
            .form input {
              font-family: "Roboto", sans-serif;
              outline: 0;
              background: #f2f2f2;
              width: 100%;
              border: 0;
              margin: 0 0 15px;
              padding: 15px;
              box-sizing: border-box;
              font-size: 14px;
            }
            .form button {
              font-family: "Roboto", sans-serif;
              text-transform: uppercase;
              outline: 0;
              background: #ff3c00;
              width: 100%;
              border: 0;
              padding: 15px;
              color: #FFFFFF;
              font-size: 14px;
              -webkit-transition: all 0.3 ease;
              transition: all 0.3 ease;
              cursor: pointer;
            }
            .form button:hover,.form button:active,.form button:focus {
              background: #e03500;
            }
            .form img {
                margin-top: -30px;
                margin-bottom: 15px;
            }
            .form .message {
              margin: 15px 0 0;
              color: #b3b3b3;
              font-size: 12px;
            }
            .form .message a {
              color: #4CAF50;
              text-decoration: none;
            }
            .container {
              position: relative;
              z-index: 1;
              max-width: 300px;
              margin: 0 auto;
            }
            .container:before, .container:after {
              content: "";
              display: block;
              clear: both;
            }
            .container .info {
              margin: 50px auto;
              text-align: center;
            }
            .container .info h1 {
              margin: 0 0 15px;
              padding: 0;
              font-size: 36px;
              font-weight: 300;
              color: #1a1a1a;
            }
            .container .info span {
              color: #4d4d4d;
              font-size: 12px;
            }
            .container .info span a {
              color: #000000;
              text-decoration: none;
            }
            .container .info span .fa {
              color: #EF3B3A;
            }
            body {
              background: #76b852; /* fallback for old browsers */
              background: -webkit-linear-gradient(right, #ff3c00, #ff5500);
              background: -moz-linear-gradient(right, #ff3c00, #ff5500);
              background: -o-linear-gradient(right, #ff3c00, #ff5500);
              background: linear-gradient(to left, #ff3c00, #ff5500);
              font-family: "Roboto", sans-serif;
              -webkit-font-smoothing: antialiased;
              -moz-osx-font-smoothing: grayscale;      
            }
        </style>
        <div class="login-page">
            <div class="form">
                <img src="{{asset('../images/logo-wc-vertical.png')}}" height="100">
                <form method="POST" action="/login" class="login-form">
                    {{ csrf_field() }}
                    <input type="text" name="email" placeholder="Нэвтрэх мэйл хаяг">
                    <input type="password" name="password" placeholder="Нууц үг">
                    <button>Нэвтрэх</button>
                </form>
                <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                      @if(Session::has('alert-' . $msg))
                        <p class="alert alert-{{ $msg }} " role = "alert">{{ Session::get('alert-' . $msg) }} 
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        </p>
                      @endif
                    @endforeach
                </div>
            </div>
        </div>

        <!-- <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    World Connect
                </div>


                <form method="POST" action="/login" class="form-group">
                    {{ csrf_field() }}
                    <input type="text" name="email" class="form-control">
                    <input type="password" name="password" class="form-control">
                    <button>Нэвтрэх</button>
                </form>
                <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                      @if(Session::has('alert-' . $msg))
                        <p class="alert alert-{{ $msg }} " role = "alert">{{ Session::get('alert-' . $msg) }} 
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        </p>
                      @endif
                    @endforeach
                </div>
            </div>
        </div> -->
    </body>
</html>