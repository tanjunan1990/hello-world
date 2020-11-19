<html>
<body>
<!-- Connection to database -->
<?php
$mysql_host="localhost"; 
$mysql_user="root";
$mysql_password="";
$mysql_db="tpshop";

$con = new mysqli($mysql_host, $mysql_user, $mysql_password, $mysql_db);
if (!$con) {
    echo $con->errno . "<br>";
    die('Could not connect: ' . $con->error);
}
?>
<!-- Check for empty fields -->
<?php  
if(isset($_POST['Submit'])){

    if (!empty($_POST['ITEM_NAME']) &&
        !empty($_POST['STOCK']) &&
        !empty($_POST['UNITPRICE']) &&
        !empty($_POST['COSTPRICE']) &&
        !empty($_POST['SHORT_DESC']) &&
        !empty($_POST['MERCHANT']) &&
        !empty($_POST['ITEM_ID'])){
        echo "OK: Fields are not empty<br>";
        // Prepare and bind variables, and return to index.php after completing update
        $itemname=$_POST['ITEM_NAME'];
        $stock=$_POST['STOCK'];
        $unitprice=$_POST['UNITPRICE'];
        $costprice=$_POST['COSTPRICE'];
        $shortdesc=$_POST['SHORT_DESC'];
        $merchant=$_POST['MERCHANT'];
        $itemID=$_POST['ITEM_ID'];

        $query=$con->prepare("UPDATE item set ITEM_NAME=?, STOCK=?, UNITPRICE=?, COSTPRICE=?, SHORT_DESC=?, MERCHANT=? WHERE ITEM_ID=?");
        $query->bind_param('siddssi', $itemname,$stock,$unitprice,$costprice,$shortdesc,$merchant,$itemID);

        if ($query->execute()){
            echo "Query Executed.";
            header("location: index.php");
        }
        else {
            echo "Error executing query.";
        }       
            }
        else{
            echo "Error: No Fields Should Be Empty<br>";
        }
        
}
// Display item information based on item ID from index.php
if(isset($_GET['Submit']) && $_GET['Submit']=== "GetUpdate"){
    $itemID=$_GET['ITEM_ID'];
    $query= "SELECT ITEM_ID, ITEM_NAME, STOCK, UNITPRICE, COSTPRICE, SHORT_DESC, MERCHANT FROM item WHERE ITEM_ID=?";
    $pQuery = $con->prepare($query);
    $pQuery->bind_param('i', $itemID);

    $result=$pQuery->execute();
    $result=$pQuery->get_result();
    if(!$result) {
        die("SELECT query failed<br> ".$con->error);
    }
    $nrows=$result->num_rows;
 

    if ($row=$result->fetch_assoc()) {
?>
<!-- HTML update form -->
    <form action="edit3.php" method="post"> 
    	<table>
        <tr><td>itemname: </td><td><input type="text" name="ITEM_NAME" value="<?php echo $row['ITEM_NAME']?>"></td></tr>
        <tr><td>stock: </td><td><input type="text" name="STOCK" value="<?php echo $row['STOCK']?>"></td></tr>
        <tr><td>unitprice: </td><td><input type="text" name="UNITPRICE" value="<?php echo $row['UNITPRICE']?>"></td></tr>
        <tr><td>costprice: </td><td><input type="text" name="COSTPRICE" value= "<?php echo $row['COSTPRICE']?>"></td></tr>
        <tr><td>shortdesc: </td><td><input type="text" name="SHORT_DESC" value="<?php echo$row['SHORT_DESC']?>"></td></tr>
        <tr><td>merchant: </td><td><input type="text" name="MERCHANT" value="<?php echo $row['MERCHANT']?>"></td></tr>
        <tr><td></td><td>
        <input type="hidden" name="ITEM_ID" value="<?php echo $row['ITEM_ID']?>">
        <input type="submit" name="Submit" value="Update"></td></tr>
    	</table>
    </form>
<?php 
    }
}
?>
</body>
</html>

