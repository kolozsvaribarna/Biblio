<?php

session_start();
ini_set("error_log", "error_log.log");

include __DIR__ . "/../vendor/autoload.php";

use App\Routing\Router;

$router = new Router;
$router->handle();

echo <<<HTML
<script>
    const path = window.location.pathname.split('/')[1];

    document.querySelectorAll('.nav-button a').forEach(link => {
    const linkPath = link.getAttribute('href').split('/')[1];

    if (path === linkPath) {
        link.querySelector('button').classList.add('active');
    }

    // Special case for main page
    if (link.getAttribute('href') === '/' && path === '') {
        link.querySelector('button').classList.add('active');
    }
});
</script>
HTML;
?>