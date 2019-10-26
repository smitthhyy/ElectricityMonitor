@extends('layouts.admin')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-3">
                <div class="card bg-light mb-3">
                    <div class="card-header">Cost last hour</div>
                    <div class="card-body">
                        <p class="card-text h1">Total: <span id="total"></span></p>
                        <p class="card-text h3">Phase 1: <span id="ch1"></span></p>
                        <p class="card-text h3">Phase 2: <span id="ch2"></span></p>
                        <p class="card-text h3">Phase 3: <span id="ch3"></span></p>
                        <p class="card-text">As at: <span id="asAt"></span></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card bg-light mb-3">
                    <div class="card-header">Cost last hour</div>
                    <div class="card-body">
                        <p class="card-text h1">Total: <span id="totalCostLastHour"></span></p>
                        <p class="card-text h3">Phase 1: <span id="ch1CostLastHour"></span></p>
                        <p class="card-text h3">Phase 2: <span id="ch2CostLastHour"></span></p>
                        <p class="card-text h3">Phase 3: <span id="ch3CostLastHour"></span></p>
                        <p class="card-text">As at: <span id="asAtCostLastHour"></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/4.3.0/echarts-en.min.js"></script>
    <script>
        window.setInterval(function(){
            $.ajax({url: "{{ route('admin.infeeds.last') }}", success: function(result){
                    console.log(result);
                    console.log(result['id']);
                    $("#asAt").html(result.created_at);
                    $("#ch1").html(result.ch_1 + " watts");
                    $("#ch2").html(result.ch_2 + " watts");
                    $("#ch3").html(result.ch_3 + " watts");
                    let total = result.ch_1 + result.ch_2 + result.ch_3;
                    $("#total").html(total + " watts");
                }});
        }, 6000);
        window.setInterval(function(){
            $.ajax({url: "{{ route('admin.infeeds.costlasthour') }}", success: function(result){
                    console.log(result);
                    console.log(result['id']);
                    $("#asAtCostLastHour").html(result.created_at);
                    $("#ch1CostLastHour").html(result.ch1 + " watts cost $" + result.ch1Cost);
                    $("#ch2CostLastHour").html(result.ch2 + " watts cost $" + result.ch2Cost);
                    $("#ch3CostLastHour").html(result.ch3 + " watts cost $" + result.ch3Cost);
                    let total = result.ch1 + result.ch2 + result.ch3;
                    $("#totalCostLastHour").html(total + " watts cost $" + result.totalCost);
                }});
        }, 15000);
    </script>
@endsection
