                <?php
                if(isset($_SESSION['email']) && isset($_SESSION['codigo']) && isset($_SESSION['enviado'])){
                    
                    unset($_SESSION['email']);
    
                    unset($_SESSION['codigo']);
    
                    unset($_SESSION['enviado']);
                }
                
                ?>                               
                <div style="background: url(http://externostest.embou.com/img/svg/pattern-3.svg) no-repeat center bottom fixed;background-size: cover;">
                    <div class="container py-4 py-lg-5 my-lg-5 px-4 px-sm-0">
                        <div class="row justify-content-between px-6 mx-6">
                            <div class="col-xl-5 col-lg-6 col-md-9 col-sm-11 ml-auto min-vh-100">
                                <div id="panel-1" class="card rounded-plus bg-faded shadow">
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                            <form class="px-3 px-sm-4 px-md-6" action="?login" method="post">
                                                <div class="form-group mt-3 mb-6">
                                                    <label class="form-label" for="simpleinput">Usuario</label>
                                                    <input type="text" name="username" id="simpleinput" class="form-control rounded-pill">
                                                </div>
                                                <div class="form-group mb-6">
                                                    <label class="form-label" for="example-password">Password</label>
                                                    <input type="password" name="pwd" id="example-password" class="form-control rounded-pill" value="">
                                                </div>
                                                <div class="form-group mb-3 mx-auto col-7">
                                                    <button class="btn btn-primary btn-block btn-lg waves-effect waves-themed mb-3">Entrar</button>
                                                    <a href="?pwdReset">¿Olvidaste tu contraseña?</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>