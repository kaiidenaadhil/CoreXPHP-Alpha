<div class="data-table">
  <div class="table-container">
    <h2>Edit Lead</h2>

    <form method="post" action="<?= ROOT ?>/admin/leads/<?= $lead->leadId ?>/update">
      <div>
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="<?= htmlspecialchars($lead->name) ?>" required>
      </div>

      <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?= htmlspecialchars($lead->email) ?>" required>
      </div>

      <div>
        <label for="phone">Phone</label>
        <input type="text" name="phone" id="phone" value="<?= htmlspecialchars($lead->phone) ?>" required>
      </div>

      <div>
        <label for="serviceInterested">Service Interested</label>
        <input type="text" name="serviceInterested" id="serviceInterested" value="<?= htmlspecialchars($lead->serviceInterested) ?>" required>
      </div>

      <div>
        <label for="status">Status</label>
        <select name="status" id="status" required>
          <option value="new" <?= $lead->status === 'new' ? 'selected' : '' ?>>New</option>
          <option value="contacted" <?= $lead->status === 'contacted' ? 'selected' : '' ?>>Contacted</option>
          <option value="converted" <?= $lead->status === 'converted' ? 'selected' : '' ?>>Converted</option>
          <option value="lost" <?= $lead->status === 'lost' ? 'selected' : '' ?>>Lost</option>
        </select>
      </div>

      <div>
        <aside class="row">
          <input type="submit" value="Update" class="save-btn">
          <a href="<?= ROOT ?>/admin/leads" class="cancel-btn">Back</a>
        </aside>
      </div>
    </form>

  </div>
</div>
