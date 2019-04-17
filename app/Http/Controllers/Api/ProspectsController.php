<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProspectRequest;
use App\Models\Prospect\Prospect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProspectsController extends Controller
{
    public function store(ProspectRequest $request)
    {
        $prospect = auth()->user()->prospects()
                          ->create($request->only([
                              'company_name',
                              'industry',
                              'website',
                              'number_of_employees',
                          ]));

        foreach ($request->contacts as $contact) {
            $prospect->contacts()->create([
                'name'                  => $contact['name'],
                'landline_phone_number' => $contact['landline_phone_number'],
                'mobile_phone_number'   => $contact['mobile_phone_number'],
                'email'                 => $contact['email'],
                'job_title'             => $contact['job_title'],
            ]);
        }

        return $prospect;
    }

    public function update(Request $request, Prospect $prospect)
    {
        if (Gate::allows('view-prospect', $prospect)) {
            $request->validate([
                'company_name'        => 'required',
                'number_of_employees' => 'nullable|numeric',
            ]);

            return tap($prospect)->update($request->only([
                'company_name',
                'industry',
                'website',
                'number_of_employees',
            ]));
        }
    }
}
