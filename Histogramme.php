<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Recettes mensuelles</title>
    <script src="jquery-3.6.0.min.js"></script>
    <script src="chart.min.js" ></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
</head>
<body>
    <!-- <div class="Histo" >
    <canvas id="histogramme"></canvas>
    <script>
        var recettes = <?php echo json_encode(array_values($recettes)); ?>;
        var mois = <?php echo json_encode(array_map(function($m) { return strftime('%B', strtotime("2023-$m-01")); }, array_keys($recettes))); ?>;
        var ctx = document.getElementById('histogramme').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: mois,
                datasets: [{
                    label: 'Recettes mensuelles',
                    data: recettes,
                    backgroundColor: 'rgba(144, 14, 111, 0.6)',
                    borderColor: 'rgba(144, 14, 111, 1)',
                    borderWidth: 0.5
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    </div> -->
    <div class="Histo_circ" >
        <canvas id="histogramme"></canvas>
        <script>
        var recettes = <?php echo json_encode(array_values($recettes)); ?>;
        var mois = <?php echo json_encode(array_map(function($m) { return strftime('%B', strtotime("2023-$m-01")); }, array_keys($recettes))); ?>;
        var ctx = document.getElementById('histogramme').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'doughnut', // Utilisation du type "doughnut" pour créer un histogramme en forme de donut
            data: {
                labels: mois,
                datasets: [{
                    label: 'Recettes mensuelles',
                    data: recettes,
                    backgroundColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 205, 86, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(218, 22, 22, 0.5)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 205, 86, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(218, 22, 22, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                cutoutPercentage: 50, // Pour créer un histogramme en forme de donut, on définit la valeur de "cutoutPercentage" à 50%
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    </div>
</body>
</html>
