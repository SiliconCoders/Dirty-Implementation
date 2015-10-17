<?php
session_start();
if (isset($_POST["name"]) && $_POST["name"] !=""){
	$username= $_POST["name"];
	$fp = fopen("log.html", 'a');
	fwrite($fp, "<div class='msgln'><i>User ".$username." has joined the chat session.</i><br></div>");
    	fclose($fp);
    	if($username != ""){
        	$_SESSION['name'] = stripslashes(htmlspecialchars($username));
		?>
		<html>
		<head>
			<title>MavChat</title>
			<link type="text/css" rel="stylesheet" href="style.css" />
			<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
			<script type="text/javascript">
				$(document).ready(function(){
					$("#submitmsg").click(function(){	
						var message = $("#usermsg").val();
						$.post("post.php", {text: message});				
						$("#usermsg").attr("value", "");
						return false;
					});
					function loadLog(){		
						var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20;
						$.ajax({
							url: "log.html",
							cache: false,
							success: function(html){		
								$("#chatbox").html(html);
								var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20;
								if(newscrollHeight > oldscrollHeight){
									$("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); 
								}				
		  					},
						});
					}
					setInterval (loadLog, 1000);
				});

			</script>
			<script type="text/javascript">
				$(document).ready(function(){
					$("#exit").click(function(){
						var exit = confirm("Are you sure you want to end the session?");
						if(exit==true){
							window.location = 'logout.php?logout=true';}		
					});
				});
			</script>
		</head>
		<body bgcolor="#F8F8FF">
			<p  align="center"><font size="6">MavChatRoom</font></p>
			<div id="wrapper" align="center">
    				<div id="menu">
        				<p  class="welcome"><font size="5">Welcome, <?php echo $_SESSION['name']; ?></font></p>
        				<p  class="logout" ><a id="exit" href="#"><font color="red">Exit Chat</font></a></p>
        				<div style="clear:both"></div>
    				</div> 
    			<div id="chatbox"></div>
     			<form name="message" action="">
        			<input name="usermsg" type="text" id="usermsg" size="63" />
        			<input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
    			</form>
			</div>

<?php
	} 
}
else{
        	echo '<span class="error">Please type in a name</span>';	
    }

?>
 