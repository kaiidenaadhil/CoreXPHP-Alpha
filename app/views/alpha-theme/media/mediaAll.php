<div class="search-container">
<form class="search-form" action="<?= ROOT ?>/admin/media/" method="get">
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
<h3>Media List</h3> <a href="<?= ROOT ?>/admin/media/build" class="gradient-btn">add New media</a>
</div>
<div class="data-table">
<div class="table-container">
<?php if (count($params['media']) > 0): ?>
<table>
<thead>
<tr>
<th>#</th>
<th>Media</th>
<th>Media Type</th>
<th>Medium Created At</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php foreach($params['media'] as $key => $media): ?>
<tr>
<td><?= $key + 1 ?></td>
<td><?= $media['media'] ?></td>
<td><?= $media['mediaType'] ?></td>
<td><?= $media['mediumCreatedAt'] ?></td>
<td>
<a href="<?= ROOT ?>/admin/media/<?= $media['mediumIdentify'] ?>">Show</a>
<a href="<?= ROOT ?>/admin/media/<?= $media['mediumIdentify'] ?>/modify">Edit</a>
<a href="<?= ROOT ?>/admin/media/<?= $media['mediumIdentify'] ?>/destroy">Delete</a>
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
<a href="<?= ROOT ?>/admin/media/build">Add a Record.</a>
<?php endif; ?>
</div>
