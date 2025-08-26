<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactsTableSeeder extends Seeder
{
    public function run(): void
    {
        $contacts = [
            ['first_name' => 'John', 'last_name' => 'Doe', 'email' => 'john.doe@example.com', 'phone' => '+1-555-0101'],
            ['first_name' => 'Jane', 'last_name' => 'Smith', 'email' => 'jane.smith@example.com', 'phone' => '+1-555-0102'],
            ['first_name' => 'Michael', 'last_name' => 'Johnson', 'email' => 'michael.johnson@example.com', 'phone' => '+1-555-0103'],
            ['first_name' => 'Emily', 'last_name' => 'Davis', 'email' => 'emily.davis@example.com', 'phone' => '+1-555-0104'],
            ['first_name' => 'David', 'last_name' => 'Wilson', 'email' => 'david.wilson@example.com', 'phone' => '+1-555-0105'],
            ['first_name' => 'Sarah', 'last_name' => 'Brown', 'email' => 'sarah.brown@example.com', 'phone' => '+1-555-0106'],
            ['first_name' => 'Robert', 'last_name' => 'Taylor', 'email' => 'robert.taylor@example.com', 'phone' => '+1-555-0107'],
            ['first_name' => 'Lisa', 'last_name' => 'Anderson', 'email' => 'lisa.anderson@example.com', 'phone' => '+1-555-0108'],
            ['first_name' => 'James', 'last_name' => 'Thomas', 'email' => 'james.thomas@example.com', 'phone' => '+1-555-0109'],
            ['first_name' => 'Jennifer', 'last_name' => 'Jackson', 'email' => 'jennifer.jackson@example.com', 'phone' => '+1-555-0110'],
            ['first_name' => 'William', 'last_name' => 'White', 'email' => 'william.white@example.com', 'phone' => '+1-555-0111'],
            ['first_name' => 'Amanda', 'last_name' => 'Harris', 'email' => 'amanda.harris@example.com', 'phone' => '+1-555-0112'],
            ['first_name' => 'Christopher', 'last_name' => 'Martin', 'email' => 'christopher.martin@example.com', 'phone' => '+1-555-0113'],
            ['first_name' => 'Jessica', 'last_name' => 'Thompson', 'email' => 'jessica.thompson@example.com', 'phone' => '+1-555-0114'],
            ['first_name' => 'Daniel', 'last_name' => 'Garcia', 'email' => 'daniel.garcia@example.com', 'phone' => '+1-555-0115'],
            ['first_name' => 'Ashley', 'last_name' => 'Martinez', 'email' => 'ashley.martinez@example.com', 'phone' => '+1-555-0116'],
            ['first_name' => 'Matthew', 'last_name' => 'Robinson', 'email' => 'matthew.robinson@example.com', 'phone' => '+1-555-0117'],
            ['first_name' => 'Nicole', 'last_name' => 'Clark', 'email' => 'nicole.clark@example.com', 'phone' => '+1-555-0118'],
            ['first_name' => 'Andrew', 'last_name' => 'Rodriguez', 'email' => 'andrew.rodriguez@example.com', 'phone' => '+1-555-0119'],
            ['first_name' => 'Stephanie', 'last_name' => 'Lewis', 'email' => 'stephanie.lewis@example.com', 'phone' => '+1-555-0120']
        ];

        foreach ($contacts as $contact) {
            Contact::create($contact);
        }
    }
}
