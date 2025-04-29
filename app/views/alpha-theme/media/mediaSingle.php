  <div class="data-table">
  <div class="table-container">
  <h2> Display media </h2>
<table>
  <thead>
    <tr>
      <th>#</th>
      <th>Media Id</th>
      <th>Media</th>
      <th>Media Type</th>
      <th>Medium Created At</th>
      <th>Medium Updated At</th>
      <th>Medium Identify</th>
    </tr>
  </thead>
  <tbody>
<?php foreach($params['media'] as $key => $media): ?>
    <tr>
      <td><?= $key + 1 ?></td>
<td><?= $media['mediaId'] ?></td>
<td><?= $media['media'] ?></td>
<td><?= $media['mediaType'] ?></td>
<td><?= $media['mediumCreatedAt'] ?></td>
<td><?= $media['mediumUpdatedAt'] ?></td>
<td><?= $media['mediumIdentify'] ?></td>
    </tr>
<?php endforeach; ?>
  </tbody>
</table>
</tbody>
</table>
 <div><aside class="row"><a href="<?= ROOT ?>/admin/media" class="cancel-btn">back</a></aside> </div>
</div>
</div>
