<div class="vender_container">
  <div class="vender_image"><img src="<? echo DIR_MAIN_IMAGES.'/'.$row[3];?>" /></div>
    <div class="vender_right">
   	  <div class="vender_category">
		<div class="vender_category_left"><a href="<? echo $url_page;?>/category/<? echo $row[0];?>"><? echo $row[1]; ?></a></div>
        <div class="vender_category_right"><? echo $row[2]; ?></div>
		<div style="clear:left"></div>
      </div>
        <div class="vender_list"><? 
		 $sql1="SELECT id, name FROM vender WHERE category='".$row[0]."' ORDER BY name ASC";
		 $res1=mysql_query($sql1,$db) or die('нет связи с БД');
		 $f=0;
		 while($row1=mysql_fetch_row($res1))
		 {
			 $f=1;
?><a class="vender_list_a" href="<? echo $url_page;?>/category/<? echo $row[0];?>/partner/<? echo $row1[0];?>"><img src="<? echo DIR_MAIN_IMAGES;?>/pin.png" border="0" style="margin-right:7px;"><? echo $row1[1];?></a>
<?		 }
		  ?>
        </div>
    </div>  
  </div>
  <div style="clear:left"></div>
</div><br />