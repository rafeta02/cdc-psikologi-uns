<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TestMagang extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'test_magangs';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const TYPE_SELECT = [
        'PRETEST'  => 'PRETEST',
        'POSTTEST' => 'POSTTEST',
    ];

    protected $fillable = [
        'mahasiswa_id',
        'magang_id',
        'type',
        'result',
        'q_1',
        'q_2',
        'q_3',
        'q_4',
        'q_5',
        'q_6',
        'q_7',
        'q_8',
        'q_9',
        'q_10',
        'q_11',
        'q_12',
        'q_13',
        'q_14',
        'q_15',
        'q_16',
        'q_17',
        'q_18',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'mahasiswa_id');
    }

    public function magang()
    {
        return $this->belongsTo(MahasiswaMagang::class, 'magang_id');
    }
}
