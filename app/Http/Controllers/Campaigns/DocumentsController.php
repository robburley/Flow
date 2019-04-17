<?php

namespace App\Http\Controllers\Campaigns;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;

class DocumentsController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required',
        ]);

        $file = $request->file('file');

        $class = $request->get('documentable_type');

        $location = '/files/' . (new $class())->getTable() . '/' . $request->get('documentable_id');

        $name = now()->format('U') . '-' . $file->getClientOriginalName();

        $file->storeAs($location, $name);

        Document::create([
            'location'          => $location,
            'name'              => $name,
            'type'              => $request->get('type'),
            'documentable_type' => $request->get('documentable_type'),
            'documentable_id'   => $request->get('documentable_id'),
        ]);

        return redirect()->back();
    }

    public function show(Document $document)
    {
        return response()->download(storage_path('app' . $document->location . '/' . $document->name));
    }
}
