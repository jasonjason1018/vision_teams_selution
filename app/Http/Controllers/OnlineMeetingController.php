<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OnlineMeetingServices;

class OnlineMeetingController extends Controller
{
    protected $onlineMeetingService;
    public function __construct()
    {
        $this->onlineMeetingService = new OnlineMeetingServices();
    }
    public function createOnlineMeeting()
    {
        $token = $this->onlineMeetingService->getToken();
        $response = $this->onlineMeetingService->createMeeting($token);

        dd($response);
    }
}
