<!--
@Author: Mark Genesis T. Romantigue
email:markg.romantigue@gmail.com
version 1.0
-->
<?php
    error_reporting(0);
	session_start();
	if(!isset($_SESSION['myusername'])){ //if login in session is not set
        header("Location:index.php");
	}
	
	include_once 'db.php';
	
	if(isset($_GET['user_id'])){
		$userId = $_GET['user_id'];
        $projectId = $_GET['project_id'];
	}
    
    $myusername = $_SESSION['myusername'];
    $strSQL = "SELECT * FROM users WHERE name = '" . $myusername . "'";
    $rs = mysql_query($strSQL);
    $row = mysql_fetch_array($rs);

    if(isset($_GET['msg'])){
		$msg = $_GET['msg'];
		if ($msg ==  "success"){
			?> <script> alert("Time log added successfully!"); </script> <?php
		}
		else if ($msg ==  "edit"){
			?> <script> alert("Time log updated successfully!"); </script> <?php
		}
    }
    
    $query="SELECT * from users c, project o WHERE c.user_id = o. user_id AND o. user_id = $userId AND o. project_id = $projectId";
    $result=mysql_query($query);
    $row2 = mysql_fetch_array($result);
    if($row2['ST'] == 1){
        header("Location:viewSizeTemplate.php?user_id=$userId&project_id=$projectId");
    }
