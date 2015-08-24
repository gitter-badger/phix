<!DOCTYPE html>
<html>
    <head>
        <? e('sections/head_content') ?>
    </head>

    <body>
        <? if ($jcrop_modal_need) e('jcrop/modal') ?>
        <? e('sections/navbar') ?>

        <div class="container">

            <? e('sections/alerts') ?>

            <?= $content ?>

        </div><!-- /.container -->

        <?= js_resources() ?>
    </body>
</html>