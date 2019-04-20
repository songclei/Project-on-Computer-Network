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
            $ret['list'][] = $activities['list'][0];
        }
        $conn->close();
        return $ret;
    }
    ?>