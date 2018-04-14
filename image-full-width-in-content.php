
<style type="text/css">
  div.alignnone  {
    width: 100vw;
    position: relative;
    left: 50%;
    right: 50%;
    margin-left: -50vw;
    margin-right: -50vw;
  }
  .alignnone img {
    width: 100% !important;
  }
</style>

<?php
function wrapImagesInDiv($content) {
   $pattern = '/(<img[^>]*class=\"([^>]*?)\"[^>]*>)/i';
   $replacement = '<div class="$2">$1</div>';
   $content = preg_replace($pattern, $replacement, $content);
   return $content;
}
add_filter('the_content', 'wrapImagesInDiv');


/**
 * Remove image attributes height and width
 * @param type $html
 * @return mixed
 */
if (!function_exists('remove_width_attribute')) {

    function remove_width_attribute($html) {
        $html = preg_replace('/(width|height)="\d*"\s/', "", $html);
        return $html;
    }

    add_filter('post_thumbnail_html', 'remove_width_attribute', 10);
    add_filter('image_send_to_editor', 'remove_width_attribute', 10);
}
