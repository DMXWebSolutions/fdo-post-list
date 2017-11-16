<?php

/*
Plugin Name: FDO Post List Widget
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: Widget to show a list of posts.
Version: 0.1
Author: Cleiton Pereira
Author URI: http://URI_Of_The_Plugin_Author
License: MIT
*/

class PostWidget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'fdo-custom-post-widget',
            'FDO Custom Post List',
            [
                'description' => 'Liste posts de acordo com as opções disponíveis no widget'
            ]
        );
    }

    # Widget frontend
    public function widget($args, $instance)
    {
        $currentPostID = (get_queried_object())->ID;
        $numberPosts = $instance['number-posts'];

        switch($instance['filter']) {
            case 'related':
                $posts = $this->getRelatedPosts($currentPostID, $numberPosts);
                break;
            case 'most-recent':
                $posts = $this->getRecentPosts($numberPosts);
                break;
            default: 
                $posts = $this->getRecentPosts($numberPosts); 
                break;
        }

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
        $title = (isset($instance['title'])) ? $instance['title'] : '';
        $numberPosts = (isset($instance['number-posts'])) ? $instance['number-posts'] : 5;
        $postFilter = (isset($instance['filter'])) ? $instance['filter'] : '';
            
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
        $instance['filter'] = (!empty($new_instance['filter'])) ? strip_tags($new_instance['filter']) : '';
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
                'numberposts'      => $numberPosts,
                'category'         => $category,
                'orderby'          => 'date',
                'post_type'        => 'post',
                'post_status'      => 'publish',
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

    private function getRecentPosts($numberPosts)
    {
        $posts = get_posts([
            'numberposts'      => $numberPosts,
            'orderby'          => 'date',
            'post_type'        => 'post',
            'post_status'      => 'publish',
        ]);

        return $posts;
    }
}

add_action('widgets_init', create_function('', 'return register_widget("PostWidget");'));
