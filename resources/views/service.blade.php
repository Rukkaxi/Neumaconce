@extends('layouts.app')

    @section('content')

        <!-- Services Start -->
        <div class="container-fluid py-5">
            <div class="container pt-5 pb-3">
                <h1 class="display-4 text-uppercase text-center mb-5">Nuestros Servicios</h1>
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-2">
                        <a href="agendar-visitas.html" class="service-item-link">
                            <div class="service-item d-flex flex-column justify-content-center px-4 mb-4">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="d-flex align-items-center justify-content-center bg-primary ml-n4" style="width: 80px; height: 80px;">
                                        <i class="fa fa-2x fa-taxi text-secondary"></i>
                                    </div>
                                    <h1 class="display-2 text-white mt-n2 m-0">01</h1>
                                </div>
                                <h4 class="text-uppercase mb-3">Agendar Visitas</h4>
                                <p class="m-0">Agenda visitas para compatibilidad de piezas, revisión técnica, reparación y/o mantenimiento</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-2">
                        <a href="cotizar.html" class="service-item-link">
                            <div class="service-item active d-flex flex-column justify-content-center px-4 mb-4">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="d-flex align-items-center justify-content-center bg-primary ml-n4" style="width: 80px; height: 80px;">
                                        <i class="fa fa-2x fa-money-check-alt text-secondary"></i>
                                    </div>
                                    <h1 class="display-2 text-white mt-n2 m-0">02</h1>
                                </div>
                                <h4 class="text-uppercase mb-3">Cotiza con Nosotros</h4>
                                <p class="m-0">Cotiza algún producto que buscas y te respondemos si lo proveemos</p>
                            </div>
                        </a>
                    </div>
                    <!-- <div class="col-lg-4 col-md-6 mb-2">
                        <a href="shop" class="service-item-link">
                            <div class="service-item d-flex flex-column justify-content-center px-4 mb-4">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="d-flex align-items-center justify-content-center bg-primary ml-n4" style="width: 80px; height: 80px;">
                                        <i class="fa fa-2x fa-car text-secondary"></i>
                                    </div>
                                    <h1 class="display-2 text-white mt-n2 m-0">03</h1>
                                </div>
                                <h4 class="text-uppercase mb-3">Tienda</h4>
                                <p class="m-0">Venta de productos para vehículos, piezas y repuestos</p>
                            </div>
                        </a>
                    </div> -->
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

        @include('layouts.footer')

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/tempusdominus/js/moment.min.js"></script>
        <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
        <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

        <!-- Template Javascript -->
        <script src="js/main.js"></script>

    @endsection