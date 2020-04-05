<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">
        <title>Tutorial Laravel #21 : CRUD Eloquent Laravel - www.malasngoding.com</title>
    </head>
    <body>
        <div class="container">
            <div class="card mt-5">
                <div class="card-header text-center">
                    Tambah Mahasiswa
                </div>
                <div class="card-body">
                 
                    
                    <form method="post" action="/mahasiswa/store">

                        {{ csrf_field() }}

                        <div class="form-group">
                            <label>Nama Depan</label>
                            <input type="text" name="first_name" class="form-control" placeholder="Nama depan ..">

                            @if($errors->has('firstname'))
                                <div class="text-danger">
                                    {{ $errors->first('firstname')}}
                                </div>
                            @endif

                        </div>

                        <div class="form-group">
                            <label>Nama Belakang</label>
                           <input type="text" class="form-control" name="last_name" placeholder="Nama Belakang ..">

                             @if($errors->has('lastname'))
                                <div class="text-danger">
                                    {{ $errors->first('lastname')}}
                                </div>
                            @endif

                        </div>
                        <div class="form-group">
                            <label>Email</label>
                           <input type="text" class="form-control" name="user_email" placeholder="Email ..">

                             @if($errors->has('user_email'))
                                <div class="text-danger">
                                    {{ $errors->first('user_email')}}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                           <input type="text" class="form-control" name="user_password" placeholder="Password ..">

                             @if($errors->has('password'))
                                <div class="text-danger">
                                    {{ $errors->first('password')}}
                                </div>
                            @endif

                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Simpan">
                            <a href="/mahasiswa" class="btn btn-dark">Kembali</a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </body>
</html>