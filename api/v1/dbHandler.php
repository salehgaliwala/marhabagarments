<?php

class DbHandler {

    private $conn;

    function __construct() {
        require_once 'dbConnect.php';
        // opening db connection
        $db = new dbConnect();
        $this->conn = $db->connect();
    }
    /**
     * Fetching single record
     */
    public function getOneRecord($query) {
        $r = $this->conn->query($query.' LIMIT 1') or die($this->conn->error.__LINE__);
        return $result = $r->fetch_assoc();    
    }

    public function geteditrecords($query) {
        $r = $this->conn->query($query) or die($this->conn->error.__LINE__);
        return $result = $r->fetch_assoc();    
    }

    public function getAllRecord($query) {
        $r = $this->conn->query($query) or die($this->conn->error.__LINE__);
        $result = null;

        while($row = $r->fetch_assoc())
        {
            $result[] = $row;
        }
        return $result;
    }

    public function databasedate($inputdate)
    {
        $inputdate = explode("T",$inputdate);
        return $inputdate[0];
    }
    public function finddata($fromdate,$todate,$reportfilter,$term)
    {
        
        
         $result = null;

        if(!empty($fromdate) and empty($todate))
        {
            $fromdate = $this->databasedate($fromdate);
            $todate = $this->databasedate($todate);
            $datewhereQuery = "AND datecreated Between '$fromdate' AND '".date('Y-m-d')."'";    
        }

        if(!empty($fromdate) and !empty($todate))
        {
            $fromdate = $this->databasedate($fromdate);
            $todate = $this->databasedate($todate);
            $datewhereQuery = "AND datecreated Between '$fromdate' AND '$todate'";    
        }
        else
        {
            $datewhereQuery ='';
        }    

        if(!empty($term) and !empty($reportfilter))
        {

            $andclauseone = "AND $reportfilter LIKE '%$term%'";
        }
        else
        {
           $andclauseone = ''; 
        }    


        $query1 = "SELECT
                    jobs.company,
                    company.companyid,
                    company.companyname,
                    jobs.jobid,
                    jobs.name,
                    jobs.location,
                    jobs.eid,
                    jobs.po,
                    jobs.status
                    FROM
                    company
                    Inner Join jobs ON company.companyid = jobs.company where 1=1 ".$datewhereQuery. " ".$andclauseone;
        $r1 = $this->conn->query($query1) or die($this->conn->error.__LINE__);
          while($row1 = $r1->fetch_assoc())
             {
                $result1 = array();
                $result1 = $row1;
                $query2 = "SELECT                                
                                jobitems.dressid,
                                dresses.dressid,
                                dresses.dressname,
                                jobitems.qty
                                FROM
                                dresses
                                Inner Join jobitems ON dresses.dressid = jobitems.dressid where jobitems.jobid = ".$row1['jobid'];
                $r2 = $this->conn->query($query2) or die($this->conn->error.__LINE__); 
                 $result2 = array();    
                 while($row2 = $r2->fetch_assoc())
                    {           
                        $result2[$row2['dressname']] = $row2['qty'];

                    } 
                    $result[] = array_merge($result1, $result2);       
             }   

             return $result; 
    }

    public function getAllLPO($company) {

        $query1 = "SELECT lponum , SUM(qty) AS total, jobtype, location from lpo where companyid = $company  GROUP by lponum";
        $r1 = $this->conn->query($query1) or die($this->conn->error.__LINE__);
        $result = null;
        while($row1 = $r1->fetch_assoc())
        {
            $lponum = $row1['lponum'];
            $query2 = "SELECT
                    Sum(jobitems.qty) AS jobtotal,
                    jobs.po
                    FROM
                    jobitems
                    Inner Join jobs ON jobs.jobid = jobitems.jobid where jobs.po = '".$lponum."'
                    group by  jobs.po";
             $r2 = $this->conn->query($query2) or die($this->conn->error.__LINE__); 
             //$result = $this->conn->query($query2);
             $row_cnt = $r2->num_rows;
            if(empty($row_cnt) or $row_cnt == 0) 
                {
                    $result[] = $row1;
                }
            else
            {     
                 while($row2 = $r2->fetch_assoc()) 
                    {    
                        if($row2['jobtotal'] < $row1['total']) 
                        $result[] = $row1;
                    }       
            }
        }
        
        return $result;  
    }

    public function DelRecord($query) {
        $r = $this->conn->query($query) or die($this->conn->error.__LINE__);
        return 'success';
    }
    /**
     * Creating new record
     */
    public function insertIntoTable($obj, $column_names, $table_name) {
        
        $c = (array) $obj;
        $keys = array_keys($c);
        $columns = '';
        $values = '';
        foreach($column_names as $desired_key){ // Check the obj received. If blank insert blank into the array.
           if(!in_array($desired_key, $keys)) {
                $$desired_key = '';
            }else{
                $$desired_key = $c[$desired_key];
            }
            $columns = $columns.$desired_key.',';
            $values = $values."'".$$desired_key."',";
        }
        $query = "INSERT INTO ".$table_name."(".trim($columns,',').") VALUES(".trim($values,',').")";
        $r = $this->conn->query($query) or die($this->conn->error.__LINE__);

        if ($r) {
            $new_row_id = $this->conn->insert_id;
            return $new_row_id;
            } else {
            return NULL;
        }
    }
public function getSession(){
    if (!isset($_SESSION)) {
        session_start();
    }
    $sess = array();
    if(isset($_SESSION['uid']))
    {
        $sess["uid"] = $_SESSION['uid'];
        $sess["name"] = $_SESSION['name'];
        $sess["username"] = $_SESSION['username'];
    }
    else
    {
        $sess["uid"] = '';
        $sess["name"] = 'Guest';
        $sess["username"] = '';
    }
    return $sess;
}
public function destroySession(){
    if (!isset($_SESSION)) {
    session_start();
    }
    if(isSet($_SESSION['uid']))
    {
        unset($_SESSION['uid']);
        unset($_SESSION['name']);
        unset($_SESSION['username']);
        $info='info';
        if(isSet($_COOKIE[$info]))
        {
            setcookie ($info, '', time() - $cookie_time);
        }
        $msg="Logged Out Successfully...";
    }
    else
    {
        $msg = "Not logged in...";
    }
    return $msg;
}

function ifrecordexist($field , $value , $tablename , $field_optional , $value_optional)
{
   $error = false;
   $response = array();
   $query = "Select * from $tablename where $field = '$value'";
   if(!empty($field_optional) and !empty($value_optional))
   {
    $query .= " AND $field_optional = $value_optional";
   }
   $r = $this->conn->query($query) or die($this->conn->error.__LINE__);
   $row_cnt = $r->num_rows;
   if( $row_cnt > 0 )
   {
         $response["status"] = "error";
         $response["message"] = 'LPO '.$value.' already exist';
         echoResponse(200, $response);
         die();
   }

}
 
}
?>