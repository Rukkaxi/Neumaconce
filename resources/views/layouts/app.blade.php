<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>NEUMACONCE - Bocar Concepción</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Rubik&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- Other header content -->
    @yield('scripts')

</head>

<body>


    <!-- Topbar Start -->
    <div class="container-fluid bg-dark py-3 px-lg-5 d-none d-lg-block">
        <div class="row">
            <div class="col-md-6 text-center text-lg-left mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center">
                    <a class="text-body pr-3" href=""><i class="fa fa-phone-alt mr-2"></i>+56974229630</a>
                    <span class="text-body">|</span>
                    <a class="text-body px-3" href=""><i class="fa fa-envelope mr-2"></i>bocar@bocar.cl</a>
                </div>
            </div>
            <div class="col-md-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-body px-3" href="https://www.facebook.com/BOCARIMPORTACIONES/">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-body px-3" href="https://www.instagram.com/neumaconce/">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    @include('layouts.search')

    <!-- Navbar Start -->
    <div class="container-fluid position-relative nav-bar p-0">
        <div class="position-relative px-lg-5" style="z-index: 9;">
            <nav class="navbar navbar-expand-lg bg-secondary navbar-dark py-3 py-lg-0 pl-3 pl-lg-5">
                <a href="{{ url('/') }}" class="navbar-brand">
                    <h1 class="text-uppercase text-primary mb-1">NEUMA CONCE</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                    <div class="navbar-nav ml-auto py-0">
                        <a href='/' class="nav-item nav-link">Inicio</a>

                        <a href="{{ route('shop.index') }}" class="nav-item nav-link">Tienda</a>
                        <a href="{{ route('gallery.index') }}" class="nav-item nav-link">Galeria</a>

                        {{-- Menu usuario registrado/noRegistrado --}}
                        <!-- <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Páginas</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="team" class="dropdown-item">Equipo</a>
                                <a href="testimonial" class="dropdown-item">Testimonio</a>
                                <a href="about" class="dropdown-item">Sobre nosotros</a>
                            </div>
                        </div> -->
                        <a href="contact" class="nav-item nav-link">Contacto</a>
                            

                        <a class="nav-item nav-link" href="{{ route('cotizaciones.form') }}">Cotizaciones</a>


                        {{-- Dropdown de admin --}}
                        @auth
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Hola, {{Auth::user()->name }}</a>
                            <div class="dropdown-menu rounded-0 m-0">

                                <a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a>

                                <a class="dropdown-item" href="{{ route('wishlist') }}">Mi lista de deseados</a>

                                <a class="dropdown-item" href="{{ url('profiles') }}">Perfil</a>


                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    {{ __('Cerrar Sesión') }}
                                </a>



                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                        @else
                        <a href="{{ route('login') }}" class="nav-item nav-link text-sm  underline">Iniciar Sesión</a>

                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="nav-item nav-link text-sm  underline">Registro</a>
                        @endif
                        @endauth

                        <!-- Search Filter Icon -->
                        <a href="#" class="nav-item nav-link" data-toggle="modal" data-target="#searchFilterModal">
                            <i class="fa fa-car"></i>
                        </a>

                        <!-- Cart Icon -->
                        <a href="#" class="nav-item nav-link" data-toggle="modal" data-target="#cartModal">
                            <i class="fa fa-shopping-cart"></i>
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->

    @include('layouts.cart')



    <main class="py-4">
        @yield('content')
    </main>



    <!-- JavaScript Libraries -->

    <!-- Scripts del cart (versiones mas recientes) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script> -->
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Cart -->

    <!-- test -->

    <script>
        $(document).ready(function() {
            console.log("jQuery is working!");
        });
    </script>


    <script>
        $(document).ready(function() {
            // Test if jQuery is working
            console.log("jQuery is loaded and working!");

            // Test AJAX request
            $('#test-button').click(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "/test-ajax",
                    method: "GET",
                    success: function(response) {
                        console.log("AJAX request successful!");
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        console.log("AJAX request failed!");
                        console.log(xhr.responseText);
                    }
                });
            });

            // Add to cart functionality
            $(document).on('click', '.add-to-cart', function(e) {
                e.preventDefault();

                var productId = $(this).data('product-id'); // Assuming productId is stored in a data attribute
                var id = $(this).data('id');
                var quantity = 1; // or get from input field

                $.ajax({
                    url: "{{ route('cart.add') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id,
                        quantity: quantity
                    },
                    success: function(response) {
                        updateCartModal(response.cart);
                        $('#cartModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            });

            // Remove from cart functionality
            $(document).on('click', '.remove-from-cart', function(e) {
                e.preventDefault();

                var id = $(this).data('id');

                $.ajax({
                    url: '/cart/remove/' + id, // Changed to use 'id' variable
                    type: 'POST', // Ensure that the method is set to POST
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        updateCartModal(response.cart);
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            });

            // Update cart modal
            function updateCartModal(cart) {
                $('#cart-items').empty();
                var totalPrice = 0;
                $.each(cart, function(i, item) {
                    var itemPrice = parseFloat(item.price) * parseFloat(item.quantity);
                    var row = '<tr>' +
                        '<td>' +
                        (item.attributes && item.attributes.image ?
                            '<img src="' + item.attributes.image + '" alt="' + item.name + '" style="width: 100px; height: 100px;">' :
                            '<span>No Image</span>') +
                        '</td>' +
                        '<td>' + item.name + '</td>' +
                        '<td>$' + item.price + '</td>' +
                        '<td>' +
                        '<button class="btn btn-secondary btn-sm decrease-quantity" data-id="' + item.id + '">-</button>' +
                        '<span>' + item.quantity + '</span>' +
                        '<button class="btn btn-secondary btn-sm increase-quantity" data-id="' + item.id + '">+</button>' +
                        '</td>' +
                        '<td>' +
                        '<button class="btn btn-danger btn-sm remove-from-cart" data-id="' + item.id + '">Quitar</button>' +
                        '</td>' +
                        '</tr>';
                    $('#cart-items').append(row);
                    totalPrice += itemPrice;
                });
                $('#cart-total').text('$' + totalPrice.toFixed(2)); // Update total price dynamically
            }


            // Increase quantity button click handler
            $(document).on('click', '.increase-quantity', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                updateQuantity(id, 'increase');
                updateCartModal(cart);
            });

            // Decrease quantity button click handler
            $(document).on('click', '.decrease-quantity', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                updateQuantity(id, 'decrease');
                updateCartModal(cart);
            });

            // Function to update quantity
            function updateQuantity(id, action) {
                var quantity = parseInt($('#cart-items').find('[data-id="' + id + '"]').siblings('span').text());
                if (action === 'increase') {
                    quantity++;
                } else if (action === 'decrease' && quantity > 1) {
                    quantity--;
                }
                $.ajax({
                    url: '/cart/update/' + id,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        quantity: quantity
                    },
                    success: function(response) {
                        updateCartModal(response.cart);
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            }

        });
            
    </script>






    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>