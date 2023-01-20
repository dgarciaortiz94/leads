<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\LeadStatus;
use App\Services\BracketsParser;
use App\Services\LeadsMailer;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * This class handle leads api CRUD.
 *
 * @author Diego García <dgarciaortiz94@gmail.com>
 * @license https://es.wikipedia.org/wiki/GNU_General_Public_License
 */ 
class LeadController extends Controller
{
    /**
     * Filter and return leads.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $queryBuilder = DB::table('leads');

        foreach ($request->toArray() as $property => $filter) {
            foreach ($filter as $operator => $value) {
                if (BracketsParser::parse($operator) == 'AND') {
                    $queryBuilder->where($property, BracketsParser::parse($operator), $value);
                } else {
                    $queryBuilder->orWhere($property, BracketsParser::parse($operator), $value);
                }
            }
        }

        $leads = $queryBuilder->orderBy('created_at', 'desc')->get();

        return $leads[0]->lead;
    }

    /**
     * Store a lead.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $lead = new Lead();

        $lead->status = $request->status;
        $lead->title = $request->title;
        $lead->created_at = new DateTime();

        $lead->save();

        return $lead;
    }

    /**
     * Show a lead.
     *
     * @param  int  $id
     * 
     * @return JsonResponse
     */
    public function show(int $id)
    {
        $lead = Lead::find($id);

        return $lead;
    }


    /**
     * Close leads with 6 months old
     * 
     * @return JsonResponse
     */
    public function closeLeads()
    {
        $currentDate = new DateTime();
        $formattedCurrentDate = $currentDate->format('Y-m-d H:i:s');

        $sixMonthAgo = date("Y-m-d", strtotime($formattedCurrentDate . "- 6 month")); 

        $queryBuilder = Lead::where('created_at', '<', $sixMonthAgo)
                            ->whereNull('closed_at');

        $leads = $queryBuilder->get();

        $queryBuilder->update(['closed_at' => $formattedCurrentDate]);

        /*
         * I cant test and send emails because of I need a mail server.
         */
        // foreach ($leads as $lead) {
        //     LeadsMailer::basic_email($lead);
        // }

        return $leads;
    }
}
