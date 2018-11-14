<?php include "db.php";?>

<?php
$query = "SELECT posts.id, posts.author_id, posts.title, posts.description, posts.content, posts.date, authors.first_name, authors.last_name, authors.email
FROM authors
RIGHT JOIN posts ON authors.id = posts.author_id
ORDER BY authors.id;";

$fields = array();
if ($result = $conn->query($query)) {
    /* fetch associative array */
    while ($row = $result->fetch_assoc()) {
       array_push($fields, $row);
    }
    if(count($fields)){
         createXMLfile($fields);
     }
    /* free result set */
    $result->free();
}
/* close connection */
$conn->close();
function createXMLfile($fields){
   $filePath = "xml/export_xml_".date("Y-m-d_H-i",time()).".xml";
   if (file_exists($filePath)) {
     $filePath = "xml/export_xml_".date("Y-m-d_H-i",time()).rand().".xml";
   }
   $dom     = new DOMDocument('1.0', 'utf-8');
   $root      = $dom->createElement('posts');

   for($i=0; $i<count($fields); $i++){
     $id        =  $fields[$i]['id'];
     $author_id      =  $fields[$i]['author_id'];
     $title    =  $fields[$i]['title'];
     $description     =  $fields[$i]['description'];
     $content      =  $fields[$i]['content'];
     $date  =  $fields[$i]['date'];
     $first_name  =  $fields[$i]['first_name'];
     $last_name  =  $fields[$i]['last_name'];
     $email  =  $fields[$i]['email'];

     $posts = $dom->createElement('post');
     $posts->setAttribute('id', $id);
     $author_id = $dom->createElement('author_id', $author_id);
     $posts->appendChild($author_id);
     $title  = $dom->createElement('title', $title);
     $posts->appendChild($title);
     $description  = $dom->createElement('description', $description);
     $posts->appendChild($description);
     $content  = $dom->createElement('content', $content);
     $posts->appendChild($content);
     $date = $dom->createElement('date', $date);
     $posts->appendChild($date);
     $first_name = $dom->createElement('first_name', $first_name);
     $posts->appendChild($first_name);
     $last_name = $dom->createElement('last_name', $last_name);
     $posts->appendChild($last_name);
     $email = $dom->createElement('email', $email);
     $posts->appendChild($email);
     $root->appendChild($posts);
   }

   $dom->appendChild($root);
   $dom->save($filePath);

   // json
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
