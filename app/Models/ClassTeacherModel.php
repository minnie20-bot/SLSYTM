<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class ClassTeacherModel extends Model
{
    protected $table = 'class_teacher';

    protected $fillable = [
        'class_id',
        'teacher_id',
        'subject_class_id',
        'status',
        'created_by_id'
    ];

    static public function getSingle($id)
    {
        return self::where('id', $id)
        ->where('is_delete', 0)
        ->first();
    }

    static function checkClassTeacher($created_by_id, $class_id, $teacher_id)
    {
        return self::where('created_by_id', $created_by_id)
            ->where('class_id', $class_id)
            ->where('teacher_id', $teacher_id)
            ->where('is_delete', 0)
            ->first();
    }

    static function checkClassTeacherSingle($created_by_id, $class_id, $teacher_id)
    {
        return self::where('created_by_id', $created_by_id)
            ->where('class_id', $class_id)
            ->where('teacher_id', $teacher_id)
            ->where('is_delete', 0)
            ->first();
    }

    static function getSelectedTeacher($class_id, $created_by_id)
    {
        return ClassTeacherModel::select('class_teacher.*', 'users.name as teacher_name', 'users.last_name as teacher_last_name')
            ->join('users', 'users.id', '=', 'class_teacher.teacher_id')
            ->where('class_teacher.created_by_id', $created_by_id)
            ->where('class_teacher.class_id', $class_id)
            ->where('class_teacher.is_delete', 0)
            ->get();
    }

    static function deleteClassTeacher($class_id, $created_by_id)
    {
        return ClassTeacherModel::where('created_by_id', $created_by_id)
            ->where('class_id', $class_id)
            ->delete();
    }

    static function getRecordTeacher($teacher_id)
{
    $return = self::select(
        'class_teacher.*',
        'class.name as class_name',
        'users.name as teacher_name',
        'subject.name as subject_name',
        'subject.type as subject_type',
        'subject_class.subject_id as subject_id'
    );

    $return = $return->join('class', 'class.id', '=', 'class_teacher.class_id');
    $return = $return->join('users', 'users.id', '=', 'class_teacher.teacher_id');
    $return = $return->leftJoin('subject_class', 'subject_class.id', '=', 'class_teacher.subject_class_id');
    $return = $return->leftJoin('subject', 'subject.id', '=', 'subject_class.subject_id');

    if (!empty(Request::get('class_name'))) {
        $return = $return->where('class.name', 'like', '%' . Request::get('class_name') . '%');
    }

    if (!empty(Request::get('subject_name'))) {
        $return = $return->where('subject.name', 'like', '%' . Request::get('subject_name') . '%');
    }

    $return = $return->where('class_teacher.teacher_id', $teacher_id)
        ->where('class_teacher.is_delete', 0)
        ->where('class_teacher.status', 1)
        ->orderBy('class_teacher.id', 'desc')
        ->paginate(10);

    return $return;
}


    static public function getRecord($user_id, $user_type)
    {
        $return = self::select('class_teacher.*', 'class.name as class_name', 'users.name as teacher_name', 'users.last_name as teacher_last_name');
        $return = $return->join('class', 'class.id', '=', 'class_teacher.class_id');
        $return = $return->join('users', 'users.id', '=', 'class_teacher.teacher_id');
        if (!empty(Request::get('id'))) {
            $return = $return->where('class_teacher.id', '=', Request::get('id'));
        }

        if (!empty(Request::get('class_name'))) {
            $return = $return->where('class.name', 'like', '%' . Request::get('class_name') . '%');
        }

        if (!empty(Request::get('teacher_name'))) {
            $return = $return->where('users.name', 'like', '%' . Request::get('teacher_name') . '%');
        }

        if (!empty(Request::get('status'))) {
            $status = Request::get('status');
            if ($status == 100) {
                $status = 0;
            }

            $return->where('class_teacher.status', $status);
        }

        $return = $return->where('class_teacher.created_by_id', '=', $user_id);

        $return = $return->where('class_teacher.is_delete', '=', 0)
            ->orderBy('class_teacher.id', 'desc')
            ->Paginate(10);
        return $return;
    }
}
