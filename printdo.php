<?php
//$con=mysqli_connect("localhost","cupcakes_master","Sakina88!","cupcakes_marhaba");
$con=mysqli_connect("localhost","root","","cms");
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
    <title>A simple, clean, and responsive HTML invoice template</title>
    
    <style>
    .invoice-box{
        max-width:800px;
        margin:auto;
        padding:30px;
        border:1px solid #eee;
        box-shadow:0 0 10px rgba(0, 0, 0, .15);
        font-size:16px;
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
        padding:5px;
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
    </style>
</head>

<body>

    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="6" style="width:100%">
                    <table>
                        <tr>
                            <td class="title" style="width:50%">
                                <img src="/img/logo.jpg" style="width:100%; max-width:300px;">
                            </td>
                            
                            <td style="width:50%">
                                Delivery Order #: 123<br>
                                Date: <?php echo date('jS, F o') ?><br>
                        
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <?php 
           //	 echo $_POST['printdo'][0];
            $sql="SELECT
					jobs.jobid,
					jobs.company,
					jobs.location,
					jobs.name,
					jobs.eid,
					jobs.jobtype,
					company.companyid,
					company.companyname,
					company.companyaddress,
					jobitems.dressid,
					jobitems.qty,
					dresses.dressname
					FROM
					jobs
					Left Join company ON jobs.company = company.companyid
					Left Join jobitems ON jobs.jobid = jobitems.jobid
					Left Join dresses ON jobitems.dressid = dresses.dressid where jobs.jobid = ".$_POST['printdo'][0];
					if ($result=mysqli_query($con,$sql))
						  {
						  // Fetch one and one row
						  while ($row=mysqli_fetch_row($result))
						    {
						    	
						    	$companyname = $row[7];
						    	$companyaddress = $row[8];
						    }
						  // Free result set
						  mysqli_free_result($result);
						}

            ?>
            <tr class="information">
                <td colspan="6">
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
                <td style="width:10%">Srno</td>
                <td style="width:30%">Name/Detail</td>
                <td style="width:15%">ID No</td>
                <td style="width:20%">Type</td>
                <td style="width:15%">Dress</td>
                <td style="width:10%">Qty</td>
            </tr>
         <?php   $i = 1;if ($result=mysqli_query($con,$sql))
						  {
						  // Fetch one and one row
							  while ($row=mysqli_fetch_row($result))
							    { ?>
							            <tr class="item">
							                <td style>
							                    <?php echo $i ?>
							                </td>
							                
							                <td>
							                 <?php echo $row[3] ?>
							                </td>
							                <td>
							                <?php echo $row[4] ?>
							                </td>
							                 <td>
							                 <?php echo $row[5] ?>
							                </td>
							                 <td>
							                <?php echo $row[11] ?>
							                </td>
							                 <td>
							                 <?php echo $row[10] ?>
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