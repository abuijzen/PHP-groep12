<?php
    require_once '../bootstrap.php';
    // POST?
    if (!empty($_POST)) {
        // welke post
        $postsId = $_POST['postsId'];
        // welke user Id
        $userId = User::getUserId();

        $l = new Like();
        $l->setPostId($postId);
        $l->setUserId($userId);
        $l->checkLike();

        // JSON
        $result = [
            'status' => 'succes',
            'message' => 'Like has been saved.',
        ];

        echo json_encode($result);
    }
