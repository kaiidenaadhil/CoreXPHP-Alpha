<div class="data-table">
  <div class="table-container">
    <h2>Display Lead</h2>

    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Lead ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Service Interested</th>
          <th>Status</th>
          <th>Created At</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td><?= htmlspecialchars($lead->leadId) ?></td>
          <td><?= htmlspecialchars($lead->name) ?></td>
          <td><?= htmlspecialchars($lead->email) ?></td>
          <td><?= htmlspecialchars($lead->phone) ?></td>
          <td><?= htmlspecialchars($lead->serviceInterested) ?></td>
          <td><?= ucfirst($lead->status) ?></td>
          <td><?= date('Y-m-d H:i A', strtotime($lead->createdAt)) ?></td>
        </tr>
      </tbody>
    </table>

    <div>
      <aside class="row">
        <a href="<?= ROOT ?>/admin/leads" class="cancel-btn">Back</a>
      </aside>
    </div>
    
  </div>
</div>
