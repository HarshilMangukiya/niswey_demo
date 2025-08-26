<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use SimpleXMLElement;

class XmlImportController extends Controller
{
    public function index()
    {
        return view('contacts.import');
    }

    public function import(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'xml_file' => 'required|file|mimes:xml|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        try {
            $xmlFile = $request->file('xml_file');
            $xmlContent = file_get_contents($xmlFile->getPathname());
            $xml = new SimpleXMLElement($xmlContent);

            $imported = 0;
            $duplicates = 0;
            $errors = 0;

            foreach ($xml->contact as $contactData) {
                $firstName = (string) $contactData->first_name;
                $lastName = (string) $contactData->last_name;
                $email = (string) $contactData->email;
                $phone = (string) $contactData->phone;

                if (empty($firstName) || empty($lastName) || empty($email)) {
                    $errors++;
                    continue;
                }

                $existingContact = Contact::where('email', $email)->first();
                if ($existingContact) {
                    $duplicates++;
                    continue;
                }

                Contact::create([
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'email' => $email,
                    'phone' => $phone ?: null
                ]);

                $imported++;
            }

            if ($imported > 0 && $errors === 0) {
                return redirect()->route('contacts.index')->with('success', 'Contacts imported successfully.');
            }

            if ($imported > 0 && $errors > 0) {
                return redirect()->route('contacts.index')->with('success', 'Contacts imported with some issues.');
            }

            if ($imported === 0 && $duplicates > 0 && $errors === 0) {
                return redirect()->route('contacts.index')->with('success', 'All contacts were already imported.');
            }

            return redirect()->back()->withErrors(['xml_file' => 'Import failed. Please check your XML file.']);

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['xml_file' => 'Invalid XML file format.']);
        }
    }
}
