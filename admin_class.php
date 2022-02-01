<?php
session_start();
ini_set('display_errors', 1);
Class Action {
	private $db;

	public function __construct() {
		ob_start();
   	include 'db_connect.php';
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}

	function login(){
		extract($_POST);
			$qry = $this->db->query("SELECT *,concat(firstname,' ',lastname) as name FROM users where email = '".$email."' and password = '".md5($password)."'  ");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
				return 1;
		}else{
			return 2;
		}
	}
	function logout(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:login.php");
	}
	function login2(){
		extract($_POST);
			$qry = $this->db->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM students where student_code = '".$student_code."' ");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['rs_'.$key] = $value;
			}
				return 1;
		}else{
			return 3;
		}
	}
	function save_user(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','cpass','password')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if(!empty($password)){
					$data .= ", password=md5('$password') ";

		}
		$check = $this->db->query("SELECT * FROM users where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
			$data .= ", avatar = '$fname' ";

		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set $data");
		}else{
			$save = $this->db->query("UPDATE users set $data where id = $id");
		}

		if($save){
			return 1;
		}
	}
	function signup(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','cpass')) && !is_numeric($k)){
				if($k =='password'){
					if(empty($v))
						continue;
					$v = md5($v);

				}
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}

		$check = $this->db->query("SELECT * FROM users where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
			$data .= ", avatar = '$fname' ";

		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set $data");

		}else{
			$save = $this->db->query("UPDATE users set $data where id = $id");
		}

		if($save){
			if(empty($id))
				$id = $this->db->insert_id;
			foreach ($_POST as $key => $value) {
				if(!in_array($key, array('id','cpass','password')) && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
					$_SESSION['login_id'] = $id;
				if(isset($_FILES['img']) && !empty($_FILES['img']['tmp_name']))
					$_SESSION['login_avatar'] = $fname;
			return 1;
		}
	}

	function save_file(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','cpass','password')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if(!empty($password)){
					$data .= ", password=md5('$password') ";

		}
		$check = $this->db->query("SELECT * FROM filing where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
			$data .= ", f_data = '$fname' ";

		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO filing set $data");
		}else{
			$save = $this->db->query("UPDATE filing set $data where id = $id");
		}
		if($save){
			return 1;
		}
	}
	
	// start for agri file saving function


	function save_agri_file(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','cpass','password')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if(!empty($password)){
					$data .= ", password=md5('$password') ";

		}
		$check = $this->db->query("SELECT * FROM agriculture where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
			$data .= ", f_data = '$fname' ";

		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO agriculture set $data");
		}else{
			$save = $this->db->query("UPDATE agriculture set $data where id = $id");
		}
		if($save){
			return 1;
		}
	}
	// end for agri file saving function


	// start for biopharma file saving function

	function save_bioPharma_file(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','cpass','password')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if(!empty($password)){
					$data .= ", password=md5('$password') ";

		}
		$check = $this->db->query("SELECT * FROM pharma where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
			$data .= ", f_data = '$fname' ";

		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO pharma set $data");
		}else{
			$save = $this->db->query("UPDATE pharma set $data where id = $id");
		}
		if($save){
			return 1;
		}
	}
	// end for biopharma file saving function

// start for gaz file saving function

function save_gaz_file(){
	extract($_POST);
	$data = "";
	foreach($_POST as $k => $v){
		if(!in_array($k, array('id','cpass','password')) && !is_numeric($k)){
			if(empty($data)){
				$data .= " $k='$v' ";
			}else{
				$data .= ", $k='$v' ";
			}
		}
	}
	if(!empty($password)){
				$data .= ", password=md5('$password') ";

	}
	$check = $this->db->query("SELECT * FROM gaz where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
	if($check > 0){
		return 2;
		exit;
	}
	if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
		$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
		$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
		$data .= ", f_data = '$fname' ";

	}
	if(empty($id)){
		$save = $this->db->query("INSERT INTO gaz set $data");
	}else{
		$save = $this->db->query("UPDATE gaz set $data where id = $id");
	}
	if($save){
		return 1;
	}
}
// end for gaz file saving function


