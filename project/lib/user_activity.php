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
     * check whether the user is the manager of the activity
     * @param $user_id, $activity_id
     * @return 1 manager  0 attendence
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
            $ret = false;
        }
        $row = $result->fetch_assoc();
        $conn->close();
        return intval($row['role']);
    }

    /**
     * delete an item by activity_id or/and user_id
     * @param 
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

    ?>