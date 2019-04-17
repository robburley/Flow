<?php

namespace App\Http\Controllers\Campaigns;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Note;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required',
        ]);

        Note::create([
            'user_id'       => auth()->user()->id,
            'body'          => $request->get('body'),
            'noteable_type' => $request->get('noteable_type'),
            'noteable_id'   => $request->get('noteable_id'),
        ]);

        return redirect()->back();
    }

    public function show(Document $document)
    {
        return $document;
    }
}