// start for ekuraz file saving function
function save_ekuraz_file(){
	extract($_POST);
	$data = "";
	foreach($_POST as $k => $v){
		if(!in_array($k, array('id','cpass','password')) && !is_numeric($k)){
			if(empty($data)){
				$data .= " $k='$v' ";
			}else{
				$data .= ", $k='$v' ";
			}
		}
	}
	if(!empty($password)){
				$data .= ", password=md5('$password') ";

	}
	$check = $this->db->query("SELECT * FROM ekuraz where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
	if($check > 0){
		return 2;
		exit;
	}
	if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
		$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
		$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
		$data .= ", f_data = '$fname' ";

	}
	if(empty($id)){
		$save = $this->db->query("INSERT INTO ekuraz set $data");
	}else{
		$save = $this->db->query("UPDATE ekuraz set $data where id = $id");
	}
	if($save){
		return 1;
	}
}
// end for ekuraz file saving function

// start for wallet file saving function
function save_wallet_file(){
	extract($_POST);
	$data = "";
	foreach($_POST as $k => $v){
		if(!in_array($k, array('id','cpass','password')) && !is_numeric($k)){
			if(empty($data)){
				$data .= " $k='$v' ";
			}else{
				$data .= ", $k='$v' ";
			}
		}
	}
	if(!empty($password)){
				$data .= ", password=md5('$password') ";

	}
	$check = $this->db->query("SELECT * FROM wallet where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
	if($check > 0){
		return 2;
		exit;
	}
	if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
		$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
		$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
		$data .= ", f_data = '$fname' ";

	}
	if(empty($id)){
		$save = $this->db->query("INSERT INTO wallet set $data");
	}else{
		$save = $this->db->query("UPDATE wallet set $data where id = $id");
	}
	if($save){
		return 1;
	}
}
// end for wallet file saving function

