<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= $view->render('head') ?>
        <?php $view->style('theme', 'theme:css/theme.css') ?>
        <?php $view->script('theme', 'theme:js/theme.js', [], ['async' => true]) ?>
    </head>
    <body>
        <header>
            <a href="<?= $view->url()->get() ?>">
                <?php if ($logo = $params['logo']) : ?>
                    <img class="logo" src="<?= $this->escape($logo) ?>" alt="<?= $params['title'] ?>">
                <?php else : ?>
                    <?= $params['title'] ?>
                <?php endif ?>
            </a>
            <?php if ($view->menu()->exists('main')) : ?>
                <?= $view->menu('main', 'menu-navbar.php') ?>
            <?php endif ?>
        </header>

        <main class="frontpage">
            <?= $view->render('content') ?>

            <?= $view->render('footer') ?>
        </main>
        <div class="leftArt"></div>
        <div class="rightArt"></div>
    </body>
</html>
