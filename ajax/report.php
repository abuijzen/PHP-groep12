<?php
    require_once '../bootstrap.php';

    $result = [];
    // POST?
    if (!empty($_POST)) {
        // welke post
        $postsId = $_POST['postsId'];

        // welke user Id
        $usersId = User::getUserId();

        $r = new Post();
        $r->setId($postsId);
        $r->setUserId($usersId);
        if ($r->checkReports()) {
            $r->addReport();

            $result = [
                'status' => 'success',
                'message' => 'nu is er een report bij ',
            ];
        } else {
            $r->setInactive();

            $result = [
                'status' => 'fail',
                'message' => 'je hebt 3 reports',
            ];
        }

        // JSON
    } else {
        $result = [
            'status' => 'nope',
            'message' => 'Report has not  been saved.',
        ];
    }
    header('Content-Type: application/json');
    echo json_encode($result);
