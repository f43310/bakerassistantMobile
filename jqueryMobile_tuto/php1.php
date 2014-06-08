<?php
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
    print("<a data-rel=\"dialog\" data-transition=\"pop\" 
href=\"index.php?action=addnew\">Add New Opportunity</a>
<br/><br/>");
    print("<ul data-role=\"listview\" data-filter=\"true\">"); 
    while($row = mysql_fetch_row($result)) {
        print("<li data-ibm-jquery-contact=\"".$row[$COL_CONTACT]."\">");
        print("<a data-rel=\"dialog\" data-transition=\"pop\"
 href=\"index.php?action=details&id=".$row[$COL_OPPID]."\">");
        print("Person:&nbsp;".$row[$COL_PERSON]."<br/>");
        print("Contact:&nbsp;".$row[$COL_CONTACT]."<br/>");
        print("Description:&nbsp;".$row[$COL_DESCRIPTION]);
        print("</a>");

        print("</li>\n");
    }
    print("</ul>");
   }
}
?>