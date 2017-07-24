@section('title')
register
@stop

 @include('header')  

<body>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Register</h3>
                    </div>
                    <div class="panel-body">
                             @if(count($errors) > 0)
                            <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                                   {{$err}}
                            @endforeach
                            </div>
                            @endif
                            @if(Session::has('thanhcong'))
                            <div class="alert alert-success">
                                   {{Session::get('thanhcong')}}
                            </div>
                            @endif
                        <form role="form" action="" method="POST">
                            <fieldset>
                            {{ csrf_field() }}
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="name" value="" type="" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" value="" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Confirm Password" name="repassword" type="password" value="">
                                </div>
                                <button type="submit" class="btn btn-lg btn-success btn-block">Register</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>

</html>
