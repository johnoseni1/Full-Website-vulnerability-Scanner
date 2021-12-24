<?php

?>
<script type="text/javascript">
function beginCrawl(value, valueTwo){
	jQuery.post("crawler/begin_crawl.php", {specifiedUrl:value,testId:valueTwo});
}

</script>
<?php 
$currentDir = './';
require_once($currentDir . 'scanner/functions/databaseFunctions.php');
require_once($currentDir . 'scanner/classes/Logger.php');
		
if(isset($_SESSION['username']))
{
	$username = $_SESSION['username'];

	echo '<body>
			<form id="form1" name="form1" method="post" >
			  <p>Enter URL to crawl:</p>
			  <p>
				<label for="urlToCrawl"></label>
				<input type="text" size="40" name="urlToCrawl" id="urlToCrawl" />
			  </p>
			  <p>
				<input type="submit" class="button" name="submit" id="submit" value="Start Crawl" />
			  </p>
			</form>';

if(isset($_POST['urlToCrawl']))
{
	$urlToCrawl = trim($_POST['urlToCrawl']);
	if(!empty($urlToCrawl))
	{
		$log = new Logger();
		$log->lfile('crawler/logs/eventlogs');

		$log->lwrite('Connecting to database');

		$connectionFlag = connectToDb($db);

		if(!$connectionFlag)
		{
			$log->lwrite('Error connecting to database');
			echo 'Error connecting to database';
			return;
		}

		$log->lwrite('Generating next test ID');
		$nextId = generateNextTestId($db);

		if(!$nextId)
		{
			$log->lwrite('Next ID generated is null');
			echo 'Next ID generated is null';
			return;
		}
		else
		{
			$log->lwrite("Next ID generated is $nextId");
			$testId = $nextId; 
			$now = time();
			$query = "INSERT into tests(id,status,numUrlsFound,type,num_requests_sent,start_timestamp,finish_timestamp,scan_finished,url,username,urls_found) VALUES($nextId,'Creating profile for new crawl...',0,'crawl',0,$now,$now,0,'$urlToCrawl','$username','')"; 
			$result = $db->query($query);
			if(!$result)
			{
				$log->lwrite("Problem executing query: $query ");
				echo 'Problem inserting a new test into the database. Please try again.';
				return;
			}
			else
			{
				$log->lwrite("Successfully executed query: $query ");
			}
		}

		updateStatus($db, 'Pending...', $testId);

		$query = "UPDATE tests SET numUrlsFound = 0 WHERE id = $testId;"; 
		$db->query($query); 
		$query = "UPDATE tests SET duration = 0 WHERE id = $testId;"; 
		$db->query($query); 
				
		echo '<script type="text/javascript">
		$(document).ready(function() {
		 $.post("crawler/getStatus.php", {testId:' . "$testId" . '}, function(data){$("#status").html(data)});
		var refreshId = setInterval(function() {
		  $.post("crawler/getStatus.php", {testId:' . "$testId" . '}, function(data){$("#status").html(data)});
		}, 500);
		$.ajaxSetup({ cache: false });
		});</script>';

		echo '<script type="text/javascript">
		$(document).ready(function() {
		 $.post("crawler/getUrlsFound.php", {testId:' . "$testId" . '}, function(data){$("#urlsFound").html(data)});
		var refreshId = setInterval(function() {
		  $.post("crawler/getUrlsFound.php", {testId:' . "$testId" . '}, function(data){$("#urlsFound").html(data)});
		}, 500);
		$.ajaxSetup({ cache: false });
		});</script>';
		
		$log->lwrite('Calling AJAX function beginCrawl()');
		echo '<script type="text/javascript">';
		echo "beginCrawl('$urlToCrawl','$testId');";
		echo '</script>';
		
	}
	else
		echo 'Error: There was no URL entered';
}

echo '<div id="status"></div><br>';
echo '<div id="urlsFound"></div><br>';
}
else
	echo 'You are not logged in. Please log in to use this feature.';
?>
