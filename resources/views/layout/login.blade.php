@section('title')
login
@stop
@include('header')

  <body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h2 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                           
                            @if(count($errors) > 0)
                            <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                                   {{$err}}
                            @endforeach
                            </div>
                            @endif
                            @if(Session::has('thongbao'))
                            <div class="alert alert-success">
                                   {{Session::get('thongbao')}}
                            </div>
                            @endif
                    
                        <form role="form" action="" method="POST">
                            <fieldset>
                            {{ csrf_field() }}
                                
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" value="" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

</body>


