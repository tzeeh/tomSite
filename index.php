<?php
$includePath =  __DIR__.DIRECTORY_SEPARATOR.'includes';
set_include_path($includePath);
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
            <?php include('html/aboutme.html') ?>
            <hr>
            <?php include('html/resume.html') ?>
            <a id="blog"></a>
            <hr>
            <?php include('php/blog.php') ?>
        </div>
        <hr>
            <?php include_once('php/footer.php') ?>
    </body>

    </html>