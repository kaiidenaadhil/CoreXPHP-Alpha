<?php

// ProjectModel.php
class ProjectModel extends Model {
    protected $table = 'projects';
    protected $primaryKey = 'projectId';

    public function user() {
        return $this->belongsTo(UserModel::class, 'userId', 'userId');
    }
}