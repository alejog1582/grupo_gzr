@extends('layouts.app')

@section('content')

@if (Auth::check())
    @if ($user->email == 'administracion@cashadvance.com.co')
        <br>
        <a id="enlace_administracion" href="/administracion">Administración</a>
    @endif
@endif

    <section id="encabezado-1">
        <div class="row">
            <div class="col-md-8"  id="encabezado">
                <br>
                <h2 id="titulo-principal" style="font-size: 1.9em; color:#0b1d2f"><b>TODAS TUS SOLICITUDES DE CRÉDITO SON 100% ONLINE.</b></h2>
                <div hidden id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img src="{{ asset('images/primer_foto.jpg') }}" class="d-block w-100" alt="...">
                      </div>

                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-md-4">

            </div>
        </div>
    </section>
    <section id="requisitos">
    <br>
    <div class="container">
        <div class="card-group">
            <div class="card" style="background-color: #f8fafc; border:none">
                <i class="fas fa-id-card text-center" id="icons_requisitos"></i>
                <div class="card-body" id="tarjeta-requisitos">
                    <h4 class="card-title text-center">Ser Colombiano mayor de edad y habitar en Colombia</h4>
                </div>
            </div>
            <div class="card"  style="background-color: #f8fafc; border:none">
                <i class="fas fa-university text-center" id="icons_requisitos"></i>
                <div class="card-body" id="tarjeta-requisitos">
                    <h4 class="card-title text-center">Ser titular de una cuenta bancaria</h4>
                </div>
            </div>
            <div class="card"  style="background-color: #f8fafc; border:none">
                <i class="fas fa-envelope-square text-center"  id="icons_requisitos"></i>
                <div class="card-body" id="tarjeta-requisitos">
                    <h4 class="card-title text-center">Poseer un correo electrónico</h4>
                </div>
            </div>
            <div class="card" style="background-color: #f8fafc; border:none">
                <i class="fas fa-mobile-alt text-center" id="icons_requisitos"></i>
                <div class="card-body" id="tarjeta-requisitos">
                    <h4 class="card-title text-center">Poseer una línea celular</h4>
                </div>
            </div>
        </div>
    </div>
    <br>
    <h3 class="text-center" id="boton_principal" style="padding-top: 30px; padding-bottom: 30px">
        Si cumples con estos requisitos, ingresa a solicitar tu Speed Cash.
    </h3>
    <br>
    </section>
    <section id="nuesto_servicio">
        <br><br>
        <h2 class="text-center">EN CASH ADVANCE TE BRINDAMOS...</h2>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="card-title">Crédito Inmediato Online <span style="color: rgba(216,142,50,1)"><b>SPEED CASH</b> </span></h1>
                    <p class="card-text">
                        Es un Préstamo 100% digital, fácil y seguro.



                    </p>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-4">
                    <div class="card" style="background-color: #0b1d2f00; border:none">
                        <i class="fas fa-credit-card text-center"  id="icons_ventajas"></i>
                        <div class="card-body">
                            <p class="card-title text-center">Crédito hasta $750.000</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card"  style="background-color: #0b1d2f00; border:none">
                        <i class="far fa-calendar-alt text-center" id="icons_ventajas"></i>
                        <div class="card-body">
                            <p class="card-title text-center">Plazo minimo de 10 dias, hasta 60 días.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card"  style="background-color: #0b1d2f00; border:none">
                        <i class="fas fa-percentage text-center" id="icons_ventajas"></i>
                        <div class="card-body">
                            <p class="card-title text-center">Nuestra tasa de interés es de 25% E.A. (Efectiva anual)</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card" style="background-color: #0b1d2f00; border:none">
                            <i class="fas fa-user-alt-slash text-center" id="icons_ventajas"></i>
                        <div class="card-body">
                            <p class="card-title text-center">Sin pápeleos, ni presencia física.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card"  style="background-color: #0b1d2f00; border:none">
                        <i class="fas fa-flag-checkered text-center" id="icons_ventajas"></i>
                        <div class="card-body">
                            <p class="card-title text-center">Solicitud ágil y con aprobación en el mismo dia</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card"  style="background-color: #0b1d2f00; border:none">
                        <i class="fas fa-fingerprint text-center"  id="icons_ventajas"></i>
                        <div class="card-body">
                            <p class="card-title text-center">Gestión segura y transparente</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">

                </div>
                <div class="col-md-8">
                    <a href="/producto-credito-speedcash" class="btn" id="boton_principal">Conoce Más</a>
                    <a href="/#encabezado-1" class="btn" id="boton_principal">Simula tu Crédito</a>
                    <a href="/costos-credito" class="btn" id="boton_principal">Ver Costos del Crédito</a>
                </div>
                <div class="col-md-4"></div>
            </div>
            <br>
        </div>
    </section>
    <section id="como_hacerlo">
        <br>
        <h2 class="card-title text-center">PASOS NECESARIOS PARA SOLICITAR TU <span style="color: rgba(216,142,50,1)"><b>SPEED CASH</b> </span></h2>
        <br>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card" style="background-color: #0b1d2f00; border:none">
                        <i class="fas fa-coins text-center" id="icons_requisitos"></i>
                        <div class="card-body">
                            <p class="card-title text-center">Define el monto y el plazo del préstamo en nuestro simulador de crédito www.cashadvance.com.co</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card"  style="background-color: #0b1d2f00; border:none">
                        <i class="fas fa-unlock-alt text-center" id="icons_requisitos"></i>
                        <div class="card-body">
                            <p class="card-title text-center">Ingresa con tu usuario o Regístrate.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card"  style="background-color: #0b1d2f00; border:none">
                        <i class="fas fa-edit text-center"  id="icons_requisitos"></i>
                        <div class="card-body">
                            <p class="card-title text-center">Diligencia el formulario con la información requerida para analizar tu solicitud.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card"  style="background-color: #0b1d2f00; border:none">
                        <i class="fas fa-spinner text-center"  id="icons_requisitos"></i>
                        <div class="card-body">
                            <p class="card-title text-center">Analizaremos tu solicitud emitiendo respuesta el mismo día*</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card" style="background-color: #0b1d2f00; border:none">
                        <i class="fas fa-file-signature text-center" id="icons_requisitos"></i>
                        <div class="card-body">
                            <p class="card-title text-center">Firma electrónicamente el contrato y acepta los términos y condiciones.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card" style="background-color: #0b1d2f00; border:none">
                        <i class="fas fa-hand-holding-usd text-center" id="icons_requisitos"></i>
                        <div class="card-body">
                            <p class="card-title text-center">El dinero quedara abonado directamente en la cuenta bancaria registrada.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="preguntas_frecuentes">
    <br>
    <h2 class="text-center">Conoce mas detalles sobre la solicitd de tu crédito</h2>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingOne">
                        <button id="titulo_acordeon" class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <b>¿Que es Speed Cash?</b>
                        </button>
                      </h2>
                      <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            SPEED CASH, Es un Crédito 100% digital, fácil y seguro, por el cual el usuario tiene la libertad de solicitar dinero
                            seleccionando el monto que requiere hasta $750.000 pesos, de igual manera elige el plazo de financiación hasta 45
                            días, (con la posibilidad de ampliar el plazo hasta 30 días más). Trámite que podrá realizar mediante esta página
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingTwo">
                        <button id="titulo_acordeon" class="btn btn-link collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                           <b> ¿Cuales son los requisitos para obtener un SPEED CASH?</b>
                        </button>
                      </h2>
                      <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            Es importante que conozcas los requisitos para acceder a los productos de CASH ADVANCE S.A.S:
                            <br><br>
                            a) Ser mayor de edad.
                            <br>
                            b) Autorizar a CASH ADVANCE S.A.S: empresa encargada de estudio crediticio del Usuario a
                            utilizar la información personal del usuario para estudiar su cupo.
                            <br>
                            c) Tener línea de celular activa y dirección de correo electrónico personal.
                            <br>
                            d) Tener historial de crédito.
                            <br>
                            e) No estar reportado en centrales de riesgo.
                            <br>
                            f) Una cuenta de ahorros o corriente a tu nombre (no giramos a cuentas de terceros)
                            <br>
                            g) Tener un email (correo electrónico) personal.
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingThree">
                        <button id="titulo_acordeon" class="btn btn-link collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <b> ¿Cual es el interes de mi crédito?</b>
                        </button>
                      </h2>
                      <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            La Tasa de Interés Anual del Préstamo se especifica en el Contrato, su monto se calcula de acuerdo con el interés
                            bancario corriente certificado por la Superintendencia Financiera de Colombia.
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <br>
                <a href="/preguntas-frecuentes" class="btn" id="boton_principal">Conoce Más Preguntas Frecuentes</a>
                <a href="/#encabezado-1" class="btn" id="boton_principal">Simula tu Crédito</a>
                <a href="/costos-credito" class="btn" id="boton_principal">Ver Costos del Crédito</a>
                <br><br>
            </div>
        </div>
    </div>
    </section>
    <section id="nuestros_aliados">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                <br>
                <h2 class="text-center">Blog</h2>
                <div class="card-group">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card h-100"  id="tarjeta-requisitos">
                                <img class="card-img-top" src="{{ asset('images/entrada_1.jpg') }}" >
                                <div class="card-body">
                                <h4 class="card-title">¿QUÉ SON LOS CRÉDITOS ONLINE?</h4>
                                <p class="card-text">Los créditos online son aquellos que, como bien indica la propia palabra, se realizan a través de internet mediante plataformas crediticias...</p>
                                <a href="/blog/que-son-los-creditos-online" class="btn" id="boton_principal">Leer Mas</a>
                                </div>
                                <div class="card-footer">
                                <small class="text-muted">Last updated 3 mins ago</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card  h-100" id="tarjeta-requisitos">
                                <img class="card-img-top" src="{{ asset('images/entrada_2.jpg') }}" >
                                <div class="card-body">
                                <h4 class="card-title">VIDA CREDITICIA</h4>
                                <p class="card-text">Así como el acceder al historial, el estado de obligaciones y hasta el saber si existe un uso fraudulento de sus datos. Tener una vida crediticia, es el comienzo...</p>
                                <a href="/blog/vida-crediticia" class="btn" id="boton_principal">Leer Mas</a>
                                </div>
                                <div class="card-footer">
                                <small class="text-muted">Last updated 3 mins ago</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-md-6">
                <br>
                <h2 class="text-center">Nuestros Aliados</h2>
                    <div class="row">
                        {{-- <div class="col-md-4">
                            <div class="card" style="background-color: #0b1d2f00; border:none">
                                <img  class="img-fluid" src="{{ asset('images/logo_payu.png') }}" alt="">
                            </div>
                        </div> --}}
                        <div class="col-md-4">
                            <div class="card"  style="background-color: #0b1d2f00; border:none">
                                <img  class="img-fluid" src="{{ asset('images/logo_datacredito.png') }}" alt="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card"  style="background-color: #0b1d2f00; border:none">
                                <img  class="img-fluid" src="{{ asset('images/logo_bancolombia.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('title')
    Cash Advance sas | creditos personales fintech | pretamos de dinero 100% online
@endsection

@section('description')
    Brindamos creditos personales 100% online agil, facil y seguro. Estudio de credito sin costo y aprobacion y desembolso en menos de 24 horas.
@endsection
