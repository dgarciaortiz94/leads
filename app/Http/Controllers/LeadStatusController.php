<?php

namespace App\Http\Controllers;

use App\Models\LeadStatus;
use Illuminate\Http\Request;

/**
 * This class handle lead status api CRUD.
 *
 * @author Diego García <dgarciaortiz94@gmail.com>
 * @license https://es.wikipedia.org/wiki/GNU_General_Public_License
 */ 
class LeadStatusController extends Controller
{
    /**
     * Return all lead status.
     * 
     * @return JsonResponse
     */
    public function index()
    {
        $leadStatus = LeadStatus::all();

        return $leadStatus;
    }
}
