<div class="search-container">
<form class="search-form" action="<?= ROOT ?>/admin/product/" method="get">
<input type="text" name="search" placeholder="Search">
<button type="submit" class="gradient-btn">Search</button>
</form>
</div>
<div class="data-info">
<?php if (isset($_SESSION['success_message'])): ?>
<p><?= $_SESSION['success_message'] ?></p>
<?php unset($_SESSION['success_message']); ?>
<?php endif; ?>
</div>
<div class="data-info">
<h3>Product List</h3> <a href="<?= ROOT ?>/admin/product/build" class="gradient-btn">add New product</a>
</div>
<div class="data-table">
<div class="table-container">
<?php if (count($params['product']) > 0): ?>
<table>
<thead>
<tr>
<th>#</th>
<th>Product Name</th>
<th>Price</th>
<th>Stock Quantity</th>
<th>Product Type</th>
<th>Status</th>
<th>Category Id</th>
<th>Product Image</th>
<th>Product Created At</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php foreach($params['product'] as $key => $product): ?>
<tr>
<td><?= $key + 1 ?></td>
<td><?= $product['productName'] ?></td>
<td><?= $product['price'] ?></td>
<td><?= $product['stockQuantity'] ?></td>
<td><?= $product['productType'] ?></td>
<td><?= $product['status'] ?></td>
<td><?= $product['categoryId'] ?></td>
<td><?= $product['productImage'] ?></td>
<td><?= $product['productCreatedAt'] ?></td>
<td>
<a href="<?= ROOT ?>/admin/product/<?= $product['productIdentify'] ?>">Show</a>
<a href="<?= ROOT ?>/admin/product/<?= $product['productIdentify'] ?>/modify">Edit</a>
<a href="<?= ROOT ?>/admin/product/<?= $product['productIdentify'] ?>/destroy">Delete</a>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
</div>
<div class="pagination-container">
<?= $params["pagination"] ?>
</div>
<?php else: ?>
<p>No Record to Display.</p>
<a href="<?= ROOT ?>/admin/product/build">Add a Record.</a>
<?php endif; ?>
</div>
