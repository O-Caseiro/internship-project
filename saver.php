<?php
$handle = fopen("index.html", 'w+');
$data = $_POST['id'];
if($handle)
{

if(!fwrite($handle, $data ))
echo "ok";
}

mysqli_close($connect);

?>