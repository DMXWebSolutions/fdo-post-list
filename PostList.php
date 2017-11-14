<?php

/*
Plugin Name: Custom Post Widget
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: A widget to show a single post.
Version: 0.1
Author: Cleiton Pereira
Author URI: http://URI_Of_The_Plugin_Author
License: MIT
*/

class PostWidget extends WP_Widget
{
    public function __construct()
    {
        add_action('admin_enqueue_scripts', array($this, 'scripts'));

        parent::__construct(
            'fdo-post-list-widget',
            'FDO Custom Post List',
            [
                'description' => 'Liste posts de acordo com as opções disponíveis no widget'
            ]
        );
    }

    public function scripts()
    {
       wp_enqueue_script( 'media-upload' );
       wp_enqueue_media();
       wp_enqueue_script('script', plugins_url('media_manager.js', __FILE__), array('jquery'));
       wp_register_style('styless', plugins_url('styles.css', __FILE__));
       wp_enqueue_style('styless' );
    }

    # Widget frontend
    public function widget($args, $instance)
    {
        $currentPostID = (get_queried_object())->ID;
        $numberPosts = $instance['number-posts'];
        
        $posts = $this->getRelatedPosts($currentPostID, $numberPosts);

        extract($args);

        ob_start();
            include __DIR__ . '/view/frontend.php';
            $template = ob_get_contents();
        ob_end_clean();

        echo $template;
    }

    # Widget backend
    public function form($instance)
    {
        $title = (isset($instance['title'])) ? $instance['title'] : '-';
        $numberPosts = (isset($instance['number-posts'])) ? $instance['number-posts'] : 5;
            
        ob_start();
            include __DIR__ . '/view/backend.php';
            $template = ob_get_contents();
        ob_end_clean();

        echo $template;
    }

    # Update the frontend when backend is changed
    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['number-posts'] = (!empty($new_instance['number-posts'])) ? strip_tags($new_instance['number-posts']) : 5;
        return $instance;
    }

    private function getRelatedPosts($postID, $numberPosts)
    {
        $categories = wp_get_post_categories($postID);
        $posts = [];
        $countPosts = 0;
        

        foreach($categories as $category) {
            if($countPosts >= $numberPosts) break;
            $allPosts = get_posts([
                'numberposts' => $numberPosts,
                'category' => $category
            ]);

            foreach($allPosts as $post) {
                if($countPosts >= $numberPosts) break;
                if(in_array($post->ID, $posts)) continue;
                $posts[$post->ID] = $post;
                ++$countPosts;
            }
        }

        return $posts;
    }
}

add_action('widgets_init', create_function('', 'return register_widget("PostWidget");'));
