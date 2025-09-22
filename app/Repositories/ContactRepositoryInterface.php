<?php

namespace App\Repositories;

use App\Models\Contact;

interface ContactRepositoryInterface
{

    public function all();

    public function find($id): ?Contact;

    public function create(array $data): Contact;

    public function update(Contact $contact, array $data): Contact;

    public function delete(Contact $contact): bool;


}