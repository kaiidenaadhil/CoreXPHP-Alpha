  <div class="data-table">
    <div class="table-container">
      <h2>Edit product</h2>
      <?php foreach ($params["product"] as $key => $product) : ?>
      <form method="post" enctype="multipart/form-data" action="<?= ROOT ?>/admin/product/<?= $product['productIdentify'] ?>/modify">
        <div>
          <label for="productName">Product Name</label>
          <input type="text" name="productName" value="<?= $product["productName"] ?>" required>
        </div>
        <div>
          <label for="price">Price</label>
          <input type="number" name="price" value="<?= $product["price"] ?>" required>
        </div>
        <div>
          <label for="stockQuantity">Stock Quantity</label>
          <input type="number" name="stockQuantity" value="<?= $product["stockQuantity"] ?>" required>
        </div>
        <div>
          <label for="productType">Product Type</label>
          <select name="productType" required>
            <option value="physical" <?= $product["productType"] == "physical" ? "selected" : "" ?>>Physical</option>
            <option value="digital" <?= $product["productType"] == "digital" ? "selected" : "" ?>>Digital</option>
            <option value="service" <?= $product["productType"] == "service" ? "selected" : "" ?>>Service</option>
          </select>
        </div>
        <div>
          <label for="status">Status</label>
          <select name="status" required>
            <option value="active" <?= $product["status"] == "active" ? "selected" : "" ?>>Active</option>
            <option value="inactive" <?= $product["status"] == "inactive" ? "selected" : "" ?>>Inactive</option>
          </select>
        </div>
        <div>
          <label for="categoryId">Category Id</label>
          <input type="number" name="categoryId" value="<?= $product["categoryId"] ?>" required>
        </div>
        <div>
          <label for="productImage">Product Image</label>
          <input type="file" name="productImage">
        </div>
        <div><aside class="row">
          <input type="submit" value="Update" class="save-btn">
          <a href="<?= ROOT ?>/admin/product" class="cancel-btn">Back</a>
        </aside></div>
      </form>
      <?php endforeach; ?>
    </div>
  </div>
