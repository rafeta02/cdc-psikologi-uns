<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CareerConfidenceTest extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'career_confidence_tests';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'result_id',
        'r_1',
        'r_2',
        'r_3',
        'r_4',
        'i_1',
        'i_2',
        'i_3',
        'i_4',
        'a_1',
        'a_2',
        'a_3',
        'a_4',
        's_1',
        's_2',
        's_3',
        's_4',
        'e_1',
        'e_2',
        'e_3',
        'e_4',
        'c_1',
        'c_2',
        'c_3',
        'c_4',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function result()
    {
        return $this->belongsTo(ResultAssessment::class, 'result_id');
    }
}
