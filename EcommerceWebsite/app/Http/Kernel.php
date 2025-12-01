<?php 

namespace App\Http;

use App\Http\Middleware\CheckLogin; 
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $routeMiddleware = [
        'checklogin' => CheckLogin::class,
    ];
}
