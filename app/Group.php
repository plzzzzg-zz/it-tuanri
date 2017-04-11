<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //
    protected $fillable =[
        'leader_name',
        'leader_number',
        'leader_qq',
        'leader_id',
        'leader_college',
        'leader_major',
        'member1_name',
        'member1_number',
        'member1_qq',
        'member1_id',
        'member1_college',
        'member1_major',
        'member2_name',
        'member2_number',
        'member2_qq',
        'member2_id',
        'member2_college',
        'member2_major',
        'member3_name',
        'member3_number',
        'member3_qq',
        'member3_id',
        'member3_college',
        'member3_major',
        'project_type',
        'project_name',
        'group_type',
        'member_num',
        'professional_member_num',
        'unprofessional_member_num',
        'secret-key',
        'url',

    ];
    protected $table = 'groups';
}
