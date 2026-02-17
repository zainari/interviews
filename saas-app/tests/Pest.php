<?php

use Tests\TestCase;

/*
|--------------------------------------------------------------------------
| Pest Configuration
|--------------------------------------------------------------------------
*/

uses(TestCase::class)->in('Feature');

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});