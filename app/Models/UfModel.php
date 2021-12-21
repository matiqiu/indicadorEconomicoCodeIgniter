<?php namespace App\Models;

use CodeIgniter\Model;

class UfModel extends Model
{
    protected $table = 'uf';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['fecha', 'valor'];

    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    protected $updateField = 'updated_at';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
}