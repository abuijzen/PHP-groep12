<?php
    require_once '../bootstrap.php';

    $result = [];
    // POST?
    if (!empty($_POST)) {
        // welke post
        $follow_id = $_POST['follow_id'];

        // welke user Id
        $users_id = User::getUserId();

        $l = new Follow();
        $l->setUsers_id($users_id);
        $l->setFollow_id($follow_id);
        if ($l->checkFollowing()) {
            $l->AddFollow();

            $result = [
                'status' => 'success',
                'message' => 'You are following someone new.',
            ];
        } else {
            $l->DeleteFollow();

            $result = [
                'status' => 'fail',
                'message' => 'Unfollow.',
            ];
        }
    }
    header('Content-Type: application/json');
    echo json_encode($result);
