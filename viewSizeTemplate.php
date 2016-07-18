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
    $strSQL = "SELECT * FROM users as u, project as p WHERE u.user_id=p.user_id AND name = '" . $myusername . "'";
    $rs = mysql_query($strSQL);
    $row = mysql_fetch_array($rs);
    
    $strSQL2 = "SELECT * FROM `base_program` WHERE `user_id` = '" . $userId . "' AND `project_id` = '" . $projectId . "'";
    $rs2 = mysql_query($strSQL2);
    $row2 = mysql_fetch_array($rs2);
    
    $strSQL3 = "SELECT * FROM `projected_loc` WHERE `user_id` = '" . $userId . "' AND `project_id` = '" . $projectId . "'";
    $rs3 = mysql_query($strSQL3);
    //$row3 = mysql_fetch_array($rs3);
    $plocCount = mysql_num_rows($rs3);
    
    $strSQL4 = "SELECT * FROM `new_objects` WHERE `user_id` = '" . $userId . "' AND `project_id` = '" . $projectId . "'";
    $rs4 = mysql_query($strSQL4);
    $objectCount = mysql_num_rows($rs4);
    
    $strSQL5 = "SELECT * FROM `size_estimates` WHERE `user_id` = '" . $userId . "' AND `project_id` = '" . $projectId . "'";
    $rs5 = mysql_query($strSQL5);
    $row5 = mysql_fetch_array($rs5);
    
    $strSQL6 = "SELECT * FROM `reused_objects` WHERE `user_id` = '" . $userId . "' AND `project_id` = '" . $projectId . "'";
    $rs6 = mysql_query($strSQL6);
    $row6 = mysql_fetch_array($rs6);
    

    if(isset($_GET['msg'])){
		$msg = $_GET['msg'];
		if ($msg ==  "success"){
			?> <script> alert("Time log added successfully!"); </script> <?php
		}
		else if ($msg ==  "edit"){
			?> <script> alert("Time log updated successfully!"); </script> <?php
		}
    }
    
