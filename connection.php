<?php
    include("dbConfig.php");
    
    class connection {
        var $host = host;
        var $user = user; 
        var $password = pass;
        var $db = db;
        var $dbc;

        function connect() {
            $conn = mysqli_connect($this->host, $this->user, $this->password, $this->db);
            if(!$conn){
                //die('Error en conexion!');
            } else {
                $this->dbc = $conn;
                //echo 'Connected!';
            }
            mysqli_set_charset($this->dbc, "utf8");
            return $this->dbc;
        }
function execute($query) {       
        $this->q_id = mysqli_query($this->db_connect_id,$query);        
        if(!$this->q_id ) {
            $error1 = mysqli_error($this->db_connect_id);
            die ("ERROR: error DB.<br> No Se Puede Ejecutar La Consulta:<br> $query <br>MySql Tipo De Error: $error1");
            exit;
        }         
    $this->query_count++; 
    return $this->q_id;    
    }


  public function fetch_row($q_id = "") {
        if ($q_id == "") {
            $q_id = $this->q_id;
        }
        $result = mysqli_fetch_array($q_id);
        return $result;
    }
    }
?>