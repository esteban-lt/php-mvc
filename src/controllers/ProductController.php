<?php
class ProductController
{
    private Product $product;

    public function __construct()
    {
        $this->product = new Product();
    }

    public function index()
    {
        $products = $this->product->all();
        View::render('products/index', ['products' => $this->product->all()]);
    }

    public function create()
    {
        $product = ['name' => '', 'price' => ''];
        $error = '';
        View::render('products/create', [
            'product' => ['name' => '', 'price' => ''],
            'error'   => '',
        ]);
    }

    public function store()
    {
        $product = [
            'name'  => trim($_POST['name'] ?? ''),
            'price' => $_POST['price'] ?? '',
        ];

        if ($product['name'] === '' || mb_strlen($product['name']) > 100 || !is_numeric($product['price']) || $product['price'] <= 0 || $product['price'] > 99999999.99) {
            $error = 'Escribe un nombre y un precio mayor que 0.';
            View::render('products/create', [
                'product' => $product,
                'error'   => 'Escribe un nombre y un precio mayor que 0.',
            ]);
            return;
        }

        $this->product->create($product['name'], (float) $product['price']);
        header('Location: ' . URL_SITE . '/');
        exit;
    }

    public function edit()
    {
        $product = $this->product->find((int) ($_GET['id'] ?? 0));
        $error = '';

        if (!$product) {
            http_response_code(404);
            exit('Producto no encontrado');
        }

        View::render('products/edit', ['product' => $product, 'error' => '']);
    }

    public function update()
    {
        $id = (int) ($_POST['id'] ?? 0);
        $product = [
            'id'    => $id,
            'name'  => trim($_POST['name'] ?? ''),
            'price' => $_POST['price'] ?? '',
        ];

        if ($product['name'] === '' || mb_strlen($product['name']) > 100 || !is_numeric($product['price']) || $product['price'] <= 0 || $product['price'] > 99999999.99) {
            $error = 'Escribe un nombre y un precio mayor que 0.';
            View::render('products/edit', [
                'product' => $product,
                'error'   => 'Escribe un nombre y un precio mayor que 0.',
            ]);
            return;
        }

        $this->product->update($id, $product['name'], (float) $product['price']);
        header('Location: ' . URL_SITE . '/');
        exit;
    }

    public function destroy()
    {
        $this->product->delete((int) ($_POST['id'] ?? 0));
        header('Location: ' . URL_SITE . '/');
        exit;
    }
}
