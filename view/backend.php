<p>
    <label for="<?= $this->get_field_id('title'); ?>">
        <?php _e('Title:'); ?>
    </label> 
    <input class="widefat" id="<?= $this->get_field_id('title'); ?>" name="<?= $this->get_field_name('title'); ?>" type="text" value="<?= esc_attr($title); ?>" />
</p>

<p>
    <label for="tipo">
        Exibir: 
    </label>
    <select class="widefat" id="tipo" name="tipo">
        <option value="relationed">Relacionados</option>
        <option value="most-recent">Mais recentes</option>
    </select>
</p>

<p>
    <label for="<?= $this->get_field_id('number-posts'); ?>">
        Quantidade:
    </label>
    <input class="widefat" id="<?= $this->get_field_id('number-posts'); ?>" name="<?= $this->get_field_name('number-posts'); ?>" type="text" value="<?= $numberPosts ?>" placeholder="Ex.: 5" />
</p>