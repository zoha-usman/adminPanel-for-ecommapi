<?php
@include_once '../connect/db.php';
if (!empty($_REQUEST['action'])) {
	if (!empty($_REQUEST['action']) and $_REQUEST['action'] == "login") {
		@$user_email = validate_data($dbc, $_REQUEST['student_email']);
		@$user_password = $_REQUEST['student_password'];
		$user_role = (empty($_REQUEST['role'])) ? "student" : $_REQUEST['role'];
		$userdata = fetchRecord($dbc, "student", "student_email", $user_email);
		$q = mysqli_query($dbc, "SELECT * FROM student WHERE student_email='$user_email' AND student_password='$user_password'");
		$count = mysqli_num_rows($q);
		$data = mysqli_fetch_assoc($q);
		if ($count == 1) {
			$_SESSION['user_login'] = $user_email;
			$response = [
				"msg" => "Logging...",
				"status" => true,
				"action" => $_REQUEST['action'],
				"data" => $data,
			];
		} else {
			$response = [
				"msg" => "Invalid Email or Password",
				"status" => false,
				"action" => $_REQUEST['action']
			];
		}
	} elseif (!empty($_REQUEST['action']) and $_REQUEST['action'] == "view_lectures" and !empty($_REQUEST['student_class'])) {
		@$q = mysqli_query($dbc, "SELECT * FROM upload_lectures WHERE class_id='$_REQUEST[student_class]'");
		while ($r = mysqli_fetch_assoc($q)) :
			$fetchTeacher = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM teacher WHERE teacher_id='$r[teacher_id]'"));
			$data[] = $r;
		endwhile;
		$response = [
			"msg" => "View Lectures",
			"status" => true,
			"action" => $_REQUEST['action'],
			"data" => $data,
		];
	} elseif (!empty($_REQUEST['action']) and $_REQUEST['action'] == "view_attendance" and !empty($_REQUEST['student_id'])) {
		@$q = mysqli_query($dbc, "SELECT * FROM student_attendance WHERE student_id='$fetchUser[student_id]'");
		while ($r = mysqli_fetch_assoc($q)) :
			$fetchTeacher = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM teacher WHERE teacher_id='$r[teacher_id]'"));
			$data[] = $r;
		endwhile;
		$response = [
			"msg" => "View Lectures",
			"status" => true,
			"action" => $_REQUEST['action'],
			"data" => $data,
		];
	}
}
if (empty($response)) {
	$response = [
		"msg" => "invalid api call. Undefined Action",
		'sts' => "danger",
		"action" => ''
	];
}
echo json_encode($response);
