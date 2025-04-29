<?php

class HomeModel extends Model {
    protected $table = 'users'; // This is set for base Model logic
    protected $primaryKey = 'userId'; // Match the schema

    public function getAllUsers() {
        return QueryBuilder::table($this->table)->get();
    }

    public function getAdmins() {
        return QueryBuilder::table($this->table)
            ->where('role', '=', 'admin')
            ->orderBy('createdAt', 'DESC')
            ->get();
    }

    public function getLatest($limit = 5) {
        return QueryBuilder::table($this->table)
            ->orderBy('createdAt', 'DESC')
            ->limit($limit)
            ->get();
    }

    public function findByEmail($email) {
        return QueryBuilder::table($this->table)
            ->where('email', '=', $email)
            ->first();
    }
}
