<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Login</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="/assets/img/icon.ico" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="/assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Open+Sans:300,400,600,700"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"],
                urls: ['/assets/css/fonts.css']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/azzara.min.css">
</head>

<body class="login">
    <div class="wrapper wrapper-login">
        <div class="container container-login animated fadeIn">
            <h3 class="text-center">Sign In To Admin</h3>
            <form action="/login" method="post">
                @csrf
                <div class="login-form">
                    <div class="form-group form-floating-label">
                        <input id="email" name="email" type="email" class="form-control input-border-bottom"
                            required>
                        <label for="email" class="placeholder">email</label>
                    </div>
                    <div class="form-group form-floating-label">
                        <input id="password" name="password" type="password" class="form-control input-border-bottom"
                            required>
                        <label for="password" class="placeholder">Password</label>
                        <div class="show-password">
                            <i class="flaticon-interface"></i>
                        </div>
                    </div>

                    <div class="form-action mb-3">
                        <button type="submit" class="btn btn-primary btn-rounded btn-login">Sign In</button>
                    </div>
            </form>

            <div class="login-account">
                <span class="msg">Don't have an account yet ?</span>
                <a href="#" id="show-signup" class="link">Sign Up</a>
            </div>
        </div>
        </form>
    </div>
    <!-- register -->
    <div class="container container-signup animated fadeIn">
        <h3 class="text-center">Sign Up</h3>
        <form action="/register" method="post">
            @csrf
            <div class="login-form">
                <div class="form-group form-floating-label">
                    <input id="nama" name="nama" type="text" class="form-control input-border-bottom"
                        required>
                    <label for="nama" class="placeholder">Nama</label>
                </div>
                <div class="form-group form-floating-label">
                    <input id="email" name="email" type="email" class="form-control input-border-bottom"
                        required>
                    <label for="email" class="placeholder">Email</label>
                </div>
                <div class="form-group form-floating-label">
                    <input id="password" name="password" type="password"
                        class="form-control input-border-bottom" required>
                    <label for="passwordsignin" class="placeholder">Password</label>
                    <div class="show-password">
                        <i class="flaticon-interface"></i>
                    </div>
                </div>


                <div class="form-action">

                    <button type="submit" class="btn btn-primary btn-rounded btn-login">Sign Up</button>
                </div>
        </form>

        <div class="login-account">
            <span class="msg">Already Have Account?</span>
            <a href="#" id="show-signin" class="link">Sign In</a>
        </div>
    </div>
    </div>
    </div>
    <script src="/assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="/assets/js/core/popper.min.js"></script>
    <script src="/assets/js/core/bootstrap.min.js"></script>
    <script src="/assets/js/ready.js"></script>
</body>

</html>
