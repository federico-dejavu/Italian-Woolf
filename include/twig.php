<?php
	
	spl_autoload_register(function ($classname) {
    $dirs = array (
        '../include/Twig/' #./path/to/dir_where_src_renamed_to_Twig_is_in
    );

    foreach ($dirs as $dir) {
        $filename = $dir . str_replace('\\', '/', $classname) .'.php';
        if (file_exists($filename)) {
            require_once $filename;
            break;
        }
    }

});

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader, [
    'cache' =>  false
]);
?>