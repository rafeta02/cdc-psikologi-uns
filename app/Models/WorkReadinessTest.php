<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkReadinessTest extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'work_readiness_tests';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'result_id',
        'cbs_1',
        'cbs_2',
        'cbs_3',
        'cbs_4',
        'cbs_5',
        'cbs_6',
        'cbs_7',
        'cbs_8',
        'cbs_9',
        'cbs_10',
        'cms_1',
        'cms_2',
        'cms_3',
        'cms_4',
        'cs_1',
        'cs_2',
        'cs_3',
        'cs_4',
        'cs_5',
        'cs_6',
        'cs_7',
        'cs_8',
        'cs_9',
        'fs_1',
        'fs_2',
        'fs_3',
        'ics_1',
        'ics_2',
        'ics_3',
        'ics_4',
        'ics_5',
        'its_1',
        'its_2',
        'its_3',
        'ls_1',
        'ls_2',
        'ls_3',
        'ls_4',
        'ls_5',
        'sms_1',
        'sms_3',
        'sms_4',
        'sms_5',
        'sms_7',
        'sms_9',
        'sts_1',
        'sts_2',
        'sts_3',
        'sts_4',
        'tps_2',
        'tps_4',
        'tps_5',
        'tps_6',
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
