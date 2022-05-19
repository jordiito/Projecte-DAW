<?php
//include ('connexio.php');
/*
$sql = "select * from producte";
$result = mysqli_query($con, $sql);
while ($row = mysqly_fetch_array($result)) {

}
*/

$q = json_decode(file_get_contents('php://input'), true);
if ($q){
  $data = [];
  // Genera la query
  $query = "SELECT * FROM producte WHERE (";
  foreach ($q as $k=>$v) {
    foreach ($v as $i=>$j){
      if ($i<count($v)-1){
        $query .= " ".$k."= ? or ";
      }else {
        $query .= " ".$k."= ?)";
      }
      $data[]=$j;
    }
    $query .= " and (";
  }
  $sql = substr($query, 0, -6);
}else {
  $sql = "SELECT * FROM producte";
}

try {
    $dbh = new PDO('mysql:host=localhost;dbname=botiga;charset=utf8','jordi', 'thos');
    $sth = $dbh->prepare($sql);
    $sth->execute($data);
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
  $res = json_encode($result);
  echo $res;