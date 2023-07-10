<?php require_once('header.php'); ?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Nearly Expire Products</h1>
	</div>
	<div class="content-header-right">
		<a href="product-add.php" class="btn btn-primary btn-sm">Add Product</a>
	</div>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-info">
				<div class="box-body table-responsive">
					<table id="example1" class="table table-bordered table-hover table-striped">
					<thead class="thead-dark">
							<tr>
								<th width="10">#</th>
								<th width="10">ID</th>
								<th width="160">Photo</th>
								<th width="160">Product Name</th>
							
							
								<th >Quantity</th>
								<th>Expiry</th>
								<th >Purchase Date</th>
							</tr>
						</thead>
						<tbody> 
							<?php
							$StartDate = date('Y-m-01', time());
							$EndDate = date('Y-m-31', time());
							$i=0;
							$statement = $pdo->prepare("
														SELECT p_id,p_featured_photo, p_name, p_qty, expiry, Purchase_Date FROM tbl_product

														Where 
														expiry BETWEEN '" . $StartDate . "' AND  '" . $EndDate . "'

							                           	");
							$statement->execute();
							$result = $statement->fetchAll(PDO::FETCH_ASSOC);
							foreach ($result as $row) {
								$i++;
								?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $row['p_id']; ?></td>



									<td style="width:82px;">
										<img src="../assets/uploads/<?php echo $row['p_featured_photo']; ?>" alt="<?php echo $row['p_name']; ?>" style="width:80px;"></td>
									<td><?php echo $row['p_name']; ?></td>
									<td><?php echo $row['p_qty']; ?></td>
									
									<td>
										<?php echo $row['expiry']; ?>
									</td>
									<td>
										<?php echo $row['Purchase_Date']; ?>
									</td>
								</tr>
								<?php
							}
							?>							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>


<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure want to delete this item?</p>
                <p style="color:red;">Be careful! This product will be deleted from the order table, payment table, size table, color table and rating table also.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>