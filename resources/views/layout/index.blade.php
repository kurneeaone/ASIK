<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/sb-admin-2.min.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('head')
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">ASIK</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/panduan')}}">Panduan</a>
                </li>
                @if(auth()->user())
                <li class="nav-item">
                    <a href="{{url('/siswa')}}" class="nav-link">Siswa</a>
                </li>
                <li class="nav-item">
                    <a href="{{url('/cek')}}" class="nav-link">Cek</a>
                </li>
                <li class="nav-item">
                    <a href="{{url('/nilai')}}" class="nav-link">Nilai</a>
                </li>
                <li class="nav-item">
                    <a href="{{url('/user')}}" class="nav-link">User</a>
                </li>
                <li class="nav-item">
                    <a href="{{url('/setting')}}" class="nav-link">Setting</a>
                </li>
                @endif
            </ul>
            <ul class="navbar-nav ml-auto">
                @if(!auth()->user())
                <li class="nav-item">
                    <a href="#login" class="nav-link text-primary" data-toggle="modal" data-target="#loginModal">Login</a>
                </li>
                @else
                <li class="nav-item">
                    <a href="{{url('/logout')}}" class="nav-link text-danger">Logout</a>
                </li>
                @endif
            </ul>
        </div>
    </nav>
    @yield('body')
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>2020 &copy; <a href="https://www.instagram.com/kurneea.one">KurneeaOne</a></span>
            </div>
        </div>
    </footer>
    
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('/login')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for=""><b>Email</b></label>
                        <input type="text" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for=""><b>Password</b></label>
                        <input type="password" name="password" class="form-control">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
            </div>
        </div>
    </div>
    <div class="toast" data-animation="true" data-delay="5000" data-autohide="true"
        style="position: absolute; top: 50px; right: 0;margin-right:50px;width:200px;z-index:999999;">
        <div class="toast-header">
            <span class="rounded mr-2" style="width: 15px;height: 15px"></span>
            <strong class="mr-auto">ONE Bot</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body text-uppercase">
            <b class="text-success" id="toast-success"></b>
            <b class="text-danger" id="toast-fail"></b>
            @if(session('success'))
            <b class="text-success">{!! session('i-error') !!}</b>
            @else
            <b class="text-danger">{!! session('i-error') !!}</b>
            @endif
            @if(count($errors)>0)
            <ul>
                @foreach($errors->all() as $error)
                <li class="text-danger"><b>{{$error}}</b></li>
                @endforeach
            </ul>
            @endif
        </div>
    </div>
    <script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>    
    <script>
        $(document).ready(function(){
            $($('button[data-dismiss="toast"]')).on('click',function(){
                $('#toast-success').html(''); 
                $('#toast-fail').html(''); 
            });
        });
        a   = $('.nav-item');
        url = document.location.href;
        for(i=0;i<a.length;i++){
            if(url == $(a.children()[0]).attr('href')+'/' || url == $(a.children()[0]).attr('href')+'/#' ){
                $(a.children()[0]).addClass('active');
            }
            if(url == $(a.children()[i]).attr('href')){
                $(a.children()[i]).addClass('active');
            }
        }
    </script>
    @if(session('i-error')||count($errors)>0)
    <script>
        $('.toast').toast('show');
    </script>
    @endif
    @yield('js')
</body>

</html>
