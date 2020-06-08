<?php

namespace App\Repositories;

use App\Models\ContactUs;
use App\Repositories\Interfaces\ContactUsRepositoryInterface;

class ContactUsRepository implements ContactUsRepositoryInterface
{

    /**
     * Store contact form data
     *
     * @param int
     * @return collection
     */
    public function store(array $contact_us_data)
    {
        return ContactUs::create($contact_us_data);
    }


}
