<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de reserva de citas medicas</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css?v=3.2.0">
</head>

<body class="hold-transition login-page"
    style="background-image: url('{{ url('assets/img/hero-bg.jpg') }}');
            background-repeat: no-repeat;
            background-size: 100vw 100vh;
            background-attachment: fixed">
    <div class="login-box">

        <div class="card">
            <div class="card-header text-center">
                <a href="" style="color:#0cb7f2;" class="h1"><b>Citas Medicas</b> </a>
                <p>Sistema de Gestion de Citas Medicas</p>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">

                        <h3 class="login-box-msg"> <b> Inicio de sesión </b></h3>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email" class="col-form-label text-md-end">Correo Electronico </label>
                                        <div class="">
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email" autofocus>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="password" class="col-form-label text-md-end">Contraseña </label>

                                        <div class="">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="current-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        {{ __('Login') }}
                                        <i class="fas fa-arrow-circle-right"></i>
                                    </button>
                                </div>
                            </div>
                        </form>

                        <br>

                    </div>
                    <div class="col-md-6 text-center" style="border-radius: 15px">
                        <img src="{{ asset('assets/img/paciente.png') }}" width="50%" alt="">
                        <br>
                        <h4>¿Aun no tienes cuenta y deseas apartar una <b>Cita Medica</b>?</h4>
                        <br>
                        <a href="{{ route('register') }}" class="btn btn-primary">Registrarme <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

        </div>


    </div>


    <script src="plugins/jquery/jquery.min.js"></script>

    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="dist/js/adminlte.min.js?v=3.2.0"></script>
</body>

</html>
