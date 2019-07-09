@extends('.layout.dashboard_app')
@section('content')

    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Bar Chart</div>
        </div>
        <div class="ibox-body">
            <div>
                <canvas id="bar_chart" style="height:200px;"></canvas>
            </div>
        </div>
    </div>

    <script>
        var barData = {
            labels: ["Sunday", "Munday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
            datasets: [
                {
                    label: "Data 1",
                    backgroundColor:'#DADDE0',
                    data: [45, 80, 58, 74, 54, 59, 40]
                },
                {
                    label: "Data 2",
                    backgroundColor: '#2ecc71',
                    borderColor: "#fff",
                    data: [29, 48, 40, 19, 78, 31, 85]
                }
            ]
        };
        var barOptions = {
            responsive: true,
            maintainAspectRatio: false
        };

        var ctx = document.getElementById("bar_chart").getContext("2d");
        new Chart(ctx, {type: 'bar', data: barData, options:barOptions});

    </script>
@endsection