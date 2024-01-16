var ctx1 = document.getElementById('carabaoChart').getContext('2d');
var carabaoChart = new Chart(ctx1, {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [carabaoPercentage, cattlePercentage, swinePercentage, goatPercentage,
                sheepPercentage, horsePercentage, dogPercentage, 100 - carabaoPercentage -
                cattlePercentage - swinePercentage - goatPercentage - sheepPercentage -
                horsePercentage - dogPercentage],
            backgroundColor: ['rgba(255, 99, 132, .9)', 'rgba(255, 255, 255, 1)', 'rgba(255, 255, 255, 1)',
                'rgba(255, 255, 255, 1)', 'rgba(255, 255, 255, 1)', 'rgba(255, 255, 255, 1)',
                'rgba(255, 255, 255, 1)'],
            borderColor: ['rgba(255, 99, 132, 1)', 'rgba(255, 159, 64, 1)', 'rgba(255, 205, 86, 1)',
                'rgba(75, 192, 192, 1)', 'rgba(54, 162, 235, 1)', 'rgba(153, 102, 255, 1)', 'rgba(201, 203, 207, 1)'],
            borderWidth: 1,
            hoverOffset: 50
        }]
    }
});



var ctx2 = document.getElementById('cattleChart').getContext('2d');
var cattleChart = new Chart(ctx2, {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [carabaoPercentage, cattlePercentage, swinePercentage, goatPercentage,
                sheepPercentage, horsePercentage, dogPercentage, 100 - carabaoPercentage -
                cattlePercentage - swinePercentage - goatPercentage - sheepPercentage -
                horsePercentage - dogPercentage],
            backgroundColor: ['rgba(255, 255, 255, 1)', 'rgba(255, 159, 64, .9)', 'rgba(255, 255, 255, 1)',
                'rgba(255, 255, 255, 1)', 'rgba(255, 255, 255, 1)', 'rgba(255, 255, 255, 1)',
                'rgba(255, 255, 255, 1)'],
            borderColor: ['rgba(255, 99, 132, 1)', 'rgba(255, 159, 64, 1)', 'rgba(255, 205, 86, 1)',
                'rgba(75, 192, 192, 1)', 'rgba(54, 162, 235, 1)', 'rgba(153, 102, 255, 1)', 'rgba(201, 203, 207, 1)'],
            borderWidth: 1,
            hoverOffset: 50
        }]
    }
});



var ctx3 = document.getElementById('swineChart').getContext('2d');
var swineChart = new Chart(ctx3, {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [carabaoPercentage, cattlePercentage, swinePercentage, goatPercentage,
                sheepPercentage, horsePercentage, dogPercentage, 100 - carabaoPercentage -
                cattlePercentage - swinePercentage - goatPercentage - sheepPercentage -
                horsePercentage - dogPercentage],
            backgroundColor: ['rgba(255, 255, 255, 1)', 'rgba(255, 255, 255, 1)', 'rgba(255, 205, 86, .9)',
                'rgba(255, 255, 255, 1)', 'rgba(255, 255, 255, 1)', 'rgba(255, 255, 255, 1)',
                'rgba(255, 255, 255, 1)'],
            borderColor: ['rgba(255, 99, 132, 1)', 'rgba(255, 159, 64, 1)', 'rgba(255, 205, 86, 1)',
                'rgba(75, 192, 192, 1)', 'rgba(54, 162, 235, 1)', 'rgba(153, 102, 255, 1)', 'rgba(201, 203, 207, 1)'],
            borderWidth: 1,
            hoverOffset: 50
        }]
    }
});

var ctx4 = document.getElementById('goatChart').getContext('2d');
var goatChart = new Chart(ctx4, {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [carabaoPercentage, cattlePercentage, swinePercentage, goatPercentage,
                sheepPercentage, horsePercentage, dogPercentage, 100 - carabaoPercentage -
                cattlePercentage - swinePercentage - goatPercentage - sheepPercentage -
                horsePercentage - dogPercentage],
            backgroundColor: ['rgba(255, 255, 255, 1)', 'rgba(255, 255, 255, 1)', 'rgba(255, 255, 255, 1)',
                'rgba(75, 192, 192, .9)', 'rgba(255, 255, 255, 1)', 'rgba(255, 255, 255, 1)',
                'rgba(255, 255, 255, 1)'],
            borderColor: ['rgba(255, 99, 132, 1)', 'rgba(255, 159, 64, 1)', 'rgba(255, 205, 86, 1)',
                'rgba(75, 192, 192, 1)', 'rgba(54, 162, 235, 1)', 'rgba(153, 102, 255, 1)', 'rgba(201, 203, 207, 1)'],
            borderWidth: 1,
            hoverOffset: 50
        }]
    }
});

