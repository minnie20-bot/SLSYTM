<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request as InputRequest;
class SubjectClassModel extends Model
{
    protected $table = 'subject_class';

    protected $fillable = [
    'class_id',
    'subject_id',
    'status',
    'created_by_id',
    'is_delete'
];

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function checkClassSubject($class_id, $subject_id, $created_by_id)
    {
        return SubjectClassModel::where('created_by_id', $created_by_id)
            ->where('class_id', $class_id)
            ->where('subject_id', $subject_id)
            ->where('is_delete', 0)
            ->count();
    }

    static public function checkClassSubjectSingle($class_id, $subject_id, $created_by_id)
    {
        return SubjectClassModel::where('created_by_id', $created_by_id)
            ->where('class_id', $class_id)
            ->where('subject_id', $subject_id)
            ->where('is_delete', 0)
            ->first();
    }

    static public function getSelectedSubject($class_id, $created_by_id)
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
            ->update(['is_delete' => 1]);    
    }





    static public function getRecord($user_id)
    {
        $return = self::select('subject_class.*', 'class.name as class_name', 'subject.name as subject_name');
        $return = $return->join('class', 'class.id', '=', 'subject_class.class_id');
        $return = $return->join('subject', 'subject.id', '=', 'subject_class.subject_id');
        if (!empty(InputRequest::get('id'))) {
            $return = $return->where('subject_class.id', '=', InputRequest::get('id'));
        }

        if (!empty(InputRequest::get('class_name'))) {
            $return = $return->where('class.name', 'like', '%' . InputRequest::get('class_name') . '%');
        }

        if (!empty(InputRequest::get('subject_name'))) {
            $return = $return->where('subject.name', 'like', '%' . InputRequest::get('subject_name') . '%');
        }

        if (!empty(InputRequest::get('status'))) {
            $status = InputRequest::get('status');
            if ($status == 100) {
                $status = 0;
            }

            $return->where('subject_class.status', $status);
        }

        $return = $return->where('subject_class.created_by_id', '=', $user_id);

        $return = $return->where('subject_class.is_delete', '=', 0)
            ->orderBy('subject_class.id', 'desc')
            ->paginate(10);
        return $return;
    }
}
