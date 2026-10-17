<?php
namespace App\Providers;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class View {

    // Render a Twig template
    static public function render(string $template, $data = []){
        $loader = new FilesystemLoader('views');
        $twig = new Environment($loader);
        $twig->addGlobal('asset', ASSET);
        $twig->addGlobal('base', BASE);
        echo $twig->render($template . ".php", $data);
    }

    // Redirect to a page
    static public function redirect(string $url){
        header('Location: ' . BASE . '/' . $url);
        exit;
    }
}