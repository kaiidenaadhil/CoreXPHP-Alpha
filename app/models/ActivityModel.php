<?php

// ActivityModel.php
class ActivityModel extends Model {
    protected $table = 'activities';
    protected $primaryKey = 'activityId';

    public function target() {
        return $this->morphTo('type', 'id');
    }
}