<?php

// Config
include( 'config.php' );

// Ini Sites
$siteList = array( 'main', 'admin' );

// Default
$defaultSiteName = 'main';

// Read URL : http://$host/$pageName/$pathElements
$host = $_SERVER['HTTP_HOST'];
$path = ltrim( $_SERVER['REQUEST_URI'], '/' );
$pathElements = trim_array( explode( '/', $path ) ); //remove empty element
$stieName = '';
$pageName = '';

// Session start
session_start();

// Check Developer Mode (localhost)
// take the 2nd element as sitename (1st = product folder)
if ( $host == 'localhost') {
    array_shift( $pathElements );
}

// Check Site & Page from PathElements
$firstElement = array_shift( $pathElements );
$siteName = '';
$pageName = '';
$site = null;
if ( $firstElement && in_array( $firstElement, $siteList ) ) {
    $siteName = $firstElement;
    $pageName = array_shift( $pathElements );
} else {
    $siteName = $defaultSiteName;
    $pageName = $firstElement;
}

if ( !$pageName || $pageName == 'index.php' || $pageName == 'index.html' ) {
    $pageName = 'index';
}

//echo '<div>siteName:'.$siteName.'</div>';
//echo '<div>pageName:'.$pageName.'</div>';

// Ini MVC File
$name_m = $pageName.'Model';
$name_v = $pageName.'View';
$name_c = $pageName.'Controller';

$file_m = $siteName.'/model/'.$name_m.'.php';
$file_v = $siteName.'/view/'.$name_v.'.php';
$file_c = $siteName.'/controller/'.$name_c.'.php';

 // echo '<div>'.$file_m.'</div>';
 // echo '<div>'.$file_v.'</div>';
 // echo '<div>'.$file_c.'</div>';

// Include MVC Files
if ( is_file($file_m) && is_file($file_v) && is_file($file_c) ) {

    require_once( $file_m );//include
    require_once( $file_v );
    require_once( $file_c );

    // Create MVC Instances
    $model      = null;
    $view       = null;
    $controller = null;

    if ( class_exists($name_m) ) $model = new $name_m();
    if ( class_exists($name_c) ) $controller = new $name_c( $model, $pathElements );
    if ( class_exists($name_v) ) $view = new $name_v( $model );

    // Check MVC Exist
    if ( $model != null && $controller != null && $view != null ) {

        // Action (GET & POST)
        if ( isset($_GET['action']) && !empty($_GET['action']) ) 
            $controller->{'action_'.$_GET['action']}();
        if ( isset($_POST['action']) && !empty($_POST['action']) ) 
            $controller->{'action_'.$_POST['action']}();

        // Ajax
        if ( isset($_POST['ajax']) && !empty($_POST['ajax']) ) {
            // Show Ajax Result Only (for ajax request handler(JS) )
            $controller->{'ajax_'.$_POST['ajax']}(); 
        } else {
            // Display Page
            $view->display();
        }

    } else {
        // Page Error ( MVC not complete )
        echo 'Page Error(2).';
    }

} else {
    // Page Not Found
    echo 'Page not found(1).';
}

//echo '<div>SiteName: '.$siteName.'</div>';
//echo '<div>PageName: '.$pageName.'</div>';

function trim_array($Array) {
    foreach ($Array as $value) {
        if (trim($value) == "")
        {
                $index = array_search($value, $Array);
                unset($Array[$index]);
        }
    }
    return $Array;
}