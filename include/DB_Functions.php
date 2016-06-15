<?php 
	class DB_Functions{
		private $conn;

		function __construct(){
			require_once 'DB_Connect.php';

			$db = new DB_Connect();
			$this->conn = $db->connect();
		}

		function __destruct(){

		}


		//it creates new menu and retruns THE menu
		public function createNewDrinkItem($name, $price, $details, $sale, $time, $imagePath){


			$stmt = $this->conn->prepare("INSERT INTO drinkTable(Name, Price, Details, Time, created_at, Sale, serverImagePath) VALUES (?, ?, ?, ?, NOW(), ?, ?) ");
			$stmt->bind_param("sissss", $name, $price, $details, $time, $sale, $imagePath);
			$result = $stmt->execute();

			echo mysqli_error($this->conn);

			$stmt->close();
		}

		//it creates new menu and retruns THE menu
		public function createNewFoodItem($name, $price, $details, $sale, $time, $imagePath){


			$stmt = $this->conn->prepare("INSERT INTO foodTable(Name, Price, Details, Time, created_at, Sale, serverImagePath) VALUES (?, ?, ?, ?, NOW(), ?, ?) ");

			$stmt->bind_param("sissss", $name, $price, $details, $time, $sale, $imagePath);
			$result = $stmt->execute();

			echo mysqli_error($this->conn);



			$stmt->close();
		}

		//it edit menu
		/* LATER WE SHOULD UPDATE THIS FUNCTION TO EDIT THE MENU BY menu_id */
		public function editDrinkTable($id, $name, $price, $details, $sale, $time, $path){
			/*
			$stmt = $this->conn->prepare("SELECT * FROM menues WHERE menu_name = ?");
			$stmt->bind_param("s", $oldName);
			$result = $stmt->execute();
			*/

			$result = mysqli_query($this->conn, "SELECT * FROM drinkTable WHERE id = '$id'");


			//TO SHOW ERRORS
			echo mysqli_error($this->conn);
			//$stmt->close();

			
			if (mysqli_num_rows($result) > 0){
				$stmt = $this->conn->prepare("UPDATE drinkTable SET Name = ?, Price = ?, Details = ?, Time = ?, updated_at = NOW(), Sale = ?, serverImagePath = ? WHERE id = ?");
				$stmt->bind_param("sssssss", $name, $price, $details, $time, $sale, $path, $id);
				$stmt->execute();
				$stmt->close();

				return true;
			}
			else {
				return false;
			}
		}

		public function getDrinkItem($id){
			/*
			$stmt = $this->conn->prepare("SELECT * FROM menues WHERE menu_name = ?");
			$stmt->bind_param("s", $oldName);
			$result = $stmt->execute();
			*/

			$result = mysqli_query($this->conn, "SELECT * FROM drinkTable WHERE id = '$id'");

			$data = $result->fetch_assoc();
			return $data;
		}

		public function getFoodItem($id){
			/*
			$stmt = $this->conn->prepare("SELECT * FROM menues WHERE menu_name = ?");
			$stmt->bind_param("s", $oldName);
			$result = $stmt->execute();
			*/

			$result = mysqli_query($this->conn, "SELECT * FROM foodTable WHERE id = '$id'");

			$data = $result->fetch_assoc();
			return $data;
		}

		public function editFoodTable($id, $name, $price, $details, $sale, $time, $path){
			/*
			$stmt = $this->conn->prepare("SELECT * FROM menues WHERE menu_name = ?");
			$stmt->bind_param("s", $oldName);
			$result = $stmt->execute();
			*/

			$result = mysqli_query($this->conn, "SELECT * FROM foodTable WHERE id = '$id'");


			//TO SHOW ERRORS
			echo mysqli_error($this->conn);
			//$stmt->close();

			
			if (mysqli_num_rows($result) > 0){
				$stmt = $this->conn->prepare("UPDATE foodTable SET Name = ?, Price = ?, Details = ?, Time = ?, updated_at = NOW(), Sale = ?, serverImagePath = ? WHERE id = ?");
				$stmt->bind_param("sssssss", $name, $price, $details, $time, $sale, $path, $id);
				$stmt->execute();
				$stmt->close();

				return true;
			}
			else {
				return false;
			}
		}



		//WARINGING THIS FUNCTION TO BE UPDATED : 3shan lma yl3'y el menu msh h3rf en el database et3mlha update w al3'eh mn 3ndy 
		//it deletes menu
		/* LATER WE SHOULD UPDATE THIS FUNCTION TO DELETE THE MENU BY menu_id */
		public function delDrink($id){
			$stmt = $this->conn->prepare("DELETE FROM drinkTable WHERE id = ?");
			$stmt->bind_param("s", $id);
			$result = $stmt->execute();

			//TO SHOW ERRORS
			echo mysqli_error($this->conn);
			$stmt->close();


			if ($result){
				return true;
			}
			else {
				return false;
			}
		}

		public function delFood($id){
			$stmt = $this->conn->prepare("DELETE FROM foodTable WHERE id = ?");
			$stmt->bind_param("s", $id);
			$result = $stmt->execute();

			//TO SHOW ERRORS
			echo mysqli_error($this->conn);
			$stmt->close();


			if ($result){
				return true;
			}
			else {
				return false;
			}
		}
		
		//it gathers all the items from drink table and returns them all
		public function showDrinkTable(){

			$result = mysqli_query($this->conn, "SELECT * FROM drinktable");

			//echo mysqli_error($this->conn);

			if ($result){
				return $result;
			}
			else {
				return false;
			}
		}

		//it gathers all the items from food table and returns them all
		public function showFoodTable(){

			$result = mysqli_query($this->conn, "SELECT * FROM foodTable");

			//echo mysqli_error($this->conn);

			if ($result){
				return $result;
			}
			else {
				return false;
			}
		}

		//To get last update the database has 
		public function last_update($timeValue){
			$result = mysqli_query($this->conn, "SELECT * FROM menues WHERE updated_at > '$timeValue'");

			//If result returns more than 0 this means that there are some columns has been updated
			if (mysqli_num_rows($result) > 0){
				return $result;
			}
			else{
				return false;
			}

		}

	}
 ?>