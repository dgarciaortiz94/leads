<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\LeadStatus;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $queryBuilder = DB::table('leads');

        foreach ($request->toArray() as $key => $value) {
            $queryBuilder->orWhere($key, '=', $value);
        }

        $leads = $queryBuilder->get();

        return $leads[0];
    }

    public function store(Request $request)
    {
        $lead = new Lead();

        $lead->status = $request->status;
        $lead->title = $request->title;
        $lead->created_at = new DateTime();

        $lead->save();

        return $lead;
    }

    public function show(int $id)
    {
        $lead = Lead::find($id);

        return $lead;
    }

    public function update(Request $request, int $id)
    {
        $lead = Lead::find($id);
 
        $lead->status = $request->status;
        $lead->title = $request->title;
        
        $lead->save();

        return $lead;
    }

    public function destroy(int $id)
    {
        
    }
}
