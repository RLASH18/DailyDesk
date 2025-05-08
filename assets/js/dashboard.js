document.addEventListener('DOMContentLoaded', function() {
    const radarCanvas = document.getElementById('productivityRadar');
    if (!radarCanvas) return;

    const productivityDataElement = document.getElementById('productivity-data');
    if (!productivityDataElement) return;

    let productivityData;
    try {
        productivityData = JSON.parse(productivityDataElement.dataset.productivity);
    } catch (e) {
        console.error('Error parsing productivity data:', e);
        return;
    }

    const ctx = radarCanvas.getContext('2d');
    new Chart(ctx, {
        type: 'pie', // still pie
        data: {
            labels: productivityData.labels,
            datasets: [{
                label: 'Last 7 Days',
                data: productivityData.data,
                backgroundColor: [
                    '#2487ce',    // Tasks
                    '#48c9b0',    // Journal
                    '#ffce56',    // Budget
                    '#ff6384'     // Priority
                ],
                borderColor: '#ffffff',
                borderWidth: 2,
                hoverOffset: 15
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 14,
                        padding: 15,
                        font: {
                            family: '"Poppins", system-ui',
                            size: 14,
                            weight: '600'
                        },
                        color: '#124265'
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(36, 135, 206, 0.8)',
                    titleFont: {
                        family: '"Poppins", system-ui',
                        size: 16,
                        weight: '700'
                    },
                    bodyFont: {
                        family: '"Poppins", system-ui',
                        size: 14
                    },
                    padding: 15,
                    cornerRadius: 8,
                    displayColors: false
                }
            }
        }
    });
});
