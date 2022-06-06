<div class="container c-card d-flex justify-content-center mt-5 mb-5">
    <div class="row g-3">
        <div class="col-md-6">  
            <span  id="sus-title">Método de pago</span>
            <div class="card card-sus">
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header p-0" id="headingTwo">
                            <h2 class="mb-0">
                                <button class="btn btn-light btn-block text-left collapsed p-3 rounded-0 border-bottom-custom" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span>Paypal</span>
                                        <img src="https://i.imgur.com/7kQEsHU.png" width="30">
                                    </div>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                                <input type="text" class="form-control" placeholder="Paypal email">
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header p-0">
                            <h2 class="mb-0">
                                <button class="btn btn-light btn-block text-left p-3 rounded-0" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span>Tarjetas de crédito aceptadas</span>
                                        <div class="icons">
                                            <img src="https://i.imgur.com/2ISgYja.png" width="30">
                                            <img src="https://i.imgur.com/W1vtnOV.png" width="30">
                                            <img src="https://i.imgur.com/35tC99g.png" width="30">
                                            <img src="https://i.imgur.com/2ISgYja.png" width="30">
                                        </div>
                                    </div>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body payment-card-body">
                                <span class="font-weight-normal card-text">Número de tarjeta</span>
                                <div class="input">
                                    <input type="text" class="form-control" placeholder="0000 0000 0000 0000">
                                </div> 
                                <div class="row mt-3 mb-3">
                                    <div class="col-md-6">
                                        <span class="font-weight-normal card-text">fecha de expiracion</span>
                                        <div class="input">
                                            <i class="fa fa-calendar"></i>
                                            <input type="text" class="form-control" placeholder="MM/YY">
                                        </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <span class="font-weight-normal card-text">CVC/CVV</span>
                                        <div class="input">
                                            <i class="fa fa-lock"></i>
                                            <input type="text" class="form-control" placeholder="000">
                                        </div> 
                                    </div>
                                </div>
                                <span class="text-muted certificate-text"><i class="fa fa-lock"></i> Tu transaccion es segura con nuestros certificados SSL</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <span id="sus-title">Resumen</span>
            <div class="card card-sus">
                <div class="d-flex justify-content-between p-3">
                    <div class="d-flex flex-column">
                        <span>Tipo de suscripcion</span>
                    </div>
                    <div class="mt-1">
                        <sup class="super-price">$9.99</sup>
                        <span class="super-month">/Mes</span>
                    </div>
                </div>
                <hr class="mt-0 line">
                <div class="p-3 d-flex justify-content-between">
                    <div class="d-flex flex-column">
                        <span>Hoy pagarás: 9.99</span>
                        <small>Después de 30 dias, se te volverá a cobrar:</small>
                    </div>
                    <span>$0</span>
                </div>
                <div class="p-3 mt-3 d-flex justify-content-end free-button">
                    <button class="btn btn-adopt">Suscribir</button> 
                    
                </div>
            </div>
        </div>
    </div>
</div>   