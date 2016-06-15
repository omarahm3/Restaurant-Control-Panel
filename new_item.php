<?php 
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();

	

	if ( isset($_POST['name']) ){
		$name = $_POST['name'];
		
		$menu = $db->createNewMenu($name);

		if ($menu != false){
			$response["error"] = FALSE;
			$response["muid"] = $menu["menu_id"];
			$response["mname"] = $menu["menu_name"];

			echo json_encode($response);
		}
		else{
			$response["error"] = TRUE;
			$response["error_msg"] = "Menu can not be created #MCE"; //Menu Creation Error

			echo json_encode($response);
		}
	}
	else{
		$response["error"] = FALSE;
		$response["error_msg"] = "Required fields are missing #RFME"; //Required fieldes are Missing Error

		echo json_encode($response);
	}

?>