<div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-light mb-3">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav w-100 d-flex justify-content-between align-items-center">
                    <!-- Categories Label for small screens -->
                    <li class="nav-item d-lg-none">
                        <span class="nav-link text-center font-weight-bold">Categorías</span>
                    </li>
                    @foreach($categories as $category)
                    <li class="nav-item">
                        <a class="nav-link text-center" href="{{ url('/shop/' . $category->name) }}">{{ $category->name }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>
</div>