<?php $this->load->view('menu/header') ; ?>
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
<div id="results" class="addform">
  <form enctype="multipart/form-data" method="POST" id="AddForm">
    <table class="table" id="table_add">
      <tr>
        <td style="text-align:left">TITLE</td>
        <td style="text-align:left">
          <input type="text" name="title" size="70" maxlength="30" required>
          <p><i>A short title is needed to specify your car</i></p>
        </td>
      </tr>
      <tr>
        <td style="text-align:left">DESCRIPTION</td>
        <td style="text-align:left"><textarea name="description" cols="70" rows="10" placeholder="Give short description for your car"></textarea></td>
      </tr>
      <tr>
        <td style="text-align:left">COVER PHOTO</td>
        <td style="text-align:left">
            <input type="file" name="cover_photo" required>
            <p><i>Cover photo will be displayed as main picture for your car</i></p>
        </td>
      </tr>
      <tr>
        <td style="text-align:left">OTHER PHOTOS</td>
        <td style="text-align:left">
            <input type="file" name="other_photo[]" multiple>
            <p><i>Add more photos to specify your car clearly</i></p>
        </td>
      </tr>
      <tr>
        <td style="text-align:left">TYPE OF CAR</td>
        <td style="text-align:left">
          <select name="type_of_car">
              <option value="">Choose an option</option>
              <option value="4 seats">4 seats</option>
              <option value="7 seats">7 seats</option>
              <option value="10 seats">10 seats</option>
          </select>
          <p><i>Give a details about how many seats your car has</i></p>
        </td>
      </tr>
      <tr>
        <td style="text-align:left">YEAR</td>
        <td style="text-align:left">
          <input type="number" name="year">
          <p><i>Year when your car is manufactured</i></p>
        </td>
      </tr>
      <tr>
        <td style="text-align:left">PRICE</td>
        <td style="text-align:left">
          <input type="number" name="price" required>
          <p><i>Note that price is in euro and hour based</i></p>
        </td>
      </tr>
      <tr>
        <td style="text-align:left">CANCELLATION POLICY</td>
        <td style="text-align:left">
          <select style="width:260px; height:35px;" name="cancellation_policy">
            <option value="">Choose option</option>
            <option value="flexible">Flexible</option>
            <option value="moderate">Moderate</option>
            <option value="strict">Strict</option>
          </select>
          <p><i>Depend on your choice of cancellation policy, <br>
            customers are allowed to cancel the reservation in a certain way</i></p>
        </td>
      </tr>
    </table>
  </form>
  <div style="text-align:center">
      <button onclick="AddListing()" class="btn btn-info" style="font-size:1.0em">SAVE</button>
  </div>

  <?php $this->load->view('menu/footer') ; ?>
