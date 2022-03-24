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
<?php echo form_open_multipart('product/create');?>
  <div class="container">
    <label for="uname"><b>Title</b></label>
    <input type="text" placeholder="Enter Title" name="title" required>

    <label><b>Description</b></label>
    <textarea name="description" id="" cols="30" rows="10" required></textarea>

    <label><b>Image</b></label>
    <input type="file" name="image" required>

    <button type="submit">Create</button>
  </div>
</form>