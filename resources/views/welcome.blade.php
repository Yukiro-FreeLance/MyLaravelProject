<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-xxx" crossorigin="anonymous" />

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .btn-1 {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 50px;
            width: 200px;
            background-color: skyblue;
            border-radius: 10px;
        }
        .btn-2 {
          
            border-radius: 10px;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            border: none;
            cursor: pointer;
            /* height: 30px; */
            padding: 10px
            /* background-color: transparent; */

            
        }
        .skyblue-button {
            text-decoration: none;
            color: rgb(0, 0, 0); /* Add text color for better visibility */
        }

        .btn-2.btn-1-:hover {
            background-color: rgb(234, 18, 18);
        }
        .mr-4{
            margin-right: 400;
        }
    </style>
</head>
<body>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                My Laravel Project
            </div>

            <!-- New link added -->
            <br />
            <div class="links-1">
                <a href="posts" class="btn-1 btn-primary skyblue-button">Manage Students</a>
            </div>

            <!-- Check if the user is logged in -->
            @if (auth()->check())
                <div class="top-right links">
                    <form action="{{ url('/logout') }}" method="POST">
                        {{ csrf_field() }}
                        {{ Auth::user()->name }}
                        <button class="btn-2 fa fa-home" type="submit">Logout</button>

                    </form>
                </div>
            @else
                <!-- Show login and register links only if the user is not logged in -->
                @if (Route::has('login'))
                    <div class="top-right links">
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    </div>
                @endif
            @endif
        </div>
    </div>
</body>
</html>
