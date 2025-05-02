  <div class="data-table">
    <div class="table-container">
      <h2>Create product</h2>
      <form method="post" enctype="multipart/form-data" action="<?= ROOT ?>/admin/product/build">
        <div>
          <label for="productName">Product Name</label>
          <input type="text" name="productName" required>
        </div>
        <div>
          <label for="price">Price</label>
          <input type="number" name="price" required>
        </div>
        <div>
          <label for="stockQuantity">Stock Quantity</label>
          <input type="number" name="stockQuantity" required>
        </div>
        <div>
          <label for="productType">Product Type</label>
          <select name="productType" required>
            <option value="physical">Physical</option>
            <option value="digital">Digital</option>
            <option value="service">Service</option>
          </select>
        </div>
        <div>
          <label for="status">Status</label>
          <select name="status" required>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
          </select>
        </div>
        <div>
          <label for="categoryId">Category Id</label>
          <input type="number" name="categoryId" required>
        </div>
        <div>
          <label for="productImage">Product Image</label>
          <input type="file" name="productImage">
        </div>
        <div><aside class="row">
          <input type="submit" value="Create" class="save-btn">
          <a href="<?= ROOT ?>/admin/product" class="cancel-btn">Back</a>
        </aside></div>
      </form>
    </div>
  </div>
