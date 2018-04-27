<div class="col-lg-4 col-lg-offset-4">
    <h2>Engine4u</h2>
    <?php $fattr = array('class' => 'form-signin');
         echo form_open(site_url().'/user/login/', $fattr); ?>
    <div class="form-group">
      <?php echo form_input(array(
          'name'=>'email',
          'id'=> 'email',
          'placeholder'=>'Email',
          'class'=>'form-control',
          'value'=> set_value('email'))); ?>
      <?php echo form_error('email') ?>
    </div>
    <div class="form-group">
      <?php echo form_password(array(
          'name'=>'password',
          'id'=> 'password',
          'placeholder'=>'Password',
          'class'=>'form-control',
          'value'=> set_value('password'))); ?>
      <?php echo form_error('password') ?>
    </div>
    <?php echo form_submit(array('value'=>'Log in', 'class'=>'btn btn-lg btn-primary btn-block')); ?>
    <?php echo form_close(); ?>
    <p>Don't have an account? Click to <a href="<?php echo site_url();?>/user/register">Register</a></p>
    <p>Click <a href="<?php echo site_url();?>/user/forgot">here</a> if you forgot your password.</p>
</div>
