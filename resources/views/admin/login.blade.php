<html>
    <head>
        <title>Laboratorium Result Check</title>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.7.2/css/all.css">
        <link rel="stylesheet" href="{{asset('css/login.css')}}">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="{{asset('img/app/logounjani.png')}}">
    </head>
    <body>
        <div class="wrapper">
            <div class="logo"> <img src="{{asset('img/app/logounjani.png')}}" alt=""> </div>
            <div class="text-center mt-4 name"> Laboratorium Result Check</div>
            <form class="p-3 mt-3">
                <div class="form-field d-flex align-items-center">
                    <span class="far fa-user"></span> <input type="text" name="userName" id="username" placeholder="Username">
                </div>
                <div class="form-field d-flex align-items-center">
                    <span class="fas fa-key"></span> <input type="password" name="password" id="pwd" placeholder="Password">
                </div>
            </form>
            <button class="btn mt-3" id="btnLogin">Login</button>
        </div>
    </body>
    {{-- <script src="//cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"> --}}
    <script>
        $(document).ready(function(){
            $('#btnLogin').on('click',function(){
                username = $('#username').val()
                pwd      = $('#pwd').val()
                url      ='/admin/login'
                if (username != '' && pwd != ''){
                    location.href = `${url}?username=${username}&pwd=${pwd}`
                } else {
                    alert("Masukan Username Dan Password Yang Benar!!!");
                }
            })


        })
    </script>
</html>
