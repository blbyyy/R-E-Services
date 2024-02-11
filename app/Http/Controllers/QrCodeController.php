<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use DB;
use File;
use Auth;

class QrCodeController extends Controller
{
    public function index()
    {
      return View::make('qrcode.index');
    }
}
