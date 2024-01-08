<?php

class Pdocon{
    
    // The connection Properties
    
      //Localhost Db information
        //  private $host       = "localhost:33066";
        // private $user       = "root";
        // private $pass       = "";
        // private $dbnm       = "cus_app";

        
//remote site db information
    private $cleardb_url;
    private $host;
    private $user;
    private $pass;
    private $dbnm;
    private $active_group;
    private $query_builder;
   
    //Handle our connection
        private $dbh;
    
    //handle our error
        private $errmsg;
    
    //Statement Handler
        private $stmt;
 
        
    //Method to open our connection

        public function __construct(){

            $this->cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
            $this->host = $this->cleardb_url["host"];
            $this->user = $this->cleardb_url["user"];
            $this->pass = $this->cleardb_url["pass"];
            $this->dbnm = substr($this->cleardb_url["path"], 1);

        // Other configuration
        $this->active_group = 'default';
        $this->query_builder = true;
            
        $dsn ="mysql:host=" . $this->host . "; dbname=" . $this->dbnm; 
    
        $options = array( 
        
            PDO::ATTR_PERSISTENT    => true,
            
            PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION

        );
            
            try{
                
                $this->dbh  = new PDO($dsn, $this->user, $this->pass, $options); 
                
                //echo "Successfully Connected";
 
            }catch(PDOException $error){
                
                $this->errmsg = $error->getMessage();
                
                echo $this->errmsg;
                
            }
            
            
        }
            
        //Write query helper function using the stmt property
        public function query($query){
            
            $this->stmt = $this->dbh->prepare($query);
            
        }
        

        //Creating a bind function 
        public function bindvalue($param, $value, $type){
            
             $this->stmt->bindValue($param, $value, $type);
            
        }
        

        //Function to execute statement
        public function execute(){
            
          return $this->stmt->execute();
            
        }
        

        //Function to check if statement was successfully executed
        public function confirm_result(){
            
            $this->dbh->lastInsertId();
            
        }
        
        //Command to fetch data in a result set in associative array
        public function fetchMultiple(){
            
        $this->execute();    
            
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);    
            
        }

        //Command count fetched data in a result set 
        
        public function fetchSingle(){
            
        $this->execute();    
            
        return $this->stmt->fetch(PDO::FETCH_ASSOC);    
            
        }
}    
?>