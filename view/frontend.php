<?= $before_widget ?>
    <?php if(!empty($instance['title'])): ?>
        <?= $before_title ?>
            <?= $instance['title'] ?>
        <?= $after_title ?>
    <?php endif; ?>
    <div class="fdo-post-list-widget">
        <ul>
            <?php foreach($posts as $post): ?>
                <li><a href="<?= get_permalink($post->ID); ?>"><?= $post->post_title ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?= $after_widget ?>