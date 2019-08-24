<?php

require_once "db.php";

class Crud extends Database
{
    public function insert($table,$fileds){
        //"INSERT INTO table_name (, , ) VALUES ('m_name','qty')";
        $sql = "";
        $sql .= "INSERT INTO ".$table;
        $sql .= " (".implode(",", array_keys($fileds)).") VALUES ";
        $sql .= "('".implode("','", array_values($fileds))."')";
        $query = mysqli_query($this->con,$sql);
        if($query){
            return true;
        }
    }
    public function insertreturnid($table,$fileds){
        //"INSERT INTO table_name (, , ) VALUES ('m_name','qty')";
        $sql = "";
        $sql .= "INSERT INTO ".$table;
        $sql .= " (".implode(",", array_keys($fileds)).") VALUES ";
        $sql .= "('".implode("','", array_values($fileds))."')";
        $query = mysqli_query($this->con,$sql);
        if($query){
            return mysqli_insert_id($this->con);
        }
    }
    public function fetch($table){
        $sql = "SELECT * FROM ".$table;
        $array = array();
        $query = mysqli_query($this->con,$sql);
        while($row = mysqli_fetch_assoc($query)){
            $array[] = $row;
        }
        return $array;
    }
    public function fetchdistinct($table,$field){
        $sql = "SELECT distinct $field FROM ".$table;
        $array = array();
        $query = mysqli_query($this->con,$sql);
        while($row = mysqli_fetch_assoc($query)){
            $array[] = $row;
        }
        return $array;
    }
    public function fetchorder($table,$order){
        $sql = "SELECT * FROM ".$table." ORDER BY ".$order;
        $array = array();
        $query = mysqli_query($this->con,$sql);
        while($row = mysqli_fetch_assoc($query)){
            $array[] = $row;
        }
        return $array;
    }
    public function fetchorderlimit($table,$order,$limit){
        // return "abc";
        $sql = "SELECT * FROM ".$table." ORDER BY ".$order." LIMIT ".$limit;
        $array = array();
        $query = mysqli_query($this->con,$sql);
        while($row = mysqli_fetch_assoc($query)){
            $array[] = $row;
        }
        return $array;
    }
    public function fetchwhere($table,$where){
        $sql = "SELECT * FROM ".$table." where ".$where;
        $array = array();
        $query = mysqli_query($this->con,$sql);
        while($row = mysqli_fetch_assoc($query)){
            $array[] = $row;
        }
        return $array;
    }
    public function fetchwheredistinct($table,$where,$distinct){
        $sql = "SELECT distinct $distinct FROM ".$table." where ".$where;
        $array = array();
        $query = mysqli_query($this->con,$sql);
        while($row = mysqli_fetch_assoc($query)){
            $array[] = $row;
        }
        return $array;
    }
    public function fetchwhereorder($table,$where,$order){
        $sql = "SELECT * FROM ".$table." where ".$where." ORDER BY ".$order;
        $array = array();
        $query = mysqli_query($this->con,$sql);
        while($row = mysqli_fetch_assoc($query)){
            $array[] = $row;
        }
        return $array;
    }
    public function fetchwhereorderlimit($table,$where,$order,$limit){
        $sql = "SELECT * FROM ".$table." where ".$where." ORDER BY ".$order." limit ".$limit;
        $array = array();
        $query = mysqli_query($this->con,$sql);
        while($row = mysqli_fetch_assoc($query)){
            $array[] = $row;
        }
        return $array;
    }
   
    public function update($table,$where,$fields){
        $sql = "";
        $condition = "";
        foreach ($where as $key => $value) {
            // id = '5' AND m_name = 'something'
            $condition .= $key . "='" . $value . "' AND ";
        }
        $condition = substr($condition, 0, -5);
        foreach ($fields as $key => $value) {
            //UPDATE table SET m_name = '' , qty = '' WHERE id = '';
            $sql .= $key . "='".$value."', ";
        }
        $sql = substr($sql, 0,-2);
        $sql = "UPDATE ".$table." SET ".$sql." WHERE ".$condition;
        if(mysqli_query($this->con,$sql)){
            return true;
        }
    }
    public function delete($table,$where){
        $sql = "";
        $condition = "";
        foreach ($where as $key => $value) {
            $condition .= $key . "='" . $value . "' AND ";
        }
        $condition = substr($condition, 0, -5);
        $sql = "DELETE FROM ".$table." WHERE ".$condition;
        if(mysqli_query($this->con,$sql)){
            return true;
        }
    }

    public function calcship($weight,$code){
        $a=$this->fetchwhere("ship","code='$code'");
        $count = count($a);

        if($weight<250){
            $col="g250";
        }else if($weight>=250 && $weight<500){
            $col="g500";
        }else if($weight>=500 && $weight<1000){
            $col="g1000";
        }else if($weight>=1000 && $weight<1500){
            $col="g1500";
        }else if($weight>=1500 && $weight<2000){
            $col="g2000";
        }else if($weight>=2000 && $weight<2500){
            $col="g2500";
        }else if($weight>=2500 && $weight<3000){
            $col="g3000";
        }else if($weight>=3000 && $weight<3500){
            $col="g3500";
        }else if($weight>=3500 && $weight<4000){
            $col="g4000";
        }else if($weight>=4000 && $weight<4500){
            $col="g4500";
        }else if($weight>=4500 && $weight<5000){
            $col="g5000";
        }else if($weight>=5000 && $weight<5500){
            $col="g5500";
        }else if($weight>=5500 && $weight<6000){
            $col="g6000";
        }else if($weight>=6000 && $weight<6500){
            $col="g6500";
        }else if($weight>=6500 && $weight<7000){
            $col="g7000";
        }else if($weight>=7000 && $weight<7500){
            $col="g7500";
        }else if($weight>=7500 && $weight<8000){
            $col="g8000";
        }else if($weight>=8000 && $weight<8500){
            $col="g8500";
        }else if($weight>=8500 && $weight<9000){
            $col="g9000";
        }else if($weight>=9000 && $weight<9500){
            $col="g9500";
        }else if($weight>=9500 && $weight<10000){
            $col="g10000";
        }else{
            $col="next";
        }

        foreach($a as $as){
            $kirim=$as[$col];
            $ceban=$as['g10000'];
            $diatasceban=$as['next'];
        }
        if($col=='next'){
            $selisih=$weight-10000; //12rb-10rb
            $bagi=$selisih/500; //2rb/500=4
            $kali=$bagi*$diatasceban; //4*biaya
            $kirim=$kali+$ceban;
        }
        if($weight<=0){
            $kirim="0";
        }

        return $kirim;
    }


}



?>