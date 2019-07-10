@extends('.layout.dashboard_app')
@section('content')

    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Applicant Report</div>
            <div class="text-right m-15">
                <select name="mParam" id="mParam" class="form-control">
                    @for($m=1; $m<=12; $m++)
                        @php($month = date('F', mktime(0,0,0,$m, 1, date('Y'))))
                        <option value="{{$month.' '.date('Y', strtotime('now'))}}">{{$month.' '.date('Y', strtotime('now'))}}</option>
                    @endfor
                </select>
            </div>
        </div>
        <div class="ibox-body">
            <div>
                <canvas id="bar_chart" style="height:450px;"></canvas>
            </div>
        </div>
    </div>

    <script>

        $("#mParam").change(function () {
            var arrData = [];
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "/report/filter",
                data: {
                    date: $(this).val()
                },
                success: function (data) {
                    arrData = data;
                    console.log(arrData);
                    var barData = {
                        labels: ["Accepted", "Reject", "Referral"],
                        datasets: [
                            {
                                label: "Total Applicants",
                                backgroundColor: ['#f4ff61','#a8ff3e','#32ff6a'],
                                data: arrData
                            }
                        ]
                    };

                    var barOptions = {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    min: 0,
                                    max: 30,
                                    stepSize: 5
                                }
                            }]
                        }
                    };

                    var ctx = document.getElementById("bar_chart").getContext("2d");
                    new Chart(ctx, {type: 'bar', data: barData, options:barOptions});
                }
            })
        });

        {{--var referral = parseInt('{{$referrals}}');--}}
        {{--var accepted = parseInt('{{$accepted}}');--}}
        {{--var rejected = parseInt('{{$rejected}}');--}}

    </script>
@endsection