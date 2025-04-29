  <div class="data-table">
    <div class="table-container">
      <h2>Create media</h2>
      <form method="post" enctype="multipart/form-data" action="<?= ROOT ?>/admin/media/build">
        <div>
          <label for="media">Media</label>
          <input type="file" name="media">
        </div>
        <div>
          <label for="mediaType">Media Type</label>
          <select name="mediaType" >
            <option value="post">Post</option>
            <option value="product">Product</option>
          </select>
        </div>
        <div><aside class="row">
          <input type="submit" value="Create" class="save-btn">
          <a href="<?= ROOT ?>/admin/media" class="cancel-btn">Back</a>
        </aside></div>
      </form>
    </div>
  </div>
