<?php
// PaymentModel.php
class PaymentModel extends Model {
    protected $table = 'payments';
    protected $primaryKey = 'paymentId';

    public function order() {
        return $this->belongsTo(OrderModel::class, 'orderId', 'orderId');
    }
}
