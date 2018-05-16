<?php
session_start();
$includePath =  __DIR__.DIRECTORY_SEPARATOR.'includes';
$_SESSION['includePath'] = $includePath;
set_include_path($_SESSION['includePath']);
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include_once('html/header.html');?>
    </head>

    <body>
        <?php include('html/navbar.html') ?>
        <div class="container">
            <a id="aboutme"></a>
            <div id="main">
                <?php include('html/aboutme.html') ?>
                <hr>
                <?php include('html/resume.html') ?>
                <hr>
                <?php include('php/partials/blog.php') ?>
            </div>
        </div>
        <hr>
            <?php include_once('php/partials/footer.php') ?>
    </body>

    </html>