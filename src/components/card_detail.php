<div class="container mt-5">
    <div class="row">
        <!-- Columna de la imagen del perfume -->
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <img src="<?php echo PUB ?>uploads/perfumes/<?php $image ?>" class="card-img-top" alt="Imagen del perfume" />
            </div>
        </div>

        <!-- Columna de la información del perfume -->
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title"><?php echo $name; ?></h3>
                    <p class="card-text"><strong>Marca:</strong> <?php echo $brand; ?></p>
                    <p class="card-text"><strong>Género:</strong> <?php echo $gender; ?></p>
                    <p class="card-text"><strong>Tamaño:</strong> <?php echo $size; ?> ml</p>
                    <p class="card-text"><strong>Concentración:</strong> <?php echo $concentration; ?></p>
                    <h4 class="text-success"><strong>$<?php echo $price; ?></strong></h4>

                    <!-- Botón para agregar al carrito o realizar otra acción -->
                    <a href="#" class="btn btn-primary mt-3">Añadir al Carrito</a>
                    <a href="catalog_perfumes.php" class="btn btn-secondary mt-3">Volver al Catálogo</a>
                </div>
            </div>
        </div>
    </div>
</div>