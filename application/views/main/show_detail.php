
<div class="show_detail">
    <div class="row">
        <img src="<?php echo base_url().'cover_gallery/'.$show_chosen[0]['cover_photo']?>" width="700px" height="350px">
    </div>
    <div class="row">
        <h1><b><?php echo $show_chosen[0]['title'] ;?> </b></h1>
    </div>
    <div class="row">
        <h3>DESCRIPTION</h3>
    </div>
    <div class="row">
        <?php echo $show_chosen[0]['description'] ;?><br>
    </div>
    <div class="row">
        <h3>PHOTO</h3>
    </div>
    <div class="row">
      <?php
      for ($i=0; $i <count($show_chosen) ; $i++)
      {
        echo '<div class="col-sm-3">';
        echo '<img src="'.base_url().'other_gallery/'.$show_chosen[$i]['photo']. '" width="170px" height="170px" alt="">';
        echo '<br><br>' ;
        echo '</div>' ;
      }
       ?>

    </div>
    <div class="row">
        <h3>TYPE OF CAR </h3>
        <?php
            echo $show_chosen[0]['type_of_car'] ;
         ?>
    </div>
    <div class="row">
        <h3>YEAR </h3>
        <?php
            echo $show_chosen[0]['year'] ;
         ?>
    </div>
    <div class="row">
        <h3>PRICE </h3>
        <?php
            echo $show_chosen[0]['price'] ;
         ?> Euro
    </div>
    <div class="row">
        <h3>CANCELLATION POLICY </h3>
        <?php
            echo $show_chosen[0]['cancellation_policy'] ;
         ?>
    </div>
</div>
