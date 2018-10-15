<?php if ($root->getDepth() === 0) : ?>
	<button id="toggle"></button>
	<nav id="menu" class="hidden">
<?php endif ?>

<?php foreach ($root->getChildren() as $node) : ?>
        <a href="<?= $node->getUrl() ?>" class="<?= $node->get('active') ? 'active' : '' ?>">
            <?= $node->title ?>
        </a>
<?php endforeach ?>

<?php if ($root->getDepth() === 0) : ?>
    </nav>
<?php endif ?>