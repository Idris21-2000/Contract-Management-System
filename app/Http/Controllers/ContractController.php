<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\ContractType;
use App\Models\User;
use Carbon\Carbon;
// use App\Models\Cost;
use App\Models\PaymentMode;
use App\Models\PaymentType;

class ContractController extends Controller
{
    public function index()
    {
        $contracts = Contract::with(['contractType', 'assignee', 'paymentMode', 'paymentType'])
            ->orderBy('signing_date', 'desc')
            ->get();

        return view('contracts.index', compact('contracts'));
    }


    public function create()
    {
        // Fetch all required data for dropdowns
        $contractTypes = ContractType::all();
        $users = User::all();
        // $costs = Cost::all();
        $paymentModes = PaymentMode::all();
        $paymentTypes = PaymentType::all();

        return view('contracts.create', compact(
            'contractTypes',
            'users',
            'paymentModes',
            'paymentTypes'
        ));
    }


    public function store(Request $request)
    {
        // Validate inputs
        $request->validate([
            'contract_id' => 'required|string|unique:contracts,contract_id',
            'counterpart_name' => 'required|string|max:255',
            'counsel_comment' => 'required|string',
            'attach_file_path' => 'nullable|file|mimes:pdf,doc,docx,jpg,png',
            'contract_type_id' => 'required|exists:contract_types,id',
            'assignees_id' => 'required|exists:users,id',
            'period_of_contract' => 'required|integer|min:1',
            'signing_date' => 'required|date',
            'renewal_date' => 'required|date|after_or_equal:signing_date',
            'currency' => 'required|string',
            'payment_mode_id' => 'required|exists:payment_modes,id',
            'payment_type_id' => 'required|exists:payment_types,id',
            'implementation_mode' => 'required|in:Support On Call,Onsite IT Support',
            'status' => 'required|in:Open,Closed,Extended,Terminated,Overdue',
        ]);

        // Handle file upload if present
        $filePath = null;
        if ($request->hasFile('attach_file_path')) {
            $filePath = $request->file('attach_file_path')->store('contracts', 'public');
        }

        // Get currency info
        $currencyInfo = collect(config('currencies'))
            ->firstWhere('code', $request->currency);

        if (!$currencyInfo) {
            return back()->withErrors(['currency' => 'Invalid currency selected.']);
        }

        //Combine value with respect currency
        $combined = $request->amount . ' ' . $currencyInfo['symbol'];

        // Auto-calculate renewal date
        $renewalDate = Carbon::parse($request->signing_date)
            ->addMonths($request->period_of_contract);


        // Create contract
        Contract::create([
            'contract_id' => $request->contract_id,
            'counterpart_name' => $request->counterpart_name,
            'counsel_comment' => $request->counsel_comment,
            'attach_file_path' => $filePath,
            'contract_type_id' => $request->contract_type_id,
            'assignees_id' => $request->assignees_id,
            'period_of_contract' => $request->period_of_contract,
            'signing_date' => $request->signing_date,
            'renewal_date' => $renewalDate,
            'cost' => $combined,
            'payment_mode_id' => $request->payment_mode_id,
            'payment_type_id' => $request->payment_type_id,
            'implementation_mode' => $request->implementation_mode,
            'status' => $request->status,
        ]);

        return redirect()->route('contracts.create')->with('success', 'Contract created successfully!');
    }
}
