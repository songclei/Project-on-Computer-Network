<?php
    include_once("common.php");
    include_once("activity.php");

    /**
     * get activities by user_id
     * @param  $user_id
     * @return  array
     */
    function getActivitiesByUserId($user_id) {
        $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);
        $sql = "select * 
                from user_activity  
                where user_id = $user_id 
                order by activity_id desc";
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        $result = $conn->query($sql);
        $ret = array(
            "num" => $result->num_rows,
            "list" => array()
        );
        while ($row = $result->fetch_assoc()) {
            $activity_id = $row['activity_id'];
            $activities = getActivities(array("id" => $activity_id));
            $activities['list'][0]['role'] = $row['role'];
            $ret['list'][] = $activities['list'][0];
        }
        $conn->close();
        return $ret;
    }

    /**
     * get participants by activity_id
     * @param  $activity_id
     * @return  array
     */
    function getUserIdByActivities($activity_id) {
        $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);
        $sql = "select * 
                from user_activity  
                where activity_id = $activity_id 
                order by role, user_id desc";
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        $result = $conn->query($sql);
        $ret = array(
            "num" => $result->num_rows,
            "list" => array()
        );
        while ($row = $result->fetch_assoc()){
            $user['user_id'] = $row['user_id'];
            $user_id = $row['user_id'];
            $user['role'] = $row['role'];
            $user['signin'] = $row['signin'];
            $sql = "select * from users where id = $user_id";
            $result_user = $conn->query($sql);
            while ($row_user = $result_user->fetch_assoc())
            {
                $user['email'] = $row_user['email'];
                $user['username'] = $row_user['username'];
            }
            $ret['list'][] = $user;
        }
        $conn->close();
        return $ret;
    }

    /**
     * get users who do not currently participate in activity_id
     * used to show all users in attendent managament page
     * @param  $activity_id
     * @return  array
     */
    function getOtherUserIdByActivities($activity_id) {
        $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);
        $sql = "select * 
                from user_activity  
                where activity_id = $activity_id 
                order by user_id desc";
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        $result = $conn->query($sql);
        $sql_other = "select * from users ";
        $count = 0;
        while ($row = $result->fetch_assoc()){
            if ($count == 0)
                $sql_other = $sql_other . "where id != " . $row['user_id'];
            else $sql_other = $sql_other . " and id != " . $row['user_id'];
            $count = $count + 1;
        }
        //echo($sql_other);
        //exit();
        $result_other = $conn->query($sql_other);
        $ret = array(
            "num" => $result_other->num_rows,
            "list" => array()
        );
        while ($row_other = $result_other->fetch_assoc()) {
            $user['user_id'] = $row_other['id'];
            $user['email'] = $row_other['email'];
            $user['username'] = $row_other['username'];
            $ret['list'][] = $user;
        }
        $conn->close();
        return $ret;
    }

    /**
     * check whether the user is the manager of the activity
     * @param $user_id, $activity_id
     * @return 1 manager  0 attendent
     */
    function checkActivityManager($user_id, $activity_id) {
        $sql = "select * from user_activity
                where user_id = $user_id and activity_id = $activity_id";
        $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        $result = $conn->query($sql);
        if ($result === false || $result->num_rows === 0)  {
            //$ret = false;
            die("User-activity pair not found.");
        }
        $row = $result->fetch_assoc();
        $conn->close();
        return intval($row['role']);
    }

    /**
     * check whether user is the participant of the activity
     * @param $user_id, $activity_id
     * @return 1 manager or attendent 0 not
     */
    function checkActivityAttendent($user_id, $activity_id){
        $sql = "select * from user_activity
                where user_id = $user_id and activity_id = $activity_id";
        $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        $result = $conn->query($sql);
        if ($result === false || $result->num_rows === 0)
            return 0;
        return 1;
    }

    /**
     * check whether user_id has already signed in activity_id
     * @param $activity_id, $user_id
     * @return 1 already sign in 0 not
     */
    function check_sign_in($activity_id, $user_id){
        $sql = "select * from user_activity
                where user_id = $user_id and activity_id = $activity_id and signin = 1";
        $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        $result = $conn->query($sql);
        if ($result === false || $result->num_rows === 0)
            return 0;
        return 1;
    }

    /**
     * let user_id sign into activity_id
     * @param $activity_id, $user_id
     * @return array
     */
    function add_sign_in($activity_id, $user_id){
        $ret = array(
            'status' => 1,
            'err_msg' => ''
        );
        if (empty($activity_id)) {
            $ret['err_msg'] = 'empty activity id';
            return $ret;
        }
        if (empty($user_id)) {
            $ret['err_msg'] = 'empty user id';
            return $ret;
        }
        $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        $sql = "update user_activity set signin = 1 where activity_id = $activity_id and user_id = $user_id";
        $result = $conn->query($sql);
        if ($result === false) {
            $ret['err_msg'] = $conn->error;
        } else {
            $ret['status'] = 0;
        }

        $conn->close();
        return $ret;
    }

    /**
     * delete an item by activity_id or/and user_id
     * @param $activity_id, $user_id
     * @return array
     */
    function deleteRecordById($activity_id, $user_id = NULL) {
        $ret = array(
            'status' => 1,
            'err_msg' => ''
        );
        if (empty($activity_id)) {
            $ret['err_msg'] = 'empty activity id';
            return $ret;
        }
        $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        $sql = "delete from user_activity
                where activity_id = $activity_id ";
        if (!empty($user_id)) {
            $sql = $sql . "and user_id = $user_id";
        }
        $result = $conn->query($sql);
        if ($result === false) {
            $ret['err_msg'] = $conn->error;
        } else {
            $ret['status'] = 0;
        }

        $conn->close();
        return $ret;
    }

    /**
     * make user_id the manager of activity_id
     * @param $activity_id, $user_id
     * @return array
     */
    function addActivityManager($activity_id, $user_id){
        $ret = array(
            'status' => 1,
            'err_msg' => ''
        );
        if (empty($activity_id)) {
            $ret['err_msg'] = 'empty activity id';
            return $ret;
        }
        if (empty($user_id)) {
            $ret['err_msg'] = 'empty user id';
            return $ret;
        }
        $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        $sql = "update user_activity set role = 1 where activity_id = $activity_id and user_id = $user_id";
        $result = $conn->query($sql);
        if ($result === false) {
            $ret['err_msg'] = $conn->error;
        } else {
            $ret['status'] = 0;
        }

        $conn->close();
        return $ret;
    }

    /**
     * make user_id(not activity's participant) the manager of activity_id
     * @param $activity_id, $user_id
     * @return array
     */
    function addActivityManagerNon($activity_id, $user_id){
        $ret = array(
            'status' => 1,
            'err_msg' => ''
        );
        if (empty($activity_id)) {
            $ret['err_msg'] = 'empty activity id';
            return $ret;
        }
        if (empty($user_id)) {
            $ret['err_msg'] = 'empty user id';
            return $ret;
        }
        $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        $sql = "insert into user_activity (user_id, activity_id, role) values($user_id, $activity_id, 1);";
        $result = $conn->query($sql);
        if ($result === false) {
            $ret['err_msg'] = $conn->error;
        } else {
            $ret['status'] = 0;
        }

        $conn->close();
        return $ret;
    }

    /**
     * cancel the manager priority of user_id on activity_id
     * @param $activity_id, $user_id
     * @return array
     */
    function cancelActivityManager($activity_id, $user_id){
        $ret = array(
            'status' => 1,
            'err_msg' => ''
        );
        if (empty($activity_id)) {
            $ret['err_msg'] = 'empty activity id';
            return $ret;
        }
        if (empty($user_id)) {
            $ret['err_msg'] = 'empty user id';
            return $ret;
        }
        $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        $sql = "update user_activity set role = 0 where activity_id = $activity_id and user_id = $user_id";
        $result = $conn->query($sql);
        if ($result === false) {
            $ret['err_msg'] = $conn->error;
        } else {
            $ret['status'] = 0;
        }

        $conn->close();
        return $ret;
    }

    /**
     * make user_id user of activity_id
     * @param $activity_id, $user_id
     * @return array
     */
    function addActivityUser($activity_id, $user_id){
        $ret = array(
            'status' => 1,
            'err_msg' => ''
        );
        if (empty($activity_id)) {
            $ret['err_msg'] = 'empty activity id';
            return $ret;
        }
        if (empty($user_id)) {
            $ret['err_msg'] = 'empty user id';
            return $ret;
        }
        $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        $sql = "insert into user_activity (user_id, activity_id, role) values($user_id, $activity_id, 0);";
        $result = $conn->query($sql);
        if ($result === false) {
            $ret['err_msg'] = $conn->error;
        } else {
            $ret['status'] = 0;
        }

        $conn->close();
        return $ret;
    }



    ?>