<!-- Add jQuery for simplicity -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        // Fetch and populate years
        $.get('/api/vehicles/years', function(data) {
            let yearSelect = $('select[name="year"]');
            yearSelect.empty();
            yearSelect.append('<option selected>Año</option>');
            data.forEach(function(year) {
                yearSelect.append('<option value="' + year.year + '">' + year.year + '</option>');
            });
        });

        // Fetch and populate brands
        $.get('/api/vehicles/brands', function(data) {
            let brandSelect = $('select[name="brand"]');
            brandSelect.empty();
            brandSelect.append('<option selected>Marca</option>');
            data.forEach(function(brand) {
                brandSelect.append('<option value="' + brand.id + '">' + brand.name + '</option>');
            });
        });

        $('select[name="brand"]').change(function() {
            let brandId = $(this).val();
            if (brandId) {
                $.get('/api/vehicles/models', {
                    brandId: brandId
                }, function(data) {
                    console.log("Received models data:", data); // Debugging line
                    let modelSelect = $('select[name="model"]');
                    modelSelect.empty();
                    modelSelect.append('<option selected>Modelo</option>');
                    data.forEach(function(model) {
                        modelSelect.append('<option value="' + model.model + '">' + model.model + '</option>');
                    });
                }).fail(function() {
                    console.error("Failed to fetch models for brandId:", brandId); // Error handling
                });
            }
        });

    });
</script>

<div class="container-fluid bg-white py-1 px-lg-5">
    <div class="row mx-n2 mb-3 align-items-center">
        <div class="col-12 px-2 py-2">
            <p class="font-weight-bold mb-1">Selecciona tu vehículo</p>
            <p class="mb-1" style="font-size: 14px;">Por favor introduzca los detalles de su auto para confirmar compatibilidad</p>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 px-2 align-items-center">
            <select class="custom-select px-4" name="year" style="height: 50px;">
                <option selected>Año</option>
                <!-- Year options will be populated here -->
            </select>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 px-2 align-items-center">
            <select class="custom-select px-4" name="brand" style="height: 50px;">
                <option selected>Marca</option>
                <!-- Brand options will be populated here -->
            </select>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 px-2 align-items-center">
            <select class="custom-select px-4" name="model" style="height: 50px;">
                <option selected>Modelo</option>
                <!-- Model options will be populated here -->
            </select>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 px-2 d-flex align-items-center justify-content-center">
            <button class="btn btn-primary btn-block" type="submit" style="height: 50px;">Buscar</button>
        </div>
    </div>
</div>