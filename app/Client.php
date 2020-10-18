<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    const TYPE_INDIVIDUAL = 'Individual';

    const TYPE_LEGAL = 'Legal';

    const MARITAL_STATUS = [
        1 => 'Solteiro',
        2 => 'Casado',
        3 => 'Divorciado'
    ];

    protected $fillable = [
        'name',
        'document',
        'email',
        'phone',
        'defaulter',
        'dateBirth',
        'gender',
        'maritalStatus',
        'physicalDesability',
        'companyName',
        'clientType'
    ];

    public static function getClientType($type)
    {
        return $type == Client::TYPE_LEGAL ? $type : Client::TYPE_INDIVIDUAL;
    }
}
