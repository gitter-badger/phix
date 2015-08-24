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

        <? require MC_ROOT . '/templates/page_end.php'; ?>
    </body>
</html>