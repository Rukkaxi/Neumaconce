<!-- Add jQuery for simplicity -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#searchFilterModal').on('show.bs.modal', function() {
            // Fetch and populate brands
            $.get('/api/vehicles/brands', function(data) {
                let brandSelect = $('select[name="brand"]');
                brandSelect.empty();
                brandSelect.append('<option value="" selected>Marca</option>');
                data.forEach(function(brand) {
                    brandSelect.append('<option value="' + brand.id + '">' + brand.name + '</option>');
                });
            });

            // When brand is selected, populate models and reset year options
            $('select[name="brand"]').change(function() {
                let brandId = $(this).val();
                if (brandId) {
                    $.get('/api/vehicles/models', {
                        brandId: brandId
                    }, function(data) {
                        let modelSelect = $('select[name="model"]');
                        modelSelect.empty();
                        modelSelect.append('<option value="" selected>Modelo</option>');
                        data.forEach(function(model) {
                            modelSelect.append('<option value="' + model.model + '">' + model.model + '</option>');
                        });
                    }).fail(function() {
                        console.error("Failed to fetch models for brandId:", brandId);
                    });
                } else {
                    // Reset model and year options if no brand is selected
                    $('select[name="model"]').empty().append('<option value="" selected>Modelo</option>');
                    $('select[name="year"]').empty().append('<option value="" selected>Año</option>');
                }
            });

            // When model is selected, populate years
            $('select[name="model"]').change(function() {
                let brandId = $('select[name="brand"]').val();
                let model = $(this).val();
                if (brandId && model) {
                    $.get('/api/vehicles/years', {
                        brandId: brandId,
                        model: model
                    }, function(data) {
                        console.log("Years data received:", data); // Log the data received
                        let uniqueYears = [...new Set(data.map(item => item.year))]; // Filter unique years
                        let yearSelect = $('select[name="year"]');
                        yearSelect.empty();
                        yearSelect.append('<option value="" selected>Año</option>');
                        uniqueYears.forEach(function(year) {
                            yearSelect.append('<option value="' + year + '">' + year + '</option>');
                        });
                    }).fail(function() {
                        console.error("Failed to fetch years for brandId:", brandId, "and model:", model);
                    });


                } else {
                    // Reset year options if no model is selected
                    $('select[name="year"]').empty().append('<option value="" selected>Año</option>');
                }
            });
        });
    });
</script>


<!-- Search Filter Modal -->
<div class="modal fade" id="searchFilterModal" tabindex="-1" role="dialog" aria-labelledby="searchFilterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="searchFilterModalLabel">Selecciona tu vehículo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid bg-white py-1 px-lg-5">
                    <div class="col-12 px-2 py-2">
                        <p class="font-weight-bold mb-1">Selecciona tu vehículo</p>
                        <p class="mb-1" style="font-size: 14px;">Por favor introduzca los detalles de su auto para confirmar compatibilidad</p>
                    </div>
                    <div class="row mx-n2 mb-3 align-items-center">
                        <div class="col-xl-4 col-lg-4 col-md-6 px-2 align-items-center">
                            <select class="custom-select px-4" name="brand" style="height: 50px;">
                                <option value="" selected>Marca</option>
                                <!-- Brand options will be populated here -->
                            </select>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-6 px-2 align-items-center">
                            <select class="custom-select px-4" name="model" style="height: 50px;">
                                <option value="" selected>Modelo</option>
                                <!-- Model options will be populated here -->
                            </select>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-6 px-2 align-items-center">
                            <select class="custom-select px-4" name="year" style="height: 50px;">
                                <option value="" selected>Año</option>
                                <!-- Year options will be populated here -->
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </div>
    </div>
</div>