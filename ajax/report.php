<?php
    require_once '../bootstrap.php';

    $result = [];
    // POST?
    if (!empty($_POST)) {
        // welke post
        $postsId = $_POST['postsId'];

        // welke user Id
        $usersId = User::getUserId();
        // echo $usersId.' dit is de user ---- nnn ----';

        $r = new Post();
        $r->setId($postsId);
        $r->setUserId($usersId);

        if ($r->alreadyReport()) {
            $r->addReport();
            $r->checkReports();

            $result = [
                'status' => 'success',
                'message' => 'We take reports seriously and we will check this content',
            ];
        } else {
            $result = [
                'status' => 'fail',
                'message' => 'You can only report a post once',
            ];
        }
    }
    header('Content-Type: application/json');
    echo json_encode($result);
