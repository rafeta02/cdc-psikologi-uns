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
        'hci' => 'Minat Pekerjaan',
        'wr' => 'Kesiapan Kerja',
        'cci' => 'Kesiapan Diri dalam Bekerja',
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

    public function hollandTest()
    {
        return $this->hasOne(HollandTest::class, 'result_id');
    }

    public function workReadinessTest()
    {
        return $this->hasOne(WorkReadinessTest::class, 'result_id');
    }

    public function careerConfidenceTest()
    {
        return $this->hasOne(CareerConfidenceTest::class, 'result_id');
    }
}
