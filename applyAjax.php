<?php  
session_start();

$action = $_GET['action'];
//echo $action;

$formToDBMapping = array(
	'content_path' 					=> 'content_path',
	'content_description' 			=> 'content_description',
	'content_id' 					=> 'id_content',
	'topic_id' 						=> 'id_topic',
	'category_id' 					=> 'id_category',
	'category'						=> 'category',
	'topic'							=> 'topic',
	'content'						=> 'content'
);

if(isset($action)) {
	require('./functions.php');

	$dbh = PDOConnect();

	switch($action) {

		case 'submit-category'://add or modify
			$appID = $_POST['id'];
			
			if($appID == '')
				PDOQuery("INSERT INTO idev_category (category) VALUES (?) ", $dbh, array($_POST['category']));
			else
				PDOQuery("UPDATE idev_category SET category = ? WHERE id_category = ? ", $dbh, array($_POST['category'], $appID));
			
			$data = PDOQueryToJson("SELECT * FROM idev_category ", $dbh, $formToDBMapping);
			echo $data;

			break;

		case 'get-category':
		
				$data = PDOQueryToJson("SELECT * FROM idev_category ", $dbh, $formToDBMapping);
				echo $data;
					
				break;

		case 'del-category':
				$appID = $_POST['id'];
				PDOQuery("DELETE FROM idev_category WHERE id_category = ? ", $dbh, array($appID));
				$data = PDOQueryToJson("SELECT * FROM idev_category ", $dbh, $formToDBMapping);
				echo $data;
					
				break;
			
						
		default:
		break;
	}
}
?>