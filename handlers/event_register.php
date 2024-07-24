<?php

$event_name = $_POST["event_name"];
$event_description = $_POST["event_description"];
$start_date = $_POST["start_date"];
$end_date = $_POST["end_date"];
$event_location = $_POST["event_loaction"];

function print_name(...$form_data){
	foreach($form_data as $key => $value){
		echo $value."<br>";
   }
}

print_name($event_name,$event_description, $start_date, $end_date, $event_location);
?>
