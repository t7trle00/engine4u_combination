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
<div id="results" class="listing_detail" style="font-size:1.25em">
  <?php echo form_open_multipart(('host_controller/edit_listing/').$carID); ?>
  <div class="container">
    <div class="row">
      <div class="col-sm-3" style="text-align:right">
        <form enctype="multipart/form-data" method="post">
          <input type="text" name="carID" hidden value="<?php echo $carID ?>">
          <label>TITLE</label>
      </div>
      <div class="col-sm-9">
        <input type="text" name="title" value="<?php echo $id_get_edit[0]['title']?>" size="70" maxlength="30">
      </div>
      <br><br>
    </div>
    <div class="row">
      <div class="col-sm-3" style="text-align:right">
        <label>DESCRIPTION</label>
      </div>
      <div class="col-sm-9">
        <textarea name="description" cols="70" rows="10"><?php echo $id_get_edit[0]['description']?></textarea>
      </div>

    </div>
    <br><br>
    <div class="row">
      <div class="col-sm-3" style="text-align:right">
        <label>COVER PHOTO</label>
      </div>
      <div class="col-sm-9">
        <img src="<?php echo base_url().'cover_gallery/'.$id_get_edit[0]['cover_photo']?>" width="170px" height="170px" alt="">
        <br><br>
        <input type="file" name="cover_photo_update" value="">
      </div>
    </div>
    <br><br>
    <div class="row">
      <div class="col-sm-3" style="text-align:right">
        <label>PHOTO</label>
      </div>
      <div class="col-sm-9">
        <div class="row">
          <?php
          for ($i=0; $i <count($id_get_edit) ; $i++)
          {
            echo '<div class="col-sm-3">';
            echo '<img src="'.base_url().'other_gallery/'.$id_get_edit[$i]['photo']. '" width="170px" height="170px" alt="">';
            echo '<br><br>' ;
            echo '</div>' ;
          }
           ?>
        </div>
         <div class="row">
           <input type="file" name="other_photo[]" value="" multiple>
           <br>
           <p><i>*Note that if you choose new files, all photos will be replaced</i></p>
         </div>

      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-sm-3" style="text-align:right">
        <label>TYPE OF CAR</label>
      </div>
      <div class="col-sm-9">
        <select name="type_of_car" style="width:100px; height:35px;">
          <option value="<?php echo $id_get_edit[0]['type_of_car']?>"><?php echo $id_get_edit[0]['type_of_car']?></option>
          <?php
              if($id_get_edit[0]['type_of_car'] == "10 seats")
              {
                echo '<option value="4 seats">4 seats</option>
                      <option value="7 seats">7 seats</option>' ;
              }
              else if($id_get_edit[0]['type_of_car'] == "7 seats")
              {
                echo '<option value="4 seats">4 seats</option>
                      <option value="10 seats">10 seats</option>' ;
              }
              if($id_get_edit[0]['type_of_car'] == "4 seats")
              {
                echo '<option value="7 seats">7 seats</option>
                      <option value="10 seats">10 seats</option>' ;
              }
              if($id_get_edit[0]['type_of_car'] == "")
              {
                echo '<option value="4 seats">4 seats </option>
                      <option value="7 seats">7 seats</option>
                      <option value="10 seats">10 seats</option>' ;
              }
           ?>
        </select>
      </div>
      <br><br>
    </div>
    <div class="row">
      <div class="col-sm-3" style="text-align:right">
        <label>YEAR</label>
      </div>
      <div class="col-sm-9">
        <input type="number" name="year" style="width:100px"  value="<?php echo $id_get_edit[0]['year']?>">
      </div>
      <br><br>
    </div>
    <div class="row">
      <div class="col-sm-3" style="text-align:right">
        <label>PRICE</label>
      </div>
      <div class="col-sm-9">
        <input type="number" name="price" style="width:100px"  value="<?php echo $id_get_edit[0]['price']?>"> Euro
      </div>
      <br><br>
    </div>
    <div class="row">
      <div class="col-sm-3" style="text-align:right">
        <label>CANCELLATION POLICY</label>
      </div>
      <div class="col-sm-9">
        <select style="width:260px; height:35px;" name="cancellation_policy">
          <option value="<?php echo $id_get_edit[0]['cancellation_policy']?>"><?php echo $id_get_edit[0]['cancellation_policy']?></option>
          <?php
            if($id_get_edit[0]['cancellation_policy'] == "flexible")
            {
              echo '<option value="strict">Strict</option>
                    <option value="moderate">Moderate</option>' ;
            }
            else if($id_get_edit[0]['cancellation_policy'] == "strict")
            {
              echo '<option value="strict">Flexible</option>
                    <option value="moderate">Moderate</option>' ;
            }
            else if($id_get_edit[0]['cancellation_policy'] == "moderate")
            {
              echo '<option value="strict">Strict</option>
                    <option value="flexible">Flexible</option>' ;
            }
            else if($id_get_edit[0]['cancellation_policy'] == "")
            {
              echo '<option value="strict">Strict</option>
                    <option value="moderate">Moderate</option>
                    <option value="flexible">Flexible</option>' ;
            }
          ?>
        </select>
      </div>
      <br><br>
    </div>
    <div class="row">
      <div class="col-sm-6" style="text-align:right">
        <input type="submit" class="btn btn-success" name="submit" value="UPDATE">
        </form>
      </div>
      <div class="col-sm-6">
        <a href="<?php echo site_url('host_controller/get_listing_update')?>">
        <button class="btn btn-info">CANCEL</button></a>
      </div>
      <br><br>
    </div>
  </div>
</div>
