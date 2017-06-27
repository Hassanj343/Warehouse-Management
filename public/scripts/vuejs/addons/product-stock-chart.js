var chart;
var ProductsStockChart = new Vue({
    el: '#ProductsStockChart',
    data: {
        range: 'month',
        highColors: [bgSuccess, bgWarning, bgDanger],
        sparkColors: {
            "primary": [bgPrimary, bgPrimaryLr, bgPrimaryDr],
            "info": [bgInfo, bgInfoLr, bgInfoDr],
            "warning": [bgWarning, bgWarningLr, bgWarningDr],
            "success": [bgSuccess, bgSuccessLr, bgSuccessDr],
            "alert": [bgAlert, bgAlertLr, bgAlertDr]
        },
        chartData: [],
    },

    ready: function () {
        this.getProductsStockChart();
    },

    methods: {
        getProductsStockChart: function () {
            var uri = '/dashboard/product-stock-chart';
            this.$http.get(uri, function (data, status, request) {
                ProductsStockChart.chartData = data;
                ProductsStockChart.drawChart();
            })

        },
        drawChart: function () {
            var productStockChart = $('#productStockChart');
            chart = productStockChart.highcharts({
                credits: false,
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: true,

                },
                title: {
                    text: null
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        center: ['50%', '50%'],
                        allowPointSelect: true,
                        cursor: 'pointer',
                        innerSize: '0',

                        dataLabels: {
                            enabled: false
                        },
                        showInLegend: true
                    }
                },
                colors: ProductsStockChart.highColors,
                legend: {

                },
                series: [{
                    type: 'pie',
                    name: 'Stock Availability',
                    data: ProductsStockChart.chartData
                }]
            });
        },
    },
});