?>
<html>
    <head>
        <title>Size Estimating Template</title>
        <script src="js/jquery.js"></script>
        <script src="js/sizeEstimatingTemplate.js"></script>
    </head>
    <body>
        <center>
            <br>
            <h2 style="text-align: center;"><strong>Size Estimating Template</strong></h2>
            <!--
            <p style="text-align: center;">&nbsp;</p>
            <table style="height: 84px; width: 1053px;">
                <tbody>
                    <tr>
                        <td style="width: 84px;">
                            <p><strong>Student</strong></p>
                        </td>
                        <td style="width: 767px;">
                            <p><u>Someone Someone S. Someone</u></p>
                        </td>
                        <td style="width: 91px;">
                            <p><strong>Date</strong></p>
                        </td>
                        <td style="width: 81px;">
                            <p><u>the/date/today</u></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 84px;">
                            <p><strong>Professor</strong></p>
                        </td>
                        <td style="width: 767px;">
                            <p><u>Prof. Someone Someone</u></p>
                        </td>
                        <td style="width: 91px;">
                            <p><strong>Program #</strong></p>
                        </td>
                        <td style="width: 81px;">
                            <p><u>Something</u></p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <p>&nbsp;</p>
            <p>&nbsp;</p>
            -->
            <form name="myform" id="myform" role="form" action="submitSizeEstimate.php?user_id=<?php echo $userId?>&project_id=<?php echo $projectId?>" method="POST">
                <table style="height: 1530px; width: 1050px;" id="myTable">
                    <tbody>
                        <tr style="height: 35px;">
                            <td style="width: 1040px; height: 35px;" colspan="9">
                                <p><strong>Base Program</strong></p>
                            </td>
                        </tr>
                        <tr style="height: 35px;">
                            <td style="width: 878px; height: 35px;" colspan="8">
                                <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Base Size (B)</p>
                            </td>
                            <td style="width: 156px; height: 35px;">
                                <input type="text" name="baseSize" id="B" data-validation="number" data-validation-allowing="float">
                            </td>
                        </tr>
                        <tr style="height: 35px;">
                            <td style="width: 878px; height: 35px;" colspan="8">
                                <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; LOC Deleted (D)</p>
                            </td>
                            <td style="width: 156px; height: 35px;">
                                <input type="text" name="locDeleted" id="D" data-validation="number" data-validation-allowing="float">
                            </td>
                        </tr>
                        <tr style="height: 35px;">
                            <td style="width: 878px; height: 35px;" colspan="8">
                                <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; LOC Modified (M)</p>
                            </td>
                            <td style="width: 156px; height: 35px;">
                                <input type="text" name="locModified" id="M" data-validation="number" data-validation-allowing="float">
                            </td>
                        </tr>
                        <tr style="height: 35px;">
                            <td style="width: 878px; height: 35px;" colspan="8">
                                <p>&nbsp;</p>
                            </td>
                            <td style="width: 156px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                        </tr>
                        <tr style="height: 35px;">
                            <td style="width: 284px; height: 35px;">
                                <p><strong>Projected LOC (P)</strong></p>
                            </td>
                            <td style="width: 31px; height: 35px;">
                                <p>&nbsp;</p>
                            </td>
                            <td style="width: 139px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 31px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 139px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 31px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 171px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 10px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 156px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                        </tr>
                        <tr style="height: 35px;">
                            <td style="width: 284px; height: 35px;">
                                <p style="text-align: left;">Base Additions</p>
                            </td>
                            <td style="width: 31px; height: 35px;">
                                <p>&nbsp;</p>
                            </td>
                            <td style="width: 139px; height: 35px;">
                                <p style="text-align: center;">Type</p>
                            </td>
                            <td style="width: 31px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 139px; height: 35px;">
                                <p style="text-align: center;">Methods</p>
                            </td>
                            <td style="width: 31px; height: 35px;">
                                <p>&nbsp;</p>
                            </td>
                            <td style="width: 171px; height: 35px;">
                                <p style="text-align: center;">Relative Size</p>
                            </td>
                            <td style="width: 10px; height: 35px;">
                                <p>&nbsp;</p>
                            </td>
                            <td style="width: 156px; height: 35px;">
                                <p style="text-align: center;">LOC</p>
                            </td>
                        </tr>
                        <tr style="height: 35px;">
                            <td style="width: 284px; height: 35px;">
                                <input type="text" name="BA[]" id="base1" style="width: 280px;" data-validation="required" data-validation-depends-on="total1">
                            </td>
                            <td style="width: 31px; height: 35px;">
                                <p>&nbsp;</p>
                            </td>
                            <td style="width: 139px; height: 35px;">
                                <center>
                                <select name="type[]" id="x1"  data-validation="required" data-validation-depends-on="base1">
                                  <option value="" disabled selected>Select type</option>
                                  <option value="logic">Logic</option>
                                  <option value="io">Input/Output</option>
                                  <option value="calculation">Calculation</option>
                                  <option value="text">Text</option>
                                  <option value="data">Data</option>
                                  <option value="setup">Set-Up</option>
                                </select>
                                </center>
                            </td>
                            <td style="width: 31px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 139px; height: 35px;">
                                <input type="text" name="methods[]" id="item1">
                            </td>
                            <td style="width: 31px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 171px; height: 35px;">
                                <center>
                                <select name="size[]" id="y1"   data-validation="required" data-validation-depends-on="x1">
                                  <option value="" disabled selected>Select Size</option>
                                  <option value="verysmall">Very Small</option>
                                  <option value="small">Small</option>
                                  <option value="medium">Medium</option>
                                  <option value="large">Large</option>
                                  <option value="verylarge">Very Large</option>
                                </select>
                                </center>
                            </td>
                            <td style="width: 10px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 156px; height: 35px;">
                                <input type="text" name="loc[]" class="toAdd" id="total1" data-validation="required" data-validation-depends-on="y1">
                            </td>
                        </tr>
                        <tr style="height: 35px;">
                            <td style="width: 284px; height: 35px;">
                                <input type="text" name="BA[]" id="base2" style="width: 280px;" data-validation="required" data-validation-depends-on="total2">
                            </td>
                            <td style="width: 31px; height: 35px;">
                                <p>&nbsp;</p>
                            </td>
                            <td style="width: 139px; height: 35px;">
                                <center>
                                <select name="type[]" id="x2"  data-validation="required" data-validation-depends-on="base2">
                                  <option value="" disabled selected>Select type</option>
                                  <option value="logic">Logic</option>
                                  <option value="io">Input/Output</option>
                                  <option value="calculation">Calculation</option>
                                  <option value="text">Text</option>
                                  <option value="data">Data</option>
                                  <option value="setup">Set-Up</option>
                                </select>
                                </center>
                            </td>
                            <td style="width: 31px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 139px; height: 35px;">
                                <input type="text" name="methods[]" id="item2">
                            </td>
                            <td style="width: 31px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 171px; height: 35px;">
                                <center>
                                <select name="size[]" id="y2"  data-validation="required" data-validation-depends-on="x2">
                                  <option value="" disabled selected>Select Size</option>
                                  <option value="verysmall">Very Small</option>
                                  <option value="small">Small</option>
                                  <option value="medium">Medium</option>
                                  <option value="large">Large</option>
                                  <option value="verylarge">Very Large</option>
                                </select>
                                </center>
                            </td>
                            <td style="width: 10px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 156px; height: 35px;">
                                <input type="text" name="loc[]" class="toAdd" id="total2" data-validation="required" data-validation-depends-on="y2">
                            </td>
                        </tr>
                        <tr style="height: 35px;">
                            <td style="width: 284px; height: 35px;">
                                <input type="text" name="BA[]" id="base3" style="width: 280px;"  data-validation="required" data-validation-depends-on="total3">
                            </td>
                            <td style="width: 31px; height: 35px;">
                                <p>&nbsp;</p>
                            </td>
                            <td style="width: 139px; height: 35px;">
                                <center>
                                <select name="type[]" id="x3"  data-validation="required" data-validation-depends-on="base3">
                                  <option value="" disabled selected>Select type</option>
                                  <option value="logic">Logic</option>
                                  <option value="io">Input/Output</option>
                                  <option value="calculation">Calculation</option>
                                  <option value="text">Text</option>
                                  <option value="data">Data</option>
                                  <option value="setup">Set-Up</option>
                                </select>
                                </center>
                            </td>
                            <td style="width: 31px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 139px; height: 35px;">
                                <input type="text" name="methods[]" id="item3">
                            </td>
                            <td style="width: 31px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 171px; height: 35px;">
                                <center>
                                <select name="size[]" id="y3" data-validation="required" data-validation-depends-on="x3">
                                  <option value="" disabled selected>Select Size</option>
                                  <option value="verysmall">Very Small</option>
                                  <option value="small">Small</option>
                                  <option value="medium">Medium</option>
                                  <option value="large">Large</option>
                                  <option value="verylarge">Very Large</option>
                                </select>
                                </center>
                            </td>
                            <td style="width: 10px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 156px; height: 35px;">
                                <input type="text" name="loc[]" class="toAdd" id="total3" data-validation="required" data-validation-depends-on="y3">
                            </td>
                        </tr>
                        <tr style="height: 35px;" class="addMore">
                            <td style="width: 284px; height: 35px;">
                                <input type="button" value="Add more base additions" onClick="addRow()" border=0       style='cursor:hand'>
                            </td>
                            <td style="width: 31px; height: 35px;">
                                <p>&nbsp;</p>
                            </td>
                            <td style="width: 139px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 31px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 139px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 31px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 171px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 10px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 156px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                        </tr>
                        <tr style="height: 35px;">
                            <td style="width: 284px; height: 35px;">
                                <p style="text-align: left;">Total Base Additions (BA)</p>
                            </td>
                            <td style="width: 31px; height: 35px;">
                                <p>&nbsp;</p>
                            </td>
                            <td style="width: 139px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 31px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 139px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 31px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 171px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 10px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 156px; height: 35px;">
                                <input type="text" name="totalBA" id="totalBA" data-validation="required" readonly>
                            </td>
                        </tr>
                        <tr style="height: 35px;">
                            <td style="width: 284px; height: 35px;">
                                <p>&nbsp;</p>
                            </td>
                            <td style="width: 31px; height: 35px;">
                                <p>&nbsp;</p>
                            </td>
                            <td style="width: 139px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 31px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 139px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 31px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 171px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 10px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 156px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                        </tr>
                        <tr style="height: 37px;">
                            <td style="width: 284px; height: 37px;">
                                <p style="text-align: left;"><strong>New Objects (NO)</strong></p>
                            </td>
                            <td style="width: 31px; height: 37px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 139px; height: 37px;">
                                <p style="text-align: center;">Type</p>
                            </td>
                            <td style="width: 31px; height: 37px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 139px; height: 37px;">
                                <p style="text-align: center;">Methods</p>
                            </td>
                            <td style="width: 31px; height: 37px;">
                                <p>&nbsp;</p>
                            </td>
                            <td style="width: 171px; height: 37px;">
                                <p style="text-align: center;">Relative Size</p>
                            </td>
                            <td style="width: 10px; height: 37px;">
                                <p>&nbsp;</p>
                            </td>
                            <td style="width: 156px; height: 37px;">
                                <p style="text-align: center;">LOC</p>
                            </td>
                        </tr>
                        <tr style="height: 35px;">
                            <td style="width: 284px; height: 35px;">
                                <input type="text" name="NO[]" id="base4" style="width: 280px;" data-validation="required" data-validation-depends-on="total4">
                            </td>
                            <td style="width: 31px; height: 35px;">
                                <p>&nbsp;</p>
                            </td>
                            <td style="width: 139px; height: 35px;">
                                <center>
                                <select name="type2[]" id='x4' data-validation="required" data-validation-depends-on="base4">
                                  <option value="" disabled selected>Select type</option>
                                  <option value="logic">Logic</option>
                                  <option value="io">Input/Output</option>
                                  <option value="calculation">Calculation</option>
                                  <option value="text">Text</option>
                                  <option value="data">Data</option>
                                  <option value="setup">Set-Up</option>
                                </select>
                                </center>
                            </td>
                            <td style="width: 31px; height: 35px;">
                                <p>&nbsp;</p>
                            </td>
                            <td style="width: 139px; height: 35px;">
                                <input type="text" name="methods2[]" id="item4">
                            </td>
                            <td style="width: 31px; height: 35px;">
                                <p>&nbsp;</p>
                            </td>
                            <td style="width: 171px; height: 35px;">
                                <center>
                                <select name="size2[]" id="y4" data-validation="required" data-validation-depends-on="x4">
                                  <option value="" disabled selected>Select Size</option>
                                  <option value="verysmall">Very Small</option>
                                  <option value="small">Small</option>
                                  <option value="medium">Medium</option>
                                  <option value="large">Large</option>
                                  <option value="verylarge">Very Large</option>
                                </select>
                                </center>
                            </td>
                            <td style="width: 10px; height: 35px;">
                                <p>&nbsp;</p>
                            </td>
                            <td style="width: 156px; height: 35px;">
                                <input type="text" name="loc2[]" class="toAdd2" id="total4" data-validation="required" data-validation-depends-on="y4">
                            </td>
                        </tr>
                        <tr style="height: 35px;">
                            <td style="width: 284px; height: 35px;">
                                <input type="text" name="NO[]" id="base5" style="width: 280px;" data-validation="required" data-validation-depends-on="total5">
                            </td>
                            <td style="width: 31px; height: 35px;">
                                <p>&nbsp;</p>
                            </td>
                            <td style="width: 139px; height: 35px;">
                                <center>
                                <select name="type2[]" id="x5" data-validation="required" data-validation-depends-on="base5">
                                  <option value="" disabled selected>Select type</option>
                                  <option value="logic">Logic</option>
                                  <option value="io">Input/Output</option>
                                  <option value="calculation">Calculation</option>
                                  <option value="text">Text</option>
                                  <option value="data">Data</option>
                                  <option value="setup">Set-Up</option>
                                </select>
                                </center>
                            </td>
                            <td style="width: 31px; height: 35px;">
                                <p>&nbsp;</p>
                            </td>
                            <td style="width: 139px; height: 35px;">
                                <input type="text" name="methods2[]" id="item5">
                            </td>
                            <td style="width: 31px; height: 35px;">
                                <p>&nbsp;</p>
                            </td>
                            <td style="width: 171px; height: 35px;">
                                <center>
                                <select name="size2[]" id="y5" data-validation="required" data-validation-depends-on="x5">
                                  <option value="" disabled selected>Select Size</option>
                                  <option value="verysmall">Very Small</option>
                                  <option value="small">Small</option>
                                  <option value="medium">Medium</option>
                                  <option value="large">Large</option>
                                  <option value="verylarge">Very Large</option>
                                </select>
                                </center>
                            </td>
                            <td style="width: 10px; height: 35px;">
                                <p>&nbsp;</p>
                            </td>
                            <td style="width: 156px; height: 35px;">
                                <input type="text" name="loc2[]" class="toAdd2" id="total5" data-validation="required" data-validation-depends-on="y5">
                            </td>
                        </tr>
                        <tr style="height: 35px;">
                            <td style="width: 284px; height: 35px;">
                                <input type="text" name="NO[]" id="base6" style="width: 280px;" data-validation="required" data-validation-depends-on="total6">
                            </td>
                            <td style="width: 31px; height: 35px;">
                                <p>&nbsp;</p>
                            </td>
                            <td style="width: 139px; height: 35px;">
                                <center>
                                <select name="type2[]" id="x6" data-validation="required" data-validation-depends-on="base6">
                                  <option value="" disabled selected>Select type</option>
                                  <option value="logic">Logic</option>
                                  <option value="io">Input/Output</option>
                                  <option value="calculation">Calculation</option>
                                  <option value="text">Text</option>
                                  <option value="data">Data</option>
                                  <option value="setup">Set-Up</option>
                                </select>
                                </center>
                            </td>
                            <td style="width: 31px; height: 35px;">
                                <p>&nbsp;</p>
                            </td>
                            <td style="width: 139px; height: 35px;">
                                <input type="text" name="methods2[]" id="item6">
                            </td>
                            <td style="width: 31px; height: 35px;">
                                <p>&nbsp;</p>
                            </td>
                            <td style="width: 171px; height: 35px;">
                                <center>
                                <select name="size2[]" id="y6" data-validation="required" data-validation-depends-on="x6">
                                  <option value="" disabled selected>Select Size</option>
                                  <option value="verysmall">Very Small</option>
                                  <option value="small">Small</option>
                                  <option value="medium">Medium</option>
                                  <option value="large">Large</option>
                                  <option value="verylarge">Very Large</option>
                                </select>
                                </center>
                            </td>
                            <td style="width: 10px; height: 35px;">
                                <p>&nbsp;</p>
                            </td>
                            <td style="width: 156px; height: 35px;">
                                <input type="text" name="loc2[]" class="toAdd2" id="total6" data-validation="required" data-validation-depends-on="y6">
                            </td>
                        </tr>
                        <tr style="height: 35px;" class="addMoreObjectRow">
                            <td style="width: 284px; height: 35px;">
                                <input type="button" value="Add more new objects" onClick="addObjectRow()" border=0       style='cursor:hand'>
                            </td>
                            <td style="width: 31px; height: 35px;">
                                <p>&nbsp;</p>
                            </td>
                            <td style="width: 139px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 31px; height: 35px;">
                                <p>&nbsp;</p>
                            </td>
                            <td style="width: 139px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 31px; height: 35px;">
                                <p>&nbsp;</p>
                            </td>
                            <td style="width: 171px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 10px; height: 35px;">
                                <p>&nbsp;</p>
                            </td>
                            <td style="width: 156px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                        </tr>
                        <tr style="height: 35px;">
                            <td style="width: 284px; height: 35px;">
                                <p>Total New Objects (NO)</p>
                            </td>
                            <td style="width: 31px; height: 35px;">
                                <p>&nbsp;</p>
                            </td>
                            <td style="width: 139px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 31px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 139px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 31px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 171px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 10px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 156px; height: 35px;">
                                <input type="text" name="totalNO" id="totalNO" readonly>
                            </td>
                        </tr>
                        <tr style="height: 35px;">
                            <td style="width: 284px; height: 35px;">
                                <p>&nbsp;</p>
                            </td>
                            <td style="width: 31px; height: 35px;">
                                <p>&nbsp;</p>
                            </td>
                            <td style="width: 139px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 31px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 139px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 31px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 171px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 10px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 156px; height: 35px;">
                                <p style="text-align: center;"><strong>&nbsp;</strong></p>
                            </td>
                        </tr>
                        <tr style="height: 35px;">
                            <td style="width: 862px; height: 35px;" colspan="7">
                                <p><strong>Reused Objects</strong></p>
                            </td>
                            <td style="width: 10px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 156px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                        </tr>
                        <tr style="height: 35px;">
                            <td style="width: 862px; height: 35px;" colspan="7">
                                <input type="text" name="RO[]" id="RO1" style="width: 800px;" data-validation="required" data-validation-depends-on="S1">
                            </td>
                            <td style="width: 10px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 156px; height: 35px;">
                                <input type="text" name="loc3[]" id="S1" class="toAdd3" data-validation="required" data-validation-depends-on="RO1">
                            </td>
                        </tr>
                        <tr style="height: 35px;">
                            <td style="width: 862px; height: 35px;" colspan="7">
                                <input type="text" name="RO[]" id="RO2" style="width: 800px;" data-validation="required" data-validation-depends-on="S2">
                            </td>
                            <td style="width: 10px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 156px; height: 35px;">
                                <input type="text" name="loc3[]" id="S2" class="toAdd3" data-validation="required" data-validation-depends-on="RO2">
                            </td>
                        </tr>
                        <tr style="height: 35px;">
                            <td style="width: 862px; height: 35px;" colspan="7">
                                <input type="text" name="RO[]" id="RO3" style="width: 800px;" data-validation="required" data-validation-depends-on="S3">
                            </td>
                            <td style="width: 10px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 156px; height: 35px;">
                                <input type="text" name="loc3[]" id="S3" class="toAdd3" data-validation="required" data-validation-depends-on="RO3">
                            </td>
                        </tr>
                        <tr style="height: 35px;">
                            <td style="width: 862px; height: 35px;" colspan="7">
                                <input type="text" name="RO[]" id="RO4" style="width: 800px;" data-validation="required" data-validation-depends-on="S4">
                            </td>
                            <td style="width: 10px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 156px; height: 35px;">
                                <input type="text" name="loc3[]" id="S4" class="toAdd3" data-validation="required" data-validation-depends-on="RO4">
                            </td>
                        </tr>
                        <tr style="height: 35px;">
                            <td style="width: 862px; height: 35px;" colspan="7">
                                <p>Reused Total (R)</p>
                            </td>
                            <td style="width: 10px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 156px; height: 35px;">
                                <input type="text" name="R" id="totalR" readonly>
                            </td>
                        </tr>
                        <tr style="height: 35px;">
                            <td style="width: 503px; height: 35px;" colspan="4">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 353px; height: 35px;" colspan="3">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 10px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 156px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                        </tr>
                        <tr style="height: 35px;">
                            <td style="width: 503px; height: 35px;" colspan="4">
                                <p>Projected LOC (P)</p>
                            </td>
                            <td style="width: 353px; height: 35px;" colspan="3">
                                <p>P = BA + NO</p>
                            </td>
                            <td style="width: 10px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 156px; height: 35px;">
                                <input type="text" name="P" id="P" data-validation="number" data-validation-allowing="float" readonly>
                            </td>
                        </tr>
                        <tr style="height: 38px;">
                            <td style="width: 503px; height: 38px;" colspan="4">
                                <p>Regression Parameter:</p>
                            </td>
                            <td style="width: 353px; height: 38px;" colspan="3">
                                <p>b<sub>0</sub></p>
                            </td>
                            <td style="width: 10px; height: 38px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 156px; height: 38px;">
                                <input type="text" name="b0" id="b0" data-validation="number" data-validation-allowing="float,negative">
                            </td>
                        </tr>
                        <tr style="height: 38px;">
                            <td style="width: 503px; height: 38px;" colspan="4">
                                <p>Regression Parameter:</p>
                            </td>
                            <td style="width: 353px; height: 38px;" colspan="3">
                                <p>b<sub>1</sub></p>
                            </td>
                            <td style="width: 10px; height: 38px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 156px; height: 38px;">
                                <input type="text" name="b1" id="b1" data-validation="number" data-validation-allowing="float">
                            </td>
                        </tr>
                        <tr style="height: 38px;">
                            <td style="width: 503px; height: 38px;" colspan="4">
                                <p>Estimated New and Changed LOC (N):</p>
                            </td>
                            <td style="width: 353px; height: 38px;" colspan="3">
                                <p>N = b<sub>0 </sub>+ b<sub>1</sub>* (P + M)</p>
                            </td>
                            <td style="width: 10px; height: 38px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 156px; height: 38px;">
                                <input type="text" name="N" id="N" data-validation="number" data-validation-allowing="float" readonly>
                            </td>
                        </tr>
                        <tr style="height: 35px;">
                            <td style="width: 503px; height: 35px;" colspan="4">
                                <p>Estimated Total LOC (T):</p>
                            </td>
                            <td style="width: 353px; height: 35px;" colspan="3">
                                <p>T = N + B &ndash; D &ndash; M + R</p>
                            </td>
                            <td style="width: 10px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 156px; height: 35px;">
                                <input type="text" name="T" id="T" data-validation="number" data-validation-allowing="float" readonly>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <input type="submit" value="Submit" />
                <p><sup>&nbsp;</sup></p>
            </form>
        </center>
    <script src="js/jquery.form-validator.js"></script>
    <script>
    $.validate({
      modules : 'logic',
      onError: function() {
        alert('Failed to save to database! Please check your inputs!');
        return false;
      },
      onSuccess: function() {
        alert('Data successfully saved!');
        return true;
      }
    });
    </script>
    </body>
</html>