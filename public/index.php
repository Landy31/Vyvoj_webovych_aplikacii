<?php

// Official Vaííčko public entry point (the Framework directory must be present).
require __DIR__ . '/../Framework/ClassLoader.php';

use Framework\Core\App;

try {
    $app = new App();
    $app->run();
} catch (Exception $e) {
    die('An error occurred: ' . $e->getMessage());
}
