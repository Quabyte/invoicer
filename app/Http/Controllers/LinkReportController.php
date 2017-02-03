<?php

namespace App\Http\Controllers;

use App\LinkReport;
use Illuminate\Http\Request;

class LinkReportController extends Controller
{
    public function generate()
    {
        LinkReport::generateReport();

        return redirect()->back();
    }

    public function generateKDV()
    {
        LinkReport::generateKDV();

        return redirect()->back();
    }

    public function generateTotal()
    {
        LinkReport::generateTotal();

        return redirect()->back();
    }
}
