<?php 
$app->get('/session', function() {
    $db = new DbHandler();
    $session = $db->getSession();
    $response["uid"] = $session['uid'];
    $response["username"] = $session['username'];
    $response["name"] = $session['name'];
    echoResponse(200, $session);
});

$app->get('/job', function() {
    $db = new DbHandler();
    $response = array();
    $response= $db->getAllRecord("SELECT
                                    jobs.jobid,
                                    jobs.name,
                                    jobs.status,
                                    jobs.location,
                                    jobs.po,
                                    jobs.eid,
                                    jobs.jobtype,
                                    jobs.gender,
                                    jobs.datecreated,
                                    company.companyname
                                    FROM
                                    jobs
                                    Inner Join company ON jobs.company = company.companyid where jobs.isdelete = 'N'");
  
     echoResponse(200, $response);
});
$app->get('/dojobs', function() {
    $db = new DbHandler();
    $response = array();
    $response= $db->getAllRecord("SELECT
                                    jobs.jobid,
                                    jobs.name,
                                    jobs.status,
                                    company.companyname
                                    FROM
                                    jobs
                                    Inner Join company ON jobs.company = company.companyid where jobs.isdelete = 'N' and status != 'Delivered'");
  
     echoResponse(200, $response);
});
$app->get('/queue', function() {
    $db = new DbHandler();
    $response = array();
    $response= $db->getAllRecord("SELECT
                                    dresses.dressname,
                                    company.companyname,
                                    jobs.name,
                                    jobs.jobtype,
                                    jobs.isdelete,
                                    dresses.dressname,
                                    jobitems.`status`,
                                    jobitems.qty,
                                    jobitems.jobitemid,
                                    jobitems.assignto,
                                    jobitems.status
                                    FROM
                                    jobs
                                    Left Join jobitems ON jobitems.jobid = jobs.jobid
                                    Left Join company ON jobs.company = company.companyid
                                    right Join dresses ON jobitems.dressid = dresses.dressid where jobs.isdelete = 'N'");
  
     echoResponse(200, $response);
});
$app->post('/getemployeejobreport', function() use ($app) {

$r = json_decode($app->request->getBody());
$db = new DbHandler();
$response = array();
$response= $db->getAllRecord("SELECT
                                    dresses.dressname,
                                    company.companyname,
                                    jobs.name,
                                    jobs.jobtype,
                                    jobs.isdelete,
                                    dresses.dressname,
                                    jobitems.`status`,
                                    jobitems.qty,
                                    jobitems.jobitemid,
                                    jobitems.assignto,
                                    jobitems.status
                                    FROM
                                    jobs
                                    Left Join jobitems ON jobitems.jobid = jobs.jobid
                                    Left Join company ON jobs.company = company.companyid
                                    Right Join dresses ON jobitems.dressid = dresses.dressid where jobs.isdelete = 'N' AND datecomplete BETWEEN '".$r->datefrom."' AND '".$r->dateto."' AND assignto =".$r->userid);
  
     echoResponse(200, $response);
});
$app->get('/users', function() {
    $db = new DbHandler();
    $response = array();
    $response= $db->getAllRecord("SELECT * from customers_auth");
  
     echoResponse(200, $response);
});

$app->get('/companies', function(){
    $db = new DbHandler();
    $response = array();
    $response=$db->getAllRecord("select * from company where isdelete ='N'"); 
    echoResponse(200, $response);
});   
$app->get('/users', function(){
    $db = new DbHandler();
    $response = array();
    $response=$db->getAllRecord("select * from customers_auth"); 
    echoResponse(200, $response);
});   
// Add user
$app->get('/edituser/:id', function($userid){

  $db = new DbHandler();
        $response = array();
        $response=$db->geteditrecords("select uid,username,name  from customers_auth where uid='$userid'"); 
         echoResponse(200, $response);
});
$app->get('/editcompany/:id', function($companyid){

  $db = new DbHandler();
        $response = array();
        $response=$db->geteditrecords("select * from company where isdelete ='N' and companyid ='$companyid'"); 
        echoResponse(200, $response);
});

// Add Company
$app->post('/addcompany', function() use ($app) {
$r = json_decode($app->request->getBody());
verifyRequiredParams(array('companyname','companyaddress'),$r->company);
$response = array();
$db = new DbHandler();
$tabble_name = "company";
$column_names = array('companyname', 'companyaddress');
$result = $db->insertIntoTable($r->company, $column_names, $tabble_name);
if ($result != NULL) {
            $response["status"] = "success";
            $response["message"] = "Company saved successfully";         
             
    }else{
        $response["status"] = "error";
        $response["message"] = "Fields missing";
        echoResponse(201, $response);
    }
      echoResponse(200,$response);

});

$app->post('/savecompany', function() use ($app) {
$r = json_decode($app->request->getBody());
$db = new DbHandler();
$response = array();
$result=$db->DelRecord("Update company SET companyname = '".$r->company->companyname."' where companyid = '".$r->company->companyid."'"); 
$result=$db->DelRecord("Update company SET companyaddress = '".$r->company->companyaddress."' where companyid = '".$r->company->companyid."'"); 
if ($result != NULL) {
            $response["status"] = "success";
            $response["message"] = "Company saved successfully";         
             
    }else{
        $response["status"] = "error";
        $response["message"] = "Fields missing";
        echoResponse(201, $response);
    }
      echoResponse(200,$response);

});
// Assign User
$app->post('/assignuser', function() use ($app) {
$r = json_decode($app->request->getBody());
$db = new DbHandler();
$response = array();
$result=$db->DelRecord("Update jobitems SET assignto = '".$r->id."' where jobitemid = '".$r->itemid."'"); 
$result=$db->DelRecord("Update jobitems SET status = 'Processing' where jobitemid = '".$r->itemid."'"); 
$result=$db->DelRecord("Update jobitems SET dateassigned = CURDATE() where jobitemid = '".$r->itemid."'"); 
echoResponse(200,$response);
 });

// Set Status
// Assign User
$app->post('/setStatus', function() use ($app) {
$r = json_decode($app->request->getBody());
$db = new DbHandler();
$response = array();
$result=$db->DelRecord("Update jobs SET status = '".$r->status."' where jobid = '".$r->jobid."'"); 

echoResponse(200,$response);
 });

// Set Item status
$app->post('/setItemStatus', function() use ($app) {
$r = json_decode($app->request->getBody());
$db = new DbHandler();
$response = array();
$result=$db->DelRecord("Update jobitems SET status = '".$r->status."' where jobitemid = '".$r->jobitemid."'"); 
if($r->status == 'Complete')
{
    $result=$db->DelRecord("Update jobitems SET datecomplete = CURDATE() where jobitemid = '".$r->jobitemid."'"); 
}
echoResponse(200,$response);
 });

// Set Assigned Status

$app->post('/SetItemStatusForWorker', function() use ($app) {
session_start();
$r = json_decode($app->request->getBody());
$db = new DbHandler();
$response = array();
$result=$db->DelRecord("Update jobitems SET status = '".$r->status."' where jobitemid = '".$r->jobitemid."'"); 
if($r->status == 'Processing')
{
    $result=$db->DelRecord("Update jobitems SET dateassigned = CURDATE() where jobitemid = '".$r->jobitemid."'"); 
    $result=$db->DelRecord("Update jobitems SET assignto = ".$_SESSION['uid']." where jobitemid = '".$r->jobitemid."'");
}
if($r->status == 'Complete')
{
    $result=$db->DelRecord("Update jobitems SET datecomplete = CURDATE() where jobitemid = '".$r->jobitemid."'"); 
    $result=$db->DelRecord("Update jobitems SET assignto = ".$_SESSION['uid']." where jobitemid = '".$r->jobitemid."'");
}
echoResponse(200,$response);
 });


// Save User
$app->post('/saveuser', function() use ($app) {
$r = json_decode($app->request->getBody());
$db = new DbHandler();
$response = array();
$result=$db->DelRecord("Update customers_auth SET name = '".$r->signup->name."' where uid = '".$r->signup->uid."'"); 
$password = $r->signup->password;
if($password != '' or $password != NULL)
{
    $password = passwordHash::hash($password);
    $result=$db->DelRecord("Update customers_auth SET password = '". $password."' where uid = '".$r->signup->uid."'"); 
}
if ($result != NULL) {
            $response["status"] = "success";
            $response["message"] = "User saved successfully";         
             
    }else{
        $response["status"] = "error";
        $response["message"] = "Fields missing";
        echoResponse(201, $response);
    }
      echoResponse(200,$response);
 });


// Delete User
$app->post('/deluser', function() use ($app) {
$r = json_decode($app->request->getBody());
$db = new DbHandler();
$response = '';
$response=$db->DelRecord("Delete from customers_auth where uid = $r->id"); 
echoResponse(200, $response);
 });

$app->get('/editjob/:id', function($jobid){
    try {
        $db = new DbHandler();
        $response = array();
        //$temp = array();
        $responsejobs=$db->geteditrecords("select jobid,company,name,eid,po,gender,location from jobs where jobid='$jobid'"); 
       // echo $responsejobs['jobid'];
        $responsejobitems=$db->getAllRecord("select jobitemid,dressid, qty, status from jobitems where jobid='$jobid'");
            
        foreach ($responsejobitems as $responsejobitem) {          
            if($responsejobitem['dressid'] == 1 or $responsejobitem['dressid'] == 4)
            {
              $temp['qty1']  = $responsejobitem['qty'];

              // $responsejobitems['item1']['s1'] = '505';
               $jobitemsid = $responsejobitem['jobitemid'];
               $temp['jobitemsid1'] = $jobitemsid ;
                $temp['dressid1'] = $responsejobitem['dressid'];
               $responsejobmeasureitems=$db->getAllRecord("select measurementid , value from jobitemsmeasurements where jobitemsid='$jobitemsid'");
                foreach($responsejobmeasureitems as $responsejobmeasureitem)
                {
                    $measurementid = $responsejobmeasureitem['measurementid'];
                   
                  
                    $temp['item1'][ $measurementid] = $responsejobmeasureitem['value'];

                }
              
            }   

            if($responsejobitem['dressid'] == 2 or $responsejobitem['dressid'] == 5)
            {
              $temp['qty2']  = $responsejobitem['qty'];
              $temp['dressid2'] = $responsejobitem['dressid'];
              // $responsejobitems['item1']['s1'] = '505';
               $jobitemsid = $responsejobitem['jobitemid'];
                 $temp['jobitemsid2'] = $jobitemsid ;
               $responsejobmeasureitems=$db->getAllRecord("select measurementid , value from jobitemsmeasurements where jobitemsid='$jobitemsid'");
                foreach($responsejobmeasureitems as $responsejobmeasureitem)
                {
                    $measurementid = $responsejobmeasureitem['measurementid'];
                   
                  
                    $temp['item2'][ $measurementid] = $responsejobmeasureitem['value'];

                }
              
            }  

            if($responsejobitem['dressid'] == 3 or $responsejobitem['dressid'] == 6)
            {
              $temp['qty3']  = $responsejobitem['qty'];

              // $responsejobitems['item1']['s1'] = '505';
               $jobitemsid = $responsejobitem['jobitemid'];
                $temp['dressid3'] = $responsejobitem['dressid'];
                 $temp['jobitemsid3'] = $jobitemsid ;
               $responsejobmeasureitems=$db->getAllRecord("select measurementid , value from jobitemsmeasurements where jobitemsid='$jobitemsid'");
                foreach($responsejobmeasureitems as $responsejobmeasureitem)
                {
                    $measurementid = $responsejobmeasureitem['measurementid'];
                   
                  
                    $temp['item3'][ $measurementid] = $responsejobmeasureitem['value'];

                }
              
            }    

        }
                


       $response = array_merge($responsejobs,$responsejobitems, $temp);
       echoResponse(200, $response);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
     }   

});

$app->post('/deljob', function() use ($app) {
$r = json_decode($app->request->getBody());
$db = new DbHandler();
$response = '';
$response=$db->DelRecord("Update jobs SET isdelete = 'Y' where jobid = $r->id"); 
echoResponse(200, $response);
 });

// Saving edited job
$app->post('/savejob', function() use ($app) {
$r = json_decode($app->request->getBody());
verifyRequiredParams(array('name', 'eid' , 'po' ,'gender'),$r->customer);
$response = array();
$db = new DbHandler();
$response=$db->DelRecord("Update jobs SET name = '".$r->customer->name."' , company = '".$r->customer->company."', location = '".$r->customer->location."', po = '".$r->customer->po."', gender='".$r->customer->gender."', eid = '".$r->customer->eid."' where jobid = '".$r->customer->jobid."'"); 
// Now we update the dress id and qty
$response=$db->DelRecord("Update jobitems SET dressid = '".$r->customer->dressid1."' where jobitemid = '".$r->customer->jobitemsid1."'"); 
$response=$db->DelRecord("Update jobitems SET dressid = '".$r->customer->dressid2."' where jobitemid = '".$r->customer->jobitemsid2."'"); 
$response=$db->DelRecord("Update jobitems SET dressid = '".$r->customer->dressid3."' where jobitemid = '".$r->customer->jobitemsid3."'");

$response=$db->DelRecord("Update jobitems SET qty = '".$r->customer->qty1."' where jobitemid = '".$r->customer->jobitemsid1."'"); 
$response=$db->DelRecord("Update jobitems SET qty  = '".$r->customer->qty2."' where jobitemid = '".$r->customer->jobitemsid2."'"); 
$response=$db->DelRecord("Update jobitems SET qty   = '".$r->customer->qty3."' where jobitemid = '".$r->customer->jobitemsid3."'");

foreach ($r->customer->item1 as $key => $value) {
    $measurementid = $key;
    $recval = $value;
    $r->customer->value = $value;
    $response=$db->DelRecord("Update jobitemsmeasurements SET value = '".$recval."' where measurementid = '". $measurementid."' and jobitemsid = '".$r->customer->jobitemsid1."'");
       
    }
foreach ($r->customer->item2 as $key => $value) {
    $measurementid = $key;
    $recval = $value;
    $r->customer->value = $value;
    $response=$db->DelRecord("Update jobitemsmeasurements SET value = '".$recval."' where measurementid = '". $measurementid."' and jobitemsid = '".$r->customer->jobitemsid2."'");
       
    }

foreach ($r->customer->item3 as $key => $value) {
    $measurementid = $key;
    $recval = $value;
    $r->customer->value = $value;
    $response=$db->DelRecord("Update jobitemsmeasurements SET value = '".$recval."' where measurementid = '". $measurementid."' and jobitemsid = '".$r->customer->jobitemsid3."'");
       
    }    
echoResponse(200, $response);
});    

$app->post('/addjob', function() use ($app) {
$r = json_decode($app->request->getBody());
verifyRequiredParams(array('name', 'eid' , 'po' ,'gender'),$r->customer);
$response = array();
$db = new DbHandler();
$tabble_name = "jobs";
$column_names = array('company', 'name', 'eid' , 'po' ,'gender', 'jobtype');
$result = $db->insertIntoTable($r->customer, $column_names, $tabble_name);
$show = $result;

// add job records to jobitems table .. this is put scale the system in future.

$r->customer->jobid = $result;

// adding shirts item
if($r->customer->qty1 != '')
{
 $tabble_name = "jobitems";
 $column_names = array('jobid', 'dressid', 'qty');   
 $r->customer->dressid = $r->customer->dressid1;
 $r->customer->qty = $r->customer->qty1;
 $result = $db->insertIntoTable($r->customer, $column_names, $tabble_name);  
 $tabble_name = "jobitemsmeasurements";
 $column_names = array('jobitemsid', 'measurementid', 'value');
 $r->customer->jobitemsid =  $result;
 foreach ($r->customer->item1 as $key => $value) {
    $r->customer->measurementid = $key;
    $r->customer->value = $value;
    $db->insertIntoTable($r->customer, $column_names, $tabble_name); 

     
    }


}
// adding trousers item
if($r->customer->qty2 != '')
{
 $tabble_name = "jobitems";
 $column_names = array('jobid', 'dressid', 'qty'); 
 $r->customer->dressid = $r->customer->dressid2;
 $r->customer->qty = $r->customer->qty2;
 $result = $db->insertIntoTable($r->customer, $column_names, $tabble_name);  
 $tabble_name = "jobitemsmeasurements";
 $column_names = array('jobitemsid', 'measurementid', 'value');
 $r->customer->jobitemsid =  $result;
 foreach ($r->customer->item2 as $key => $value) {
    $r->customer->measurementid = $key;
    $r->customer->value = $value;
    $db->insertIntoTable($r->customer, $column_names, $tabble_name); 
     
    }

}
// adding jackets item
if($r->customer->qty3 != '')
{
 $tabble_name = "jobitems";
 $column_names = array('jobid', 'dressid', 'qty'); 
 $r->customer->dressid = $r->customer->dressid3;
 $r->customer->qty = $r->customer->qty3;
$result = $db->insertIntoTable($r->customer, $column_names, $tabble_name);  
 $tabble_name = "jobitemsmeasurements";
 $column_names = array('jobitemsid', 'measurementid', 'value');
 $r->customer->jobitemsid =  $result;
 foreach ($r->customer->item3 as $key => $value) {
    $r->customer->measurementid = $key;
    $r->customer->value = $value;
    $db->insertIntoTable($r->customer, $column_names, $tabble_name); 
     
    }


}
    
if ($result != NULL) {
            $response["status"] = "success";
            $response["message"] = "Job created successfully";         
             
    }else{
        $response["status"] = "error";
        $response["message"] = "Fields missing";
        echoResponse(201, $response);
    }
      echoResponse(200,$response);

});   

$app->post('/login', function() use ($app) {
    require_once 'passwordHash.php';
    $r = json_decode($app->request->getBody());
    verifyRequiredParams(array('username', 'password'),$r->customer);
    $response = array();
    $db = new DbHandler();
    $password = $r->customer->password;
    $username = $r->customer->username;
    $user = $db->getOneRecord("select uid,name,password,username,created,role from customers_auth where username='$username'");
    if ($user != NULL) {
        if(passwordHash::check_password($user['password'],$password)){
        $response['status'] = "success";
        $response['message'] = 'Logged in successfully.';
        $response['name'] = $user['name'];
        $response['uid'] = $user['uid'];
         $response['role'] = $user['role'];
        $response['username'] = $user['username'];
        $response['createdAt'] = $user['created'];
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['uid'] = $user['uid'];
        $_SESSION['username'] = $username;
        $_SESSION['name'] = $user['name'];
        $_SESSION['role'] = $user['role'];
        } else {
            $response['status'] = "error";
            $response['message'] = 'Login failed. Incorrect credentials';
        }
    }else {
            $response['status'] = "error";
            $response['message'] = 'No such user is registered';
        }
    echoResponse(200, $response);
});
$app->post('/adduser', function() use ($app) {
    $response = array();
    $r = json_decode($app->request->getBody());
    verifyRequiredParams(array('username', 'name', 'password'),$r->customer);
    require_once 'passwordHash.php';
    $db = new DbHandler();   
    $name = $r->customer->name;
    $username = $r->customer->username;   
    $password = $r->customer->password;
    $isUserExists = $db->getOneRecord("select 1 from customers_auth where username='$username'");
    if(!$isUserExists){
        $r->customer->password = passwordHash::hash($password);
        $tabble_name = "customers_auth";
        $column_names = array('name', 'username', 'password', 'role');
        $result = $db->insertIntoTable($r->customer, $column_names, $tabble_name);
        if ($result != NULL) {
            $response["status"] = "success";
            $response["message"] = "User account created successfully";
            $response["uid"] = $result;
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['uid'] = $response["uid"];            
            $_SESSION['name'] = $name;
            $_SESSION['username'] = $username;
            echoResponse(200, $response);
        } else {
            $response["status"] = "error";
            $response["message"] = "Failed to create customer. Please try again";
            echoResponse(201, $response);
        }            
    }else{
        $response["status"] = "error";
        $response["message"] = "An user with the provided phone or username exists!";
        echoResponse(201, $response);
    }
});
$app->get('/logout', function() {
    $db = new DbHandler();
    $session = $db->destroySession();
    $response["status"] = "info";
    $response["message"] = "Logged out successfully";
    echoResponse(200, $response);
});
?>