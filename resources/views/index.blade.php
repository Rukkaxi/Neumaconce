    @extends('layouts.app')
    @section('content')
    @include('layouts.search')

    <!-- Carousel Start -->
    <div class="container-fluid p-0" style="margin-bottom: 30px;">
        <div id="header-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="media/photos/photo1.png" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase mb-md-3">NEUMACONCE</h4>
                            <h1 class="display-1 text-white mb-md-4">Los mejores repuestos de la región</h1>
                            <a href="{{ route('shop.index') }}" class="btn btn-primary py-md-3 px-md-5 mt-2">Compra Aquí</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="media/photos/photo2.png" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase mb-md-3">NEUMACONCE</h4>
                            <h1 class="display-1 text-white mb-md-4">Lleva tu automóvil a un nivel superior</h1>
                            <a href="{{ route('shop.index') }}" class="btn btn-primary py-md-3 px-md-5 mt-2">Compra Aquí</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="media/photos/photo3.png" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase mb-md-3">NEUMACONCE</h4>
                            <h1 class="display-1 text-white mb-md-4">Años de experiencia en servicio</h1>
                            <a href="{{ route('shop.index') }}" class="btn btn-primary py-md-3 px-md-5 mt-2">Compra Aquí</a>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                <div class="btn btn-dark" style="width: 45px; height: 45px;">
                    <span class="carousel-control-prev-icon mb-n2"></span>
                </div>
            </a>
            <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                <div class="btn btn-dark" style="width: 45px; height: 45px;">
                    <span class="carousel-control-next-icon mb-n2"></span>
                </div>
            </a>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <h1 class="display-1 text-primary text-center">01</h1>
            <h1 class="display-4 text-uppercase text-center mb-5">Bienvenidos a <span class="text-primary">NeumaConce</span></h1>
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <img class="w-75 mb-4" src="" alt="">
                    <p>Bienvenido a NeumaConce, su destino confiable para todas sus necesidades de partes y repuestos de vehículos en Concepción, Chile. Nos enorgullece ofrecer una amplia gama de piezas de calidad, así como un conveniente servicio de retiro en nuestro local o despacho a su ubicación, ya sea en la ciudad o en regiones. Además de nuestro extenso inventario, también proporcionamos servicios especializados de desabolladuría y pintura de autos para mantener su vehículo en óptimas condiciones estéticas y de funcionamiento. En NeumaConce, nuestro compromiso es brindarle soluciones integrales para todas sus necesidades automotrices.</p>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-4 mb-2">
                    <div class="d-flex align-items-center bg-light p-4 mb-4" style="height: 150px;">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary ml-n4 mr-4" style="width: 100px; height: 100px;">
                            <i class="fa fa-2x fa-headset text-secondary"></i>
                        </div>
                        <h4 class="text-uppercase m-0">Asistencia por redes o correo</h4>
                    </div>
                </div>
                <div class="col-lg-4 mb-2">
                    <div class="d-flex align-items-center bg-secondary p-4 mb-4" style="height: 150px;">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary ml-n4 mr-4" style="width: 100px; height: 100px;">
                            <i class="fa fa-2x fa-car text-secondary"></i>
                        </div>
                        <h4 class="text-light text-uppercase m-0">Despacho local y a regiones</h4>
                    </div>
                </div>
                <div class="col-lg-4 mb-2">
                    <div class="d-flex align-items-center bg-light p-4 mb-4" style="height: 150px;">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary ml-n4 mr-4" style="width: 100px; height: 100px;">
                            <i class="fa fa-2x fa-map-marker-alt text-secondary"></i>
                        </div>
                        <h4 class="text-uppercase m-0">Freire #82, Concepción</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Include the recommended products section -->
    <div class="container-fluid d-flex justify-content-center">
        <div class="col-lg-9 d-flex align-items-center justify-content-center">
            <div id="recommended-products-section" class="my-3"></div>
        </div>
    </div>




    <!-- Services Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <h1 class="display-1 text-primary text-center">02</h1>
            <h1 class="display-4 text-uppercase text-center mb-5">Nuestros Servicios</h1>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-2 ">
                    <a href="agendar-visitas.html" class="service-item-link">
                        <div class="service-item d-flex flex-column justify-content-center px-4 mb-4">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="d-flex align-items-center justify-content-center bg-primary ml-n4" style="width: 80px; height: 80px;">
                                    <i class="fa fa-2x fa-taxi text-secondary"></i>
                                </div>
                                <h1 class="display-2 text-white mt-n2 m-0">01</h1>
                            </div>
                            <h4 class="text-uppercase mb-3">Agendar Visitas</h4>
                            <p class="m-0">Agenda visitas para compatibilidad de piezas, revisión técnica, reparación y/o mantenimiento.</p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 mb-2">
                    <a href="cotizaciones" class="service-item-link">
                        <div class="service-item active d-flex flex-column justify-content-center px-4 mb-4">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="d-flex align-items-center justify-content-center bg-primary ml-n4" style="width: 80px; height: 80px;">
                                    <i class="fa fa-2x fa-money-check-alt text-secondary"></i>
                                </div>
                                <h1 class="display-2 text-white mt-n2 m-0">02</h1>
                            </div>
                            <h4 class="text-uppercase mb-3">Cotiza con Nosotros</h4>
                            <p class="m-0">Cotiza algún producto que buscas y te respondemos si lo proveemos.</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Services End -->

    <style>
        .service-item-link {
            text-decoration: none;
            color: inherit;
        }

        .service-item-link:hover {
            text-decoration: none;
        }

        .service-item-link .service-item:hover {
            transform: scale(1.05);
            transition: transform 0.3s;
        }
    </style>




    <!-- Banner Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="bg-banner py-5 px-4 text-center">
                <div class="py-5">
                    <h1 class="display-1 text-uppercase text-primary mb-4">20% DE DESCUENTO</h1>
                    <h1 class="text-uppercase text-light mb-4">Descuento especial para nuevos miembros</h1>
                    <p class="mb-4">Solo disponible de Lunes a viernes</p>
                    <a class="btn btn-primary mt-2 py-3 px-5" href="{{ url('register') }}">Regístrate Ahora</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <!-- Contact Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <h1 class="display-1 text-primary text-center">03</h1>
            <h1 class="display-4 text-uppercase text-center mb-5">Tu opinión nos importa, Contáctanos</h1>
            <div class="row">
                <div class="col-lg-7 mb-2">
                    <div class="contact-form bg-light mb-4" style="padding: 30px;">
                        <form>
                            <div class="row">
                                <div class="col-6 form-group">
                                    <input type="text" class="form-control p-4" placeholder="Tu Nombre" required="required">
                                </div>
                                <div class="col-6 form-group">
                                    <input type="email" class="form-control p-4" placeholder="Tu Correo Electrónico" required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control p-4" placeholder="Asunto" required="required">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control py-3 px-4" rows="5" placeholder="Mensaje" required="required"></textarea>
                            </div>
                            <div>
                                <button class="btn btn-primary py-3 px-5" type="submit">Enviar Mensaje</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5 mb-2">
                    <div class="bg-secondary d-flex flex-column justify-content-center px-5 mb-4" style="height: 435px;">
                        <div class="d-flex mb-3">
                            <i class="fa fa-2x fa-map-marker-alt text-primary flex-shrink-0 mr-3"></i>
                            <div class="mt-n1">
                                <h5 class="text-light">Casa Matriz</h5>
                                <p>FREIRE #82, CONCEPCIÓN</p>
                            </div>
                        </div>

                        <div class="d-flex mb-3">
                            <i class="fa fa-2x fa-envelope-open text-primary flex-shrink-0 mr-3"></i>
                            <div class="mt-n1">
                                <h5 class="text-light">Correo Electronico</h5>
                                <p>bocar@bocar.cl</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->


    <!-- Vendor Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <h1 class="display-1 text-primary text-center">04</h1>
            <h1 class="display-4 text-uppercase text-center mb-5">Nuestra Galeria</h1>
            <div class="owl-carousel vendor-carousel">
                <div class="bg-light p-4">
                    <img src="media/photos/vendor-1.png" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="media/photos/vendor-2.png" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="media/photos/vendor-3.png" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="media/photos/vendor-4.png" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="media/photos/vendor-5.png" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="media/photos/vendor-6.png" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="media/photos/vendor-7.png" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="media/photos/vendor-8.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-secondary py-5 px-sm-3 px-md-5" style="margin-top: 90px;">
        <div class="row pt-5">
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-uppercase text-light mb-4">Contáctanos</h4>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-white mr-3"></i>FREIRE #82, CONCEPCIÓN</p>
                <p class="mb-2"><i class="fa fa-phone-alt text-white mr-3"></i>+569 8765 4321</p>
                <p><i class="fa fa-envelope text-white mr-3"></i>bocar@bocar.cl</p>
                <h6 class="text-uppercase text-white py-2">Síguenos</h6>
                <div class="d-flex justify-content-start">
                    <!--   <a class="btn btn-lg btn-dark btn-lg-square mr-2" href="#"><i class="fab fa-twitter"></i></a> -->
                    <a class="btn btn-lg btn-dark btn-lg-square mr-2" href="https://web.facebook.com/BOCARIMPORTACIONES?locale=es_LA"><i class="fab fa-facebook-f"></i></a>
                    <!--    <a class="btn btn-lg btn-dark btn-lg-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a> -->
                    <a class="btn btn-lg btn-dark btn-lg-square" href="https://www.instagram.com/neumaconce/?hl=es"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-uppercase text-light mb-4">condiciones</h4>
                <div class="d-flex flex-column justify-content-start">
                    <a class="text-body mb-2" href="#"><i class="fa fa-angle-right text-white mr-2"></i>Politicas</a>
                    <a class="text-body mb-2" href="#"><i class="fa fa-angle-right text-white mr-2"></i>Terminos & Condiciones</a>
                    <a class="text-body mb-2" href="#"><i class="fa fa-angle-right text-white mr-2"></i>Registros de nuevos miembros</a>
                    <a class="text-body" href="#"><i class="fa fa-angle-right text-white mr-2"></i>Ayuda & Preguntas</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-uppercase text-light mb-4">Galería de Vehiculos</h4>
                <div class="row mx-n1">
                    <div class="col-4 px-1 mb-2">
                        <a href=""><img class="w-100" src="media/photos/vendor-1.png" alt=""></a>

                    </div>
                    <div class="col-4 px-1 mb-2">
                        <a href=""><img class="w-100" src="media/photos/vendor-2.png" alt=""></a>
                    </div>
                    <div class="col-4 px-1 mb-2">
                        <a href=""><img class="w-100" src="media/photos/vendor-3.png" alt=""></a>
                    </div>
                    <div class="col-4 px-1 mb-2">
                        <a href=""><img class="w-100" src="media/photos/vendor-4.png" alt=""></a>
                    </div>
                    <div class="col-4 px-1 mb-2">
                        <a href=""><img class="w-100" src="media/photos/vendor-5.png" alt=""></a>
                    </div>
                    <div class="col-4 px-1 mb-2">
                        <a href=""><img class="w-100" src="media/photos/vendor-6.png" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-uppercase text-light mb-4">Suscribete</h4>
                <p class="mb-4">Recibe ofertas de tu auto o de los productos que no tenemos en stock a tiempo real una vez que nos llegue a tu correo </p>
                <div class="w-100 mb-3">
                    <div class="input-group">
                        <form action="{{ route('register') }}" method="get">
                            <div class="input-group-append">
                                <input type="text" class="form-control bg-dark border-dark" style="padding: 25px;" placeholder="Tu Email">
                                <button class="btn btn-primary text-uppercase px-3">Regístrate</button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark py-4 px-sm-3 px-md-5">
        <p class="mb-2 text-center text-body">&copy; <a href="#">NEUMACONCE</a>. Todos los derechos Reservados.</p>
        <p class="m-0 text-center text-body">Diseñado por <a href="#">FFIB</a></p>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>
    @endsection