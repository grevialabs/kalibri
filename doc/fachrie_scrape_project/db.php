<?php 
function connect(){
	
	$env = env();
	$dbhost = $env['DB_HOST'];
	$dbuser = $env['DB_USER'];
	$dbpass = $env['DB_PASS'];
	$dbname = $env['DB_NAME'];

	$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

	// Check connection
	if (!$con) {
		die("Connection failed: " . mysqli_connect_error());
	} else {
		// debug($dbhost);
		// die('mantap jalanbro');
	}
	
	return $con;
};

function orm_get($sql)
{
	// $sql = "SELECT id, firstname, lastname FROM MyGuests";
	if (! isset($sql)) die('query get not set');
	
	$conn = connect();
	$result = mysqli_query($conn, $sql);

	$returndata = array();
	if (mysqli_num_rows($result) > 0) 
	{
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			// echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
			$returndata = $row;
		}
	} else {
		$returndata = NULL;
	}
	
	// $response = NULL;
	return $returndata;
}

function orm_get_list($sql)
{
	// $sql = "SELECT id, firstname, lastname FROM MyGuests";
	if (! isset($sql)) die('query get not set');
	
	$conn = connect();
	$result = mysqli_query($conn, $sql);

	$returndata = $response = array();
	if (mysqli_num_rows($result) > 0) 
	{
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			$returndata[] = $row;
		}
	} else {
		$returndata[] = NULL;
	}
	
	$response['data'] = $returndata;
	$response['totaldata'] = count($returndata);
	return $response;
}


function orm_save($table, $data)
{
	$list_field = $list_value = '';
	
	if (! isset($table)) die('table save not set');
	if (empty($table)) die('data table save not set');
		
	$query = 'INSERT INTO '.$table;
	$i = 1;
	foreach($data as $key => $val)
	{
		$list_field.= $key;
		$list_value.= replace_quote($val);
		if ($i != count($data)) {
			$list_field.= ' ,';
			$list_value.= ' ,';
		}
		$i++;
	}
	$query.= '('.$list_field.') VALUES('.$list_value.')';
	$conn = connect();
	$save = mysqli_query($conn, $query);
	
	if ($save) return TRUE; else return FALSE;
}

function orm_update($table, $primary_key, $id, $data)
{
	if (! isset($table)) die('table update not set');
	if (! isset($primary_key)) die('primary key table update not set');
	if (! isset($id)) die('id table update not set');
	if (empty($table)) die('data table update not set');
	
	$query = 'UPDATE ' . $table . ' SET';
	$i = 1;
	foreach($data as $key => $val)
	{
		$query.= ' '.$key .' = ' . replace_quote($val);
		if ($i != count($data)) $query.= ' ,';
		$i++;
	}
	$query.= ' WHERE ' . $primary_key . ' = '. replace_quote($id,'num');
	$conn = connect();
	$update = mysqli_query($conn, $query);
	if ($update) return TRUE; else return FALSE;
}

function orm_delete($table,$primary_key, $id)
{
	if (! isset($table)) die('table delete not set');
	if (! isset($primary_key)) die('primary key table delete not set');
	if (! isset($id)) die('id table delete not set');
	
	$query = 'DELETE FROM ' . $table . ' WHERE ' . $primary_key . ' = ' . replace_quote($id,'num');
	$conn = connect();
	$delete = mysqli_query($conn, $query);
	if ($delete) return TRUE; else return FALSE;
}


?>