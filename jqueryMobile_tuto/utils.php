<?
function addOpp($person,$contact,$description)
{
	global $mysql_link;

	$sql = "insert opportunities(opp_id,opp_person,opp_contact,opp_description) values (NULL,'$person','$contact','$description')";
	$result = mysql_query($sql,$mysql_link);
	if ($result == 1) {
		return "SUCCESS";
	} else {
		return "FAILED";
	}

}

function updateOpp($id,$person,$contact,$description)
{
global $mysql_link;

$sql = "update opportunities set opp_person='".$person."',opp_contact= '".$contact."',opp_description='".$description."' where opp_id= ".$id;
$result = mysql_query($sql,$mysql_link);
if ($result == 1) {
	return "SUCCESS"; 	
} else {
	return "FAILED";
}

}

function showOpps()
{
global $mysql_link;

$COL_OPPID= 0;
$COL_PERSON= 1;
$COL_CONTACT= 2;
$COL_DESCRIPTION= 3;
$sql ="select * from opportunities order by opp_id desc";
$result = mysql_query($sql,$mysql_link);
   
  if(mysql_num_rows($result))
  {
	print("<a data-rel=\"dialog\" data-transition=\"pop\" href=\"index.php?action=addnew\">Add New Opportunity</a><br/><br/>");
	print("<ul data-role=\"listview\" data-filter=\"true\">"); 
	while($row = mysql_fetch_row($result)) {
		print("<li data-ibm-jquery-contact=\"".$row[$COL_CONTACT]."\">");
		print("<a data-rel=\"dialog\" data-transition=\"pop\" href=\"index.php?action=details&id=".$row[$COL_OPPID]."\">");
		print("Person:&nbsp;".$row[$COL_PERSON]."<br/>");
		print("Contact:&nbsp;".$row[$COL_CONTACT]."<br/>");
		print("Description:&nbsp;".$row[$COL_DESCRIPTION]);
		print("</a>");
		
		print("</li>\n");
	}
	print("</ul>");
   }
}


function showOneOpp($id)
{
global $mysql_link;


$COL_OPPID= 0;
$COL_PERSON= 1;
$COL_CONTACT= 2;
$COL_DESCRIPTION= 3;

$person = "";
$contact = "";
$description = "";

	if ($id != -1) {
		$sql ="select * from opportunities where opp_id = " . $id;
		$result = mysql_query($sql,$mysql_link);
		   
		if(mysql_num_rows($result)) {
			$row = mysql_fetch_row($result);
			$person = $row[$COL_PERSON];
			$contact = $row[$COL_CONTACT];
			$description = $row[$COL_DESCRIPTION];
		}
		print("<a rel=\"external\" href=\"javascript:deleteEntry($id)\">Delete this entry</a>");
	}

	print("<form method=\"post\" rel=\"external\" action=\"index.php\" onsubmit=\"return checkForm();\">");
	print("<input type=\"hidden\" name=\"action\" value=\"upsert\"/>");
	print("<input type=\"hidden\" name=\"id\" value=\"$id\"/>");
	print("<fieldset>");

	print("<div data-role=\"fieldcontain\">");
	print("<label for=\"person\">Person</label>");
	print("<input type=\"text\" name=\"person\" maxlength=\"100\" id=\"person\" value=\"$person\" />");
	print("</div>");

	print("<div data-role=\"fieldcontain\">");
	print("<label for=\"contact\">Contact info</label>");
	print("<input type=\"text\" name=\"contact\" maxlength=\"100\" id=\"contact\" value=\"$contact\" />");
	print("</div>");

	print("<div data-role=\"fieldcontain\">");
	print("<label for=\"description\">Comments</label>");
	print("<input type=\"text\" name=\"description\" maxlength=\"100\" id=\"description\" value=\"$description\" />");
	print("</div>");

	print("<fieldset>");
	print("<button type=\"submit\" value=\"Save\">Save Opportunity</button>");

	print("</form>\n");

}

function showOneOppJSON($id)
{
global $mysql_link;


$COL_OPPID= 0;
$COL_PERSON= 1;
$COL_CONTACT= 2;
$COL_DESCRIPTION= 3;
$sql ="select * from opportunities where opp_id = " . $id;
$result = mysql_query($sql,$mysql_link);
$ret = '';   
  if(mysql_num_rows($result))
  {
	$row = mysql_fetch_row($result);
	$ret = "{\"id\":\"".$row[$COL_OPPID]."\",\"person\":\"".$row[$COL_PERSON]."\",\"contact\":\"".$row[$COL_CONTACT]."\",\"description\":\"".$row[$COL_DESCRIPTION]."\"}";
	return $ret;
   }
}






function killOpp($id)
{
global $mysql_link;

$sql = "delete from opportunities where opp_id =$id";
$result = mysql_query($sql,$mysql_link);

}




?>
