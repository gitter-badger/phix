<!DOCTYPE html>
<html>
    <head>
        <? require MC_ROOT . '/templates/head_content.php'; ?>
    </head>

    <body>
        <? require MC_ROOT . '/templates/navbar.php'; ?>

        <div class="container">
            <?= $content ?>
        </div><!-- /.container -->

        <?= js_resources() ?>
    </body>
</html>