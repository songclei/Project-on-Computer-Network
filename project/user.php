<?php
include_once("common.php");

/**
 * get user's infomation by his/her username
 * @param username
 * @return array|null
 */
function getUserByUsername($username) {
    if (!isset($username)) {
        return null;
    }

    $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);
    $sql = $conn->prepare("select * from users where username = ?");
    $sql->bind_param("s", $username);
    $sql->execute();
    $result = $sql->get_result();
   
    $info = null;
    if ($result->num_rows > 0) {
        $info = $result->fetch_assoc();
    }
    $conn->close();
    return $info; 
}

/**
 * check whether the username if occupied
 * @param username
 * @return true: username is occupied
 *         false: username has not been occupied
 */
function checkUsernameUsed($username) {
    $usr = getUserByUsername($username);
    if (is_null($usr)) {
        return false;
    }
    else {
        return true;
    } 
}

/**
 * check whether the user name and password consistent
 * @param username and password
 * @return status=1 if there is something wrong
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

/**
 * register a new user 
 * @param array consist of info
 * @return false|true
 */
function addUser($params) {
    
}
?>