<?php
    class Database
    {
        public $con;
        public function __construct(){
            $this->con = mysqli_connect("localhost", "u2401249_eddyhu71", "Eddyhu71", "u2401249_db_hor");
            if (!$this->con) {
                echo "Error in Connecting ".mysqli_connect_error();
            }
        }
    }
?>