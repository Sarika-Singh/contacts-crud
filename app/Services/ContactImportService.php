<?php

namespace App\Services;
use App\Repositories\ContactRepositoryInterface;

class ContactImportService
{
    protected $contacts;

    public function __construct(ContactRepositoryInterface $contacts)
    {
        $this->contacts = $contacts;
    }
    public function import($file): int
    {
        
        $xml = simplexml_load_file($file);
        $importedCount = 0;
        foreach ($xml->contact as $contactData) {
            $data = [
                'name' => (string)$contactData->name,
                'phone' => (string)$contactData->phone,
            ];
            $this->contacts->create($data);
            $importedCount++;
        }
        return $importedCount;   
    }
}