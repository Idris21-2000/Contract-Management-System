@extends('layouts.app')

@section('title', 'Contracts List')

@section('content')
    <div class="container">
        <h2>Contracts List</h2>

        <table class="contract-table">
            <thead>
                <tr>
                    <th>Contract ID</th>
                    <th>Counterpart Name</th>
                    <th>Contract Type</th>
                    <th>Assignee</th>
                    <th>Period (Months)</th>
                    <th>Signing Date</th>
                    <th>Renewal Date</th>
                    <th>Remaining Time</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contracts as $contract)
                    <tr>
                        <td>{{ $contract->contract_id }}</td>
                        <td>{{ $contract->counterpart_name }}</td>
                        <td>{{ $contract->contractType->name ?? 'N/A' }}</td>
                        <td>{{ $contract->assignee->name ?? 'N/A' }}</td>
                        <td>{{ $contract->period_of_contract }}</td>
                        <td>{{ \Carbon\Carbon::parse($contract->signing_date)->format('d-m-Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($contract->renewal_date)->format('d-m-Y') }}</td>
                        <td>
                            @php
                                $remainingDays = now()->diffInDays($contract->renewal_date, false);
                                $remainingDays = number_format($remainingDays, 0);
                                $remainingMonths = now()->diffInDays($contract->renewal_date, false) / 30;
                                $remainingMonths = number_format($remainingMonths, 0);
                            @endphp
                            @if ($remainingMonths > 0)
                                {{ $remainingMonths }} months left
                            @elseif ($remainingMonths === 0)
                                Expires this month
                            @else
                                Expired {{ abs($remainingMonths) }} months ago
                            @endif
                        </td>
                        <td>{{ ucfirst($contract->status) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" style="text-align:center;">No contracts found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <style>
        .contract-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        .contract-table th,
        .contract-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .contract-table th {
            background-color: #f8f9fa;
        }

        .contract-table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .contract-table tbody tr:hover {
            background-color: #e6f7ff;
        }
    </style>
@endsection
