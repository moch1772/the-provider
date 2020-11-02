<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Content-Type: application/json');

    include "dbsetup.php"
?>
<?php 
    $post = new Post($conn);

    $post_arr = array(
        //'userID' => $userID,
        'showComments' => $showComments,
        'title' => $title,
        'text' => $text,
    );

    print_r(json_encode($post_arr));

    function createPost() {
        $insertCreation = 'INSERT INTO post (title, text, showComments)
        VALUES($title, $text, $showComments)';
    }
?>
