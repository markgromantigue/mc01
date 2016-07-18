<?php
    //@Author: Mark Genesis T. Romantigue
    //email:markg.romantigue@gmail.com
    //version 1.0
    
    include 'db.php';
    
    if(isset($_GET['user_id'])){
		$userId = $_GET['user_id'];
        $projectId = $_GET['project_id'];
    }

    //get inputs by post
    $baseSize =($_POST["baseSize"] );
    $locDeleted =($_POST["locDeleted"] );
    $locModified =($_POST["locModified"] );
    $BA = ($_POST["BA"] );
    $type = ($_POST["type"] );
    $methods = ($_POST["methods"] );
    $size = ($_POST["size"] );
    $loc = ($_POST["loc"] );
    $NO = ($_POST["NO"] );
    $type2 = ($_POST["type2"] );
    $methods2 = ($_POST["methods2"] );
    $size2 = ($_POST["size2"] );
    $loc2 = ($_POST["loc2"] );
    $RO = ($_POST["RO"] );
    $loc3 = ($_POST["loc3"] );
    $P = ($_POST["P"] );
    $b0 = ($_POST["b0"] );
    $b1 = ($_POST["b1"] );
    $N = ($_POST["N"] );
    $T = ($_POST["T"] );
    
    //To protect from XSS attacks and Mysql Injection
    $baseSize = mysql_real_escape_string($baseSize);
    $locDeleted = mysql_real_escape_string($locDeleted);
    $locModified = mysql_real_escape_string($locModified);
    
    $insertBaseQuery = "INSERT INTO `base_program`(`user_id`, `project_id`, `base_size`, `loc_deleted`, `loc_modified`) VALUES ('" . $userId . "','" . $projectId . "','" . $baseSize . "','" . $locDeleted . "','" . $locModified . "')";
    $result = mysql_query($insertBaseQuery);
    
    foreach ($BA as $index => $value) {
        if (!empty($BA[$index])) {
            $query = mysql_query("INSERT INTO `projected_loc`(`user_id`, `project_id`, `base_additions`, `type`, `methods`, `relative_size`, `loc`) VALUES('" . $userId . "','" . $projectId . "','" . $BA[$index] . "','" . $type[$index] . "','" . $methods[$index] . "','" . $size[$index] . "','" . $loc[$index] . "')");
        }
    }
    
    foreach ($NO as $index => $value) {
        if (!empty($NO[$index])) {
            $query = mysql_query("INSERT INTO `new_objects`(`user_id`, `project_id`, `base_additions`, `type`, `methods`, `relative_size`, `loc`) VALUES('" . $userId . "','" . $projectId . "','" . $NO[$index] . "','" . $type2[$index] . "','" . $methods2[$index] . "','" . $size2[$index] . "','" . $loc2[$index] . "')");
        }
    }
    
    foreach ($RO as $index => $value) {
        if (!empty($RO[$index])) {
            $query = mysql_query("INSERT INTO `reused_objects`(`user_id`, `project_id`, `base_additions`, `loc`) VALUES('" . $userId . "','" . $projectId . "','" . $RO[$index] . "','" . $loc3[$index] . "')");
        }
    }
    
    $insertEstimates = "INSERT INTO `size_estimates`(`user_id`, `project_id`, `projected_loc`, `parameter_b0`, `parameter_b1`, `estimated_new`, `estimated_total`) VALUES ('" . $userId . "','" . $projectId . "','" . $P . "','" . $b0 . "','" . $b1 . "','" . $N . "','" . $T . "')";
    $result2 = mysql_query($insertEstimates);
    
    $query = mysql_query("UPDATE `project` SET `ST`= 1 WHERE `project_id` = '".$projectId."' AND `user_id` = '".$userId."'");
    
    if ($query) {
    echo "success!";
  } else {
    echo "failed!";
  }

    mysql_close();
    header("Location: view_project.php?user_id=$userId&project_id=$projectId");

?>