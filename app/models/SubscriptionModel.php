<?php

// SubscriptionModel.php
class SubscriptionModel extends Model {
    protected $table = 'subscriptions';
    protected $primaryKey = 'subscriptionId';

    public function user() {
        return $this->belongsTo(UserModel::class, 'userId', 'userId');
    }
}