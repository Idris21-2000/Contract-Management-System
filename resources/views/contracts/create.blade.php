@extends('layouts.app')

@section('title', 'Create Contract')

@section('content')
    <div class="container">
        <h2>Create New Contract</h2>

        @if (session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('contracts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Contract ID -->
            <div class="mb-3">
                <label for="contract_id">Contract ID</label>
                <input type="text" id="contract_id" name="contract_id" value="{{ old('contract_id') }}" required>
            </div>

            <!-- Counterpart Name -->
            <div class="mb-3">
                <label for="counterpart_name">Counterpart Name</label>
                <input type="text" id="counterpart_name" name="counterpart_name" value="{{ old('counterpart_name') }}"
                    required>
            </div>

            <!-- Counsel Comment -->
            <div class="mb-3">
                <label for="counsel_comment">Counsel Comment</label>
                <textarea id="counsel_comment" name="counsel_comment" rows="4" required>{{ old('counsel_comment') }}</textarea>
            </div>

            <!-- Attachment File -->
            <div class="mb-3">
                <label for="attach_file_path">Attachment</label>
                <input type="file" id="attach_file_path" name="attach_file_path">
            </div>

            <!-- Contract Type -->
            <div class="mb-3">
                <label for="contract_type_id">Contract Type</label>
                <select id="contract_type_id" name="contract_type_id" required>
                    <option value="">Select Contract Type</option>
                    @foreach ($contractTypes as $type)
                        <option value="{{ $type->id }}" {{ old('contract_type_id') == $type->id ? 'selected' : '' }}>
                            {{ $type->id }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Assignee -->
            <div class="mb-3">
                <label for="assignees_id">Assignee</label>
                <select id="assignees_id" name="assignees_id" required>
                    <option value="">Select User</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('assignees_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Period of Contract -->
            <div class="mb-3">
                <label for="period_of_contract">Period of Contract (months)</label>
                <input type="number" id="period_of_contract" name="period_of_contract"
                    value="{{ old('period_of_contract') }}" min="1" required>
            </div>

            <!-- Signing Date -->
            <div class="mb-3">
                <label for="signing_date">Signing Date</label>
                <input type="date" id="signing_date" name="signing_date" value="{{ old('signing_date') }}" required>
            </div>

            <!-- Cost -->
            <div class="mb-3">
                <label>Amount:</label>
                <input type="number" name="amount" step="0.01" required>

                <label>Currency:</label>
                <select name="currency" required>
                    @foreach (config('currencies') as $currency)
                        <option value="{{ $currency['code'] }}">
                            {{ $currency['flag'] }} {{ $currency['name'] }} ({{ $currency['symbol'] }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Payment Mode -->
            <div class="mb-3">
                <label for="payment_mode_id">Payment Mode</label>
                <select id="payment_mode_id" name="payment_mode_id" required>
                    <option value="">Select Payment Mode</option>
                    @foreach ($paymentModes as $mode)
                        <option value="{{ $mode->id }}" {{ old('payment_mode_id') == $mode->id ? 'selected' : '' }}>
                            {{ $mode->id }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Payment Type -->
            <div class="mb-3">
                <label for="payment_type_id">Payment Type</label>
                <select id="payment_type_id" name="payment_type_id" required>
                    <option value="">Select Payment Type</option>
                    @foreach ($paymentTypes as $type)
                        <option value="{{ $type->id }}" {{ old('payment_type_id') == $type->id ? 'selected' : '' }}>
                            {{ $type->id }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Implementation Mode -->
            <div class="mb-3">
                <label for="implementation_mode">Implementation Mode</label>
                <select id="implementation_mode" name="implementation_mode" required>
                    <option value="">Select Mode</option>
                    <option value="Support On Call"
                        {{ old('implementation_mode') == 'Support On Call' ? 'selected' : '' }}>Support On Call</option>
                    <option value="Onsite IT Support"
                        {{ old('implementation_mode') == 'Onsite IT Support' ? 'selected' : '' }}>Onsite IT Support
                    </option>
                </select>
            </div>

            <!-- Status -->
            <div class="mb-3">
                <label for="status">Status</label>
                <select id="status" name="status" required>
                    <option value="">Select Status</option>
                    @foreach (['Open', 'Closed', 'Extended', 'Terminated', 'Overdue'] as $status)
                        <option value="{{ $status }}" {{ old('status') == $status ? 'selected' : '' }}>
                            {{ $status }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn-primary">Create Contract</button>
        </form>
    </div>
@endsection
