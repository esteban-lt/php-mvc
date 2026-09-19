<?php
/** @var array $products */
?>
<div class="d-flex justify-content-between align-items-center">
    <h2 class="mb-3">Lista de Productos</h2>
    <a href="<?= URL_SITE ?>/create" class="btn btn-primary mb-3">Nuevo producto</a>
</div>

<?php if (empty($products)): ?>
    <div class="alert alert-info">No hay productos registrados aún.</div>
<?php else: ?>
    <table class="table table-sm table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= e($product['id']) ?></td>
                    <td><?= e($product['name']) ?></td>
                    <td>$<?= number_format((float) $product['price'], 2) ?></td>
                    <td>
                        <div class="d-flex gap-2">
                            <a 
                                href="<?= URL_SITE ?>/edit?id=<?= e($product['id']) ?>" 
                                class="btn btn-sm btn-warning"
                            >
                                Editar
                            </a>

                            <form 
                                action="<?= URL_SITE ?>/destroy" 
                                method="post" onsubmit="return confirm('¿Seguro que quieres eliminar este producto?')"
                            >
                                <input type="hidden" name="id" value="<?= e($product['id']) ?>">
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
