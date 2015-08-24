<!DOCTYPE html>
<html>
    <head>
        <? r('head_content') ?>
    </head>

    <body>
        <? r('navbar') ?>

        <div class="container">
            <?= $content ?>
        </div><!-- /.container -->

        <?= js_resources() ?>
    </body>
</html>