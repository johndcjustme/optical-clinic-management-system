


// const graddddd = canvas.createLinearGradient(0,0,0,400);
// graddddd.addColorStop(0, 'blue');
// graddddd.addColorStop(0.8, 'green');
// graddddd.addColorStop(1, 'red');

const labels = [
    'JAN',
    'FEB',
    'MAR',
    'APR',
    'MAY',
    'JUN',
    'JUL',
    'AUG',
    'SEP',
    'OCT',
    'NOV',
    'DEC',
];

const data = {
    labels: labels,
    datasets: [{
    label: 'My First dataset',
    borderColor: '#2B4FFF ',
    data: [12, 10, 22, 20, 9, 15, 6, 4, 10, 20, 22, 25 ], 
    fill: false,
    fillColor:'pink',
    }]
};


const analyticsOptions = {
    plugins: {
        legend: {
            display: false,
        },
        title: {
            display: false,
            text: 'Patient  year',
            align: 'start',
            padding: {
                top: 10,
                bottom: 10,
            }
        },
        subtitle: {
            display: false,
            text: 'dkfjdkfjd',
            align: 'start',
            padding: {
                bottom: 30,
            }
        },
    },
    scales: {
        x: {
            grid: {
                display: false
            }
        }
    }
};

const config = {
    type: 'line',
    data: data,
    options: analyticsOptions,
};




const myChart = new Chart(
    document.getElementById('myChart'),
    config
);



