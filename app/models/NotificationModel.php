<?php

class NotificationModel extends Model {
    protected $table = 'notifications';
    protected $primaryKey = 'notificationId';

    public function user() {
        return $this->belongsTo(UserModel::class, 'userId', 'userId');
    }
}