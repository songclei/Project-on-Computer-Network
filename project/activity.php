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
        $result = $conn->query($sql);
        $ret = array(
            "num" => $result->num_rows,
            "list" => $result->fetch_all(MYSQLI_ASSOC)
        );
        $conn->close();
        return $ret;
    }
?>