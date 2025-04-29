<div class="search-container">
    <form class="search-form" action="<?= ROOT ?>/admin/leads/" method="get">
        <input type="text" name="search" placeholder="Search Leads">
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
    <h3>Lead List</h3>
    <a href="<?= ROOT ?>/admin/leads/create" class="gradient-btn">Add New Lead</a>
</div>

<div class="data-table">
    <div class="table-container">
        <?php if (!empty($leads)) : ?>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Service Interested</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($leads as $index => $lead) : ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= htmlspecialchars($lead->name) ?></td>
                            <td><?= htmlspecialchars($lead->email) ?></td>
                            <td><?= htmlspecialchars($lead->phone) ?></td>
                            <td><?= htmlspecialchars($lead->serviceInterested) ?></td>
                            <td><?= ucfirst($lead->status) ?></td>
                            <td><?= date('Y-m-d H:i A', strtotime($lead->createdAt)) ?></td>
                            <td>
                                <a href="<?= ROOT ?>/admin/leads/<?= $lead->leadId ?>">View</a> |
                                <a href="<?= ROOT ?>/admin/leads/<?= $lead->leadId ?>/edit">Edit</a> |
                                <form action="<?= ROOT ?>/admin/leads/<?= $lead->leadId ?>/delete" method="POST" style="display:inline;">
                                    <button type="submit" onclick="return confirm('Are you sure to delete?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <a href="<?= ROOT ?>/admin/leads/export-csv" class="gradient-btn">Export Leads as CSV</a>

        <?php else : ?>
            <p>No leads found.</p>
            <a href="<?= ROOT ?>/admin/leads/create" class="gradient-btn">Create New Lead</a>
        <?php endif; ?>
    </div>
</div>

<div class="pagination-container">
<?php
$pagination = $params['pagination'] ?? null;
$queryParams = $_GET;

renderPagination($pagination);
?>


</div>
