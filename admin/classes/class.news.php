<?php
/*********************************
 * 	News.php
 *
 * A Simple News script class
 *
 * @author		Darrin C. Roenfanz
 * @version		0.1
 *********************************/

class News {
  private $id, $author, $title, $content, $category, $date;

  function __contstruct() {
    }

  function display() {
    $query = 'SELECT id, author, title, content, category, date FROM news ORDER BY id ASC';
    $mysqli = News::mysqlConnect();
    if ($stmt = $mysqli->prepare($query)) {
        $stmt->execute();               /* execute statement */
        $stmt->bind_result( $id, $author, $title, $content, $category, $date );
        while ($stmt->fetch()) {        /* fetch values */
          $news[] = array( 'id'=> $id,
                           'author'=> $author,
                           'title'=> $title,
                           'content'=>  $content,
                           'category'=>  $category,
                           'date'=> $date ); /* this instead values */
        }
        $stmt->close();                 /* close statement */
    }
    $mysqli->close();
    return $news;
    } /* END OF News::Display  */

  function create($author, $title, $content, $category) {
    $query = 'INSERT INTO news(author, title, content, category, date)'
            .'VALUES (?,?,?,?, CURDATE())';
    $stmt->bind_param('ssss', $author, $title, $content, $category);

    $mysqli = mysqlConnect();

    if ($stmt = $mysqli->prepare($query)) {
      $stmt->execute();
      $stmt->close();
      }
    $mysqli->close();
  } /* END OF News::Create  */

  function delete($id) {
		// Only allow numbers for ID
		if(is_numeric($id))	{
			$query = 'DELETE FROM news WHERE id=? LIMIT 1';
      $stmt->bind_param('i', $id);
      $mysqli = mysqlConnect();

      if ($stmt = $mysqli->prepare($query)) {
        $stmt->execute();
        $stmt->close();
      }
    }
    $mysqli->close();
  }

  function edit() {
    } /* END OF News::Edit  */

  function mysqlConnect() {
  	require_once('../config/config.php');
  	$conn = new mysqli( "$dbHost",	"$dbUsername", "$dbPass",	"$dbName");

  	if (mysqli_connect_errno()) {
  		printf("Unable to connect to MySQL: %s\n", mysqli_connect_error());
  		exit();
  	}
  	return $conn;
  } /* END OF News::mysqlConnect  */

	function convertDate($date) {
		$date_array = explode("-",$date); // split the array
		$y = $date_array[0];
        $m = $date_array[1];
        $d = $date_array[2];

        return $d . '/' . $m . '/' . $y;
	}
} /* END OF Class::News  */
?>