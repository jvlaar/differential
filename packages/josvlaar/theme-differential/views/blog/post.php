<section class="blogpost">

    <?php if ($image = $post->get('image.src')): ?>
        <img src="<?= $image ?>" alt="<?= $post->get('image.alt') ?>">
    <?php endif ?>

    <main>
        <h1 class="uk-article-title"><?= $post->title ?></h1>

        <small>
            <?= __('Written by %name% on %date%', ['%name%' => $post->user->name, '%date%' => $post->date->format('d-m-Y')]) ?>
        </small>

        <?= $post->content ?>

        <?= $view->render('blog/comments.php') ?>
    </main>

    <?php if ($view->position()->exists('below-blog')) : ?>
        <?= $view->position('below-blog', 'belowblog.php') ?>
    <?php endif ?>

</section>