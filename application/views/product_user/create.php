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
<?php echo form_open('product_user/create');?>
  <div class="container">
    <select name="id_product">
      <?php foreach($products as $product): ?>
        <option value="<?php echo $product['id']; ?>"><?php echo $product['title']; ?></option>
      <?php endforeach ?>
    </select>

    <label><b>Quantity</b></label>
    <input type="text" placeholder="Enter Quantity" name="qty" required>

    <label><b>Price</b></label>
    <input type="text" placeholder="Enter Quantity" name="price" required>


    <button type="submit">Create</button>
  </div>
</form>