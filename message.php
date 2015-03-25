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
			if(!$conn){header('Location: index.html');}
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
				<div class="pic">
        			<img src="portrait/'.$content[2].'" alt="portrait">
				</div>
				<div class="title">
    				<div class="sender">
      					<span class="time">'.$content[0].'</span>
      					<span class="from">'.$content[3].'</span>
    				</div>
                    <p>
                        '.$content[1].'
                    </p>
				</div>
			</li>';
		}
		public function draw_new(){
			echo'<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/CSS" href="shared-frame.css">
<link rel="stylesheet" type="text/CSS" href="pink-theme.css">
<link rel="stylesheet" type="text/CSS" href="messages.css">


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
			echo'<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/CSS" href="shared-frame.css">
<link rel="stylesheet" type="text/CSS" href="pink-theme.css">
<link rel="stylesheet" type="text/CSS" href="messages.css">
<title>iDating - Messages</title>
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
		<div class="mail-list-ft"> </div>
	</div>
</div>';
		}
	}
	class MessageViewController{
		public function show(){
			session_start();
			$session=new Session();
			$uid=$session->get_uid();
			if($uid==NULL){header('Location: index.html');}
			if($_SERVER["REQUEST_METHOD"]=="GET" && isset($_GET['with'])){
				$mess=new Message($uid,$_GET['with']);
				$view=new MessageView();
				$user=new User();
				$user->set_user($_GET['with']);
				$result=$user->show_info();
				$view->draw($mess->get_content(),$result['photo'],$result['username'],$result['email']);
			}
			else{header('Location: index.html');}
		}
		public function show_new(){
			session_start();
			$session=new Session();
			$uid=$session->get_uid();
			if($uid==NULL){header('Location: index.html');}
			$view=new MessageView();
			$view->draw_new();
		}
	}
?>