var ctx5 = document.getElementById('sheepChart').getContext('2d');
var sheepChart = new Chart(ctx5, {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [carabaoPercentage, cattlePercentage, swinePercentage, goatPercentage,
                sheepPercentage, horsePercentage, dogPercentage, 100 - carabaoPercentage -
                cattlePercentage - swinePercentage - goatPercentage - sheepPercentage -
                horsePercentage - dogPercentage],
            backgroundColor: ['rgba(255, 255, 255, 1)', 'rgba(255, 255, 255, 1)', 'rgba(255, 255, 255, 1)',
                'rgba(255, 255, 255, 1)', 'rgba(54, 162, 235, .9)', 'rgba(255, 255, 255, 1)',
                'rgba(255, 255, 255, 1)'],
            borderColor: ['rgba(255, 99, 132, 1)', 'rgba(255, 159, 64, 1)', 'rgba(255, 205, 86, 1)',
                'rgba(75, 192, 192, 1)', 'rgba(54, 162, 235, 1)', 'rgba(153, 102, 255, 1)', 'rgba(201, 203, 207, 1)'],
            borderWidth: 1,
            hoverOffset: 50
        }]
    }
});


var ctx6 = document.getElementById('horseChart').getContext('2d');
var horseChart = new Chart(ctx6, {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [carabaoPercentage, cattlePercentage, swinePercentage, goatPercentage,
                sheepPercentage, horsePercentage, dogPercentage, 100 - carabaoPercentage -
                cattlePercentage - swinePercentage - goatPercentage - sheepPercentage -
                horsePercentage - dogPercentage],
            backgroundColor: ['rgba(255, 255, 255, 1)', 'rgba(255, 255, 255, 1)', 'rgba(255, 255, 255, 1)',
                'rgba(255, 255, 255, 1)', 'rgba(255, 255, 255, 1)', 'rgba(153, 102, 255, .9)',
                'rgba(255, 255, 255, 1)'],
            borderColor: ['rgba(255, 99, 132, 1)', 'rgba(255, 159, 64, 1)', 'rgba(255, 205, 86, 1)',
                'rgba(75, 192, 192, 1)', 'rgba(54, 162, 235, 1)', 'rgba(153, 102, 255, 1)', 'rgba(201, 203, 207, 1)'],
            borderWidth: 1,
            hoverOffset: 50
        }]
    }
});

var ctx7 = document.getElementById('dogChart').getContext('2d');
var dogChart = new Chart(ctx7, {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [carabaoPercentage, cattlePercentage, swinePercentage, goatPercentage,
                sheepPercentage, horsePercentage, dogPercentage, 100 - carabaoPercentage -
                cattlePercentage - swinePercentage - goatPercentage - sheepPercentage -
                horsePercentage - dogPercentage],
            backgroundColor: ['rgba(255, 255, 255, 1)', 'rgba(255, 255, 255, 1)', 'rgba(255, 255, 255, 1)',
                'rgba(255, 255, 255, 1)', 'rgba(255, 255, 255, 1)', 'rgba(255, 255, 255, 1)',
                'rgba(201, 203, 207, .9)'],
            borderColor: ['rgba(255, 99, 132, 1)', 'rgba(255, 159, 64, 1)', 'rgba(255, 205, 86, 1)',
                'rgba(75, 192, 192, 1)', 'rgba(54, 162, 235, 1)', 'rgba(153, 102, 255, 1)', 'rgba(201, 203, 207, 1)'],
            borderWidth: 1,
            hoverOffset: 50
        }]
    }
});


var ctx8 = document.getElementById('overallChart').getContext('2d');
var overallChart = new Chart(ctx8, {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [carabaoPercentage, cattlePercentage, swinePercentage, goatPercentage, sheepPercentage, horsePercentage, dogPercentage, 100 - carabaoPercentage - cattlePercentage - swinePercentage - goatPercentage - sheepPercentage - horsePercentage - dogPercentage],
            backgroundColor: ['rgba(255, 99, 132, .9)', 'rgba(255, 159, 64, .9)', 'rgba(255, 205, 86, .9)',
                'rgba(75, 192, 192, .9)', 'rgba(54, 162, 235, .9)', 'rgba(153, 102, 255, .9)',
                'rgba(201, 203, 207, .9)'],
            borderColor: ['rgba(255, 99, 132, 1)', 'rgba(255, 159, 64, 1)', 'rgba(255, 205, 86, 1)',
                'rgba(75, 192, 192, 1)', 'rgba(54, 162, 235, 1)', 'rgba(153, 102, 255, 1)', 'rgba(201, 203, 207, 1)'],
            borderWidth: 1,
            hoverOffset: 50
        }]
    }
});








