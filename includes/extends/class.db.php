<?php


/**
 * 数据库类
 */
class DB
{
    //私有属性 在外面不能访问
    private $hostname = null;
    private $username = null;
    private $password = null;
    private $charset = "UTF8";
    private $pre = "pre_";
    private $dbname = null;
    private $link = null;  //套接字  连接标识符
    private $sql = null;

    //构造函数 在对象实例化的时候，自动调用的一个方法
    public function __construct($hostname = "localhost",$username ='root',$password='',$dbname='')
    {
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;

        //连接数据库操作
        $this->link = mysqli_connect($this->hostname,$this->username,$this->password) or die("连接数据库失败");

        //选择数据库
        mysqli_select_db($this->link,$this->dbname);

        //设置数据库编码
        $res = mysqli_query($this->link,"SET NAMES {$this->charset}");
    }


    public function select($fields = "*")
    {
        $this->sql = "SELECT $fields ";
        return $this;
    }

    public function from($table,$as="")
    {
        $this->sql .= "FROM {$this->pre}$table ";
        if (!empty($as)){
            $this->sql .= "AS {$as} ";
        }
        return $this;
    }

    public function where($where = 1)
    {
        if(is_array($where))
        {
            $this->sql .= "WHERE ";
            foreach($where as $key=>$item)
            {
                $this->sql .= "$key = '$item' AND ";
            }
        }else {
            $this->sql .= "WHERE $where ";
        }

        $this->sql = trim($this->sql,"AND ");

        return $this;
    }

    public function join($table,$on,$by="LEFT")
    {
        $this->sql .= "$by JOIN {$this->pre}$table AS $table ON $on ";
        return $this;
    }

    public function orderby($fields=null,$by="asc")
    {
        if($fields)
        {
            $this->sql .= " ORDER BY $fields $by ";
            return $this;
        }else{
            return $this;
        }
    }

    public function limit($start=0,$limit=10)
    {
        $this->sql .= " LIMIT $start,$limit";
        return $this;
    }



    public function table($table){

        $this->sql = "{$this->pre}$table ";
//        foreach ($data as $key => $val){
//        }
        return $this;
    }

//  新增数据
    public function insert($data){
        $table_name = "";
        $values = "";
        //判断是否data是否是一维数组
        if(count($data) == count($data, 1)){
            unset($data['id']);
            foreach ($data as $key => $val){
                $table_name .= "{$key},";
                $values .= "'{$val}',";
            }
            $table_name = rtrim($table_name, ',');
            $table_name = '('.$table_name.')';
            $values = rtrim($values, ',');
            $values = '('.$values.')';
        }else{
            foreach ($data as $value ){
                unset($value['id']);
                foreach ($value as $key => $val){
                    $table_name .="{$key},";
                }
                $table_name = rtrim($table_name, ',');
                $table_name = '('.$table_name.')';

                //要一条字段名就可以了
                break;
            }
            foreach ($data as $value){
                unset($value['id']);
                $values .= '(';
                foreach ($value as $key => $val){
                    $values .="'{$val}',";
                }
                $values = rtrim($values, ',');
                $values .= '),';
            }
        }
        $values = rtrim($values, ',');
        $table_name = rtrim($table_name, ',');

        $this->sql = "INSERT INTO ".$this->sql."{$table_name} VALUES {$values}";

        return $this;
    }

    public function update($data)
    {
        if (!empty($data['id'])){
            unset($data['id']);
        }
        $set_v = "";
        foreach ($data as $k => $v){
            $set_v .=$k."='{$v}'".",";
        }
        $set_v = rtrim($set_v, ',');
        $this->sql = "UPDATE ".$this->sql."set ".$set_v." ";

        return $this;

    }

//   删除
    public function delete($id , $where=false)
    {
        if ($where){
            $this->sql = "DELETE FROM ".$this->sql." where $where";
            return $this;
        }
        $this->sql = "DELETE FROM ".$this->sql." WHERE id={$id}";
        return $this;
    }

//    运行
    public function run()
    {
        $res = mysqli_query($this->link,$this->sql);
        if(!$res)
        {
            $this->error();
            exit();
        }
        return mysqli_insert_id($this->link);
    }

    public function rows()
    {
        $res = mysqli_query($this->link,$this->sql);
        if(!$res)
        {
            $this->error();
            exit();
        }
        return mysqli_affected_rows($this->link);
    }

//  查询所有
    public function all()
    {
        //会返回一个执行结果
        $res = mysqli_query($this->link,$this->sql);

        if(!$res)
        {
            $this->error();
            exit();
        }
        while($row = mysqli_fetch_assoc($res))
        {
            $data[] = $row;
        }
       if (empty($data)){
           $data['code'] = 0;
           $data['text'] = '查询数据行为空';
       }
        return $data;
    }

    public function find()
    {
        //会返回一个执行结果
        $res = mysqli_query($this->link,$this->sql);

        if(!$res)
        {
            $this->error();
            exit();
        }

        return mysqli_fetch_assoc($res);
    }

    public function sql()
    {
        //会返回一个sql语句
        return $this->sql;
    }

    //获取sql语句错误的信息
    public function error()
    {
        $error = mysqli_error($this->link);
        $message = "[".date("Y-m-d H:i")."] SQL错误：".$error."\r\n";

        $filename = APP_PATH."/includes/extends/mysql_error.log";
        file_put_contents($filename,$message,FILE_APPEND);
        echo "SQL语句执行失败";
        exit;
    }

    //老师写的
    public function addAll($table,$data)
    {
        //获取表字段
        $sql = "desc {$this->pre}$table";
        $res = mysqli_query($this->link,$sql);
        $tableFields = [];
        while($row = mysqli_fetch_assoc($res))
        {
            if($row['Key'] == "PRI")
            {
                continue;
            }else{
                $tableFields[] = $row['Field'];
            }
        }



        //组装好的字段部分
        sort($tableFields);
        $fields = "`".implode("`,`",$tableFields)."`";

        $dataArr = [];
        foreach($data as $item)
        {
            ksort($item);
            $dataArr[] = "('".implode("','",$item)."')";
        }

        if(count($dataArr) > 0)
        {
            $dataStr = implode(",",$dataArr);
        }else{
            $dataStr = "";
        }

        $this->sql = "INSERT INTO {$this->pre}$table($fields) VALUES $dataStr";
        $res = mysqli_query($this->link,$this->sql);

        if(!$res)
        {
            $this->error();
            return false;
        }

        return mysqli_affected_rows($this->link);
    }



    public function dd($data){
        echo '<pre style="background: rgba(255,204,204,.5);color: #FF6633;">';
        print_r($data);
        echo '</pre>';
        exit;
    }



}

?>