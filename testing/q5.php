<?php
$password="testing123";
$key="key";
$hashed = hash_hmac('sha256',$password,$key);
echo "<html>
<body>
    <table border='1'>
        <tr>
            <td>MATRIC</td>
            <td>".$password."</td>
        </tr>
        <tr>
            <td>
                Q5_KEY
            </td>
            <td>
                ".$key."
            </td>
        </tr>
        <tr>
            <td>
                SHA-256 HASH
            </td>
            <td>
                ".$hashed."
            </td>
        </tr>
    </table>
</body>
</html>"
?>
