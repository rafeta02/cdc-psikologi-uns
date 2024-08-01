<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HollandTest extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'holland_tests';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'result_id',
        'r_1',
        'r_2',
        'r_3',
        'r_4',
        'r_5',
        'r_6',
        'r_7',
        'r_8',
        'i_1',
        'i_2',
        'i_3',
        'i_4',
        'i_5',
        'i_6',
        'i_7',
        'i_8',
        'a_1',
        'a_2',
        'a_3',
        'a_4',
        'a_5',
        'a_6',
        'a_7',
        'a_8',
        's_1',
        's_2',
        's_3',
        's_4',
        's_5',
        's_6',
        's_7',
        's_8',
        'e_1',
        'e_2',
        'e_3',
        'e_4',
        'e_5',
        'e_6',
        'e_7',
        'e_8',
        'c_1',
        'c_2',
        'c_3',
        'c_4',
        'c_5',
        'c_6',
        'c_7',
        'c_8',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function result()
    {
        return $this->belongsTo(ResultAssessment::class, 'result_id');
    }
}
