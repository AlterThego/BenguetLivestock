// Main Chart
var ctx = document.getElementById('petTrend').getContext('2d');
var petChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [''],
        datasets: [
            {
                label: 'Dog Count',
                backgroundColor: 'rgba(255, 206, 86, 1)',
                borderColor: 'rgba(255, 206, 86, 1)',
                borderWidth: 1,
                data: [dogCount]
            },
            {
                label: 'Cat Count',
                backgroundColor: 'rgba(255, 99, 132, 1)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1,
                data: [catCount]
            }
        ]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});


// Doughnut
var ctx1 = document.getElementById('dogChart').getContext('2d');
var dogChart = new Chart(ctx1, {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [dogPercentage, catPercentage, 100 - dogPercentage - catPercentage],
            backgroundColor: ['rgba(255, 206, 86, 1)', 'rgba(255, 255, 255, 0)', 'rgba(255, 255, 255, 0)'],
            borderColor: ['rgba(255, 206, 86, 1)', 'rgba(255, 99, 132, 1)', 'rgba(255, 255, 255, 0)'],
            borderWidth: 1
        }]
    }
});


var ctx2 = document.getElementById('catChart').getContext('2d');
var catChart = new Chart(ctx2, {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [dogPercentage, catPercentage, 100 - dogPercentage - catPercentage],
            backgroundColor: ['rgba(255, 255, 255, 0)', 'rgba(255, 99, 132, 1)', 'rgba(255, 255, 255, 0)'],
            borderColor: ['rgba(255, 206, 86, 1)', 'rgba(255, 99, 132, 1)', 'rgba(255, 255, 255, 0)'],
            borderWidth: 1
        }]
    }
});

var ctx3 = document.getElementById('totalChart').getContext('2d');
var totalChart = new Chart(ctx3, {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [dogPercentage, catPercentage, 100 - dogPercentage - catPercentage],
            backgroundColor: ['rgba(255, 206, 86, 1)', 'rgba(255, 99, 132, 1)', 'rgba(255, 255, 255, 0)'],
            borderColor: ['rgba(235, 186, 66, 1)', 'rgba(235, 79, 112, 1)', 'rgba(255, 255, 255, 0)'],
            borderWidth: 1
        }]
    }
});



