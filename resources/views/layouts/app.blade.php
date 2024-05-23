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

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Rubik&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
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
                        <a href="service" class="nav-item nav-link">Servicios</a>

                        {{-- Menu usuario registrado/noRegistrado --}}
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Páginas</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="team" class="dropdown-item">Equipo</a>
                                <a href="testimonial" class="dropdown-item">Testimonio</a>
                                <a href="about" class="dropdown-item">Sobre nosotros</a>
                            </div>
                        </div>
                        <a href="contact" class="nav-item nav-link">Contacto</a>


                        {{-- Dropdown de admin --}}
                        @auth
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Hola, {{Auth::user()->name }}</a>
                                <div class="dropdown-menu rounded-0 m-0">

                                    <a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a>

                                    <a class="dropdown-item" href="{{ route('wishlist') }}">Mi lista de deseados</a>

                                    <a class="dropdown-item" href="{{ url('profiles') }}">Perfil</a>

                                    
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
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
                        <!-- Carrito -->
                        <div class="nav-item dropdown">
                            <a href="#" id="cart-toggle-btn" class="nav-link dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-shopping-cart"></i>
                                @if(Session::has('cart'))
                                    <span class="badge badge-danger cart-count">{{ count(Session::get('cart')) }}</span>
                                @endif
                            </a>
                            <div class="dropdown-menu rounded-0 m-0" id="cart-toggle-menu" aria-labelledby="cart-toggle-btn" style="width: 300px; right: 0; left: auto;">
                                <div class="px-3 py-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-bold" style="letter-spacing: 1px;">Carrito</span>
                                        <span class="fw-bold cart-item-count" style="letter-spacing: 1px;">
                                            @if(Session::has('cart'))
                                                {{ count(Session::get('cart')) }} Producto(s)
                                            @else
                                                0 Productos
                                            @endif
                                        </span>
                                    </div>
                                    <hr class="dropdown-divider">
                                    @if(Session::has('cart') && count(Session::get('cart')) > 0)
                                        @php $totalPrice = 0; @endphp
                                        @foreach(Session::get('cart') as $id => $details)
                                            @php $subtotal = $details['price'] * $details['quantity']; @endphp
                                            @php $totalPrice += $subtotal; @endphp
                                            <div class="d-flex flex-column mb-2 cart-item" data-product-id="{{ $id }}" style="font-size: 12px;">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span>{{ $details['name'] }}</span>
                                                    <button type="button" class="btn btn-sm btn-outline-danger delete-btn" data-product-id="{{ $id }}" style="font-size: 10px;">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </div>
                                                <div class="quantity-controls d-flex align-items-center mt-2">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary decrease-btn" data-product-id="{{ $id }}" style="font-size: 10px;">-</button>
                                                    <input type="text" value="{{ $details['quantity'] }}" id="quantity-{{ $id }}" class="form-control form-control-sm text-center mx-2 quantity-input" style="width: 40px; font-size: 12px;">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary increase-btn" data-product-id="{{ $id }}" style="font-size: 10px;">+</button>
                                                    <span class="fw-bold product-price" data-unit-price="{{ $details['price'] }}" style="font-size: 12px;">{{ number_format($subtotal, 0, ',', '.') }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                        <hr class="dropdown-divider">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="fw-bold" style="font-size: 12px;">Precio Total</span>
                                            <span class="fw-bold total-price" style="font-size: 12px;">{{ number_format($totalPrice, 0, ',', '.') }}</span>
                                        </div>
                                        <hr class="dropdown-divider">
                                        <div class="text-center mb-3">
                                            <a href="{{ route('cart.index') }}" class="btn btn-secondary me-3" style="font-size: 12px;">Ir al Carrito</a>
                                            <a href="{{ route('checkout') }}" class="btn btn-primary" style="font-size: 12px;">Comprar</a>
                                        </div>
                                    @else
                                        <div class="text-center mb-3" style="font-size: 12px;">
                                            No hay productos en el carrito
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                const cartToggleLink = document.getElementById('cart-toggle-btn');
                                const cartMenu = document.getElementById('cart-toggle-menu');
                                const decreaseButtons = document.querySelectorAll('.decrease-btn');
                                const increaseButtons = document.querySelectorAll('.increase-btn');
                                const deleteButtons = document.querySelectorAll('.delete-btn');
                                const totalPriceElement = document.querySelector('.total-price');
                                const cartItemCountElement = document.querySelector('.cart-item-count');

                                cartToggleLink.addEventListener('click', function(event) {
                                    event.preventDefault();
                                    cartMenu.classList.toggle('show');
                                });

                                decreaseButtons.forEach(button => {
                                    button.addEventListener('click', () => updateQuantity(button.getAttribute('data-product-id'), 'decrease'));
                                });

                                increaseButtons.forEach(button => {
                                    button.addEventListener('click', () => updateQuantity(button.getAttribute('data-product-id'), 'increase'));
                                });

                                deleteButtons.forEach(button => {
                                    button.addEventListener('click', () => confirmDelete(button.getAttribute('data-product-id')));
                                });

                                updateTotalPrice();

                                function updateQuantity(productId, action) {
                                    const quantityElement = document.getElementById('quantity-' + productId);
                                    let quantity = parseInt(quantityElement.value);

                                    if (action === 'increase') {
                                        quantity++;
                                    } else if (action === 'decrease' && quantity > 1) {
                                        quantity--;
                                    }

                                    quantityElement.value = quantity;

                                    const productPrice = parseFloat(document.querySelector('.cart-item[data-product-id="' + productId + '"] .product-price').getAttribute('data-unit-price'));
                                    const subtotal = quantity * productPrice;
                                    document.querySelector('.cart-item[data-product-id="' + productId + '"] .product-price').textContent = formatPrice(subtotal);

                                    updateTotalPrice();
                                    updateCartSessionStorage(productId, quantity); // Guardar la cantidad actualizada en sessionStorage
                                }

                                function updateTotalPrice() {
                                    let totalPrice = 0;
                                    document.querySelectorAll('.cart-item').forEach(item => {
                                        const unitPrice = parseFloat(item.querySelector('.product-price').getAttribute('data-unit-price'));
                                        const quantity = parseInt(item.querySelector('.quantity-input').value);
                                        totalPrice += unitPrice * quantity;
                                    });
                                    totalPriceElement.textContent = formatPrice(totalPrice);
                                    cartItemCountElement.textContent = document.querySelectorAll('.cart-item').length + " Producto(s)";
                                }

                                function confirmDelete(productId) {
                                    if (confirm("¿Está seguro que desea eliminar este producto?")) {
                                        fetch('/cart/remove/' + productId, {
                                            method: 'DELETE',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                            }
                                        })
                                        .then(response => {
                                            if (!response.ok) {
                                                throw new Error('Network response was not ok');
                                            }
                                            return response.json();
                                        })
                                        .then(data => {
                                            // Eliminar el producto del carrito en la sesión
                                            const cart = JSON.parse(sessionStorage.getItem('cart')) || [];
                                            const updatedCart = cart.filter(item => item.id !== productId);
                                            sessionStorage.setItem('cart', JSON.stringify(updatedCart));

                                            // Eliminar el elemento del carrito del DOM
                                            const cartItem = document.querySelector('.cart-item[data-product-id="' + productId + '"]');
                                            if (cartItem) {
                                                cartItem.remove(); // Eliminar el elemento del carrito del DOM
                                            } else {
                                                console.error("No se encontró el elemento del producto en el carrito.");
                                            }
                                            totalPriceElement.textContent = formatPrice(data.total);
                                            cartItemCountElement.textContent = `${data.itemCount} Producto(s)`;
                                        })
                                        .catch(error => {
                                            console.error('Hubo un error con la operación de red:', error);
                                        });
                                    }
                                }

                                function updateCartSessionStorage(productId, quantity) {
                                    const cart = JSON.parse(sessionStorage.getItem('cart')) || [];
                                    const updatedCart = cart.map(item => {
                                        if (item.id == productId) {
                                            item.quantity = quantity;
                                        }
                                        return item;
                                    });
                                    sessionStorage.setItem('cart', JSON.stringify(updatedCart));
                                }

                                function loadCartItems() {
                                    const cart = JSON.parse(sessionStorage.getItem('cart')) || [];
                                    cart.forEach(item => {
                                        const productId = item.id;
                                        const quantity = item.quantity;
                                        const quantityElement = document.getElementById('quantity-' + productId);
                                        if (quantityElement) {
                                            quantityElement.value = quantity;
                                        }
                                    });
                                }

                                function formatPrice(price) {
                                    return '$' + price.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                                }
                            });
                        </script>



                            


                        





                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->

    <main class="py-4">
        @yield('content')
    </main>


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
</body>
</html>
