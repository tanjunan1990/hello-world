<html>
<head>
<title>CRUD Application</title>
<style>
table,th,td{
    border: 1px solid black;
}


</style>

</head>
<body>
<h1>CRUD Application</h1>
<form action='q3.php' method='post'> <!-- List table -->
    <input type="submit" name="actiontype" value='List All'>
</form>
<!-- Action Form -->
<form action="q3.php" method="POST">   
<table>
       
        <td>Action type <br>
        <input type="radio" name="actiontype" value="add">
        <label >Add</label><br>
        <input type="radio" name="actiontype" value="update" >
        <label>Update</label><br>
        <input type="radio" name="actiontype" value="delete">
        <label>Delete</label>
        </td>
        
<!-- </table> -->
<!-- </form> -->

<form action="q3.php" method="POST">

	<table>
    <br><br>
		<tr><td>ID: </td><td><input type="text" name="ID"></td></tr>
		<tr><td>Name:     </td><td><input type="text" name="NAME"></td></tr>
		<tr><td>Contact: </td><td><input type="text" name="CONTACT"></td></tr>
		<tr><td>Email: </td><td><input type="text" name="EMAIL"></td></tr>
		<tr><td>Date Of Birth: </td><td><input type="text" name="DOB"></td></tr>
		<tr><td></td><td><input type="submit" name="Submit" value="Action"></td></tr>
	</table>
	
	</form>

</body>
</html>