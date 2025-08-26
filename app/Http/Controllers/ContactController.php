<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index()
    {
        return view('contacts.index');
    }

    public function data(Request $request)
    {
        $draw = (int) $request->input('draw', 1);
        $start = (int) $request->input('start', 0);
        $length = (int) $request->input('length', 10);
        $searchValue = $request->input('search.value', '');
        $orderColumnIndex = (int) data_get($request->input('order'), '0.column', 0);
        $orderDir = data_get($request->input('order'), '0.dir', 'asc');

        $orderableColumns = [
            0 => 'first_name',
            1 => 'email',
            2 => 'phone',
            3 => 'created_at',
        ];
        $orderColumn = $orderableColumns[$orderColumnIndex] ?? 'created_at';

        $baseQuery = Contact::query();

        $recordsTotal = (clone $baseQuery)->count();

        if ($searchValue !== '') {
            $baseQuery->where(function ($q) use ($searchValue) {
                $q->where('first_name', 'like', "%$searchValue%")
                  ->orWhere('last_name', 'like', "%$searchValue%")
                  ->orWhere('email', 'like', "%$searchValue%")
                  ->orWhere('phone', 'like', "%$searchValue%");
            });
        }

        $recordsFiltered = (clone $baseQuery)->count();

        $contacts = $baseQuery
            ->orderBy($orderColumn, $orderDir === 'desc' ? 'desc' : 'asc')
            ->skip($start)
            ->take($length)
            ->get();

        $data = $contacts->map(function ($contact) {
            $nameHtml = '<strong>' . e($contact->first_name . ' ' . $contact->last_name) . '</strong>';
            $actionsHtml = '<div class="btn-group" role="group">'
                . '<a href="' . route('contacts.show', $contact->id) . '" class="btn btn-sm btn-info">'
                . '<i class="fas fa-eye"></i>'
                . '</a>'
                . '<a style="margin-left: 5px;" href="' . route('contacts.edit', $contact->id) . '" class="btn btn-sm btn-warning">'
                . '<i class="fas fa-edit"></i>'
                . '</a>'
                . '<button style="margin-left: 5px;" type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal" data-delete-url="' . route('contacts.destroy', $contact->id) . '">'
                . '<i class="fas fa-trash"></i>'
                . '</button>'
                . '</div>';

            return [
                'name' => $nameHtml,
                'email' => e($contact->email),
                'phone' => e($contact->phone ?: 'N/A'),
                'created' => $contact->created_at?->format('M d, Y') ?? '',
                'actions' => $actionsHtml,
            ];
        });

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ]);
    }

    public function create()
    {
        return view('contacts.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:contacts,email',
            'phone' => 'nullable|string|max:20'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Contact::create($request->all());
        return redirect()->route('contacts.index')->with('success', 'Contact added successfully.');
    }

    public function show(string $id)
    {
        $contact = Contact::findOrFail($id);
        return view('contacts.show', compact('contact'));
    }

    public function edit(string $id)
    {
        $contact = Contact::findOrFail($id);
        return view('contacts.edit', compact('contact'));
    }

    public function update(Request $request, string $id)
    {
        $contact = Contact::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:contacts,email,' . $id,
            'phone' => 'nullable|string|max:20'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $contact->update($request->all());
        return redirect()->route('contacts.index')->with('success', 'Contact updated successfully.');
    }

    public function destroy(string $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully.');
    }
}
