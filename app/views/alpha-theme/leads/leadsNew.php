<div class="data-table">
  <div class="table-container">
    <h2>Create Lead</h2>

    <form method="post" action="<?= ROOT ?>/admin/leads">

      <div>
        <label for="name">Name</label>
        <input type="text" name="name" id="name" required>
      </div>

      <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>
      </div>

      <div>
        <label for="phone">Phone</label>
        <input type="text" name="phone" id="phone" required>
      </div>

      <div>
        <label for="serviceInterested">Service Interested</label>
        <input type="text" name="serviceInterested" id="serviceInterested" required>
      </div>

      <div>
        <label for="status">Status</label>
        <select name="status" id="status" required>
          <option value="new">New</option>
          <option value="contacted">Contacted</option>
          <option value="converted">Converted</option>
          <option value="lost">Lost</option>
        </select>
      </div>

      <div>
        <aside class="row">
          <input type="submit" value="Save Lead" class="save-btn">
          <a href="<?= ROOT ?>/admin/leads" class="cancel-btn">Back</a>
        </aside>
      </div>
    </form>

  </div>
</div>
