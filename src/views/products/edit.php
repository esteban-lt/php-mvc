<?php
/**
 * @var array $product  ['id' => ..., 'name' => ..., 'price' => ...]
 * @var string $error
 */
?>
<h2 class="mb-3">Editar producto</h2>

<?php if ($error !== ''): ?>
    <div class="alert alert-danger"><?= e($error) ?></div>
<?php endif; ?>

<form action="<?= URL_SITE ?>/update" method="post" class="card card-body">
    <input type="hidden" name="id" value="<?= e($product['id']) ?>">

    <div class="mb-3">
        <label for="name" class="form-label">Nombre</label>
        <input type="text" id="name" name="name" class="form-control"
               maxlength="100" value="<?= e($product['name']) ?>" required>
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Precio</label>
        <input type="number" id="price" name="price" class="form-control" step="0.01" min="0.01" value="<?= e($product['price']) ?>" required>
    </div>

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="<?= URL_SITE ?>/" class="btn btn-secondary">Cancelar</a>
    </div>
</form>
