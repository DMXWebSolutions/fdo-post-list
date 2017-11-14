<?= $before_widget ?>
    <?php if(!empty($instance['title'])): ?>
        <?= $before_title ?>
            <?= $instance['title'] ?>
        <?= $after_title ?>
    <?php endif; ?>

    <div class="fdo-post-list-widget">
        <ul>
            <?php $i = 1?>
            <?php foreach($posts as $post): ?>
                <li><a href="javascript:void()"><?=$i . ' - ' . $post->post_title ?></a></li>
                <?php ++$i ?>
            <?php endforeach; ?>
            <li><a href="javascript:void()">Post 3</a></li>
        </ul>
    </div>
<?= $after_widget ?>