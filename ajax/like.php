<?php
    require_once '../bootstrap.php';

    $result = [];
    // POST?
    if (!empty($_POST)) {
        // welke post
        $postsId = $_POST['postsId'];

        // welke user Id
        $usersId = User::getUserId();

        $l = new Like();
        // $l->setPostId();
        // $l->setUserId();
        $l->saveLike($usersId, $postsId);

        // JSON
        $result = [
            'status' => 'succes',
            'message' => 'Like has been saved.',
        ];
    } else {
        $result = [
            'status' => 'nope',
            'message' => 'Like has not  been saved.',
        ];
    }
    header('Content-Type: application/json');
    echo json_encode($result);
