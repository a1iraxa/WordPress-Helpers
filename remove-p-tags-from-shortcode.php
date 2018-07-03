<?php
if( !function_exists('tm_fix_shortcodes') ) {
    function tm_fix_shortcodes($content){

        $array = array (
            '<p>[' => '[',
            ']</p>' => ']',
            ']<br />' => ']'
        );

        $content = strtr($content, $array);

        return $content;

    }
    add_filter('the_content', 'tm_fix_shortcodes');
}
