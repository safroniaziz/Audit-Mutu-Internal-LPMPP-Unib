<!DOCTYPE html>
<html>
<head>
    <title>Radar Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="radarChart" width="600" height="600"></canvas>

    <script>
        const ctx = document.getElementById('radarChart').getContext('2d');

        const data = {
            labels: [
                'SS 1.1', 'SS 1.2', 'SS 1.3', 'SS 1.4', 'SS 1.5',
                'SS 2.1', 'SS 3.1', 'SS 3.2', 'SS 3.3',
                'SS 4.1', 'SS 4.2', 'SS 4.3', 'SS 4.4'
            ],
            datasets: [{
                label: 'Peta Ketercapaian Sasaran Strategis',
                data: [0.0, 1.5, 0.8, 0.9, 0.0, 0.0, 0.7, 0.8, 0.0, 0.9, 0.8, 0.0, 0.0],
                fill: true,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                pointBackgroundColor: 'rgba(54, 162, 235, 1)',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgba(54, 162, 235, 1)'
            }]
        };

        const config = {
            type: 'radar',
            data: data,
            options: {
                elements: {
                    line: {
                        borderWidth: 2
                    }
                },
                scales: {
                    r: {
                        beginAtZero: true,
                        suggestedMax: 2
                    }
                }
            }
        };

        new Chart(ctx, config);
    </script>
</body>
</html>
