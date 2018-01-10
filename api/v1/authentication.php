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
// Production report 
$app->get('/prodreport', function() {
    $db = new DbHandler();
    $response = array();
    $response= $db->getAllRecord("SELECT
                                    jobs.jobid,
                                    jobs.name,
                                    jobs.status,
                                    jobs.location,
                                    jobs.po as lpo,
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

$app->get('/lpo', function() {
    $db = new DbHandler();
    $response = array();
    $response= $db->getAllRecord("SELECT
                                    lpo.id,
                                    lpo.lponum,
                                    lpo.shirts,
                                    lpo.trousers,
                                    lpo.jackets,
                                    lpo.tshirt,
                                    lpo.skirt,
                                    lpo.coat,
                                    lpo.tie,
                                    lpo.belt,
                                    lpo.bow,
                                    lpo.cap,
                                    lpo.scarf,
                                    lpo.apron,
                                    lpo.coverall,
                                    lpo.shoes,
                                    lpo.other,
                                    lpo.cargo_pants,
                                    lpo.waist,
                                    lpo.companyid,
                                    company.companyname,
                                    (lpo.shirts + lpo.trousers + lpo.jackets + lpo.tshirt + lpo.skirt + lpo.coat + lpo.tie + lpo.belt + lpo.bow + lpo.cap + lpo.scarf + lpo.apron + lpo.coverall + lpo.shoes + lpo.other + lpo.cargo_pants + lpo.waist ) AS total
                                    FROM
                                    lpo
                                    Inner Join company ON lpo.companyid = company.companyid where lpo.isdelete = 'N'");
  
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
$app->post('/prodreport', function() use ($app) {
$r = json_decode($app->request->getBody());
$response = array();
$db = new DbHandler();
if(empty($r->prodreport->datefrom))
    $r->prodreport->datefrom = NULL;
if(empty($r->prodreport->dateto))
    $r->prodreport->dateto = NULL;
if(!isset($r->prodreport->reportfilter))
    $r->prodreport->reportfilter='';
if(!isset($r->prodreport->term))
    $r->prodreport->term='';
$response = $db->findData($r->prodreport->datefrom,$r->prodreport->dateto,$r->prodreport->reportfilter,$r->prodreport->term);
echoResponse(200, $response);
});




$app->get('/users', function() {
    session_start();
    $db = new DbHandler();
    $response = array();
    $response= $db->getAllRecord("SELECT * from customers_auth");
  if($_SESSION['role'] == 0)
     echoResponse(200, $response);
});

$app->get('/companies', function(){
    $db = new DbHandler();
    $response = array();
    $response=$db->getAllRecord("select * from company where isdelete ='N'"); 
    echoResponse(200, $response);
});  

$app->get('/lpos/:companyid', function($comapnyid){
    $db = new DbHandler();
    $response = array();
    $response=$db->getAllLPO($comapnyid); 
    echoResponse(200, $response);
});  
$app->get('/jobtypes', function(){
    $db = new DbHandler();
    $response = array();
    $response=$db->getAllRecord("SELECT jobtype.companyid,jobtype.jobtypename,jobtype.jobtypeid,company.companyid,company.companyname
            FROM
            jobtype
            Inner Join company ON company.companyid = jobtype.companyid and jobtype.isdelete = 'N'"); 
                echoResponse(200, $response);
            }); 
$app->get('/populatejobtypes/:id', function($comapnyid){

  $db = new DbHandler();
        $response = array();
        $response=$db->getAllRecord("SELECT * from jobtype where companyid='$comapnyid'");
         echoResponse(200, $response);
});

// Load the LPO for edit job
$app->get('/populatelpobynum/:lponum', function($lponum){

  $db = new DbHandler();
        $response = array();
        $response=$db->getAllRecord("SELECT * from lpo where lponum='$lponum'"); 
         echoResponse(200, $response);
});
// Populate Job type by name
$app->get('/populatejobtypesbyid/:jobtypeid', function($jobtypeid){

  $db = new DbHandler();
        $response = array();
        $response=$db->getAllRecord("SELECT * from jobtype where jobtypeid='$jobtypeid'"); 
         echoResponse(200, $response);
});

// Add user
$app->get('/edituser/:id', function($userid){
 session_start();
 if($_SESSION['role'] == 0) 
 {
  $db = new DbHandler();
        $response = array();
        $response=$db->geteditrecords("select uid,username,name  from customers_auth where uid='$userid'"); 
         echoResponse(200, $response);
 }        
});
$app->get('/editcompany/:id', function($companyid){

  $db = new DbHandler();
        $response = array();
        $response=$db->geteditrecords("select * from company where isdelete ='N' and companyid ='$companyid'"); 
        echoResponse(200, $response);
});

$app->get('/editlpo/:lponum', function($lponum){

  $db = new DbHandler();
        $response = array();
        session_start();
        if($_SESSION['role'] == 0){

        $response=$db->getAllRecord("select * from lpo where isdelete ='N' and lponum ='$lponum'");


        }
        echoResponse(200, $response);
});

$app->get('/editjobtype/:id', function($jobtypeid){

  $db = new DbHandler();
        $response = array();
        $response=$db->geteditrecords("select * from jobtype where isdelete ='N' and jobtypeid ='$jobtypeid'");
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


// Add LPO
$app->post('/addlpo', function() use ($app) {
$r = json_decode($app->request->getBody());
verifyRequiredParams(array('lponum'),$r->lpo);

 session_start();
$response = array();
$db = new DbHandler();
$db->ifrecordexist('lponum',$r->lpo->lponum,'lpo','companyid', $r->lpo->companyid); 
$tabble_name = "lpo";
//$column_names = array('lponum', 'companyid', 'shirts' , 'trousers' , 'jackets' , 'tshirt' , 'skirt', 'coat', 'tie' , 'belt' , 'bow', 'cap');
$column_names = array('lponum', 'companyid','jobtype','location','dressid' , 'qty');

foreach ($r->dress as $dress ){

    $r->lpo->dressid = $dress->dressid;
    $r->lpo->qty = $dress->qty;
    $r->lpo->jobtype = $dress->jobtype;
    if($_SESSION['role'] == 0)
        $result = $db->insertIntoTable($r->lpo, $column_names, $tabble_name);
}

if ($result != NULL) {
            $response["status"] = "success";
            $response["message"] = "LPO saved successfully";         
             
    }else{
        $response["status"] = "error";
        $response["message"] = "LPO number field missing";
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

$app->post('/savelpo', function() use ($app) {

    session_start();
$r = json_decode($app->request->getBody());
$db = new DbHandler();
$response = array();

if($r->lpo[0]->lponum != $r->plponum)
$db->ifrecordexist('lponum',$r->lpo[0]->lponum,'lpo','companyid', $r->lpo[0]->companyid);

//$result=$db->DelRecord("Update lpo SET lponum = '".$r->lpo->lponum."' where id = '".$r->lpo->id."'");
/*$result=$db->DelRecord("Update lpo SET companyid = '".$r->lpo->companyid."' where id = '".$r->lpo->id."'");
$result=$db->DelRecord("Update lpo SET shirts = '".$r->lpo->shirts."' where id = '".$r->lpo->id."'"); 
$result=$db->DelRecord("Update lpo SET trousers = '".$r->lpo->trousers."' where id = '".$r->lpo->id."'"); 
$result=$db->DelRecord("Update lpo SET jackets = '".$r->lpo->jackets."' where id = '".$r->lpo->id."'"); 
$result=$db->DelRecord("Update lpo SET tshirt = '".$r->lpo->tshirt."' where id = '".$r->lpo->id."'");
$result=$db->DelRecord("Update lpo SET skirt = '".$r->lpo->skirt."' where id = '".$r->lpo->id."'");
$result=$db->DelRecord("Update lpo SET coat = '".$r->lpo->coat."' where id = '".$r->lpo->id."'");
$result=$db->DelRecord("Update lpo SET tie = '".$r->lpo->tie."' where id = '".$r->lpo->id."'");
$result=$db->DelRecord("Update lpo SET belt = '".$r->lpo->belt."' where id = '".$r->lpo->id."'");
$result=$db->DelRecord("Update lpo SET bow = '".$r->lpo->bow."' where id = '".$r->lpo->id."'");
$result=$db->DelRecord("Update lpo SET cap = '".$r->lpo->cap."' where id = '".$r->lpo->id."'");*/

    $result=$db->DelRecord("Update lpo SET companyid = '".$r->lpo[0]->companyid."' where lponum = '".$r->plponum."'");
    $result=$db->DelRecord("Update lpo SET location = '".$r->lpo[0]->location."' where lponum = '".$r->plponum."'");
    $result=$db->DelRecord("Update lpo SET lponum = '".$r->lpo[0]->lponum."' where lponum = '".$r->plponum."'");

    foreach ($r->dress as $dress ){

        if(isset($dress->lpoid)){
        $result = $db->DelRecord("Update lpo SET dressid = '".$dress->dressid."' where id = '".$dress->lpoid."'");
        $result = $db->DelRecord("Update lpo SET qty = '".$dress->qty."' where id = '".$dress->lpoid."'");
        $result = $db->DelRecord("Update lpo SET jobtype = '".$dress->jobtype."' where id = '".$dress->lpoid."'");
        }
        else {
            $tabble_name = "lpo";
            $column_names = array('lponum', 'companyid', 'jobtype', 'location', 'dressid', 'qty');

            $r->lpo[0]->dressid = $dress->dressid;
            $r->lpo[0]->qty = $dress->qty;
            $r->lpo[0]->jobtype = $dress->jobtype;
            $r->lpo[0]->lponum = $r->plponum;

            if ($_SESSION['role'] == 0)
                $result = $db->insertIntoTable($r->lpo[0], $column_names, $tabble_name);
        }
    }


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

// Save Job Type

$app->post('/savejobtype', function() use ($app) {
$r = json_decode($app->request->getBody());
$db = new DbHandler();
$response = array();
$result=$db->DelRecord("Update jobtype SET jobtypename = '".$r->jobtype->jobtypename."' where jobtypeid = '".$r->jobtype->jobtypeid."'"); 
$result=$db->DelRecord("Update jobtype SET companyid = '".$r->jobtype->companyid."' where jobtypeid = '".$r->jobtype->jobtypeid."'"); 
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

// Add Job Type
$app->post('/addjobtype', function() use ($app) {
$r = json_decode($app->request->getBody());
verifyRequiredParams(array('jobtypename','companyid'),$r->jobtype);
$response = array();
$db = new DbHandler();
$tabble_name = "jobtype";
$column_names = array('jobtypename', 'companyid');
$result = $db->insertIntoTable($r->jobtype, $column_names, $tabble_name);
if ($result != NULL) {
            $response["status"] = "success";
            $response["message"] = "Job Type saved successfully";         
             
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
        $responsejobs=$db->geteditrecords("select jobid,company,name,eid,po,gender,location,jobtype,do,inv,slipno from jobs where jobid='$jobid'");
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

            if($responsejobitem['dressid'] == 2 or $responsejobitem['dressid'] == 5 or $responsejobitem['dressid'] == 16)
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

            if($responsejobitem['dressid'] == 3 or $responsejobitem['dressid'] == 6 or $responsejobitem['dressid'] == 17)
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
            /*if($responsejobitem['dressid'] == 7 or $responsejobitem['dressid'] == 8 || $responsejobitem['dressid'] == 9 || $responsejobitem['dressid'] == 10)
            {
                 $temp['qty4']  = $responsejobitem['qty'];
                 $temp['others'] = $responsejobitem['dressid'];
                 $jobitemsid = $responsejobitem['jobitemid']; 
                 $temp['jobitemsid4'] = $jobitemsid;   
            }*/

            if($responsejobitem['dressid'] == 7)
            {
                $temp['qtytie']  = $responsejobitem['qty'];
                $jobitemsid = $responsejobitem['jobitemid'];
                $temp['jobitemsid7'] = $jobitemsid;
            }
            if($responsejobitem['dressid'] == 8)
            {
                $temp['qtybelt']  = $responsejobitem['qty'];
                $jobitemsid = $responsejobitem['jobitemid'];
                $temp['jobitemsid8'] = $jobitemsid;
            }
            if($responsejobitem['dressid'] == 9)
            {
                $temp['qtybow']  = $responsejobitem['qty'];
                $jobitemsid = $responsejobitem['jobitemid'];
                $temp['jobitemsid9'] = $jobitemsid;
            }
            if($responsejobitem['dressid'] == 10)
            {
                $temp['qtycap']  = $responsejobitem['qty'];
                $jobitemsid = $responsejobitem['jobitemid'];
                $temp['jobitemsid10'] = $jobitemsid;
            }
            if($responsejobitem['dressid'] == 11)
            {
                $temp['qtyscarf']  = $responsejobitem['qty'];
                $jobitemsid = $responsejobitem['jobitemid'];
                $temp['jobitemsid11'] = $jobitemsid;
            }
            if($responsejobitem['dressid'] == 12)
            {
                $temp['qtyapron']  = $responsejobitem['qty'];
                $jobitemsid = $responsejobitem['jobitemid'];
                $temp['jobitemsid12'] = $jobitemsid;
            }
            if($responsejobitem['dressid'] == 13)
            {
                $temp['qtycoverall']  = $responsejobitem['qty'];
                $jobitemsid = $responsejobitem['jobitemid'];
                $temp['jobitemsid13'] = $jobitemsid;
            }
            if($responsejobitem['dressid'] == 14)
            {
                $temp['qtyshoes']  = $responsejobitem['qty'];
                $jobitemsid = $responsejobitem['jobitemid'];
                $temp['jobitemsid14'] = $jobitemsid;
            }
            if($responsejobitem['dressid'] == 15)
            {
                $temp['qtyother']  = $responsejobitem['qty'];
                $jobitemsid = $responsejobitem['jobitemid'];
                $temp['jobitemsid15'] = $jobitemsid;
            }

        }
                


       $response = array_merge($responsejobs,$responsejobitems, $temp);
       echoResponse(200, $response);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
     }   

});

$app->post('/deljob', function() use ($app) {
session_start();
$r = json_decode($app->request->getBody());
$db = new DbHandler();
$response = '';
if($_SESSION['role'] == 0)
$response=$db->DelRecord("Update jobs SET isdelete = 'Y' where jobid = $r->id"); 
echoResponse(200, $response);
 });

$app->post('/dellpo', function() use ($app) {
session_start();
$r = json_decode($app->request->getBody());
$db = new DbHandler();
$response = '';
if($_SESSION['role'] == 0)
$response=$db->DelRecord("Update lpo SET isdelete = 'Y' where jobid = $r->id"); 
echoResponse(200, $response);
 });

// Saving edited job
$app->post('/savejob', function() use ($app) {
$r = json_decode($app->request->getBody());
verifyRequiredParams(array('name', 'eid' , 'po' ,'gender'),$r->customer);
$response = array();
$db = new DbHandler();
$response=$db->DelRecord("Update jobs SET name = '".$r->customer->name."' , company = '".$r->customer->company."', location = '".$r->customer->location."', jobtype = '".$r->customer->jobtype."', gender='".$r->customer->gender."', eid = '".$r->customer->eid."' , do = '".$r->customer->do."' , inv = '".$r->customer->inv."', slipno = '".$r->customer->slipno."' where jobid = '".$r->customer->jobid."'");
// Now we update the dress id and qty
if(!empty($r->customer->jobitemsid1))
$response=$db->DelRecord("Update jobitems SET dressid = '".$r->customer->dressid1."' where jobitemid = '".$r->customer->jobitemsid1."'"); 
if(!empty($r->customer->jobitemsid2))
$response=$db->DelRecord("Update jobitems SET dressid = '".$r->customer->dressid2."' where jobitemid = '".$r->customer->jobitemsid2."'"); 
if(!empty($r->customer->jobitemsid3))
$response=$db->DelRecord("Update jobitems SET dressid = '".$r->customer->dressid3."' where jobitemid = '".$r->customer->jobitemsid3."'");
if(!empty($r->customer->jobitemsid4))
$response=$db->DelRecord("Update jobitems SET dressid = '".$r->customer->others."' where jobitemid = '".$r->customer->jobitemsid4."'");
if(!empty($r->customer->jobitemsid1))
$response=$db->DelRecord("Update jobitems SET qty = '".$r->customer->qty1."' where jobitemid = '".$r->customer->jobitemsid1."'"); 
if(!empty($r->customer->jobitemsid2))
$response=$db->DelRecord("Update jobitems SET qty  = '".$r->customer->qty2."' where jobitemid = '".$r->customer->jobitemsid2."'"); 
if(!empty($r->customer->jobitemsid3))
$response=$db->DelRecord("Update jobitems SET qty   = '".$r->customer->qty3."' where jobitemid = '".$r->customer->jobitemsid3."'");
if(!empty($r->customer->jobitemsid4))
    $response=$db->DelRecord("Update jobitems SET qty   = '".$r->customer->qty4."' where jobitemid = '".$r->customer->jobitemsid4."'");


if(!empty($r->customer->jobitemsid1))
{
    foreach ($r->customer->item1 as $key => $value) {
        $measurementid = $key;
        $recval = $value;
        $r->customer->value = $value;
        
         $response=$db->DelRecord("Update jobitemsmeasurements SET value = '".$recval."' where measurementid = '". $measurementid."' and jobitemsid = '".$r->customer->jobitemsid1."'");
           
        }
}
if(!empty($r->customer->jobitemsid2)){
    foreach ($r->customer->item2 as $key => $value) {
        $measurementid = $key;
        $recval = $value;
        $r->customer->value = $value;
      
        $response=$db->DelRecord("Update jobitemsmeasurements SET value = '".$recval."' where measurementid = '". $measurementid."' and jobitemsid = '".$r->customer->jobitemsid2."'");
           
        }
}
if(!empty($r->customer->jobitemsid3)){
    foreach ($r->customer->item3 as $key => $value) {
        $measurementid = $key;
        $recval = $value;
        $r->customer->value = $value;
        if(!empty($r->customer->jobitemsid3))
        $response=$db->DelRecord("Update jobitemsmeasurements SET value = '".$recval."' where measurementid = '". $measurementid."' and jobitemsid = '".$r->customer->jobitemsid3."'");
           
        }    
}

    if(!empty($r->customer->jobitemsid7))
        $response=$db->DelRecord("Update jobitems SET qty   = '".$r->customer->qtytie."' where jobitemid = '".$r->customer->jobitemsid7."'");

    if(!empty($r->customer->jobitemsid8))
        $response=$db->DelRecord("Update jobitems SET qty   = '".$r->customer->qtybelt."' where jobitemid = '".$r->customer->jobitemsid8."'");

    if(!empty($r->customer->jobitemsid9))
        $response=$db->DelRecord("Update jobitems SET qty   = '".$r->customer->qtybow."' where jobitemid = '".$r->customer->jobitemsid9."'");

    if(!empty($r->customer->jobitemsid10))
        $response=$db->DelRecord("Update jobitems SET qty   = '".$r->customer->qtycap."' where jobitemid = '".$r->customer->jobitemsid10."'");

    if(!empty($r->customer->jobitemsid11))
        $response=$db->DelRecord("Update jobitems SET qty   = '".$r->customer->qtyscarf."' where jobitemid = '".$r->customer->jobitemsid11."'");

    if(!empty($r->customer->jobitemsid12))
        $response=$db->DelRecord("Update jobitems SET qty   = '".$r->customer->qtyapron."' where jobitemid = '".$r->customer->jobitemsid12."'");

    if(!empty($r->customer->jobitemsid13))
        $response=$db->DelRecord("Update jobitems SET qty   = '".$r->customer->qtycoverall."' where jobitemid = '".$r->customer->jobitemsid13."'");

    if(!empty($r->customer->jobitemsid14))
        $response=$db->DelRecord("Update jobitems SET qty   = '".$r->customer->qtyshoes."' where jobitemid = '".$r->customer->jobitemsid14."'");

    if(!empty($r->customer->jobitemsid15))
        $response=$db->DelRecord("Update jobitems SET qty   = '".$r->customer->qtyother."' where jobitemid = '".$r->customer->jobitemsid15."'");

   $result["status"] = "success";
echoResponse(200,$result);
});


function validateLpoQty($customer){

    $db = new DbHandler();
    $lpo_values = $db->getOneRecord("select * from lpo where lponum = '$customer->po' AND companyid = $customer->company");
    $err = '';

    //Get all the jobids from previously added jobs
    $previousJobid = $db->getAllRecord("select jobid from jobs where po = '$customer->po' AND company = '$customer->company' ");
    $jobIDs = '';
    if(isset($previousJobid))
    for($i = 0 ; $i < sizeof($previousJobid); $i++)
        $jobIDs .= '\''.$previousJobid[$i]['jobid'].'\',';
    $jobIDs .= '0';

    if($customer->dressid1 == 1 && $customer->qty1 != 0)
    {
        $qtySum  = $db->getOneRecord("SELECT COALESCE(sum(qty),0) As qtySum from jobitems where jobid IN(".$jobIDs.") AND dressid = '1'");

        if( $qtySum['qtySum'] + $customer ->qty1  > $lpo_values['shirts'] )
            $err .= 'Shirt ';
    }
    if($customer->dressid2 == 2 && $customer->qty2 != 0)
    {
        $qtySum  = $db->getOneRecord("SELECT COALESCE(sum(qty),0) As qtySum from jobitems where jobid IN(".$jobIDs.") AND dressid = '2'");
        if( $qtySum['qtySum'] + $customer ->qty2 > $lpo_values['trousers'] )
        $err .= 'Trouser ';
    }
    if($customer->dressid3 == 3 && $customer->qty3 != 0)
    {
        $qtySum  = $db->getOneRecord("SELECT COALESCE(sum(qty),0) As qtySum from jobitems where jobid IN(".$jobIDs.") AND dressid = '3'");
        if( $qtySum['qtySum'] + $customer ->qty3 > $lpo_values['jackets'] )
            $err .= 'Jacket ';
    }
    if($customer->dressid1 == 4 && $customer->qty1 != 0)
    {
        $qtySum  = $db->getOneRecord("SELECT COALESCE(sum(qty),0) As qtySum from jobitems where jobid IN(".$jobIDs.") AND dressid = '4'");
        if( $qtySum['qtySum'] + $customer ->qty1 > $lpo_values['tshirt'] )
            $err .= 'T-shirt ';
    }
    if($customer->dressid2 == 5 && $customer->qty2 != 0)
    {
        $qtySum  = $db->getOneRecord("SELECT COALESCE(sum(qty),0) As qtySum from jobitems where jobid IN(".$jobIDs.") AND dressid = '5'");
        if( $qtySum['qtySum'] + $customer->qty2 > $lpo_values['skirt'] )
        $err .= 'Skirt ';
    }

    if($customer->dressid3 == 6 && $customer->qty3 != 0)
    {
        $qtySum  = $db->getOneRecord("SELECT COALESCE(sum(qty),0) As qtySum from jobitems where jobid IN(".$jobIDs.") AND dressid = '6'");
        if( $qtySum['qtySum'] + $customer ->qty3 > $lpo_values['coat'] )
        $err .= 'Coat ';
    }

    if($customer->dressid2 == 16 && $customer->qty2 != 0)
    {
        $qtySum  = $db->getOneRecord("SELECT COALESCE(sum(qty),0) As qtySum from jobitems where jobid IN(".$jobIDs.") AND dressid = '16'");
        if( $qtySum['qtySum'] + $customer ->qty2 > $lpo_values['cargo_pants'] )
        $err .= 'Cargo Pants ';
    }

    if($customer->dressid3 == 17 && $customer->qty3 != 0)
    {
        $qtySum  = $db->getOneRecord("SELECT COALESCE(sum(qty),0) As qtySum from jobitems where jobid IN(".$jobIDs.") AND dressid = '17'");
        if( $qtySum['qtySum'] + $customer ->qty3 > $lpo_values['waist'] )
        $err .= 'Waist ';
    }
    /*if($customer->others == 7 && $customer->qty4 != 0)
    {
        $qtySum  = $db->getOneRecord("SELECT COALESCE(sum(qty),0) As qtySum from jobitems where jobid IN(".$jobIDs.") AND dressid = '7'");
        if( $qtySum['qtySum'] + $customer ->qty4 > $lpo_values['tie'] )
        $err .= 'Tie ';
    }
    if($customer->others == 8 && $customer->qty4 != 0)
    {
        $qtySum  = $db->getOneRecord("SELECT COALESCE(sum(qty),0) As qtySum from jobitems where jobid IN(".$jobIDs.") AND dressid = '8'");
        if( $qtySum['qtySum'] + $customer ->qty4 > $lpo_values['belt'] )
        $err .= 'Belt ';
    }
    if($customer->others == 9 && $customer->qty4 != 0)
    {
        $qtySum  = $db->getOneRecord("SELECT COALESCE(sum(qty),0) As qtySum from jobitems where jobid IN(".$jobIDs.") AND dressid = '9'");
        if( $qtySum['qtySum'] + $customer ->qty4 > $lpo_values['bow'] )
        $err .= 'Bow ';
    }
    if($customer->others == 10 && $customer->qty4 != 0)
    {
        $qtySum  = $db->getOneRecord("SELECT COALESCE(sum(qty),0) As qtySum from jobitems where jobid IN(".$jobIDs.") AND dressid = '10'");
        if( $qtySum['qtySum'] + $customer ->qty4 > $lpo_values['cap'] )
        $err .= 'Cap ';
    }*/

    if($customer->qtytie != 0)
    {
        $qtySum  = $db->getOneRecord("SELECT COALESCE(sum(qty),0) As qtySum from jobitems where jobid IN(".$jobIDs.") AND dressid = '7'");
        if( $qtySum['qtySum'] + $customer ->qtytie > $lpo_values['tie'] )
            $err .= 'Tie ';
    }
    if($customer->qtybelt != 0)
    {
        $qtySum  = $db->getOneRecord("SELECT COALESCE(sum(qty),0) As qtySum from jobitems where jobid IN(".$jobIDs.") AND dressid = '8'");
        if( $qtySum['qtySum'] + $customer ->qtybelt > $lpo_values['belt'] )
            $err .= 'Belt ';
    }
    if($customer->qtybow != 0)
    {
        $qtySum  = $db->getOneRecord("SELECT COALESCE(sum(qty),0) As qtySum from jobitems where jobid IN(".$jobIDs.") AND dressid = '9'");
        if( $qtySum['qtySum'] + $customer ->qtybow > $lpo_values['bow'] )
            $err .= 'Bow ';
    }
    if($customer->qtycap != 0)
    {
        $qtySum  = $db->getOneRecord("SELECT COALESCE(sum(qty),0) As qtySum from jobitems where jobid IN(".$jobIDs.") AND dressid = '10'");
        if( $qtySum['qtySum'] + $customer ->qtycap > $lpo_values['cap'] )
            $err .= 'Cap ';
    }
    if($customer->qtyscarf != 0)
    {
        $qtySum  = $db->getOneRecord("SELECT COALESCE(sum(qty),0) As qtySum from jobitems where jobid IN(".$jobIDs.") AND dressid = '11'");
        if( $qtySum['qtySum'] + $customer ->qtyscarf > $lpo_values['scarf'] )
            $err .= 'Scarf ';
    }
    if($customer->qtyapron != 0)
    {
        $qtySum  = $db->getOneRecord("SELECT COALESCE(sum(qty),0) As qtySum from jobitems where jobid IN(".$jobIDs.") AND dressid = '12'");
        if( $qtySum['qtySum'] + $customer ->qtyapron > $lpo_values['apron'] )
            $err .= 'Apron ';
    }
    if($customer->qtycoverall != 0)
    {
        $qtySum  = $db->getOneRecord("SELECT COALESCE(sum(qty),0) As qtySum from jobitems where jobid IN(".$jobIDs.") AND dressid = '13'");
        if( $qtySum['qtySum'] + $customer ->qtycoverall > $lpo_values['coverall'] )
            $err .= 'Coverall ';
    }
    if($customer->qtyshoes != 0)
    {
        $qtySum  = $db->getOneRecord("SELECT COALESCE(sum(qty),0) As qtySum from jobitems where jobid IN(".$jobIDs.") AND dressid = '14'");
        if( $qtySum['qtySum'] + $customer ->qtyshoes > $lpo_values['shoes'] )
            $err .= 'Shoes ';
    }
    if($customer->qtyother != 0)
    {
        $qtySum  = $db->getOneRecord("SELECT COALESCE(sum(qty),0) As qtySum from jobitems where jobid IN(".$jobIDs.") AND dressid = '15'");
        if( $qtySum['qtySum'] + $customer ->qtyother > $lpo_values['other'] )
            $err .= 'Other ';
    }

    return $err;

}



$app->post('/addjob', function() use ($app) {
$r = json_decode($app->request->getBody());

//calling lpo check func
$lpocheck = validateLpoQty($r->customer);
//$lpocheck = '';
$result = null;

verifyRequiredParams(array('name', 'eid' , 'po' ,'gender'),$r->customer);
$response = array();

    if($lpocheck == '') {


    $db = new DbHandler();
    $tabble_name = "jobs";
    $column_names = array('company', 'name', 'eid', 'po', 'gender', 'jobtype','location','slipno');
    $result = $db->insertIntoTable($r->customer, $column_names, $tabble_name);
    $show = $result;

// add job records to jobitems table .. this is put scale the system in future.

    $r->customer->jobid = $result;

// adding shirts item
    if ($r->customer->qty1 != '') {
        $tabble_name = "jobitems";
        $column_names = array('jobid', 'dressid', 'qty');
        $r->customer->dressid = $r->customer->dressid1;
        $r->customer->qty = $r->customer->qty1;
        $result = $db->insertIntoTable($r->customer, $column_names, $tabble_name);
        $tabble_name = "jobitemsmeasurements";
        $column_names = array('jobitemsid', 'measurementid', 'value');
        $r->customer->jobitemsid = $result;
        foreach ($r->customer->item1 as $key => $value) {
            $r->customer->measurementid = $key;
            $r->customer->value = $value;
            $db->insertIntoTable($r->customer, $column_names, $tabble_name);


        }


    }
// adding trousers item
    if ($r->customer->qty2 != '') {
        $tabble_name = "jobitems";
        $column_names = array('jobid', 'dressid', 'qty');
        $r->customer->dressid = $r->customer->dressid2;
        $r->customer->qty = $r->customer->qty2;
        $result = $db->insertIntoTable($r->customer, $column_names, $tabble_name);
        $tabble_name = "jobitemsmeasurements";
        $column_names = array('jobitemsid', 'measurementid', 'value');
        $r->customer->jobitemsid = $result;
        foreach ($r->customer->item2 as $key => $value) {
            $r->customer->measurementid = $key;
            $r->customer->value = $value;
            $db->insertIntoTable($r->customer, $column_names, $tabble_name);

        }

    }
// adding jackets item
    if ($r->customer->qty3 != '') {
        $tabble_name = "jobitems";
        $column_names = array('jobid', 'dressid', 'qty');
        $r->customer->dressid = $r->customer->dressid3;
        $r->customer->qty = $r->customer->qty3;
        $result = $db->insertIntoTable($r->customer, $column_names, $tabble_name);
        $tabble_name = "jobitemsmeasurements";
        $column_names = array('jobitemsid', 'measurementid', 'value');
        $r->customer->jobitemsid = $result;
        foreach ($r->customer->item3 as $key => $value) {
            $r->customer->measurementid = $key;
            $r->customer->value = $value;
            $db->insertIntoTable($r->customer, $column_names, $tabble_name);

        }


    }

    /*if ($r->customer->qty4 != '') {
        $tabble_name = "jobitems";
        $column_names = array('jobid', 'dressid', 'qty');
        $r->customer->dressid = $r->customer->others;
        $r->customer->qty = $r->customer->qty4;
        $result = $db->insertIntoTable($r->customer, $column_names, $tabble_name);
    }*/


    if ($r->customer->qtytie != '') {
        $tabble_name = "jobitems";
        $column_names = array('jobid', 'dressid', 'qty');
        $r->customer->dressid = '7';
        $r->customer->qty = $r->customer->qtytie;
        $result = $db->insertIntoTable($r->customer, $column_names, $tabble_name);
    }
    if ($r->customer->qtybelt != '') {
        $tabble_name = "jobitems";
        $column_names = array('jobid', 'dressid', 'qty');
        $r->customer->dressid = '8';
        $r->customer->qty = $r->customer->qtybelt;
        $result = $db->insertIntoTable($r->customer, $column_names, $tabble_name);
    }
    if ($r->customer->qtybow != '') {
        $tabble_name = "jobitems";
        $column_names = array('jobid', 'dressid', 'qty');
        $r->customer->dressid = '9';
        $r->customer->qty = $r->customer->qtybow;
        $result = $db->insertIntoTable($r->customer, $column_names, $tabble_name);
    }
    if ($r->customer->qtycap != '') {
        $tabble_name = "jobitems";
        $column_names = array('jobid', 'dressid', 'qty');
        $r->customer->dressid = '10';
        $r->customer->qty = $r->customer->qtycap;
        $result = $db->insertIntoTable($r->customer, $column_names, $tabble_name);
    }
    if ($r->customer->qtyscarf != '') {
        $tabble_name = "jobitems";
        $column_names = array('jobid', 'dressid', 'qty');
        $r->customer->dressid = '11';
        $r->customer->qty = $r->customer->qtyscarf;
        $result = $db->insertIntoTable($r->customer, $column_names, $tabble_name);
    }
    if ($r->customer->qtyapron != '') {
        $tabble_name = "jobitems";
        $column_names = array('jobid', 'dressid', 'qty');
        $r->customer->dressid = '12';
        $r->customer->qty = $r->customer->qtyapron;
        $result = $db->insertIntoTable($r->customer, $column_names, $tabble_name);
    }
    if ($r->customer->qtycoverall != '') {
        $tabble_name = "jobitems";
        $column_names = array('jobid', 'dressid', 'qty');
        $r->customer->dressid = '13';
        $r->customer->qty = $r->customer->qtycoverall;
        $result = $db->insertIntoTable($r->customer, $column_names, $tabble_name);
    }
    if ($r->customer->qtyshoes != '') {
        $tabble_name = "jobitems";
        $column_names = array('jobid', 'dressid', 'qty');
        $r->customer->dressid = '14';
        $r->customer->qty = $r->customer->qtyshoes;
        $result = $db->insertIntoTable($r->customer, $column_names, $tabble_name);
    }
    if ($r->customer->qtyother != '') {
        $tabble_name = "jobitems";
        $column_names = array('jobid', 'dressid', 'qty');
        $r->customer->dressid = '15';
        $r->customer->qty = $r->customer->qtyother;
        $result = $db->insertIntoTable($r->customer, $column_names, $tabble_name);
    }

    }
if ($result != NULL) {
            $response["status"] = "success";
            $response["message"] = "Job created successfully";
             
    }else{
        $response["status"] = "error";
        $response["message"] = $lpocheck."quantity exceed";
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
    session_start();
    $response = array();
    $r = json_decode($app->request->getBody());
    verifyRequiredParams(array('username', 'name', 'password'),$r->customer);
    require_once 'passwordHash.php';
    $db = new DbHandler();   
    $name = $r->customer->name;
    $username = $r->customer->username;   
    $password = $r->customer->password;
    $isUserExists = $db->getOneRecord("select 1 from customers_auth where username='$username'");
    if(!$isUserExists and $_SESSION['role'] == 0){
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

// Add Location
$app->post('/addlocation', function() use ($app) {
    $r = json_decode($app->request->getBody());
    verifyRequiredParams(array('locationname','companyid'),$r->location);
    $response = array();
    $db = new DbHandler();
    $tabble_name = "location";
    $column_names = array('locationname', 'companyid');
    $result = $db->insertIntoTable($r->location, $column_names, $tabble_name);
    if ($result != NULL) {
        $response["status"] = "success";
        $response["message"] = "Job Type saved successfully";

    }else{
        $response["status"] = "error";
        $response["message"] = "Fields missing";
        echoResponse(201, $response);
    }
    echoResponse(200,$response);

});

$app->get('/locations', function(){
    $db = new DbHandler();
    $response = array();
    $response=$db->getAllRecord("SELECT location.companyid,location.locationname,location.locationid,company.companyid,company.companyname
            FROM
            location
            Inner Join company ON company.companyid = location.companyid and location.isdelete = 'N'");
    echoResponse(200, $response);
});
$app->get('/populatelocation/:id', function($comapnyid){

    $db = new DbHandler();
    $response = array();
    $response=$db->getAllRecord("SELECT * from location where companyid='$comapnyid'");
    echoResponse(200, $response);
});

$app->get('/editlocation/:id', function($locationid){

    $db = new DbHandler();
    $response = array();
    $response=$db->geteditrecords("select * from location where isdelete ='N' and locationid ='$locationid'");
    echoResponse(200, $response);

});

$app->post('/savelocation', function() use ($app) {
    $r = json_decode($app->request->getBody());
    $db = new DbHandler();
    $response = array();
    $result=$db->DelRecord("Update location SET locationname = '".$r->location->locationname."' where locationid = '".$r->location->locationid."'");
    $result=$db->DelRecord("Update location SET companyid = '".$r->location->companyid."' where locationid = '".$r->location->locationid."'");
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

$app->post('/dellocation', function() use ($app) {
    session_start();
    $r = json_decode($app->request->getBody());
    $db = new DbHandler();
    $response = '';
    if($_SESSION['role'] == 0)
        $response=$db->DelRecord("Update location SET isdelete = 'Y' where locationid = $r->locationid");
    echoResponse(200, $response);
});

$app->get('/populatelocationbyid/:locationid', function($locationid){

    $db = new DbHandler();
    $response = array();
    $response=$db->getAllRecord("SELECT * from location where locationid='$locationid'");
    echoResponse(200, $response);
});



//Dresses


$app->get('/dresses', function(){
    $db = new DbHandler();
    $response = array();
    $response=$db->getAllRecord("SELECT * FROM dresses");
    echoResponse(200, $response);
});
?>