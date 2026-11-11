<?php declare(strict_types=1);

function view(string $view, array $data = [])
{
    // Extract variables if you pass data to views later
    extract($data); 
    
    // Start capturing output
    ob_start();
    require BASE_PATH . "/src/views/{$view}.php";
    // Return the captured HTML as a string cleanly
    return ob_get_clean();
}
