<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Prospect\Contact;
use App\Models\Prospect\Prospect;
use App\Rules\UniquePhoneNumber;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function store(Request $request, Prospect $prospect)
    {
        $request->validate([
            'name'                  => 'required',
            'landline_phone_number' => [
                'required_without:mobile_phone_number',
                'nullable',
                'phone:AUTO,GB',
                new UniquePhoneNumber(),
            ],
            'mobile_phone_number'   => [
                'required_without:landline_phone_number',
                'nullable',
                'phone:AUTO,GB',
                new UniquePhoneNumber(),
            ],
            'email'                 => 'nullable|email',
        ]);

        return $prospect->contacts()
                        ->create($request->only([
                            'name',
                            'landline_phone_number',
                            'mobile_phone_number',
                            'email',
                            'job_title',
                        ]));
    }

    public function update(Request $request, Prospect $prospect, Contact $contact)
    {
        $request->validate([
            'name'                  => 'required',
            'landline_phone_number' => [
                'required_without:mobile_phone_number',
                'nullable',
                'phone:AUTO,GB',
                new UniquePhoneNumber($contact->id),
            ],
            'mobile_phone_number'   => [
                'required_without:landline_phone_number',
                'nullable',
                'phone:AUTO,GB',
                new UniquePhoneNumber($contact->id),
            ],
            'email'                 => 'nullable|email',
        ]);

        return tap($contact)->update($request->only([
            'name',
            'landline_phone_number',
            'mobile_phone_number',
            'email',
            'job_title',
        ]));
    }

    public function destroy(Request $request, Prospect $prospect, Contact $contact)
    {
        if ($contact->prospect->is($prospect)) {
            $contact->delete();
        }

        return response(['success' => 'true'], 200);
    }
}
