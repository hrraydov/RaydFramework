<?php

namespace Framework;

abstract class Base_Model {
    /*
     * Insert into database
     */

    public function insert($table, $data) {
        $db = \Framework\Database::getInstance();
        $query = 'INSERT INTO ' . $table;
        $query.=' (' . implode(',', array_keys($data)) . ')';
        $query.=' VALUES ("' . implode('","', $data) . '")';
        mysql_query($query);
        echo mysql_error();
    }

    /*
     * Get from database
     * @return array asd
     */

    public function get($table, $where = null, $separator = 'AND', $what = '*', $order_by = null, $order = 'ASC') {
        $db = \Framework\Database::getInstance();
        $query = 'SELECT ' . $what . ' FROM ' . $table;
        if ($where != null) {
            $query.=' WHERE ';
            $arr = array();
            foreach ($where as $key => $value) {
                $arr[] = $key . '="' . $value . '"';
            }
            $str = implode(' ' . $separator . ' ', $arr);
            $query.=$str;
        }
        if ($order_by != null) {
            $query.=' ORDER BY' . $order_by . ' ' . $order;
        }
        $res = mysql_query($query);
        $data = array();
        while ($row = mysql_fetch_array($res)) {
            $data[] = $row;
        }
        echo mysql_error();
        return $data;
    }

    /*
     * Update database
     */

    public function update($table, $set, $where = null, $separator = 'AND') {
        $db = \Framework\Database::getInstance();
        $query = 'UPDATE ' . $table . ' SET ';
        $arr = array();
        foreach ($set as $key => $value) {
            $arr[] = $key . '="' . $value . '" ';
        }
        $str = implode(',', $arr);
        $query.=$str . ' ';
        if ($where != null) {
            $query.=' WHERE ';
            $arr = array();
            foreach ($where as $key => $value) {
                $arr[] = $key . '="' . $value . '"';
            }
            $str = implode(' ' . $separator . ' ', $arr);
            $query.=$str;
        }
        mysql_query($query);
        echo mysql_error();
    }

    /*
     * Delete from database
     */

    public function delete($table, $where = null, $separator = 'AND') {
        $db = \Framework\Database::getInstance();
        $query = 'DELETE FROM ' . $table;
        if ($where != null) {
            $query.=' WHERE ';
            $arr = array();
            foreach ($where as $key => $value) {
                $arr[] = $key . '="' . $value . '"';
            }
            $str = implode(' ' . $separator . ' ', $arr);
            $query.=$str;
        }
        mysql_query($query);
        echo mysql_error();
    }

}

