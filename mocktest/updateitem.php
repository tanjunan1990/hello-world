<!-- Server Connection -->
<?php
$mysql_host="localhost";
$mysql_user="root";
$mysql_password="";
$mysql_db="DB0A170";

$con= new mysqli($mysql_host,$mysql_user,$mysql_password,$mysql_db);
if(!$con){
    echo $con->errno . "<br>";
    die('Could not connect: '. $con->error);
}
else {
    echo "Connection to $mysql_db at $mysql_host successful<br>";
}
?>
<?php 
if (isset($_POST['actiontype']) && $_POST['actiontype'] === "Update"){
    if (isset($_POST['Submit']) && $_POST['Submit'] === "Action"){ 
        if(!empty($_POST['PRODUCTID']) &&
        !empty($_POST['PRODUCTNAME']) &&
        !empty($_POST['STOCKAMOUNT']) &&
        !empty($_POST['SELLERCONTACT']) &&
        !empty($_POST['CREATEDDATE']))
        {
            echo "OK: Fields are not empty<br>";

            $productid=$_POST['PRODUCTID'];
            $productname=$_POST['PRODUCTNAME'];
            $stockamount=$_POST['STOCKAMOUNT'];
            $sellercontact=$_POST['SELLERCONTACT'];
            $createddate=$_POST['CREATEDDATE'];
            $query=$con->prepare("UPDATE item37228107 set  ProductName=?, StockAmount=?, SellerContact=?, CreatedDate=? WHERE ProductID=?");
            $query->bind_param('ssiss',$productid,$productname,$stockamount,$sellercontact,$createddate);
            if ($query->execute()){
                echo "Query executed.";
            }else{
                echo "Error executing query.";
            }
            
        }
    }

}

?>