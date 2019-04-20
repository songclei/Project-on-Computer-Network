<?php
    include_once("common.php");

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
        $sql->bind_param("ssss", $name, $abbr, date('Y-m-d H:i:s',strtotime($begin_date)), date('Y-m-d H:i:s',strtotime($end_date)));
        
        $result = $sql->execute();
        if ($result === true) {
            $activityId = $conn->insert_id;
            $userId = $params['uid'];
            $sql = "insert into user_activity (user_id, activity_id) values ($userId, $activityId)";
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
?>