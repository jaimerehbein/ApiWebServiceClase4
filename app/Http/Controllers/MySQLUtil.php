<?php
namespace App\Http\Controllers;
class MySQLUtil {
    public function __construct() {        
    }
    public function getConnection() {
        $sqlconn = new \MySQLi("localhost","root","","baseeventos");
        return $sqlconn;
    }
    public function execute($sqlTxt) {
        $conn = $this->getConnection();
        $resultset = $conn->query($sqlTxt);
        $conn->close();
    }
    public function query($sqlTxt) {
        $conn = $this->getConnection();
        $resultset = $conn->query($sqlTxt);
        $ret = [];
        for ($rec = $resultset->fetch_assoc(); $rec != null; $rec = $resultset->fetch_assoc()) {
            array_push($ret, $rec);
        }
        $conn->close();
        return $ret;
    }
}

/*
$idUsuario = uniqid();
$strSQL = "select * from usuarios";
$utilitario = new MySQLUtil();
$resp = $utilitario->query($strSQL);
var_dump($resp);
echo $strSQL;
*/

?>