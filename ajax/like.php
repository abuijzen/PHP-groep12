<?php
    require_once '../bootstrap.php';

    if (!empty($_POST)) {
        $postId = $_POST['postId'];
        // $userId = $_SESSION['uid'];
        // voorlopig hardcoded
        $userId = 1;

        include_once '../bootstrap.php';
        $l = new Like();
        $l->setPostId($postId);
        $l->setUserId($userId);
        $l->save();

        // JSON
        $result = [
            'status' => 'succes',
            'message' => 'Like has been saved.',
        ];

        echo json_encode($result);
    }
