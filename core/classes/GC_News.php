<?php
/**
 * Golem CMS - The Rock Solid CMS. <http://darrin.roenfanz.info/golemcms>
 * Copyright (C) 2008 Darrin Roenfanz <darrin@roenfanz.info>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>. 
 */

/*********************************
 * 	News.php
 *
 * A Simple News script class
 *
 * @author		Darrin C. Roenfanz
 * @version		0.1
 */
$news->display(order = 'asc', type = category, limit = 50)
class GC_News 
{
    private $db, $id, $author, $title, $content, $category, $date;

    function __contstruct($db) {
        $this->db = $db;
    }

    function display() {
        $query = 'SELECT id, author, title, content, category, date FROM news ORDER BY date DESC';

        if ($stmt = $this->db->prepare($query)) {
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
        return $news;
    } /* END OF News::Display  */

    function create($author, $title, $content, $category) {
        $query = 'INSERT INTO news(author, title, content, category, date)'
                .'VALUES (?,?,?,?, CURDATE())';

        if ($stmt = $this->db->prepare($query)) {
            $stmt->bind_param('ssss', $author, $title, $content, $category);
            $stmt->execute();
            $stmt->close();
        }
    } /* END OF News::Create  */
    
    function save($id, $author, $title, $content, $category) {
        $query = 'UPDATE news SET author =?, title =?, content=?, category=?, date=? WHERE id=?';
        if ($stmt = $this->db->prepare($query)) {
            $stmt->bind_param('ssssi', $author, $title, $content, $category, $id);
            $stmt->execute();
            $stmt->close();
        }
    
    }
    function delete($id) {
		// Only allow numbers for ID
		if(is_numeric($id))	{
        $query = 'DELETE FROM news WHERE id=? LIMIT 1';
            if ($stmt = $this->db->prepare($query)) {
                $stmt->bind_param('i', $id);
                $stmt->execute();
                $stmt->close();
            }
        }   
    }

  function edit() {
    } /* END OF News::Edit  */

	function convertDate($date) {
		$date_array = explode("-",$date); // split the array
		$y = $date_array[0];
        $m = $date_array[1];
        $d = $date_array[2];

        return $d . '/' . $m . '/' . $y;
	}
} /* END OF Class::News  */
?>