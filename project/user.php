<?php
include_once("common.php");

/**
 * get user's infomation by his/her username
 */
function getUserByUsername($username) {
    if (!isset($username)) {
        return null;
    }

    $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);
    $sql = "select * from users where username = '$username'";
    $result = $conn->query($sql);
   
    $info = null;
    if ($result->num_rows > 0) {
        $info = $result->fetch_assoc();
    }
    $conn->close();
    return $info; 
}

/**
 * check whether the user name and password consistent
 * return: status=1 if there is something wrong
 *         status=0 name and password consistent
 */
function checkUser($username, $password=null) {
    $ret = array(
        'status' => 1,
        'err_msg' => ''
    );
    // username can not be empty
    if (!isset($username)) {
        $ret['err_msg'] = 'empty_username';
        return $ret;
    }

    // username does not exist
    $userInfo = getUserByUsername($username);
    if ($userInfo === null) {
        $ret['err_msg'] = 'false_username';
        return $ret;
    }

    // wrong password
    if ($password !== $userInfo['password']) {
        $ret['err_msg'] = 'false_password';
        return $ret;
    }

    $ret['status'] = 0;
    return $ret;
}
?>