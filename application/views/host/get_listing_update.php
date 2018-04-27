<div class="hostNav" style="text-align:center">
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <ul class="nav navbar-nav">
        <li><a class="pointer" onclick="getListing('html')">View your listing</button></a></li>
        <li><a href="<?php echo site_url('host_controller/add_listing') ;?>">Add new listing</a></li>
        <li><a class="pointer" href="<?php echo site_url('host_controller/get_listing_update')?>">Edit your listing</a></li>
        <li><a class="pointer" onclick="getListingDelete('html')">Delete your listing</a></li>
      </ul>
    </div>
  </nav>
</div>
<div id="results">
  <table border="1" align="center" class="getListing">
    <th>ID</th>
    <th>TITLE</th>
    <th>EDIT</th>
    <?php
      foreach ($images as $row ) {
        ?>
        <tr>
        <td><?php echo $row['carID'] ;?></td>
        <td><?php echo $row['title'] ;?></td>
        <td><a href="<?php echo site_url('host_controller/listing_detail/').$row['carID']?>">
          <button class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span></button></td></a>
        </tr>
      <?php
        }
       ?>
  </table>
</div>
