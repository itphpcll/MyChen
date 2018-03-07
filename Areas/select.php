<?php
/**
 * @Author: Chen
 * @Date:   2018-03-07 16:41:08
 * @Last Modified time: 2018-03-07 23:11:44
 */
header("content-type:text/html;charset=utf-8");
/**
* 
*/
class Areas 
{
    function mysql_con($sql){
        $mysql_conf = array(
            'host'    => '127.0.0.1:3306', 
            'db'      => 'itshop', 
            'db_user' => 'root', 
            'db_pwd'  => '123456', 
            );

        $mysqli = @new mysqli($mysql_conf['host'], $mysql_conf['db_user'], $mysql_conf['db_pwd']);//mysqli connect
        if ($mysqli->connect_errno) {
            die("could not connect to the database:\n" . $mysqli->connect_error);//Diagnose connection error
        }
        $mysqli->query("set names 'utf8';");//Coding transformation
        $select_db = $mysqli->select_db($mysql_conf['db']);
        if (!$select_db) {
            die("could not connect to the db:\n" .  $mysqli->error);
        }
        // $sql = "select * from areas;";
        $res = $mysqli->query($sql);
        if (!$res) {
            die("sql error:\n" . $mysqli->error);
        }
        return $res;
        $res->free();
        $mysqli->close();
    }

    function get_province($sql,$id=''){
        $res=$this->mysql_con($sql);
        // echo "<pre>";
        $arr=array();
         while ($row = $res->fetch_assoc()) {
                // var_dump($row);
            $arr[]=$row;
            }
        return json_encode($arr); 
    }

    function get_id($name){
        $sql="SELECT id FROM areas WHERE name ='$name' ";
        // return $sql;die;
        $res=$this->mysql_con($sql);
        $id = $res->fetch_assoc();
        return implode($id,'');
        
    }

}

$ar=new Areas();

$sql="SELECT * FROM areas WHERE id LIKE '%0000' ";
// // $sql="SELECT * FROM areas WHERE id LIKE '44%00' AND id <> 440000 ";
// $sql="SELECT * FROM areas WHERE id LIKE '4403%' AND id <> 440300 ";
$str=$ar->get_province($sql);
echo $str;
// $id=$ar->get_id('北京市');
// var_dump($id);die;

// echo "<pre>";
// var_dump(json_decode($arr));
