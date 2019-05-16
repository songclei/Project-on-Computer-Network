<?php
    include_once("common.php");
    include_once("user_activity.php");

    /**
     *  get activities which meet conditions
     * @param filter: array
     * @return array
     */
    function getActivities($filter=array()) {
        $select = "select * from activities ";
        $where = "where true ";
        if (!empty($filter['id'])) {
            $id = $filter['id'];
            $where = $where . "and id = $id ";
        }
        if (!empty($filter['name'])) {
            $name = $filter['name'];
            $where = $where . "and name = $name ";
        }
        if (!empty($filter['abbr'])) {
            $abbr = $filter['abbr'];
            $where = $where . "and abbr = $abbr ";
        }
        if (!empty($filter['begin_date'])) {
            $beginDate = $filter['begin_date'];
            $where = $where . "and begin_date >= $beginDate ";
        }
        if (!empty($filter['end_date'])) {
            $endDate = $filter['end_date'];
            $where = $where . "and end_date <= $endDate ";
        }
        $order = "order by id desc";
        $sql = $select . $where . $order;
        
        $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        $result = $conn->query($sql);
        $ret = array(
            "num" => $result->num_rows,
            "list" => $result->fetch_all(MYSQLI_ASSOC)
        );
        $conn->close();
        return $ret;
    }

    /**
    * add a new activity
    * @param array consist of info
    * @return mixed
    */

    function addActivities($params){
        $ret = array(
        'status' => 1,
        'err_msg' => ''
        );

        $name = $params['name'];
        $abbr = isset($params['abbr']) ? $params['abbr'] : '';
        $begin_date = isset($params['begin_date']) ? $params['begin_date'] : '';
        $end_date = isset($params['end_date']) ? $params['end_date'] : '';

        $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);
        $sql = $conn->prepare("insert into activities (name, abbr, begin_date, end_date) values (?, ?, ?, ?)");
        if ($sql === false) {
            echo($conn->error);
            exit();
            }
        $begin_date_pass = date('Y-m-d H:i:s',strtotime($begin_date));
        $end_date_pass = date('Y-m-d H:i:s',strtotime($end_date));
        $sql->bind_param("ssss", $name, $abbr, $begin_date_pass, $end_date_pass);
        
        $result = $sql->execute();
        if ($result === true) {
            $activityId = $conn->insert_id;
            $userId = $params['uid'];
            $sql = "insert into user_activity (user_id, activity_id, role) values ($userId, $activityId, 1)";
            $result = $conn->query($sql);
            if ($result === false) {
                $ret['err_msg'] = $conn->error;
            } else {
                $ret['status'] = 0;
            }
        }
        else {
            $ret['err_msg'] = $conn->error;
            echo($conn->error);
            ret();
        }
        $conn->close();
        return $ret;
    }

    /**
     * delete an activity by id
     * @param $id
     * @return mixed
     */
    function deleteActivity($id) {
        $ret = array(
            'status' => 1,
            'err_msg' => ''
        );

        $delete_ret = deleteRecordById($id);
        if ($delete_ret['status'] === 1) {
            $ret['err_msg'] = $delete_ret['err_msg'];
        } else {
            $sql = "delete from activities where id = $id";
            $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);
            if ($conn->connect_error) {
                die($conn->connect_error);
            }
            $result = $conn->query($sql);
            if ($result === false) {
                $ret['err_msg'] = $conn->error;
            } else {
                $ret['status'] = 0;
            }
        }
        $conn->close();
        return $ret;
    }

    /**
     * change the activity information according to params
     * @param $params
     * @return mixed
     */
    function changeActivityInfo($params){
        $ret = array(
            'status' => 1,
            'err_msg' => ''
        );
        $activity_id = $params['activity_id'];
        if (empty($activity_id)) {
            $ret['err_msg'] = 'empty activity id';
            return $ret;
        }
        $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        $sql = "update activities set";
        $name = $params['name'];
        $abbr = $params['abbr'];
        $description = $params['description'];
        $website_address = $params['website_address'];
        if (!empty($name))
        {
            $sql = $sql . " name = '$name',";
        }
        if (!empty($abbr))
        {
            $sql = $sql . " abbr = '$abbr',";
        }
        if (!empty($description))
        {
            $sql = $sql . " description = '$description',";
        }
        if (!empty($webaddress))
        {
            $sql = $sql . " website_address = '$website_address',";
        }

        $sql = substr($sql, 0, strlen($sql)-1);
        $sql = $sql . " where id = $activity_id";
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