<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Launch extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description', 'type_document_id', 'date_document', 'doc_file'
    ];

    public function type_documents()
    {
        return  $this->belongsTo('App\TypeDocument');
    }

    public function hasTypeDocument($type_document_id)
    {        
        if (empty($type_document_id)) {
            return;
        }
        $type_document = TypeDocument::find($type_document_id);
        return $type_document->description;
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'launches_users', 'launch_id', 'user_id')->withTimestamps();
    }
}
