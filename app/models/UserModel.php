<?php

// UserModel.php
class UserModel extends Model {
    protected $table = 'users';
    protected $primaryKey = 'userId';

    public function projects() {
        return $this->hasMany(ProjectModel::class, 'userId', 'userId');
    }

    public function subscriptions() {
        return $this->hasMany(SubscriptionModel::class, 'userId', 'userId');
    }

    public function orders() {
        return $this->hasMany(OrderModel::class, 'userId', 'userId');
    }
}