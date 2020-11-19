<html>
<head>
<title>SWAP Mock Test</title>
<style>
table,th,td{
    border: 1px solid black;
}


</style>

</head>
<body>
<h1>CRUD Application 107 (190A170372281B21E2B495388CECF80D345471637E898DEC777CB3D25A608366)</h1>
<a href="listitem.php"><button style="margin-bottom:15px;">List all</button></a>
<!-- Action Form -->
<form action="additem.php" method="POST">   
<table>
        <tr>
        <td>Action type <br>
        <input type="radio" name="actiontype" value="Add">
        <label >Add</label><br>
        <input type="radio" name="actiontype" value="Update" >
        <label>Update</label><br>
        <input type="radio" name="actiontype" value="Delete">
        <label>Delete</label>
        </td>
        
<!-- </table> -->
<!-- </form> -->

<form action="additem.php" method="POST">

	<table>
    <br><br>
		<tr><td>Product ID: </td><td><input type="text" name="PRODUCTID"></td></tr>
		<tr><td>Product Name:     </td><td><input type="text" name="PRODUCTNAME"></td></tr>
		<tr><td>Stock Amount: </td><td><input type="text" name="STOCKAMOUNT"></td></tr>
		<tr><td>Seller Contact: </td><td><input type="text" name="SELLERCONTACT"></td></tr>
		<tr><td>Created Date: </td><td><input type="text" name="CREATEDDATE"></td></tr>
		<tr><td></td><td><input type="submit" name="Submit" value="Action"></td></tr>
	</table>
	
	</form>

</body>
</html>
