<?php

class LeadModel extends Model
{
    protected $table = 'leads';
    protected $primaryKey = 'leadId';

    // ✅ Fillable fields
    protected array $fields = [
        'name',
        'email',
        'phone',
        'serviceInterested',
        'status',
        'createdAt'
    ];

    // ❌ Guarded fields (cannot be mass-assigned)
    protected array $guarded = [
        'leadId'
    ];

    // 🔍 Searchable fields
    protected array $filters = [
        'name',
        'email',
        'phone',
        'serviceInterested',
        'status'
    ];


    protected array $validationRules = [
        'name'              => 'required|max:100',
        'email'             => 'required|email|unique:leads,email',
        'phone'             => 'required|min:10|max:20',
        'serviceInterested' => 'required|in:Web Development,App Development,SEO,Other',
        'status'            => 'required|in:new,converted,lost',
        'createdAt'         => ''
    ];
}
