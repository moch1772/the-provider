<?php 
    include "dbsetup.php";
?>
<?php
    if(isset($_POST['addtag'])){
        $tags = [''];
        $tag = $_POST['tag'];
        newTag($tag, $tags);
    }

    function newTag($element, $array) {
        if(!empty($tag));
            array_push($array, $element);
        }
?>