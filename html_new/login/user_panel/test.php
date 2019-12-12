<html><script type="text/javascript">
	
	function check1(){
	
		if(box1.value=="Standard"){
			box2.value=100
		}
		if(box1.value=="Dulex"){
			box2.value=200
		}
		if(box1.value=="Hostel"){
			box2.value=300
		}
		document.getElementById('box2').value = check1();
	}
	
</script>

<body>
<form action="" method="post">
Accomodation Type:<select id="box1" onChange="check1()">
<option value="Standard" >Standard</option>
<option value="Dulex" >Dulex</option>
<option value="Hostel" >Hostel</option>

</select>

<input type="text" name="box2"  id="box2" value="100" style="border:none;background-color:transparent;" readonly ></input>

No. of Memebers:<select id="boxz" >
<option value="1" >1</option>
<option value="2" >2</option>
<option value="3" >3</option>
<option value="4" >4</option>
<option value="5" >5</option>
<option value="6" >6</option>
</select>

<input type="submit" name="submit">

</form>
</body>
</html>
Welcome <?php if(isset($_POST["box1"])){
echo $_POST["box1"];
	} ?> <br>
Your email address is: <?php if(isset($_POST["box2"])){
echo $_POST["box2"];
echo $_POST["box1"];
	} 





	?>