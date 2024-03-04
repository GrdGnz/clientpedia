@extends('layouts.app')

@section('content')
@include('layouts.topbar')

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        
        @include('travelconsultant.sidebar')

    </div>
    <div id="layoutSidenav_content">
        <main class="p-3">
            <p class="h3">VIP - {{ $client['name'] }}</p>
            <hr class="w-100" />

            <div class="table-responsive">
                <table id="officialContactPersons" class="table table-bordered w-100">
                    <thead class="marsman-bg-color-dark text-white">
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Contact No.</th>
                            <th>Email</th>
                            <th>Birthday</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientVips as $vip)
                            <tr>
                                <td>{{ $vip->name }}</td>
                                <td>{{ $vip->designation }}</td>
                                <td>{{ $vip->contact_number }}</td>
                                <td>{{ $vip->email }}</td>
                                <td>{{ \Carbon\Carbon::parse($vip->birthday)->format('F d, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </main>
    </div>
@endsection
