<style>
    body {
        font-family: Arial, sans-serif;
        background: #f2f2f2;
        margin: 0;
        padding: 20px;
    }
    h1, h2 {
        color: #333;
    }
    .card-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }
    .card {
        background: #fff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        width: 300px;
        transition: transform 0.2s;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .card strong {
        color: #555;
    }
    .card p {
        margin: 5px 0;
    }
</style>

<h1>User Details</h1>
<p><strong>Name:</strong> <?= htmlspecialchars($user->name) ?></p>
<p><strong>Email:</strong> <?= htmlspecialchars($user->userEmail) ?></p>

<hr>

<h2>Projects</h2>
<div class="card-container">
<?php if (!empty($projects)): ?>
    <?php foreach ($projects as $project): ?>
        <div class="card">
            <p><strong>Project Name:</strong> <?= htmlspecialchars($project->projectName) ?></p>
            <p><strong>Type:</strong> <?= htmlspecialchars($project->projectType) ?></p>
            <p><strong>Status:</strong> <?= htmlspecialchars($project->status) ?></p>
            <p><strong>Budget:</strong> $<?= htmlspecialchars($project->budget) ?></p>
            <p><strong>Deadline:</strong> <?= htmlspecialchars($project->deadline) ?></p>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>No projects found.</p>
<?php endif; ?>
</div>

<h2>Subscriptions</h2>
<div class="card-container">
<?php if (!empty($subscriptions)): ?>
    <?php foreach ($subscriptions as $subscription): ?>
        <div class="card">
            <p><strong>Plan:</strong> <?= htmlspecialchars($subscription->planName) ?></p>
            <p><strong>Price:</strong> $<?= htmlspecialchars($subscription->price) ?></p>
            <p><strong>Status:</strong> <?= htmlspecialchars($subscription->status) ?></p>
            <p><strong>Start:</strong> <?= htmlspecialchars($subscription->startDate) ?></p>
            <p><strong>End:</strong> <?= htmlspecialchars($subscription->endDate) ?></p>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>No subscriptions found.</p>
<?php endif; ?>
</div>

<h2>Orders</h2>
<div class="card-container">
<?php if (!empty($orders)): ?>
    <?php foreach ($orders as $order): ?>
        <div class="card">
            <p><strong>Order ID:</strong> <?= htmlspecialchars($order->orderId) ?></p>
            <p><strong>Amount:</strong> $<?= htmlspecialchars($order->amount) ?></p>
            <p><strong>Status:</strong> <?= htmlspecialchars($order->status) ?></p>
            <p><strong>Created At:</strong> <?= htmlspecialchars($order->createdAt) ?></p>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>No orders found.</p>
<?php endif; ?>
</div>
