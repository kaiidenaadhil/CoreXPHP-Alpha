<?php

// OrderModel.php
class OrderModel extends Model {
    protected $table = 'orders';
    protected $primaryKey = 'orderId';

    public function user() {
        return $this->belongsTo(UserModel::class, 'userId', 'userId');
    }

    public function payments() {
        return $this->hasMany(PaymentModel::class, 'orderId', 'orderId');
    }
}
