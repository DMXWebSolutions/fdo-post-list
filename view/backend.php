<p>
    <label for="<?= $this->get_field_id('title'); ?>">
        <?php _e('Title:'); ?>
    </label> 
    <input class="widefat" id="<?= $this->get_field_id('title'); ?>" name="<?= $this->get_field_name('title'); ?>" type="text" value="<?= esc_attr($title); ?>" />
</p>

<p>
    <label for="<?= $this->get_field_id('filter'); ?>">
        Exibir: 
    </label>
    <select class="widefat" id="<?= $this->get_field_id('filter'); ?>" name="<?= $this->get_field_name('filter'); ?>">
        <option value="related" <?= ($postFilter == 'related') ? 'selected' : '' ?>>Relacionados</option>
        <option value="most-recent" <?= ($postFilter == 'most-recent') ? 'selected' : '' ?>>Mais recentes</option>
    </select>
</p>

<p>
    <label for="<?= $this->get_field_id('number-posts'); ?>">
        Quantidade:
    </label>
    <input class="widefat" id="<?= $this->get_field_id('number-posts'); ?>" name="<?= $this->get_field_name('number-posts'); ?>" type="text" value="<?= $numberPosts ?>" placeholder="Ex.: 5" />
</p>