<div class="col-lg-4 col-lg-offset-4">
    <h2>Hello There</h2>
    <h5>Please enter the required information below.</h5>
<?php
    $fattr = array('class' => 'form-signin');
    echo form_open('/user/register', $fattr); ?>
    <div class="form-group">
      <?php echo form_input(array('name'=>'firstname', 'id'=> 'firstname', 'placeholder'=>'First Name', 'class'=>'form-control', 'value' => set_value('firstname'))); ?>
      <?php echo form_error('firstname');?>
    </div>
    <div class="form-group">
      <?php echo form_input(array('name'=>'lastname', 'id'=> 'lastname', 'placeholder'=>'Last Name', 'class'=>'form-control', 'value'=> set_value('lastname'))); ?>
      <?php echo form_error('lastname');?>
    </div>
    <div class="form-group">
      <?php echo form_input(array('name'=>'email', 'id'=> 'email', 'placeholder'=>'Email', 'class'=>'form-control', 'value'=> set_value('email'))); ?>
      <?php echo form_error('email');?>
    </div>
    <div class="form-group">
      <?php echo form_input(array('name'=>'birthdate', 'id'=> 'birthdate', 'placeholder'=>'Date of Birth YYYY-MM-DD', 'class'=>'form-control', 'value'=> set_value('birthdate'))); ?>
      <?php echo form_error('birthdate');?>
    </div>
    <div class="form-group">
      <?php echo form_input(array('name'=>'phone', 'id'=> 'phone', 'placeholder'=>'Phone number', 'class'=>'form-control', 'value'=> set_value('phone'))); ?>
      <?php echo form_error('phone');?>
    </div>
    <div class="form-group">
      <?php echo form_input(array('name'=>'country', 'id'=> 'country', 'placeholder'=>'Country', 'class'=>'form-control', 'value'=> set_value('country'))); ?>
      <?php echo form_error('country');?>
    </div>
    <div class="form-group">
      <?php echo form_input(array('name'=>'city', 'id'=> 'city', 'placeholder'=>'City', 'class'=>'form-control', 'value'=> set_value('city'))); ?>
      <?php echo form_error('city');?>
    </div>
    <div class="form-group">
      <?php echo form_input(array('name'=>'street', 'id'=> 'street', 'placeholder'=>'Street', 'class'=>'form-control', 'value'=> set_value('street'))); ?>
      <?php echo form_error('street');?>
    </div>
    <div class="form-group">
      <?php echo form_input(array('name'=>'postalcode', 'id'=> 'postalcode', 'placeholder'=>'Postal Code', 'class'=>'form-control', 'value'=> set_value('postalcode'))); ?>
      <?php echo form_error('postalcode');?>
    </div>
    <?php echo form_submit(array('value'=>'Sign up', 'class'=>'btn btn-lg btn-primary btn-block')); ?>
    <?php echo form_close(); ?>
</div>
