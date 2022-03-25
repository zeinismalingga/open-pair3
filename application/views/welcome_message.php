<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
		text-decoration: none;
	}

	a:hover {
		color: #97310e;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
		min-height: 96px;
	}

	p {
		margin: 0 0 10px;
		padding:0;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

<div id="container">
	<?php echo 'Welcome '. $this->session->userdata('email') ?>
	<br>
	<br>
	<?php if($this->session->userdata('role') == '1'): ?>
	<a href="<?php echo base_url('index.php/product/create') ?>">Create Product</a>
	<br>
	<br>

	<table>
		<tr>
			<td>All Active User :</td>
			<td><?php echo $active_user['0']['total'] ?></td>
		</tr>
		<tr>
			<td>Active User Attached Product:</td>
			<td><?php echo $active_user_attached['0']['total'] ?></td>
		</tr>
		<tr>
			<td>All Active Product :</td>
			<td><?php echo $active_product['0']['total'] ?></td>
		</tr>
		<tr>
			<td>Active Product Which don't Belong to Any User :</td>
			<td><?php echo $active_product_dont_belong['0']['total'] ?></td>
		</tr>
		<tr>
			<td>Amount of all active attached products :</td>
			<td><?php echo $active_attached_products['0']['total'] ?></td>
		</tr>
		<tr>
			<td>Summarized price of all active attached products :</td>
			<td><?php echo $price_active_attached_products['0']['total'] ?></td>
		</tr>
		<tr style="vertical-align: top;">
			<td>Summarized prices of all active products per user :</td>
			<td>
				<?php foreach($price_active_attached_products_peruser as $data): ?>
				<span><?php echo $data['email'] ?> : <?php echo $data['total'] ?></span> <br>
				<?php endforeach ?>
			</td>
		</tr>
		<tr style="vertical-align: top;">
			<td>Exchange rates :</td>
			<td>
				<span>USD : <?php echo $exchange['rates']['USD'] ?></span> <br>
				<span>RON : <?php echo $exchange['rates']['RON'] ?></span> <br>
			</td>
		</tr>
	</table>
	<?php endif ?>

	<?php if($this->session->userdata('role') == '0'): ?>
	<a href="<?php echo base_url('index.php/product_user/create') ?>">Create Product User</a>
	<?php endif ?>
	<br>


	<a href="<?php echo base_url('index.php/auth/logout') ?>">Logout</a>
	
</div>

</body>
</html>
