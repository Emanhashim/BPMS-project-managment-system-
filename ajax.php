<?php
ob_start();
date_default_timezone_set("Asia/Manila");

$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();
if($action == 'login'){
	$login = $crud->login();
	if($login)
		echo $login;
}
if($action == 'login2'){
	$login = $crud->login2();
	if($login)
		echo $login;
}
if($action == 'logout'){
	$logout = $crud->logout();
	if($logout)
		echo $logout;
}
if($action == 'logout2'){
	$logout = $crud->logout2();
	if($logout)
		echo $logout;
}

if($action == 'signup'){
	$save = $crud->signup();
	if($save)
		echo $save;
}

if($action == 'save_user'){
	$save = $crud->save_user();
	if($save)
		echo $save;
}

// start  for file add and delete
if($action == 'save_file'){
	$save = $crud->save_file();
	if($save)
		echo $save;
}
if($action == 'delete_file'){
	$save = $crud->delete_file();
	if($save)
		echo $save;
}
// end for file add and delete

// start for agri file saving

if($action == 'save_agri_file'){
	$save = $crud->save_agri_file();
	if($save)
		echo $save;
}
if($action == 'delete_agri_file'){
	$save = $crud->delete_agri_file();
	if($save)
		echo $save;
}
// ending agri file saving 

// start for biopharma file saving

if($action == 'save_bioPharma_file'){
	$save = $crud->save_bioPharma_file();
	if($save)
		echo $save;
}
if($action == 'delete_pharma_file'){
	$save = $crud->delete_pharma_file();
	if($save)
		echo $save;
}
// ending biopharma file saving 

// start for gaz file saving

if($action == 'save_gaz_file'){
	$save = $crud->save_gaz_file();
	if($save)
		echo $save;
}
if($action == 'delete_gaz_file'){
	$save = $crud->delete_gaz_file();
	if($save)
		echo $save;
}

// ending gaz file saving 

// start for ekuraz file saving
if($action == 'save_ekuraz_file'){
	$save = $crud->save_ekuraz_file();
	if($save)
		echo $save;
}

if($action == 'delete_ekuraz_file'){
	$save = $crud->delete_ekuraz_file();
	if($save)
		echo $save;
}
// ending ekuraz file saving

// start for kamaz file saving

if($action == 'save_kamaz_file'){
	$save = $crud->save_kamaz_file();
	if($save)
		echo $save;
}
if($action == 'delete_pharma_file'){
	$save = $crud->delete_pharma_file();
	if($save)
		echo $save;
}
// ending kamaz file saving 


// start for wallet file saving
if($action == 'save_wallet_file'){
	$save = $crud->save_wallet_file();
	if($save)
		echo $save;
}
if($action == 'delete_w_file'){
	$save = $crud->delete_w_file();
	if($save)
		echo $save;
}
// ending wallet file saving 


if($action == 'update_user'){
	$save = $crud->update_user();
	if($save)
		echo $save;
}
if($action == 'delete_user'){
	$save = $crud->delete_user();
	if($save)
		echo $save;
}


if($action == 'save_project'){
	$save = $crud->save_project();
	if($save)
		echo $save;
}
if($action == 'delete_project'){
	$save = $crud->delete_project();
	if($save)
		echo $save;
}
if($action == 'save_task'){
	$save = $crud->save_task();
	if($save)
		echo $save;
}
if($action == 'delete_task'){
	$save = $crud->delete_task();
	if($save)
		echo $save;
}
if($action == 'save_progress'){
	$save = $crud->save_progress();
	if($save)
		echo $save;
}
if($action == 'delete_progress'){
	$save = $crud->delete_progress();
	if($save)
		echo $save;
}

if($action == 'get_report'){
	$get = $crud->get_report();
	if($get)
		echo $get;
}
ob_end_flush();
?>
