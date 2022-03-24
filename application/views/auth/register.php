<?php 

if(validation_errors()){
  ?>
  <div class="alert alert-info text-center">
    <?php echo validation_errors(); ?>
  </div>
  <?php
}

if($this->session->flashdata('message')){
  ?>
  <div class="alert alert-info text-center">
    <?php echo $this->session->flashdata('message'); ?>
  </div>
  <?php
  unset($_SESSION['message']);
}

?>
<form action="<?php base_url('auth/register') ?>" method="post">
  <div class="container">
    <label for="uname"><b>Email</b></label>
    <input type="email" placeholder="Enter Email" name="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>

    <button type="submit">Register</button>
  </div>
</form>