<?php
	require("session.php");
	class Inbox{
		private $user_id;
		private $content;
		private $total;
		
		public function get_content(){return($this->content);}
		public function get_num(){return($this->total);}
		
		public function __construct($id){
			$this->user_id=$id;
			$conn=connect();
			if($conn){
				$sql='SELECT * FROM inbox WHERE user_id="'.$this->user_id.'"  ORDER BY dat DESC;';
				$result=mysqli_query($conn,$sql);
				if($result){
					$this->content=array();
					$this->total=0;
					while($row=mysqli_fetch_array($result)){
						$this->content[$this->total]=$row;
						$this->total+=1;
					}
				}
				mysqli_close($conn);
			}
		}
		
		public function new_inbox($info){
			$conn=connect();
			if($conn){
				$sql='SELECT * FROM inbox WHERE with_id="'.$info['with_id'].'" AND user_id="'.$this->user_id.'";';
				$result=mysqli_query($conn,$sql);
				if(mysqli_num_rows($result)>0){
					$sql='UPDATE inbox SET dat=CURRENT_TIMESTAMP, preview="'.$info['preview'].'", type="0" WHERE user_id="'.$this->user_id.'" AND with_id="'.$info['with_id'].'";';
					//echo $sql;
					$result=mysqli_query($conn,$sql);
					$sql='UPDATE inbox SET dat=CURRENT_TIMESTAMP, preview="'.$info['preview'].'", type="0" WHERE user_id="'.$info['with_id'].'" AND with_id="'.$this->user_id.'";';
					//echo $sql;
					$result=mysqli_query($conn,$sql);
					if($result){return(true);}
					return(false);
				}
				else{
					$sql='INSERT INTO inbox(user_id,with_id,dat,preview,type) VALUES("'.$this->user_id.'","'.$info['with_id'].'",CURRENT_TIMESTAMP,"'.$info['preview'].'","1");';
					//echo $sql;
					$result=mysqli_query($conn,$sql);
					$sql='INSERT INTO inbox(user_id,with_id,dat,preview,type) VALUES("'.$info['with_id'].'","'.$this->user_id.'",CURRENT_TIMESTAMP,"'.$info['preview'].'","1");';
					$result=mysqli_query($conn,$sql);
					if($result){return(true);}
					return(false);
				}
			}
			return(false);
		}
		
		public function read_chat($with_id){
			$conn=connect();
			if($conn){
				$sql='SELECT * FROM inbox WHERE with_id="'.$info['with_id'].'";';
				$result=mysqli_query($conn,$sql);
				if(mysqli_num_rows($result)>0){
					$sql='UPDATE inbox SET type="1" WHERE user_id="'.$this->user_id.'" AND with_id="'.$info['with_id'].'";';
					$result=mysqli_query($conn,$sql);
					if($result){return(true);}
					return(false);
				}
			}
			return(false);
		}
	}
	
	class InboxView{
		public function draw_one($content){
			return '<li><a href="read_msg.php?with='.$content['with_id'].'">
			<table style="width:100%">
				<tr>
					<td style="width:10%">
						<div class="pic">
        					<div style="height:80px; background-image:url(\'portrait\/'.$content['photo'].'\')" class="background-cover-center">
						</div>
					</td>
					<td style="width:90%">
						<div class="title">
    						<div id="sender" class="colored-txt">
      							<span class="time">'.$content['dat'].'</span>
      							<span class="from">'.$content['username'].'</span>
    						</div>
                    		<p>
                        		"'.$content['preview'].'"
                    		</p>
						</div>
  					</td>
				</tr>
				</table>
				<div class="select">
					<input class="checking" type="checkbox" name="groupCheckbox" value="'.$content['with_id'].'">
				</div>
			</a>
			</li>';
		}
		public function draw_one_m($content){
			return '<a href="read_msg-m.php?with='.$content['with_id'].'">
			<div class="message-box">
				<table style="width:100%">
				<tr>
					<td style="width:20%">
						<img src="portrait/'.$content['photo'].'" alt="portrait">
					</td>
					<td style="width:80%">
						<p id="message-from" class="colored-txt">'.$content['username'].'</p>
						<p class="message-time">'.$content['dat'].'</p>
						<p class="message-content">"'.substr($content['preview'],0,30).'"</p>
					</td>
				</tr>
				</table>
			</div></a>';
		}
		
		public function draw_inbox_m($content){
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
</div><div id="B">
<div class="header">
<div id="topnav">
<img id="upload" src="img/add.png" alt="upload moments">
</div>
<img id="nav" src="img/nav.png" alt="navigate">
<h1>Inbox</h1>
</div>
<!--header-end-->
<!--header-end-->

<!--content-start-->
<div class="container">
<!--search-condition-start-->


<div id="messages">';
		foreach($content as $key=>$value){
			echo $this->draw_one_m($value);
		}
		echo'</div>
	</div>
</form>';
		}
		
		public function draw_inbox($content){
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
			echo $this->draw_one($value);
		}
		echo'
            <form id="mail-form" action="new_msg.php">
            <span class="button-group">
            <input name="mc_delete" type="button" onClick="del()" class="btn btn-lg" value="Delete selected messages">
            <input name="mc_markread" type="button" onClick="msg_read()" class="btn btn-lg" value="Mark as read">
            <input name="mc_markread" type="submit" class="btn btn-lg" value="Start new conversation" style="float:right; margin-right: 30px">
            </span>
		</ul>
		<div class="mail-list-ft"> </div>
	</div>
</form>
  
    
</div>';
		}
	}
	
	class InboxViewController{
		public function show(){
			session_start();
			$conn=connect();
			$session=new Session();
			$user_id=$session->get_uid();
			if($user_id==NULL){header('Location: index.php');}
			if($conn){
				$inbox=new Inbox($user_id);
				$content=$inbox->get_content();
				foreach($content as $key=>$value){
					$sql='SELECT username, photo FROM user_info WHERE user_id="'.$value['with_id'].'";';
					$result=mysqli_query($conn,$sql);
					if(mysqli_num_rows($result)>0){
						$row=mysqli_fetch_array($result);
						$value['username']=$row[0];
						$value['photo']=$row[1];
					}
					$content[$key]=$value;
				}
				$user=new User();
				$user->set_user($user_id);
				$data=$user->show_info();
				$view=new InboxView();
				echo '<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/CSS" href="shared-frame.css">
<link rel="stylesheet" type="text/CSS" href="'.$data['theme'].'-theme.css">
<link rel="stylesheet" type="text/CSS" href="messages.css">
';
				$view->draw_inbox($content);
			}
			else{header('Location: indxe.html');}
		}
		public function show_m(){
			session_start();
			$conn=connect();
			$session=new Session();
			$user_id=$session->get_uid();
			if($user_id==NULL){header('Location: index.php');}
			if($conn){
				$inbox=new Inbox($user_id);
				$content=$inbox->get_content();
				foreach($content as $key=>$value){
					$sql='SELECT username, photo FROM user_info WHERE user_id="'.$value['with_id'].'";';
					$result=mysqli_query($conn,$sql);
					if(mysqli_num_rows($result)>0){
						$row=mysqli_fetch_array($result);
						$value['username']=$row[0];
						$value['photo']=$row[1];
					}
					$content[$key]=$value;
				}
				$user=new User();
				$user->set_user($user_id);
				$data=$user->show_info();
				echo '<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/CSS" href="shared-frame-m.css">
<link rel="stylesheet" type="text/CSS" href="shared-theme-m.css">
<link rel="stylesheet" type="text/CSS" href="'.$data['theme'].'-theme.css">
<link rel="stylesheet" type="text/CSS" href="messages-m.css">
<link rel="stylesheet" type="text/CSS" href="sidebar.css">
';
				$view=new InboxView();
				$view->draw_inbox_m($content);
			}
			else{header('Location: index-m.html');}
		}
	}
?>