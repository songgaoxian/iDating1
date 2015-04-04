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
						<div style="background-image:url(\'portrait\/'.$content[2].'\')" class="msg-portrait background-cover-center">					</div>
					</td>
					<td style="width:90%">
						<div class="title">
    						<p class="msg-time">'.$content[0].'</p>
      						<h3 class="msg-from colored-txt">'.$content[3].'</h3>
    						<p class="msg-content">"'.$content[1].'"</p>
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
					<td style="width:25%">
						<img src="portrait/'.$content[2].'" alt="portrait">
					</td>
					<td style="width:75%">
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
$(document).ready(function() {
	$(".msg-portrait").height($(".msg-portrait").width());
	
	//resize the window
	$(window).resize(function(){
		$(".msg-portrait").height($(".msg-portrait").width());		
	});
});
</script>
</head>

<body>
<div id="C">
<div id="A">
<ul>
<li><a href="accountmgt-m.php">My Page</a></li>
<li><a href="search-m.php">Search</a></li>
<li><a href="shake.php">Shake</a></li>
<li><a href="calendar-m.php">Calendar</a></li>
<li><a href="moments-m.php">Moments</a></li>
<li><a href="messages-m.php">Messages</a></li>
<li><a href="logout1.php">Log Out</a></li>
</ul>
</div>

<div id="B">
<!--header-start-->
<div class="header">
<div id="topnav">
<img id="add" src="img/add.png" alt="add message" onClick="">
</div>
<img id="nav" src="img/nav.png" alt="navigate">
<h1>Messages</h1>
</div>
<!--header-end-->

<!--container-start-->
<div class="container">
<!--messages-start-->
<div id="messages">';
		foreach($content as $key=>$value){
			echo $this->draw_one_m($value);
		}
		echo'    
		</ul>
</div>
<!--messages-end-->
<div id="new-msg-details">
	<textarea class="txtbox txtbox-fill" placeholder="Leave your message here..." id="text" rows="4"></textarea>
    <button id="mail-btn2" type="button" class="btn onClick=\'window.location.replace("messages-m.php")\'>Return to Inbox</button>
	<button id="mail-btn1" type="button" class="btn" onClick="send()">Send Message</button>
</div>
';
		}
		public function draw_new(){
			echo'
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

<!--container-start-->
<div class="container">
<h1 class="colored-txt">My Message Inbox</h1>
	<!--messages-start-->
	<div class="mail-list">
		<form>
			<br>Message Receiver: <br>
			<input type="email" id="email" placeholder="Email Address" class="txtbox txtbox-fill">			<br>
            <textarea class="txtbox txtbox-fill" placeholder="Leave your message here..." id="text" rows="5"></textarea>
            <button id="msg-send-new" type="button" class="btn btn-lg" onClick="send()">Send Message</button>            
		</form>
	</div>
	<!--messages-end-->
</div>
<!--container-end-->';
		}
		
		public function draw_new_m(){
			echo'
<title>iDating - Messages</title>
</head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

<body>
<div id="C">
<!--header-start-->
<div id="A">
<ul>
<li><a href="accountmgt-m.php">My Page</a></li>
<li><a href="search-m.php">Search</a></li>
<li><a href="shake.php">Shake</a></li>
<li><a href="calendar-m.php">Calendar</a></li>
<li><a href="moments-m.php">Moments</a></li>
<li><a href="messages-m.php">Messages</a></li>
<li><a href="logout1.php">Log Out</a></li>
</ul>
</div>

<div id="B">
<div class="header">
<div id="topnav">
</div><img id="nav" src="img/nav.png" alt="navigate"><h1 class="colored-txt">New Message</h1></div>

<div class="container">
<!--search-condition-start-->
			<div id="new-msg-details">
				<br>Message Receiver:<br>
				<input type="email" id="email" placeholder="Email Address" class="txtbox txtbox-fill">
            	<textarea class="txtbox txtbox-fill" placeholder="Leave your message here..." id="text" rows="5"></textarea>
				<button id="mail-btn2" type="button" class="btn" onClick=\'window.location.replace("messages-m.php")\'>Return to Inbox</button><button id="mail-btn1" type="button" class="btn" onClick="send()">Send Message</button>
			</div>
	 
	</div>
</div>';
		}
		
		public function draw($content,$photo,$username,$email){
			echo'
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
$(document).ready(function() {
	$(".msg-portrait").height($(".msg-portrait").width());
	
	//resize the window
	$(window).resize(function(){
		$(".msg-portrait").height($(".msg-portrait").width());		
	});
});
</script>
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

<!--container-start-->
<div class="container">
<h1 class="colored-txt">My Message Inbox</h1>
	<!--messages-start-->
	<div class="mail-list">
		<ul>';
		foreach($content as $key=>$value){
			echo $this->draw_one($value,$photo,$username);
		}
		echo'</ul>
		<p>Email: ';echo $email.'</p>
        <textarea  class="txtbox txtbox-fill" placeholder="Leave your message here..." id="text" rows="5"></textarea>
        <button id="msg-send-new" type="button" class="btn btn-lg" onClick="send()">Send Message</button>
	</div>
	<!--messages-end-->
</div>
<!--container-end-->';
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
<link rel="shortcut icon" href="img/icon.png">
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
				$user1=new User();
				$user1->set_user($uid);
				$result1=$user1->show_info();
				echo '<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="shortcut icon" href="img/icon.png">
<link rel="stylesheet" type="text/CSS" href="shared-frame-m.css">
<link rel="stylesheet" type="text/CSS" href="'.$result1['theme'].'-theme.css">
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
			$user1=new User();
			$user1->set_user($uid);
			$result1=$user1->show_info();
			echo '<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">

<link rel="shortcut icon" href="img/icon.png">
<link rel="stylesheet" type="text/CSS" href="shared-frame.css">
<link rel="stylesheet" type="text/CSS" href="'.$result1['theme'].'-theme.css">
<link rel="stylesheet" type="text/CSS" href="messages.css">
<title>iDating - Messages</title>';
			if($uid==NULL){header('Location: index-m.html');}
			$view=new MessageView();
			$view->draw_new();
		}
		public function show_new1(){
			session_start();
			$session=new Session();
			$uid=$session->get_uid();
			$user1=new User();
			$user1->set_user($uid);
			$result1=$user1->show_info();
			echo '<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="shortcut icon" href="img/icon.png">
<link rel="stylesheet" type="text/CSS" href="shared-frame-m.css">
<link rel="stylesheet" type="text/CSS" href="'.$result1['theme'].'-theme.css">
<link rel="stylesheet" type="text/CSS" href="messages-m.css">
';
			if($uid==NULL){header('Location: index-m.html');}
			$view=new MessageView();
			$view->draw_new_m();
		}
	}
?>