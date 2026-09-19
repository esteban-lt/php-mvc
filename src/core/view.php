<?php
class View
{
    public static function render(string $name, array $data = []): void
    {
        extract($data);

        ob_start();
        require __DIR__ . "/../views/$name.php";
        $content = ob_get_clean();

        require __DIR__ . '/../views/layouts/main.php';
    }
}
