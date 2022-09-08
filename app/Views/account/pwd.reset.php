            <?php var_dump($_SESSION);?>

            <?php if (isset($_SESSION['enviado']) && $_SESSION['enviado']==0): ?>

                <div class="text-center color-secondary pt-6" style="background: url(http://externostest.embou.com/img/svg/pattern-3.svg) no-repeat center bottom fixed;background-size: cover;">
                    <p class="h3 mt-6">Ve a tu email para restablecer tu contraseña</p>
                    <p class="mt-6">Pulsa <a href="?login">aquí</a> para volver al login</p>
                </div>

            <?php elseif (!isset($_SESSION['enviado'])): ?>

                <div style="background: url(http://externostest.embou.com/img/svg/pattern-3.svg) no-repeat center bottom fixed;background-size: cover;">
                    <div class="container py-4 py-lg-5 my-lg-5 px-4 px-sm-0">
                        <div class="row justify-content-between px-6 mx-6">
                            <div class="col-xl-5 col-lg-6 col-md-9 col-sm-11 ml-auto min-vh-100">
                                <div id="panel-1" class="card rounded-plus bg-faded shadow">
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                            <form class="px-3 px-sm-4 px-md-6" action="?pwdReset" method="post">
                                                <div class="form-group mt-3 mb-6">
                                                    <label class="form-label" for="simpleinput">Usuario</label>
                                                    <input type="text" name="username" id="simpleinput" class="form-control rounded-pill">
                                                </div>
                                                <div class="form-group mb-6">
                                                    <label class="form-label" for="example-password">Email</label>
                                                    <input type="mail" name="email" id="example-password" class="form-control rounded-pill" value="">
                                                    <span id="emailtip" class="d-none"></span>
                                                </div>
                                                <div class="form-group mb-3 mx-auto col-10">
                                                    <button class="btn btn-danger btn-block btn-lg waves-effect waves-themed mb-3">Restablecer contraseña</button>
                                                    <a href="?login">Log in</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
            <?php elseif (isset($_SESSION['enviado']) && $_SESSION['enviado']==1): ?>

            <div style="background: url(http://externostest.embou.com/img/svg/pattern-3.svg) no-repeat center bottom fixed;background-size: cover;">
                <div class="container py-4 py-lg-5 my-lg-5 px-4 px-sm-0">
                    <div class="row justify-content-between px-6 mx-6">
                        <div class="col-xl-5 col-lg-6 col-md-9 col-sm-11 ml-auto min-vh-100">
                            <div id="panel-1" class="card rounded-plus bg-faded shadow">
                                <div class="panel-container show">
                                    <div class="panel-content">
                                        <form class="px-3 px-sm-4 px-md-6" action="?newPassword" method="post">
                                            <div class="form-group mt-3 mb-6">
                                                <label class="form-label" for="simpleinput">Introduce Código</label>
                                                <input type="text" name="confCode" id="simpleinput" class="form-control rounded-pill">
                                                <span id="codetip" class="d-none"></span>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <?php elseif(isset($_SESSION['enviado']) && $_SESSION['enviado']==2): ?>

            <div style="background: url(http://externostest.embou.com/img/svg/pattern-3.svg) no-repeat center bottom fixed;background-size: cover;">
                <div class="container py-4 py-lg-5 my-lg-5 px-4 px-sm-0">
                    <div class="row justify-content-between px-6 mx-6">
                        <div class="col-xl-5 col-lg-6 col-md-9 col-sm-11 ml-auto min-vh-100">
                            <div id="panel-1" class="card rounded-plus bg-faded shadow">
                                <div class="panel-container show">
                                    <div class="panel-content">
                                        <form class="px-3 px-sm-4 px-md-6" action="?newPassword" method="post">
                                            <div class="form-group mt-3 mb-6">
                                                <label class="form-label" for="simpleinput">Nueva contraseña</label>
                                                <input type="password" name="pwd1" id="simpleinput" class="form-control rounded-pill">
                                                <span id="pwdtip" class="d-none"></span>
                                            </div>
                                            <div class="form-group mb-6">
                                                <label class="form-label" for="example-password">Repetir contraseña</label>
                                                <input type="password" name="pwd2" id="mail" class="form-control rounded-pill" value="">
                                                <span id="pwd2tip" class="d-none"></span>
                                            </div>
                                            <div class="form-group mb-3 mx-auto col-10">
                                                <button class="btn btn-danger btn-block btn-lg waves-effect waves-themed mb-3">Restablecer contraseña</button>
                                                <a href="?login">Log in</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php else:?>

                <div class="text-center color-secondary pt-6" style="background: url(http://externostest.embou.com/img/svg/pattern-3.svg) no-repeat center bottom fixed;background-size: cover;">
                    <p class="h3 mt-6">Ha ocurrido un error, vuelve a empezar</p>
                    <p class="mt-6">Pulsa <a href="?login">aquí</a> para volver al login</p>
                </div>


            <?php endif; ?>

      