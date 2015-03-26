<?php
class searchView{
	public function showCriteria(){
echo "
	<!--header-start-->
<div class='header'>
<ul id='topnav'>
<li><a href='logout.php'>Log Out</a>
  <li><a href='messages.php'>Messages</a>
  <li><a href='moments.php'>Moments</a>
  <li><a href='calendar.php'>Calendar</a>
  <li><a href='search.php'>Search</a>
  <li><a href='accountmgt.php'>My Page</a>  
</ul>
<img src='img/logo_small.png' alt='iDating logo'>
</div>
<!--header-end-->

<!--content-start-->
<div class='container'>
<!--search-condition-start-->
<div id='search-condition'>
<div id='tabs'>
<button id='tab-by-condition' class='link-btn no-line colored-txt-dark' type='button'>Search by Conditions</button>|
<button id='tab-by-name' class='link-btn no-line' type='button'>Search by Nickname</button>
</div>

<form id='by-name-form' method='get' action='sresult.php'>
<input class='txtbox' type='text' placeholder='Nickname' name='nickname' required>
<input id='search-1' class='btn' type='submit' value=''>
</form>

<form id='by-condition-form' method='post' action='sresult.php'>
<input id='search-2' class='btn' type='submit' value=''>

<div class='search-item'>
Gender: 
<select name='gender'>
  <option value='Male'>Male</option>
  <option value='Female'>Female</option>
  <option value='unlimited' selected>Unlimited</option>
</select>
<button class='btn item-delete'>X</button>
<button class='btn item-add'>Add</button>
</div>

<div class='search-item'>
Age:
<input id='age-from' class='txtbox-embed' type='number' min='18' max='99' value='18' name='age-from'> ~ <input id='age-to' class='txtbox-embed' type='number'  min='18' max='99'  value='28' name='age-to'>
<button class='btn item-delete'>X</button>
<button class='btn item-add'>Add</button>
</div>

<div class='search-item'>
Height (cm):
<input id='height-from' class='txtbox-embed' type='number' min='140' max='220' value='150' name='height-from'> ~ <input id='height-to' class='txtbox-embed' type='number' min='140' max='220' value='170' name='height-to'>
<button class='btn item-delete'>X</button>
<button class='btn item-add'>Add</button>
</div>

<div class='search-item'>
Occupation:
  <select name='job' class='txtbox-embed'>
  	<option value='Unlimited' selected>Unlimited</option>
  	<option value='Student'>Student</option>
    <option value='Computer Software'>Computer Software</option>
	<option value='Computer Hardware'>Computer Hardware</option>
    <option value='Telecommunications'>Telecommunications</option>
	<option value='Internet/E-commerce'>Internet/E-commerce</option>
	<option value='Accounting/Auditing'>Accounting/Auditing</option>
	<option value='Banking'>Banking</option>
	<option value='Real Estate'>Real Estate</option>
	<option value='Insurance'>Insurance</option>
	<option value='Consulting'>Consulting</option>
	<option value='Legal'>Legal</option>
	<option value='Trading/Import & Export'>Trading/Import & Export</option>
	<option value='Wholesale/Retail'>Wholesale/Retail</option>
	<option value='Apparel/Textiles'>Apparel/Textiles</option>
	<option value='Furniture/Home Appliances'>Furniture/Home Appliances</option>
	<option value='Healthcare/Medicine/Public Health'>Healthcare/Medicine/Public Health</option>
	<option value='Public Relations/Marketing'>Public Relations/Marketing</option>
	<option value='Films/Media/Arts'>Films/Media/Arts</option>
	<option value='Education/Training'>Education/Training</option>
	<option value='Science/Research'>Science/Research</option>
	<option value='Transportation/Logistic'>Transportation/Logistic</option>
	<option value='Utilities/Energy'>Utilities/Energy</option>
	<option value='Agriculture/Fishing/Forestry'>Agriculture/Fishing/Forestry</option>
	<option value='Others'>Others</option>
  </select>
<button class='btn item-delete'>X</button>
<button class='btn item-add'>Add</button>
</div>

<div class='search-item'>
Eduacation:
<select name='education' class='txtbox-embed'>
    <option value='Unlimited' selected>Unlimited</option>
    <option value='High School'>High School</option>
    <option value='Bachelor'>Bachelor</option>
    <option value='Master'>Master</option>
    <option value='PhD'>PhD</option>
  </select></td>
<button class='btn item-delete'>X</button>
<button class='btn item-add'>Add</button>
</div>
<button id='more-condition' type='button' class='link-btn'>More conditions?</button>
</form>
</div>
<!--search-condition-end-->
<!--more-condition-start-->
<div id='more-condition-box'>
<div class='search-item'>
City:
<input class='txtbox-embed' type='text' value='Hong Kong' name='city'>
<button class='btn item-delete'>X</button>
<button class='btn item-add'>Add</button>
</div>

<div class='search-item'>
Hometown:
<input class='txtbox-embed' type='text' value='Peking' name='hometown'>
<button class='btn item-delete'>X</button>
<button class='btn item-add'>Add</button>
</div>

<div class='search-item'>
Monthly Income (HKD): &gt;=
<input id='income' class='txtbox-embed' type='number' value='10000' name='income'>
<button class='btn item-delete'>X</button>
<button class='btn item-add'>Add</button>
</div>

<!--
<div class='search-item'>
Tags: Workaholic + Reliable
<button class='btn item-delete'>X</button>
<button class='btn item-add'>Add</button>
</div>-->
</div>
<!--more-condition-end-->
</div>
<!--container-end-->

<!--footer-start-->
<div class='footer'>
Copyright &copy; 2015 All Rights Reserved.
</div>
<!--footer-end-->";
	}
} 
?>