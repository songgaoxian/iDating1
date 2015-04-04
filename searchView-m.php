<?php
class searchView{
	public function showCriteria(){
		echo "<!--header-start-->
<div class='header'>
<img id='nav' src='img/nav.png' alt='navigate'>
<h1>Search</h1>
</div>
<!--header-end-->

<div class='sidebar'>
<a href='accountmgt-m.php'>My Page</a>
<a href='search-m.php'>Search</a>
<a href='shake.php'>Shake</a>
<a href='calendar-m.php'>Calendar</a>
<a href='moments-m.php'>Moments</a>
<a href='messages-m.php'>Messages</a>
</div>

<!--search-start-->

<div class='container'>
<!--search-condition-start-->
<div id='tabs'>
    Search by: 
    <button id='tab-by-condition' class='link-btn no-line colored-txt-dark' type='button'>Conditions</button>|
    <button id='tab-by-name' class='link-btn no-line' type='button'>Nickname</button>
</div>

<div class='container'>
<form id='by-name-form' method='get' action='sresult-m.php'>
<table>
	<tr>
		<td style='width:40%'><label class='item-name'>Nickname</label></td>
		<td style='width:60%'>
    		<input type='text' name='nickname' class='singleIn'>
    	</td>
	</tr>
</table>
<input id='search-now' class='btn btn-fill' type='submit' value=''>
</form>

<form id='by-condition-form' method='post' action='sresult-m.php'>
<table>
<tr>
	<td style='width:40%'><label class='item-name'>Gender</label></td>
	<td style='width:60%'>
    	Male
        <input type='checkbox' name='gender' value='Male' class='js-switch' checked />
            <script>
                var elem = document.querySelector('.js-switch');
                var init = new Switchery(elem, {color: '#eb6877', secondaryColor: '#81ccef'});
            </script>
        Female
    </td>
</tr>
</table>


<table>
<tr>
	<td style='width:40%'><label class='item-name'>Age</label></td>
	<td style='width:60%'>
    <input class='doubleIn' type='number' name='age-from'> ~ <input class='doubleIn' type='number' name='age-to'>
    </td>
</tr>
</table>

<table>
<tr>
	<td style='width:40%'><label class='item-name'>Height</label></td>
	<td style='width:60%'>
    <input class='doubleIn' type='number' name='age-from'> ~ <input class='doubleIn' type='number' name='age-to'>
    </td>
</tr>
</table>

<table>
<tr>
	<td style='width:40%'><label class='item-name'>Occupation</label></td>
	<td style='width:60%'>
    <select class='basic' name='job'>
     	<option value='unlimited' selected>Unlimited</option>
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
        <option value='Law'>Law</option>
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
    </td>
</tr>
</table>

<table>
<tr>
	<td style='width:40%'><label class='item-name'>Income Minimum Requirement</label></td>
	<td style='width:60%'>
    <input class='singleIn' name='income' type='number'> 
    </td>
</tr>
</table>

<table>
<tr>
	<td style='width:40%'><label class='item-name'>Education</label></td>
	<td style='width:60%'>
    <select class='basic' name='education'>
        <option value='unlimited' selected>Unlimited</option>
        <option value='High School'>High School</option>
        <option value='Bachelor'>Bachelor</option>
        <option value='Master'>Master</option>
        <option value='PhD'>PhD</option>
	</select>
    </td>
</tr>
</table>

<table>
<tr>
	<td style='width:40%'><label class='item-name'>City</label></td>
	<td style='width:60%'>
    <input class='singleIn' type='text' name='city'>
    </td>
</tr>
</table>

<table>
<tr>
	<td style='width:40%'><label class='item-name'>Hometown</label></td>
	<td style='width:60%'>
    <input class='singleIn' type='text' name='hometown'>
    </td>
</tr>
</table>

<table>
<tr>
	<td style='width:40%'><label class='item-name'>Tags</label></td>
	<td style='width:60%'>
    	<select class='selectify' id='tags' multiple='multiple' name='tags[]'>
    		<option value='Music'>Music</option>
    		<option value='Movies'>Movie</option>
    		<option value='Book'>Book</option>
    		<option value='Jogging'>Jogging</option>
    		<option value='Cooking'>Cooking</option>
        </select>
    </td>
</tr>
</table>


<input id='search-now' class='btn btn-fill' type='submit' value=''>
</form>
</div>
<!--search-end-->";
	}
}
?>