// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Function to create the pie chart
function createPieChart(labels, data) {
    var ctx = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                data: data,
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: false
            },
            cutoutPercentage: 80,
        },
    });
}

// AJAX request to get the data
$.ajax({
    url: 'php/procesos.php',
    type: 'POST',
    data: { action: 'obtenerProductosMasVendidos' },
    success: function(response) {
        // Parse the response to JSON
        console.log(response);
        var datos = JSON.parse(response);

        // Create arrays for the labels and the data
        var labels = [];
        var data = [];

        // Fill the arrays with the data
        for (var i = 0; i < datos.length; i++) {
            labels.push(datos[i].producto);
            data.push(datos[i].total);
        }

        // Create the pie chart with the data
        createPieChart(labels, data);
    }
});

