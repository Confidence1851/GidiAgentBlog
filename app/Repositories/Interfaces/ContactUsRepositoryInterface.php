<?php

namespace App\Repositories\Interfaces;

interface ContactUsRepositoryInterface
{
    /**
     * Store contact us form data
     *
     * @param int
     */
    public function store(array $pcontact_us_data);


}
