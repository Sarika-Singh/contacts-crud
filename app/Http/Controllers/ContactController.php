<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Repositories\ContactRepositoryInterface;
use App\Services\ContactImportService;

class ContactController extends Controller
{
    protected $contacts;
    public function __construct(ContactRepositoryInterface $contacts){
        $this->contacts = $contacts;
    }

    public function index(){
        return response()->json($this->contacts->all());
    }

    public function create(){
    }

    public function store(StoreContactRequest $request){
        $contact = $this->contacts->create($request->validated());
        return response()->json($contact, 201);
    }

    public function show(string $id){
        $contact = $this->contacts->find($id);
        return $contact ? response()->json($contact) : response()->json(['error' => 'Not found'], 404);
    }

    public function edit(string $id){
    }

    public function update(UpdateContactRequest $request, string $id){
        $contact = $this->contacts->find($id);
        if (!$contact) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        $contact = $this->contacts->update($contact, $request->validated());
        return response()->json($contact, 200);
    }

    public function destroy(string $id){
        $contact = $this->contacts->find($id);
        if (!$contact) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        $this->contacts->delete($contact);
        return response()->json(['message' => 'Deleted successfully']);
    }

    public function import(Request $request, ContactImportService $importService){
       $request->validate([
              'file' => 'required|file',
       ]);
       $file = $request->file('file');
        try {
            $xml = simplexml_load_file($file->getRealPath());
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid file, Please provide a Valid XML File'], 422);
        }
       $count = $importService->import($file);
       return response()->json(['imported'=>$count,'message' => "$count contacts imported successfully"], 200);
    }
}
