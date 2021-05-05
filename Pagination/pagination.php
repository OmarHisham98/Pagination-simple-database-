<!DOCTYPE html>
<html>
  <head>
    <title>Courses</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/placeholder-loading/dist/css/placeholder-loading.min.css">
  </head>
  <body style="background-color:cornflowerblue;">
    <br />
    <div class="container">
      <h3 align="center">Courses</h3>
      <br />
      <div class="card">
        <div class="card-header">Records</div>
        <div class="card-body">
          <div class="form-group">
            <input type="text" name="search_box" id="search_box" class="form-control" placeholder="Search Here" />
          </div>
          <div class="table-responsive" id="table_content">
            
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
<script>
  $(document).ready(function(){

    load_data(1);

    function load_data(page, query = '')
    {
      $.ajax({
        url:"database.php",
        method:"POST",
        data:{page:page, query:query},
        success:function(data) //if requested completed succefully
        {
          $('#table_content').html(data);
        }
      });
    }

    $(document).on('click', '.page-link', function(){//for actions on pagination Links(page numbers) to work
      //var page = $(this).data('page_number');
      var page = $(this).attr("id");
      var query = $('#search_box').val();
      load_data(page, query);
    });

    $('#search_box').keyup(function(){ //data_filter (seen in decreasing number of pages and total records decreasing) to work
      
      // load_data(1, query);
      var query = $('#search_box').val();
        if(query == ""){
            load_data(1);
        }else if(query.length > 2){
            //alert(search_key);
            load_data(1, query);
        }
    });

  });
</script>