// start for kamaz file saving function
function save_kamaz_file(){
	extract($_POST);
	$data = "";
	foreach($_POST as $k => $v){
		if(!in_array($k, array('id','cpass','password')) && !is_numeric($k)){
			if(empty($data)){
				$data .= " $k='$v' ";
			}else{
				$data .= ", $k='$v' ";
			}
		}
	}
	if(!empty($password)){
				$data .= ", password=md5('$password') ";

	}
	$check = $this->db->query("SELECT * FROM kamaz where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
	if($check > 0){
		return 2;
		exit;
	}
	if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
		$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
		$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
		$data .= ", f_data = '$fname' ";

	}
	if(empty($id)){
		$save = $this->db->query("INSERT INTO kamaz set $data");
	}else{
		$save = $this->db->query("UPDATE kamaz set $data where id = $id");
	}
	if($save){
		return 1;
	}
}
// end for kamaz file saving function



	function update_user(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','cpass','table','password')) && !is_numeric($k)){
				
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		$check = $this->db->query("SELECT * FROM users where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
			$data .= ", avatar = '$fname' ";

		}
		if(!empty($password))
			$data .= " ,password=md5('$password') ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set $data");
		}else{
			$save = $this->db->query("UPDATE users set $data where id = $id");
		}

		if($save){
			foreach ($_POST as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
			if(isset($_FILES['img']) && !empty($_FILES['img']['tmp_name']))
					$_SESSION['login_avatar'] = $fname;
			return 1;
		}
	}
	function delete_user(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM users where id = ".$id);
		if($delete)
			return 1;
	}

	function delete_file(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM filing where id = ".$id);
		if($delete)
			return 1;
	}
     // delete wallet file
	function delete_w_file(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM wallet where id = ".$id);
		if($delete)
			return 1;
	}

 // delete agri file
	function delete_agri_file(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM agriculture where id = ".$id);
		if($delete)
			return 1;
	}

 // delete biopharma file
	function delete_pharma_file(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM pharma where id = ".$id);
		if($delete)
			return 1;
	}

 // delete gaz file
	function delete_gaz_file(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM gaz where id = ".$id);
		if($delete)
			return 1;
	}
 // delete ekuraz file
 function delete_ekuraz_file(){
	extract($_POST);
	$delete = $this->db->query("DELETE FROM ekuraz where id = ".$id);
	if($delete)
		return 1;
}

 // delete kamaz file
 function delete_kamaz_file(){
	extract($_POST);
	$delete = $this->db->query("DELETE FROM kamaz where id = ".$id);
	if($delete)
		return 1;
}
	function save_system_settings(){
		extract($_POST);
		$data = '';
		foreach($_POST as $k => $v){
			if(!is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if($_FILES['cover']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['cover']['name'];
			$move = move_uploaded_file($_FILES['cover']['tmp_name'],'../assets/uploads/'. $fname);
			$data .= ", cover_img = '$fname' ";

		}
		$chk = $this->db->query("SELECT * FROM system_settings");
		if($chk->num_rows > 0){
			$save = $this->db->query("UPDATE system_settings set $data where id =".$chk->fetch_array()['id']);
		}else{
			$save = $this->db->query("INSERT INTO system_settings set $data");
		}
		if($save){
			foreach($_POST as $k => $v){
				if(!is_numeric($k)){
					$_SESSION['system'][$k] = $v;
				}
			}
			if($_FILES['cover']['tmp_name'] != ''){
				$_SESSION['system']['cover_img'] = $fname;
			}
			return 1;
		}
	}
	function save_image(){
		extract($_FILES['file']);
		if(!empty($tmp_name)){
			$fname = strtotime(date("Y-m-d H:i"))."_".(str_replace(" ","-",$name));
			$move = move_uploaded_file($tmp_name,'assets/uploads/'. $fname);
			$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
			$hostName = $_SERVER['HTTP_HOST'];
			$path =explode('/',$_SERVER['PHP_SELF']);
			$currentPath = '/'.$path[1]; 
			if($move){
				return $protocol.'://'.$hostName.$currentPath.'/assets/uploads/'.$fname;
			}
		}
	}
	function save_project(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','user_ids')) && !is_numeric($k)){
				if($k == 'description')
					$v = htmlentities(str_replace("'","&#x2019;",$v));
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if(isset($user_ids)){
			$data .= ", user_ids='".implode(',',$user_ids)."' ";
		}
		// echo $data;exit;
		if(empty($id)){
			$save = $this->db->query("INSERT INTO project_list set $data");
		}else{
			$save = $this->db->query("UPDATE project_list set $data where id = $id");
		}
		if($save){
			return 1;
		}
	}
	function delete_project(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM project_list where id = $id");
		if($delete){
			return 1;
		}
	}
	function save_task(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id')) && !is_numeric($k)){
				if($k == 'description')
					$v = htmlentities(str_replace("'","&#x2019;",$v));
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO task_list set $data");
		}else{
			$save = $this->db->query("UPDATE task_list set $data where id = $id");
		}
		if($save){
			return 1;
		}
	}
	function delete_task(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM task_list where id = $id");
		if($delete){
			return 1;
		}
	}
	function save_progress(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id')) && !is_numeric($k)){
				if($k == 'comment')
					$v = htmlentities(str_replace("'","&#x2019;",$v));
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		$dur = abs(strtotime("2020-01-01 ".$end_time)) - abs(strtotime("2020-01-01 ".$start_time));
		$dur = $dur / (60 * 60);
		$data .= ", time_rendered='$dur' ";
		// echo "INSERT INTO user_productivity set $data"; exit;
		if(empty($id)){
			$data .= ", user_id={$_SESSION['login_id']} ";
			
			$save = $this->db->query("INSERT INTO user_productivity set $data");
		}else{
			$save = $this->db->query("UPDATE user_productivity set $data where id = $id");
		}
		if($save){
			return 1;
		}
	}
	function delete_progress(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM user_productivity where id = $id");
		if($delete){
			return 1;
		}
	}
	function get_report(){
		extract($_POST);
		$data = array();
		$get = $this->db->query("SELECT t.*,p.name as ticket_for FROM ticket_list t inner join pricing p on p.id = t.pricing_id where date(t.date_created) between '$date_from' and '$date_to' order by unix_timestamp(t.date_created) desc ");
		while($row= $get->fetch_assoc()){
			$row['date_created'] = date("M d, Y",strtotime($row['date_created']));
			$row['name'] = ucwords($row['name']);
			$row['adult_price'] = number_format($row['adult_price'],2);
			$row['child_price'] = number_format($row['child_price'],2);
			$row['amount'] = number_format($row['amount'],2);
			$data[]=$row;
		}
		return json_encode($data);

	}
}