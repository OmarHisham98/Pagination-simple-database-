<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "university2";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {

  die("Connection failed: " . $conn->connect_error);
}


$limit = 5; //displays 5 records 



if(isset($_POST['page'])){
  $page = $_POST['page'];
  $start = ($page - 1) * $limit; 
}else{
  $page = 1;
  $start = 0;
}





$query = "
 SELECT course.course_name, course.course_description, course.course_id,department.department_name, professor.professor_name
 FROM course
 JOIN department ON department.department_id = course.department_id
 JOIN professor ON professor.professor_id = course.professor_id
";

if($_POST['query'] != '')
{
  $search_query = $_POST['query'];
  $query .= "
                WHERE (course.course_name
                       LIKE '%$search_query%'
                       OR
                       course.course_description
                       LIKE '%$search_query%'
                       OR
                       department.department_name
                       LIKE '%$search_query%'
                       OR
                       professor.professor_name
                       LIKE '%$search_query%')
                       OR
                      (REPLACE(course.course_name, ' ', '')
                       LIKE '%$search_query%'
                       OR
                       REPLACE(course.course_description, ' ', '')
                       LIKE '%$search_query%'
                       OR
                       REPLACE(department.department_name, ' ', '')
                       LIKE '%$search_query%'
                       OR
                       REPLACE(professor.professor_name, ' ', '')
                       LIKE '%$search_query%')
            ";
  
}


$query .= 'ORDER BY course.course_id ';

$filter_query = $query . 'LIMIT '.$start.', '.$limit.'';

$statement = mysqli_query($conn,$query);


$filter_statement = mysqli_query($conn,$filter_query);
$total_filter_data = mysqli_num_rows($filter_statement);

$output = '';
if($total_filter_data > 0)
{
    $output .= '
        <style>
        table{

        border-collapse: collapse;
        width: 100%;
        color: #588c7e;
        font-family: monospace;
        font-size: 25px;
        text-align: left;
        }

        th{

        background-color: #588c7e;
        color: white
        }
        </style>
        <table class="table table-bordered border-primary">
          <tr>
          <th>course ID</th>
          <th>course name</th>
          <th>course description</th>
          <th>professor name</th>
          <th>department_name</th>
          </tr>
        ';
  while($row=mysqli_fetch_assoc($filter_statement))
  {

    $output .= "
    <tr>
      <td>{$row['course_id']}</td>
      <td>{$row['course_name']}</td>
      <td>{$row['course_description']}</td>
      <td>{$row['professor_name']}</td>
      <td>{$row['department_name']}</td>
    </tr>
    ";
  }
}
else
{
  $output .= '
  <tr>
    <td colspan="2" align="center">No Records in Datbase</td>
  </tr>
  ';
}

$output .= '
</table>
<br />
<div align="center">
  <ul class="pagination">
';

$total_pages = ceil(mysqli_num_rows($statement)/$limit); //calculates total no. of pagination links
$previous_link = '';
$next_link = '';
$page_link = '';


$previous_tag = $page - 1;
if($previous_tag > 0){
  $previous_link ="
                        <li class='page-item'>
                            <a class='page-link' id='$previous_tag'>Previous</a>
                        </li>
                    ";
}else{
  $previous_link = "
                    <li class='page-item disabled'>
                        <a class='page-link'>Previous</a>
                    </li>
                ";

}




for($cur_page = 1; $cur_page <= $total_pages; $cur_page++){
  if($cur_page == $page){
      $page_link .= '
          <li class="page-item active">
              <a class="page-link">'.$cur_page.'</a>
          </li>
      ';
  }else{
      $page_link .= "
          <li class='page-item'>
              <a class='page-link' id='$cur_page'>$cur_page</a>
          </li>
      ";
  }
}

$next_tag = $page + 1;
if($next_tag <= $total_pages){
  $next_link ="
                        <li class='page-item'>
                            <a class='page-link' id='$next_tag'>Next</a>
                        </li>
                    ";
}else{
  $next_link = "
                    <li class='page-item disabled'>
                        <a class='page-link'>Next</a>
                    </li>
                ";

}


$output .= $previous_link . $page_link . $next_link;
$output .= '
  </ul>

</div>
';

echo $output;

?>
