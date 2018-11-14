<?php include "db.php";?>

<?php
$query = $conn->query("SELECT posts.id, posts.author_id, posts.title, posts.description, posts.content, posts.date, authors.first_name, authors.last_name, authors.email
FROM authors
RIGHT JOIN posts ON authors.id = posts.author_id
ORDER BY authors.id;");

if($query->num_rows > 0){
    $delimiter = ",";
    //$date = date("Y-m-d_H-i",time());
    // $filename = "export_cvs_".$date.".cvs";

$filename = "export_cvs_".date("Y-m-d_H-i",time()).".cvs";
    if (file_exists('csv/' .$filename)) {
      $filename = "export_cvs_".date("Y-m-d_H-i",time()).rand().".cvs";
  }
    $f = fopen('csv/' .$filename, 'w');
    //set column headers
    $fields = array('ID', 'author_id', 'title', 'description', 'content', 'date', 'first_name', 'last_name', 'email');
    fputcsv($f, $fields, $delimiter);
    //output each row of the data, format line as csv and write to file pointer
    while($row = $query->fetch_assoc()){
        $lineData = array($row['id'], $row['author_id'], $row['title'], $row['description'], $row['content'], $row['date'], $row['first_name'], $row['last_name'], $row['email']);
        fputcsv($f, $lineData, $delimiter);
    }

    //move back to beginning of file
    fseek($f, 0);

    //set headers to download file rather than displayed
    // header('Content-Type: text/csv');
    // header('Content-Disposition: attachment; filename="' . $filename . '";');

    //output all remaining data on a file pointer
    fpassthru($f);

    //  json
    $response = new stdClass();
    $response->code = "OK";
    $response->message = "Failas issaugotas";
    echo json_encode($response);
    exit(0);
}
$response = new stdClass();
$response->code = "ERROR";
$response->message = "Nenumatyta klaida";
echo json_encode($response);
exit(0);

?>
