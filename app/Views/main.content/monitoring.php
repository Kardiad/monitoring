                    <!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
                    <main class="page-content text-center" role="main">
                        <div class="row mx-auto" id="main-page">
                            <div id="panel-1" class="panel mx-auto">
                                <div class="panel-hdr align-content-center justify-content-center p-2">
                                    <div class="d-flex col-gap-6 fs3" id="servers-charts">
                                        <?php for($i = 1; $i < 9; $i++): ?>
                                        <a class="nav-link">
                                            <div id="update-chart" class="d-flex flex-column align-items-start">
                                                <div id="<?=$i?>" class="js-easy-pie-chart position-relative d-flex align-items-center justify-content-center" data-piesize="100" data-linewidth="20" data-trackcolor="#dfe2e6" data-scalelength="0">
                                                    <div class="d-flex flex-column align-items-center justify-content-center position-absolute pos-left pos-right pos-top pos-bottom fw-300 fs-xl">
                                                        <span class="js-percent d-block text-dark"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="text-dark">Servidor <?=$i?></p>
                                        </a>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                                <div class="panel-container show p-3">
                                    <div class="row panel-content p-3">

                                    <?php for ($x=1; $x<9; $x++){
                                        echo '
                                        <div class="col-5 panel panel-content mx-auto px-1 py-4 pr-0">
                                        <div class="row row-cols-3 col-12 align-items-center justify-content-between pr-0">
                                            <p class="m-0 row col-3 justify-content-center">Servidor '.$x.'</p>
                                            <div class="col-7">
                                                <div class="row col-gap-6 justify-content-end">
                                                    <p class="w-3rem m-0">KO</p>
                                                    <p class="w-3rem m-0">WR</p>
                                                    <p class="w-3rem m-0">CR</p>
                                                </div>
                                                <div class="row col-gap-6 justify-content-end">
                                                    <p data-ko="'.$x.'" class="rounded-pill w-3rem bg-secondary text-light m-0" ></p>
                                                    <p data-wr="'.$x.'" class="rounded-pill w-3rem bg-warning text-light m-0" ></p>
                                                    <p data-cr="'.$x.'" class="rounded-pill w-3rem bg-danger text-light m-0"></p>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="modal fade" id="exampleModalToggle'.$x.'" aria-hidden="true" aria-labelledby="exampleModalToggleLabel'.$x.'" tabindex="-1" data-server="'.$x.'">
                                                    <div class="modal-dialog modal-position">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h2 class="modal-title" id="exampleModalToggleLabel'.$x.'">Nombre del servidor '.$x.'</h2>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"  data-server="'.$x.'"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="panel mx-auto">
                                                                    <div class="panel-container show">
                                                                        <div class="panel-content row">                                                        
                                                                            <div class=" panel col-4 m-auto">
                                                                                <h3 class="text-center">Estado del disco</h3>
                                                                                <div class="d-flex flex-column align-items-start" id="pie-'.$x.'">
                                                                                    <canvas id="pieChart-'.$x.'" class="graph"></canvas>  
                                                                                </div>                                                                                    
                                                                                <div class="row mt-5">
                                                                                    <div class="col-12 text-center mt-5">
                                                                                        <h5>Alertas</h5>
                                                                                    </div>
                                                                                </div>
                                                                                <table class="table mt-2">
                                                                                    <thead>
                                                                                        <tr class="text-center">
                                                                                            <th>Descripcion</th>
                                                                                            <th>Stauts</th>
                                                                                            <th>Tiempo</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody class="text-center" id="alertas'.$x.'">                                                                                
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                            <div class=" panel col-6 m-auto d-flex flex-column">
                                                                                <div class="mt-3 col-12">
                                                                                    <div class="panel-content">
                                                                                    <h5>Servicios</h5>
                                                                                        <table class="table mt-5">
                                                                                            <thead>
                                                                                                <tr class="text-center">
                                                                                                    <th>Nombre Servicio</th>
                                                                                                    <th>Descripcion</th>
                                                                                                    <th>Status</th>
                                                                                                    <th>Ver grafico</th>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody class="text-center" id="servicios'.$x.'" data-servidor="servidor-'.$x.'">                                                                                            
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="panel col-12">
                                                                                    <div class="panel-content">
                                                                                        <div id="areaChart-'.$x.'" data-server-ping='.$x.'>
                                                                                            <canvas id="chart-'.$x.'" class="graph"></canvas>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle'.$x.'" role="button" data-id="'.$x.'"><i class="fal fa-search"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                        ';
                                    } ?>
                                    </div>
                                </div>
                                <div class="panel mx-auto" id="servidoresDetalle">
                                
                                </div>
                            </div>
                        </div>
                        <div class="row mx-auto" id="js-page-content"></div>
                    </main>
                    <!-- this overlay is activated only when mobile menu is triggered -->
                    <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div> <!-- END Page Content -->