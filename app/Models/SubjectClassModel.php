<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class SubjectClassModel extends Model
{
    protected $table = 'subject_class';

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static function checkClassSubject($class_id, $subject_id, $created_by_id)
    {
        return SubjectClassModel::where('created_by_id', $created_by_id)
            ->where('class_id', $class_id)
            ->where('subject_id', $subject_id)
            ->where('is_delete', 0)
            ->count();
    }

    static function getSelectedSubject($class_id, $created_by_id)
    {
        return SubjectClassModel::select('subject_class.*', 'subject.name as subject_name')
            ->join('subject', 'subject.id', '=', 'subject_class.subject_id')
            ->where('subject_class.created_by_id', $created_by_id)
            ->where('subject_class.class_id', $class_id)
            ->where('subject_class.is_delete', 0)
            ->get();
    }

    static function deleteClassSubject($class_id, $created_by_id)
    {
        return SubjectClassModel::where('created_by_id', $created_by_id)
            ->where('class_id', $class_id)
            ->delete();
    }





    static public function getRecord($user_id, $user_type)
    {
        $return = self::select('subject_class.*', 'class.name as class_name', 'subject.name as subject_name');
        $return = $return->join('class', 'class.id', '=', 'subject_class.class_id');
        $return = $return->join('subject', 'subject.id', '=', 'subject_class.subject_id');
        if (!empty(Request::get('id'))) {
            $return = $return->where('subject_class.id', '=', Request::get('id'));
        }

        if (!empty(Request::get('class_name'))) {
            $return = $return->where('class.name', 'like', '%' . Request::get('class_name') . '%');
        }

        if (!empty(Request::get('subject_name'))) {
            $return = $return->where('subject.name', 'like', '%' . Request::get('subject_name') . '%');
        }

        if (!empty(Request::get('status'))) {
            $status = Request::get('status');
            if ($status == 100) {
                $status = 0;
            }

            $return->where('subject_class.status', $status);
        }

        $return = $return->where('subject_class.created_by_id', '=', $user_id);

        $return = $return->where('subject_class.is_delete', '=', 0)
            ->orderBy('subject_class.id', 'desc')
            ->Paginate(10);
        return $return;
    }
}
