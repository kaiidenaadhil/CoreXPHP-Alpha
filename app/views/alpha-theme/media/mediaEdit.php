  <div class="data-table">
    <div class="table-container">
      <h2>Edit media</h2>
      <?php foreach ($params["media"] as $key => $media) : ?>
      <form method="post" enctype="multipart/form-data" action="<?= ROOT ?>/admin/media/<?= $media['mediumIdentify'] ?>/modify">
        <div>
          <label for="media">Media</label>
          <input type="file" name="media">
        </div>
        <div>
          <label for="mediaType">Media Type</label>
          <select name="mediaType" >
            <option value="post" <?= $media["mediaType"] == "post" ? "selected" : "" ?>>Post</option>
            <option value="product" <?= $media["mediaType"] == "product" ? "selected" : "" ?>>Product</option>
          </select>
        </div>
        <div><aside class="row">
          <input type="submit" value="Update" class="save-btn">
          <a href="<?= ROOT ?>/admin/media" class="cancel-btn">Back</a>
        </aside></div>
      </form>
      <?php endforeach; ?>
    </div>
  </div>
