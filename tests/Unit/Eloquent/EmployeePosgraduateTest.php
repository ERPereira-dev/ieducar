<?php

namespace Tests\Unit\Eloquent;

use App\Models\Employee;
use App\Models\EmployeePosgraduate;
use Tests\EloquentTestCase;

class EmployeePosgraduateTest extends EloquentTestCase
{
    /**
     * @var array
     */
    protected $relations = [
        'employee' => Employee::class,
    ];

    /**
     * @return string
     */
    protected function getEloquentModelName()
    {
        return EmployeePosgraduate::class;
    }
}