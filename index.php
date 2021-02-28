<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Drag and Drop</title>
<link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.7.2.custom.min.js"></script>
</head>
<style>
body{
	margin:30px;
}
.dragdrop{
	background-color: #DFF0D8;
    border-color: #D6E9C6;
    color: #468847;
	border-radius: 4px 4px 4px 4px;
    margin-bottom: 10px;
    padding: 8px 35px 8px 14px;
    text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
	width:200px;
}
</style>
<script type="text/javascript">

$(document).ready(function(){ 
						   
	$(function() {
		$(".unstyled").sortable({ opacity: 0.6, cursor: 'move', update: function() {
			var order = $(this).sortable("serialize") + '&action=updateRecordsListings'; 
			$.post("#updateDB", order, function(theResponse){}); 															 
		}								  
		});
	});

});	


</script>
<body>
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-49240280-1', 'url.ph');
	  ga('send', 'pageview');

	</script>
<?php
error_reporting(0);
$mysqli = new mysqli("localhost","root","","demo");

// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
$sql = "SELECT * FROM tbl_dragdrop ORDER BY position ASC";
?>
<div>
	<h3>Drag and Drop, Autosave Database</h3>
    <div id="updateDB" style="margin-bottom:30px;"><a name="updateDB"></a>
    <?php
    $action 				= $_POST['action']; 
    $updateRecordsArray 	= $_POST['recordsArray'];
    
    if($action == 'updateRecordsListings'){
        $listingCounter = 1;
        foreach ($updateRecordsArray as $recordIDValue) {		
            $update = "UPDATE tbl_dragdrop SET position = " . $listingCounter . " WHERE id = " . $recordIDValue;
            $mysqli->query($update);
            $listingCounter += 1;	
        }
    }
    ?>
        <ul class="unstyled">
            <?php
            $select = $mysqli->query($sql);
            while($row = $select->fetch_assoc()){
                echo '<li id="recordsArray_'.$row['id'].'"><div class="dragdrop"><strong>'.$row['title'].'</strong></div></li>';
            }
            
            ?>
        </ul>
    </div>
     <a class="btn btn-primary btn-large" href="../downloads.php?path=archive/&download=drag-drop.rar">
    	Download drag-drop.rar
    </a>
    <hr>
    <div>
    	<p>A drag and drop UI used JQUERY UI, PHP, and MySQL Database. This simple program autosave the position of the item once you drag it in a certain position. This is not my own code I just made some sort of modification need in my project. This drag and drop works in <em><strong>IE</strong></em>, <em><strong>Chrome</strong></em>, and <em><strong>Mozilla</strong></em> but the auto save function doesn't work in <em><strong>IE</strong></em>. For the database table it only needs three(3) important fields <em><strong>id</strong></em>, <em><strong>title</strong></em>, and <em><strong>position</strong></em>.</p>
        <p>The download does not include the sql database and database connection script just create your own database and database connection.</p>
    </div>
    <hr>
</div>
</body>
</html>
