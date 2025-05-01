<?php
class DummyModelWithTable extends Model
{
    protected $table = 'leads';  // Table name
    protected $primaryKey = 'leadId';  // Correct primary key
}
