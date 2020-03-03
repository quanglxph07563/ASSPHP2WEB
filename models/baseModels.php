<?php
namespace Models;
use PDO;
use Exception;
class baseModels{
    function __construct()
    {
        $host = "127.0.0.1";
        $dbname = 'pt14314-web-assignment';
        $dbusername = 'root';
        $dbpass = "";
        try {
            $this->connect = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $dbusername, $dbpass);
            // set the PDO error mode to exception
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
            }
        catch(PDOException $e)
            {
            echo "Connection failed: " . $e->getMessage();
            }
        
    }

    public function fill($dataArr){
        foreach ($this->fillable as $col) {
            $this->{$col} = $dataArr[$col];
        }
    }

    public static function getAll(){
        $model = new static();
        $sql = "select * from " . $model->table;
        $stmt = $model->connect->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }

    public static function findOne($id){
        $model = new static();
        $sql = "select * from " . $model->table . " where id = $id";
        $stmt = $model->connect->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();
        if(!$data){
            return false;
        }
        return $data[0];
    }

    public static function destroy($id){

        try{
            $model = new static();
            $sql = "delete from " . $model->table . " where id = $id";
            $stmt = $model->connect->prepare($sql);
            $stmt->execute();
            return true;
        }catch (Exception $ex){
            var_dump($ex->getMessage());
            return false;
        }
    }

    public static function customQuery($sql){
        $model = new static();
        $stmt = $model->connect->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_CLASS, get_class($model));
        return $data;
    }
    public static function  insertData($data)
    {  
        
        $model = new static();
        $sql = "INSERT INTO  $model->table (id";
        foreach ($data as $key => $value) {
            $sql = $sql . "," . $key;
        } 
        $sql = $sql.") values('null";
        foreach ($data as $key => $value) {
            $sql = $sql . "','" . $value;
        }
        $sql = $sql . "')";
        $result = $model->connect->query($sql);
        return $result;
    }
    public static function updateData($data, $tableID, $id)
    {
        $model = new static();
        $sql = "UPDATE $model->table set";
        foreach ($data as $key => $value) {
            $sql = $sql . " " . $key . "=" . "'$value',";
        }
        $sql = $sql . "' where $tableID=$id";
        $sql = str_replace(",'", ' ', $sql);
        $result = $model->connect->query($sql);
        return $result;
    }

}
?>
