<?php
    require_once '../bootstrap.php';
    // POST?
    if (!empty($_POST)) {
        // welke post
        $postId = $_POST['postId'];
        // welke user Id
        $userId = User::getUserId();

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
