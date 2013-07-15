<?
	if($_POST['save'])
	{
		foreach($_POST['qwe'] as $k=>$val)
		{
		  if($val!=$_POST['qwe_old'][$k]) 
		  {
			  $sql="UPDATE faq SET question='".mysql_real_escape_string($val)."' WHERE id='".$k."'";
			  mysql_query($sql,$db);
		  }
		  if($_POST['ans'][$k]!=$_POST['ans_old'][$k]) 
		  {
			  $sql="UPDATE faq SET answer='".mysql_real_escape_string($_POST['ans'][$k])."' WHERE id='".$k."'";
			  mysql_query($sql,$db);
		  }
		  if($_POST['pos'][$k]!=$_POST['pos_old'][$k]) 
		  {
			  $sql="UPDATE faq SET position='".$_POST['pos'][$k]."' WHERE id='".$k."'";
			  mysql_query($sql,$db);
		  }
		}
		echo 'Удачно сохранено';  		
	}
	
	if($_POST['add_qwe']&&$_POST['add_btn'])
	{
		$sql="INSERT INTO faq SET answer='".mysql_real_escape_string($_POST['add_ans'])."',question='".mysql_real_escape_string($_POST['add_qwe'])."', position='".$_POST['add_pos']."'";
		mysql_query($sql,$db);
		echo 'Добавлен новый вопрос '.$_POST['add_qwe'];  
	}
?>
<form method="post">
<table cellpadding="2" cellspacing="2" border="0" width="100%" >
  <tr bgcolor="#D3DCE3" style="color:#0000FF" align="center">
	<td width="300">Вопрос</td><td>Ответ</td><td>Позиция</td>
  </tr> 
<?
		$sql="SELECT * FROM faq ORDER BY position ASC";
		$res=mysql_query($sql,$db) or die('нет связи с БД');
		while($row=mysql_fetch_row($res))
		{
?>
<tr class="<? if($odd) {$odd=0; echo "even";}
else { $odd=1; echo "odd";}?>">
<td><textarea name="qwe[<? echo $row[3];?>]" style="width:300px; height:45px;"><? echo stripslashes($row[1]);?></textarea>
<input type="hidden" name="old_qwe[<? echo $row[3];?>]" value='<? echo stripslashes($row[1]);?>'></td>
<td><textarea style="width:750px; height:45px;" name="ans[<? echo $row[3];?>]"><? echo stripslashes($row[2]);?></textarea>
<input type="hidden" name="old_ans[<? echo $row[3];?>]" value='<? echo stripslashes($row[2]);?>'></td>
<td><input type="text" size="3" maxlength="20" name="pos[<? echo $row[3];?>]" value='<? echo stripslashes($row[0]);?>'>
<input type="hidden" name="old_pos[<? echo $row[3];?>]" value='<? echo stripslashes($row[0]);?>'></td>
</tr>
<?
		}
?>
  <tr bgcolor="#D3DCE3" style="color:#0000FF" align="center">
	<td colspan="5"><input language='javascript' onclick="return confirm('Вы действительно хотите сохранить все FAQ?')" type="submit" value="Сохранить" name="save">&nbsp;&nbsp;<input type="submit" value="Отмена" name="cancel"></td>
  </tr> 
   <tr bgcolor="#D3DCE3" style="color:#0000FF" align="center">
	<td><textarea name="add_qwe" style="width:300px; height:45px;"></textarea></td>
	<td><textarea style="width:750px; height:45px;" name="add_ans"></textarea></td>
	<td><input type="text" size="3" maxlength="20" name="add_pos" value=""></td>
   </tr>	
  <tr bgcolor="#D3DCE3" style="color:#0000FF" align="center">
	<td colspan="5"><input type="submit" value="Добавить" name="add_btn"></td>
  </tr> 
</table>
</form>