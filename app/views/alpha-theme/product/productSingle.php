  <div class="data-table">
  <div class="table-container">
  <h2> Display product </h2>
<table>
  <thead>
    <tr>
      <th>#</th>
      <th>Product Id</th>
      <th>Product Name</th>
      <th>Price</th>
      <th>Stock Quantity</th>
      <th>Product Type</th>
      <th>Status</th>
      <th>Category Id</th>
      <th>Product Image</th>
      <th>Product Created At</th>
      <th>Product Updated At</th>
      <th>Product Identify</th>
    </tr>
  </thead>
  <tbody>
<?php foreach($params['product'] as $key => $product): ?>
    <tr>
      <td><?= $key + 1 ?></td>
<td><?= $product['productId'] ?></td>
<td><?= $product['productName'] ?></td>
<td><?= $product['price'] ?></td>
<td><?= $product['stockQuantity'] ?></td>
<td><?= $product['productType'] ?></td>
<td><?= $product['status'] ?></td>
<td><?= $product['categoryId'] ?></td>
<td><?= $product['productImage'] ?></td>
<td><?= $product['productCreatedAt'] ?></td>
<td><?= $product['productUpdatedAt'] ?></td>
<td><?= $product['productIdentify'] ?></td>
    </tr>
<?php endforeach; ?>
  </tbody>
</table>
</tbody>
</table>
 <div><aside class="row"><a href="<?= ROOT ?>/admin/product" class="cancel-btn">back</a></aside> </div>
</div>
</div>
