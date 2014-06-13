<?php

class Database{
	
	private $link;
	private $res;
	private $host = "localhost";
	private $user = "felipe";
	private $pass = "fe2206";
	private $db = "mysql";

	// sets user, pass and host and connects
	public function setup($u, $p, $h, $db){
		$this->user = $u; 
		$this->pass = $p; 
		$this->host = $h; 
		$this->db = $db;
		if (isset($this->link)){
			$this->disconnect();
		}
	 	$this->connect();
	}

	// Changes the database in which all queries will be performed
	public function setDb($db){
		$this->db = $db;
	}

	// destructor disconnects
	public function __destruct(){
		$this->disconnect();
	}

	//Closes the connection to the DB 
	public function disconnect (){
		if(isset($this->link)){
			mysqli_close($this->link);
		}
		unset($this->link);
	}

	// connects to the DB or disconnects/reconnects if a connection already existed
	public function connect(){
		if(!isset($this->link)){
			$this->link = mysqli_connect($this->host, $this->user,$this->pass,$this->db) or die("Failed to connect to MySQL: ".mysqli_error($this->link));
		}
		else{
			$this->disconnect();
			$this->connect();
		}
	}

	// send sql query
	//This function returns the query handle for SELECT queries, TRUE/FALSE for other queries, or FALSE on failure.
	public function send_sql($sql){
		if(!isset($this->link)){
			$this->connect();
		}
		try{
			if(!$succ = mysqli_select_db($this->link,$this->db) ){
				throw new Exception("Could not select the database ".$this->db);
			}
			if( !$this->res=mysqli_query($this->link,$sql) ){
				throw new Exception("Could not send query");
			}
		}
		catch(Exception $e){
			echo $e->getMessage()."<br/>";
			echo mysqli_error($this->link);
			exit;
		}

		return $this->res;
	}

	// Shows the contents of the $res as a table 
	public function printout () {
		if (isset ($this->res) &&  ( $this->res->num_rows > 0) )
		{
			mysqli_data_seek($this->res, 0);
			$num=mysqli_field_count($this->link);
			echo "<table border=l>";
			echo "<tr>";
			for ($i=0;$i<$num;$i++) {
				echo "<th>";
				$aux = mysqli_fetch_field_direct($this->res, $i); 
				echo $aux->name;
				echo "</th>";
			}
			echo "</tr>";
			while ($row = mysqli_fetch_row($this->res)) {
				echo "<tr>";
				foreach ($row as $elem) {
					echo "<td>$elem</td>";
				}
				echo "</tr>";
			}
		echo "</table>";
		}
		else
			echo "There is nothing to print!<br/>";
	} // printout() end

	// return an array with the next row from the last result
	public function next_row($res){
		if($res == NULL){
			if(isset($this->res)){
				return mysqli_fetch_row($this->res);
			}
			else{
				echo "You need to make a query first";
				return false;
			}
		}
		else{
			return mysqli_fetch_row($res);
		}
		
	}

	// returns the lest AUTO_INCREMENET data created
	public function inserted_id(){
		if(isset($this->link)){
			$id = mysqli_insert_id($this->link);
			if($id == 0){
				echo "You did not insert an element that cause an auto-increment ID to be created"."<br/>";
			}
			return $id;
		}
		echo "You are not connected to the database";
		return false;
	}

	// Creates a new DB and selects it
	public function new_db($name){
		if(!isset($this->link)){
			$this->connect();
		}
		$query = "CREATE DATABASE IF NOT EXISTS".$name;
		try{
			if(mysqli_query($this->link,$query)){
				throw new Exception("Cannot create database ".$name);
			}
			$this->db = $name;
		}
		catch(Exception $e){
			echo $e->getMessage()."<br/>";
			echo mysql_error();
			exit;
		}

	}

	// returns the number of rows found
	// specifie a result or return the number of rows returned by the last query.
	public function num_rows_result(mysqli_result $res){
		return $res->num_rows;
	}

	public function num_field_result(mysqli_result $res){
		return $res->field_count;
	}

	public function is_result_empty(mysqli_result $res){
		if( $res->num_rows <= 0 ) 
			return TRUE;
		else 
			return FALSE;
	}

} // class end

?>

<?php
	/*
	include ("DbConnect.php");
	$db = new Database();
	//$db->setup("dbuser", "dbpass", "dbhost", "dbname"); //optional, you can alter the default values on the script, but if not using this dont forget to set de db
	$db->setDb("mysql");
	$query = "SELECT * FROM user";
	$res = $db->send_sql($query);
	echo "Found ".mysql_num_rows($res)." rows<BR>"; // or num_rows_result
	$row = $db->next_row();
	echo $row[0]."<BR>";
	$row = $db->next_row();
	echo $row [1]."<BR>";
	$db->printout();
	$db->inserted_id();
	$db->new_db("testing");
	$db->disconnect();
	$db->inserted_id();


	*/

?>