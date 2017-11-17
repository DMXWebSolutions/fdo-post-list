<?= $before_widget ?>
    <?php if(!empty($instance['title'])): ?>
        <?= $before_title ?>
            <?= $instance['title'] ?>
        <?= $after_title ?>
    <?php endif; ?>
    <ul class="fdo-posts-list">
        <?php foreach($posts as $post): ?>
            <li class="fdo-post-item"><a class="post-link" href="<?= get_permalink($post->ID); ?>"><?= $post->post_title ?></a></li>
        <?php endforeach; ?>
    </ul>
<?= $after_widget ?>