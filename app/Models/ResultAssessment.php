<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResultAssessment extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'result_assessments';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const GENDER_RADIO = [
        'male'   => 'Laki - Laki',
        'female' => 'Perempuan',
    ];

    public const TEST_NAME_SELECT = [
        'HCI' => 'Holland Carrer Interest',
        'WR'  => 'Work Readiness',
        'CCI' => 'Career Confidence Inventory',
    ];

    protected $fillable = [
        'user_id',
        'initial',
        'age',
        'gender',
        'field',
        'test_name',
        'result_text',
        'result_description',
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
}