?>
<html>
    <head>
        <title>Size Estimating Template</title>
        <script src="js/jquery.js"></script>
        <script src="js/sizeEstimatingTemplate.js"></script>
        <script>
        function addRow(){
            var i=0;
            for(i=0;i<<?php echo $plocCount;?>;i++){
                $('#myTable tr.addMore').before("");
                $('.toAdd, .toAdd2').trigger('click');
                $('.toAdd, .toAdd2').trigger('keyup');
            }
            for(i=0;i<<?php echo $objectCount;?>;i++){
                $('#myTable tr.addMoreObjectRow').before("");
                $('.toAdd, .toAdd2').trigger('click');
                $('.toAdd, .toAdd2').trigger('keyup');
            }
        }
        </script>
    </head>
    <body  onload="addRow();">
        <center>
            <br>
            <h2 style="text-align: center;"><strong>Size Estimating Template</strong></h2>
            <p style="text-align: center;">&nbsp;</p>
            <table style="height: 84px; width: 1053px;">
                <tbody>
                    <tr>
                        <td style="width: 84px;">
                            <p><strong>Student</strong></p>
                        </td>
                        <td style="width: 767px;">
                            <p><u><?php echo $row['name'];?></u></p>
                        </td>
                        <td style="width: 91px;">
                            <p><strong>Date</strong></p>
                        </td>
                        <td style="width: 81px;">
                            <p><u><?php echo $row['date'];?></u></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 84px;">
                            <p><strong>Professor</strong></p>
                        </td>
                        <td style="width: 767px;">
                            <p><u><?php echo $row['professor'];?></u></p>
                        </td>
                        <td style="width: 91px;">
                            <p><strong>Program #</strong></p>
                        </td>
                        <td style="width: 81px;">
                            <p><u><?php echo $row['program_no'];?></u></p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <p>&nbsp;</p>
            <p>&nbsp;</p>
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
                                <input type="text" name="baseSize" id="B" value="<?php echo $row2['base_size'];?>" readonly>
                            </td>
                        </tr>
                        <tr style="height: 35px;">
                            <td style="width: 878px; height: 35px;" colspan="8">
                                <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; LOC Deleted (D)</p>
                            </td>
                            <td style="width: 156px; height: 35px;">
                                <input type="text" name="locDeleted" id="D" value="<?php echo $row2['loc_deleted'];?>" readonly>
                            </td>
                        </tr>
                        <tr style="height: 35px;">
                            <td style="width: 878px; height: 35px;" colspan="8">
                                <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; LOC Modified (M)</p>
                            </td>
                            <td style="width: 156px; height: 35px;">
                                <input type="text" name="locModified" id="M" value="<?php echo $row2['loc_modified'];?>" readonly>
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
                        
                        <?php
                        while ($row3 = mysql_fetch_array($rs3)) {
                            echo "<tr style='height: 35px;'><td style='width: 284px; height: 35px;'><input type='text' name='BA[]' id='base' style='width: 280px;' value='". $row3['base_additions'] ."' readonly></td><td style='width: 31px; height: 35px;'><p>&nbsp;</p></td><td style='width: 139px; height: 35px;'><center><select name='type[]' id='x'  data-validation='required' data-validation-depends-on='base'><option value='' disabled selected>" . $row3['type'] . "</option><option value='logic'>Logic</option><option value='io'>Input/Output</option><option value='calculation'>Calculation</option><option value='text'>Text</option><option value='data'>Data</option><option value='setup'>Set-Up</option></select></center></td><td style='width: 31px; height: 35px;'><p><strong>&nbsp;</strong></p></td><td style='width: 139px; height: 35px;'><input type='text' name='methods[]' id='item' value='" . $row3['methods'] . "' readonly></td><td style='width: 31px; height: 35px;'><p><strong>&nbsp;</strong></p></td><td style='width: 171px; height: 35px;'><center><select name='size[]' id='y' data-validation='required' data-validation-depends-on='x'><option value='' disabled selected>" . $row3['relative_size'] . "</option><option value='verysmall'>Very Small</option><option value='small'>Small</option><option value='medium'>Medium</option><option value='large'>Large</option><option value='verylarge'>Very Large</option></select></center></td><td style='width: 10px; height: 35px;'><p><strong>&nbsp;</strong></p></td><td style='idth: 156px; height: 35px;'><input type='text' name='loc[]' class='toAdd' id='total'  value='" . $row3['loc'] . "' readonly></td></tr>";
                        }
                        ?>
                        
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
                        
                        <?php
                        while ($row4 = mysql_fetch_array($rs4)) {
                            echo "<tr style='height: 35px;'><td style='width: 284px; height: 35px;'><input type='text' name='BA[]' id='base' style='width: 280px;' value='". $row4['base_additions'] ."' readonly></td><td style='width: 31px; height: 35px;'><p>&nbsp;</p></td><td style='width: 139px; height: 35px;'><center><select name='type[]' id='x'  data-validation='required' data-validation-depends-on='base'><option value='' disabled selected>" . $row4['type'] . "</option><option value='logic'>Logic</option><option value='io'>Input/Output</option><option value='calculation'>Calculation</option><option value='text'>Text</option><option value='data'>Data</option><option value='setup'>Set-Up</option></select></center></td><td style='width: 31px; height: 35px;'><p><strong>&nbsp;</strong></p></td><td style='width: 139px; height: 35px;'><input type='text' name='methods[]' id='item' value='" . $row4['methods'] . "' readonly></td><td style='width: 31px; height: 35px;'><p><strong>&nbsp;</strong></p></td><td style='width: 171px; height: 35px;'><center><select name='size[]' id='y' data-validation='required' data-validation-depends-on='x'><option value='' disabled selected>" . $row4['relative_size'] . "</option><option value='verysmall'>Very Small</option><option value='small'>Small</option><option value='medium'>Medium</option><option value='large'>Large</option><option value='verylarge'>Very Large</option></select></center></td><td style='width: 10px; height: 35px;'><p><strong>&nbsp;</strong></p></td><td style='idth: 156px; height: 35px;'><input type='text' name='loc[]' class='toAdd2' id='total'  value='" . $row4['loc'] . "' readonly></td></tr>";
                        }
                        ?>
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
                                <input type="text" name="RO[]" style="width: 800px;" value="<?php echo $row6['base_additions'];?>" readonly>
                            </td>
                            <td style="width: 10px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 156px; height: 35px;">
                                <input type="text" name="loc3[]" class="toAdd3" value="<?php echo $row6['loc'];?>" readonly>
                            </td>
                        </tr>
                        <tr style="height: 35px;">
                            <td style="width: 862px; height: 35px;" colspan="7">
                                <input type="text" name="RO[]" style="width: 800px;">
                            </td>
                            <td style="width: 10px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 156px; height: 35px;">
                                <input type="text" name="loc3[]" class="toAdd3">
                            </td>
                        </tr>
                        <tr style="height: 35px;">
                            <td style="width: 862px; height: 35px;" colspan="7">
                                <input type="text" name="RO[]" style="width: 800px;">
                            </td>
                            <td style="width: 10px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 156px; height: 35px;">
                                <input type="text" name="loc3[]" class="toAdd3">
                            </td>
                        </tr>
                        <tr style="height: 35px;">
                            <td style="width: 862px; height: 35px;" colspan="7">
                                <input type="text" name="RO[]" style="width: 800px;">
                            </td>
                            <td style="width: 10px; height: 35px;">
                                <p><strong>&nbsp;</strong></p>
                            </td>
                            <td style="width: 156px; height: 35px;">
                                <input type="text" name="loc3[]" class="toAdd3">
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
                                <input type="text" name="b0" id="b0" value="<?php echo $row5['parameter_b0'];?>" readonly>
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
                                <input type="text" name="b1" id="b1"  value="<?php echo $row5['parameter_b1'];?>" readonly>
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
                <p><sup>&nbsp;</sup></p>
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