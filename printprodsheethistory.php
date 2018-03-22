<?php
$con=mysqli_connect("localhost","cupcakes_master","Sakina88!","cupcakes_marhaba");
//$con=mysqli_connect("localhost","root","root","cms");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
<!--    <title>A simple, clean, and responsive HTML invoice template</title>-->
    
    <style>
    .invoice-box{
        max-width:1240px;
        margin:auto;
        padding:30px;
        border:1px solid #eee;
        box-shadow:0 0 10px rgba(0, 0, 0, .15);
        font-size:14px;
        line-height:24px;
        font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color:#555;
    }
    .heading td{text-align: left !important}
    .item td{text-align: left !important}
    .invoice-box table{
        width:100%;
        line-height:inherit;
        text-align:left;
    }
    
    .invoice-box table td{
        padding:4px;
        vertical-align:top;
        width: 16.66%
    }
    
    .invoice-box table tr td:nth-child(2){
        text-align:right;
    }
    
    .invoice-box table tr.top table td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.top table td.title{
        font-size:45px;
        line-height:45px;
        color:#333;
    }
    
    .invoice-box table tr.information table td{
        padding-bottom:40px;
    }
    
    .invoice-box table tr.heading td{
        background:#eee;
        border-bottom:1px solid #ddd;
        font-weight:bold;
    }
    
    .invoice-box table tr.details td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom:1px solid #eee;
    }
    
    .invoice-box table tr.item.last td{
        border-bottom:none;
    }
    
    .invoice-box table tr.total td:nth-child(2){
        border-top:2px solid #eee;
        font-weight:bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td{
            width:100%;
            display:block;
            text-align:center;
        }
        
        .invoice-box table tr.information table td{
            width:100%;
            display:block;
            text-align:center;
        }
    }
    @page { size: landscape; }
    @media (min-width: 1200px) {
        .container {
            width: auto;
        }
    }
    </style>
</head>
<?php

//	 echo $_POST['printdo'][0];
$prodnum = $_POST['printprod'];

// Extra logic to get jobids
$select = 'SELECT jobid from production WHERE prodnum = '.'"'.$prodnum.'"';
$result = mysqli_query($con, $select);
$jobids = array();
while ($row = $result->fetch_assoc()){
    $jobids.array_push($jobids,$row['jobid']);
}

$match = '\'' . implode("','", $jobids) . '\'';
//echo  $match;


$sql = "SELECT
                                    jobs.jobid,
                                    jobs.slipno,
                                    jobs.company,
                                    jobs.name,
                                    jobs.eid,
                                    jobs.po,
                                    DATE_FORMAT(jobs.datecreated,'%d/%m/%Y') as date,
                                    jobtype.jobtypename,
                                    company.companyname,
                                    company.companyaddress,
                                    jobitems.qty,
                                    dresses.dressname,
                                    location.locationname
                                    FROM
                                    jobs
                                    Inner Join company ON jobs.company = company.companyid
                                    Inner Join jobtype ON jobs.jobtype = jobtype.jobtypeid
                                    LEFT Join  jobitems ON jobitems.jobid = jobs.jobid
                                    LEFT  Join dresses ON dresses.dressid = jobitems.dressid
                                    LEFT  JOIN location ON jobs.location = location.locationid
                                    where jobs.jobid IN ( " . $match . ")";

function ProductionTableCal ($results) {


    $allItems = array();

    for($j = 0,$i= 0 ; $j < sizeof($results)  ; $i++) {


        $allItems[$i] = array(
            'jobid' => $results[$j]['jobid'] ,
            'slipno' => $results[$j]['slipno'],
            'name'=> $results[$j]['name'] ,
            'company' => $results[$j]['company'],
            'po' => $results[$j]['po'],
            'jobtypename' => $results[$j]['jobtypename'],
            'locationname' => $results[$j]['locationname'],
            'companyname' => $results[$j]['companyname'],
            'eid' => $results[$j]['eid'],
            'date' =>$results[$j]['date'],
            'Total' => 0
        );


        while( $allItems[$i]['jobid'] == $results[$j]['jobid']){

            if(!empty( $allItems[$i][ $results[$j]['dressname'] ]) )
                $allItems[$i][$results[$j]['dressname']] = 0;

            $allItems[$i][$results[$j]['dressname']] +=  (int)($results[$j]['qty']);
            $allItems[$i]['Total'] +=  (int)($results[$j]['qty']);


            $j++;
            if($j > sizeof($results) - 1)
                break;

        }
    }


    return $allItems;
}


if ($selectJoin = mysqli_query($con, $sql)) {

    $rows = mysqli_fetch_all($selectJoin,MYSQLI_ASSOC);
    $companyname = $rows[0]['companyname'];
    $companyaddress = $rows[0]['companyaddress'];
    
    $data = ProductionTableCal($rows);
//    print_r($data);

    $prodnum = date("Ymd").(string)$rows[0]['slipno'];

        // Free result set
        mysqli_free_result($result);
}

?>

<body>

    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="19" style="width:100%">
                    <table>
                        <tr>
                            <td class="title" style="width:50%">
                                <img src="/img/logo.jpg" style="width:100%; max-width:300px;">
                            </td>
                            
                            <td style="width:50%">
                                Production Sheet No #: <?php echo $prodnum ?><br>
                                Date: <?php echo date('jS, F o') ?><br>
                        
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="information">
                <td colspan="20">
                    <table>
                        <tr>
                            <td style="width:50%">
                                Marhaba Garments Trading LLC.<br>                             
                                09, Mohd Al Buraimi Compound
                                <br>
                                Dubai, UAE
                            </td>
                            
                           <td style="width:50%">
                                <?php echo $companyname  ?><br>
                                <?php echo $companyaddress ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
           
            
           
            
            <tr class="heading">
                <td style="..">Sr.No</td>
                <td style="..">Jobid</td>
                <td style="..">Slip No</td>
                <td style="...">Company</td>
                <td style="...">Name</td>
                <td style="width:15%">ID No</td>
                <td style="...">Job Type</td>
                <td style="...">Location</td>
                <td style="...">Shirt</td>
                <td style="...">Trouser</td>
                <td style="...">Jackets</td>
                <td style="...">Tshirt</td>
                <td style="...">Cargo</td>
                <td style="...">Skirt</td>
                <td style="...">Coat</td>
                <td style="...">Waist</td>
                <td style="...">Other</td>
                <td style="...">LPO</td>
                <td style="...">Date</td>

            </tr>
         <?php   $i = 0;if (!empty($data))
						  {
						  // Fetch one and one row
							  foreach ($data as $row)
							    { ?>
							            <tr class="item">
                                            <td style>
                                                <?php echo $i + 1 ?>
                                            </td>

                                            <td>
                                                <?php echo $row['jobid'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['slipno'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['companyname'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['name'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['eid'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['jobtypename'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['locationname'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['Shirt'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['Trouser'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['Jacket'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['Tshirt'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['Cargo_pants'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['Skirt'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['Coat'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['Waist'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['Other'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['po'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['date'] ?>
                                            </td>
							            </tr>

           					<?php $i++;} 
           					}
           					?>		

        </table>
    </div>
    <p><!-- pagebreak --></p>
</body>
</html>