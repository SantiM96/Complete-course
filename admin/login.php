<?php 
    session_start();
    if(isset($_GET['session_close'])) {
        session_destroy();
    }
    include 'templates/header.php';
?>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="../index.php" class="h1"><b>GDL</b>WebCamp</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Inicia sesión aquí</p>

                <form action="admin-area.php" method="post">
                    <div class="input-group mb-3">
                        <input type="text" id="user" name="user" class="form-control" placeholder="Usuario">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <input type="hidden" id="login-admin" name="login-admin" value="1">
                            <button type="submit" id="submit" class="btn btn-primary btn-block">Iniciar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

<?php include 'templates/footer.php'; ?>
