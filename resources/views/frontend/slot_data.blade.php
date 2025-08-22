{{-- @foreach ($slots as $slots)
<div class="col-6 my-3" >
    <div class=""  style="border:1px solid black;padding:5px">
        <span>{{\Carbon\Carbon::parse($slots->from_time)->format('g:i A')}} - {{ \Carbon\Carbon::parse($slots->from_time)->addHour()->format('g:i A')}}</span><br>
        <span>1 Slots Left</span>
    </div>
</div>
@endforeach --}}
<div class=" mt-4">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <!-- Time Slot Title -->
                        <h5 class="section-title">Time Slot</h5>

                        <!-- Afternoon Section -->
                        <div class="row">
                            @foreach ($slots as $slots)
                            <div class="col-sm-12 col-6">
                                <div class="time-slot">
                                    <h6>{{\Carbon\Carbon::parse($slots->from_time)->format('g:i A')}} - {{ \Carbon\Carbon::parse($slots->from_time)->addHour()->format('g:i A')}}</h6>
                                    <p>1 Slots left</p>
                                </div>
                            </div>
                            @endforeach

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

