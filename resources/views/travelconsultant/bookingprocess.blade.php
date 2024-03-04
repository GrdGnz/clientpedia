@extends('layouts.app')

@section('content')
@include('layouts.topbar')

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        
        @include('travelconsultant.sidebar')

    </div>
    <div id="layoutSidenav_content">
        <main class="p-3">
            <p class="h3">BOOKING PROCESS - {{ $client['name'] }}</p>
            <hr class="w-100" />

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link txt-2 active" id="international-tab" data-bs-toggle="tab" data-bs-target="#international-tab-pane" type="button" role="tab" aria-controls="international-tab-pane" aria-selected="true">International</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link txt-2" id="domestic-tab" data-bs-toggle="tab" data-bs-target="#domestic-tab-pane" type="button" role="tab" aria-controls="domestic-tab-pane" aria-selected="false">Domestic</button>
                </li>
            </ul>
            <div class="tab-content py-3 p-3" id="myTabContent">
                <div class="tab-pane fade show active" id="international-tab-pane" role="tabpanel" aria-labelledby="international-tab" tabindex="0">
                    <!-- First tab -->
                    
                    <p class="fs-3 h5">International</p>
                    <p>Modified by:</p>
                    <div class="mb-3">
                        <label for="" class="form-label"></label>
                        <textarea class="form-control txt-1" name="" id="" rows="3"></textarea>
                    </div>  

                    <!-- First tab end -->
                </div>
                <div class="tab-pane fade" id="domestic-tab-pane" role="tabpanel" aria-labelledby="domestic-tab" tabindex="0">
                    <!-- Second tab -->

                    <p class="fs-3 h5">Domestic</p>
                    <p>Modified by:</p>
                    <div class="mb-3">
                    <label for="" class="form-label"></label>
                    <textarea class="form-control txt-1" name="" id="" rows="3"></textarea>

                    <!-- Second tab end -->
                </div>
            </div> 

        </main>
    </div>
</div>
@endsection
