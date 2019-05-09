<?php
    require_once '../bootstrap.php';

    $result = [];
    // POST?
    if (!empty($_POST)) {
        // welke post
        $postsId = $_POST['postsId'];

        // welke user Id
        $userId = User::getUserId();

        $l = new Like();
        // $l->setPostId();
        // $l->setUserId();
        $l->saveLike($postsId, $usersId);

        // JSON
        $result = [
            'status' => 'succes',
            'message' => 'Like has been saved.',
        ];
    } else {
        $result = [
            'status' => 'nope',
            'message' => 'Like has been saved.',
        ];
    }
    header('Content-Type: application/json');
    echo json_encode($result);
