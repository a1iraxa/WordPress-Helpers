<?php
// To add the new role, using 'international' as the short name and
// 'International Blogger' as the displayed name in the User list and edit page:

add_role('international', 'International Blogger', array(
    'read' => true, // True allows that capability, False specifically removes it.
    'edit_posts' => true,
    'delete_posts' => true,
    'edit_published_posts' => true,
    'publish_posts' => true,
    'edit_files' => true,
    'import' => true,
    'upload_files' => true //last in array needs no comma!
));


// To remove one outright or remove one of the defaults:
remove_role('international');
