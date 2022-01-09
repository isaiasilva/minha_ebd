// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Bar Chart Example
var jan = 59;
var fev = 0;
var mar = 0;
var abr = 0;
var mai = 0;
var jun = 0;
var ctx = document.getElementById("myBarChart");
var myLineChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho"],
        datasets: [{
            label: "Revenue",
            backgroundColor: "rgba(2,117,216,1)",
            borderColor: "rgba(2,117,216,1)",
            data: [jan, fev, mar, abr, mai, jun],
        }],
    },
    options: {
        scales: {
            xAxes: [{
                time: {
                    unit: 'month'
                },
                gridLines: {
                    display: false
                },
                ticks: {
                    maxTicksLimit: 6
                }
            }],
            yAxes: [{
                ticks: {
                    min: 0,
                    max: 200,
                    maxTicksLimit: 5
                },
                gridLines: {
                    display: true
                }
            }],
        },
        legend: {
            display: false
        }
    }
});
