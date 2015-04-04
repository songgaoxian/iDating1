<?php
	require('inbox.php');
	class Message{
		private $content;
		private $total;
		private $uid;
		private $with_id;
		public function get_total(){return($this->total);}
		public function __construct($uid,$with_id){
			$msg=uuid();
			$content=array();
			$conn=connect();
			$sql='SELECT dat,content,photo,username FROM mess WHERE (from_id="'.$uid.'" AND to_id="'.$with_id.'") OR (to_id="'.$uid.'" AND from_id="'.$with_id.'") ORDER BY dat DESC;';
			if(!$conn){header('Location: index.php');}
			$result=mysqli_query($conn,$sql);
			$content=array();
			$i=0;
			if(mysqli_num_rows($result)!=0){
				while($row=mysqli_fetch_row($result)){
					$this->content[$i]=$row;
					$i+=1;
				}
			}
			$this->uid=$uid;
			$this->with_id=$with_id;
			$this->total=$i;
		}
		public function get_email(){
			$conn=connect();
			$with=new User();
			$with->set_user($this->with_id);
			$result=$with->show_info();
			if($result==NULL){return(NULL);}
			return($result['email']);
		}
		public function get_content(){return($this->content);}
		public function set($info){$this->content=$info;}
		public function send($content){
			$conn=connect();
			if($conn){
				$user=new User();
				$user->set_user($this->uid);
				$data=$user->show_info();
				$sql='INSERT INTO mess(from_id,to_id,mess_id,content,photo,username) VALUES("'.$this->uid.'","'.$this->with_id.'","'.uuid().'","'.$content.'","'.$data['photo'].'","'.$data['username'].'");';
				$result=mysqli_query($conn,$sql);
				//echo $sql;
				return($result);
				$this->content[$this->total]=$content;
				$this->total+=1;
			}
			return(false);
		}
	}
	class MessageView{
				public function draw_one($content,$photo,$username){
			return '<li>
			<table style="width:100%">
				<tr>
					<td style="width:10%">
						<div class="pic">
        					<div style="height:80px; background-image:url(\'portrait\/'.$content[2].'\')" class="background-cover-center">
						</div>
					</td>
					<td style="width:90%">
						<div class="title">
    						<div id="sender" class="colored-txt">
      							<span class="time">'.$content[0].'</span>
      							<span class="from">'.$content[3].'</span>
    						</div>
                    		<p>
                        		"'.$content[1].'"
                    		</p>
						</div>
  					</td>
				</tr>
			</table>
			</li>';
		}
		public function draw_one_m($content){
			return '<div class="message-box">
				<table style="width:100%">
				<tr>
					<td style="width:20%">
						<img src="portrait/'.$content[2].'" alt="portrait">
					</td>
					<td style="width:80%">
						<p id="message-from" class="colored-txt">'.$content[3].'</p>
						<p class="message-time">'.$content[0].'</p>
						<p class="message-content">"'.$content[1].'"</p>
					</td>
				</tr>
				</table>
			</div>';
		}
		public function draw_m($content){
			echo'
<title>iDating - Messages</title>
</head>

<body>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
$(document).ready(function() {
	$(".sidebar").hide();
	
	$(".moment-sml").click(function() {
		$(".moment-sml").children("p").hide();
		$(this).children("p").fadeIn();
	});
	
	$("#nav").click(function() {
		$(".sidebar").fadeToggle();
	});
});
</script>

</head>

<body>
<!--header-start-->
<div class="header">
<div id="topnav">
<img id="upload" src="img/add.png" alt="upload moments">
</div>
<img id="nav" src="img/nav.png" alt="navigate">
<h1>Massages</h1>
</div>
<!--header-end-->
<div class="sidebar">
<a href="accountmgt-m.php">My Page</a>
<a href="search-m.php">Search</a>
<a href="shake.php">Shake</a>
<a href="calendar-m.php">Calendar</a>
<a href="moments-m.php">Moments</a>
<a href="messages-m.php">Messages</a>
</div>
<!--header-end-->

<!--content-start-->
<div class="container">
<!--search-condition-start-->


<div id="messages">';
		foreach($content as $key=>$value){
			echo $this->draw_one_m($value);
		}
		echo'
            <textarea  class="txtbox txtbox-fill" placeholder="Add new message..." id="text" rows="4"></textarea>
            <div class="btn-group">
            	<input id="mail-btn1" type="button" class="btn btn-mobile" value="Send new message" onClick="send()">
				<input id="mail-btn2" type="button" class="btn btn-mobile" value="Return to inbox" onClick=\'window.location.replace("messages-m.php")\'>
            </div>
		</ul>
		</div>
	</div>
</form>
  
    
</div>';
		}
		public function draw_new(){
			echo'
<title>iDating - Messages</title>
</head>

<body>
<!--header-start-->
<div class="header">
<ul id="topnav">
  <li><a href="logout.php">Log Out</a>
  <li><a href="messages.php">Messages</a>
  <li><a href="moments.php">Moments</a>
  <li><a href="calendar.html">Calendar</a>
  <li><a href="search.php">Search</a>
  <li><a href="accountmgt.php">My Page</a>
</ul>
<img src="img/logo_small.png" alt="iDating logo">
</div>
<!--header-end-->

<!--content-start-->
<div class="container">
<!--search-condition-start-->

<h1 class="colored-txt">My Message Inbox</h1>

	<div class="mail-list">
		<ul>';
		echo'<span class="colored-txt">Message receiver: </span><input type="text" id="email", placeholder="Email address">
			<br></br>
            <textarea class="txtbox txtbox-fill" placeholder="Add new message..." id="text" rows="5"></textarea>
            <span class="button-group">
            	<input name="mc_markread" type="button" class="btn btn-lg" value="Send new message" onClick="send()">
            </span>
		</ul>
		<div class="mail-list-ft"> </div>
	</div>
</div>';
		}
		public function draw($content,$photo,$username,$email){
			echo'
</head>

<body>
<!--header-start-->
<div class="header">
<ul id="topnav">
  <li><a href="logout.php">Log Out</a>
  <li><a href="messages.php">Messages</a>
  <li><a href="moments.php">Moments</a>
  <li><a href="calendar.php">Calendar</a>
  <li><a href="search.php">Search</a>
  <li><a href="accountmgt.php">My Page</a>
</ul>
<img src="img/logo_small.png" alt="iDating logo">
</div>
<!--header-end-->

<!--content-start-->
<div class="container">
<!--search-condition-start-->

<h1 class="colored-txt">My Message Inbox</h1>

	<div class="mail-list">
		<ul>';
		foreach($content as $key=>$value){
			echo $this->draw_one($value,$photo,$username);
		}
		echo'<p>Email: ';echo $email.'</p>
            <textarea  class="txtbox txtbox-fill" placeholder="Add new message..." id="text" rows="5"></textarea>
            <span class="button-group">
            <input name="mc_markread" type="button" class="btn btn-lg" onClick="send()" value="Send new message">
            </span>
		</ul>
		</div>
	</div>
</div>';
		}
	}
	class MessageViewController{
		public function show(){
			session_start();
			$session=new Session();
			$uid=$session->get_uid();
			if($uid==NULL){header('Location: index.php');}
			if($_SERVER["REQUEST_METHOD"]=="GET" && isset($_GET['with'])){
				$mess=new Message($uid,$_GET['with']);
				$view=new MessageView();
				$user=new User();
				$user->set_user($_GET['with']);
				$user1=new User();
				$user1->set_user($uid);
				$result1=$user1->show_info();
				$result=$user->show_info();
				echo '<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/CSS" href="shared-frame.css">
<link rel="stylesheet" type="text/CSS" href="'.$result1['theme'].'-theme.css">
<link rel="stylesheet" type="text/CSS" href="messages.css">
<title>iDating - Messages</title>';
				$view->draw($mess->get_content(),$result['photo'],$result['username'],$result['email']);
			}
			else{header('Location: index.php');}
		}
		public function show_m(){
			session_start();
			$session=new Session();
			$uid=$session->get_uid();
			if($uid==NULL){header('Location: index.php');}
			if($_SERVER["REQUEST_METHOD"]=="GET" && isset($_GET['with'])){
				$mess=new Message($uid,$_GET['with']);
				$view=new MessageView();
				$user=new User();
				$user->set_user($_GET['with']);
				$result=$user->show_info();
				echo '<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/CSS" href="shared-frame-m.css">
<link rel="stylesheet" type="text/CSS" href="shared-theme-m.css">
<link rel="stylesheet" type="text/CSS" href="'.$result['theme'].'-theme.css">
<link rel="stylesheet" type="text/CSS" href="messages-m.css">

';
				$view->draw_m($mess->get_content(),$result['photo'],$result['username'],$result['email']);
			}
			else{header('Location: index-m.html');}
		}
		public function show_new(){
			session_start();
			$session=new Session();
			$uid=$session->get_uid();
			if($uid==NULL){header('Location: index.php');}
			$view=new MessageView();
			$view->draw_new();
		}
	}
?>