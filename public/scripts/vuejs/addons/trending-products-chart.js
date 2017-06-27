var chart;
var trendingProductsVue = new Vue({
    el: '#TrendingProductsChart',
    data: {
        range: 'month',
        highColors: [
            '#3498db', '#2ecc71', '#1abc9c', '#9b59b6', '#34495e',
            '#f1c40f', '#e67e22', '#e74c3c', '#95a5a6', bgDark
        ],
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
        this.getTrendingProductsChart();
    },

    methods: {
        changeRange: function (range) {
            this.range = range;
            this.getTrendingProductsChart();
        },
        getTrendingProductsChart: function () {
            var uri = '/dashboard/trending-products-chart/' + this.range;
            this.$http.get(uri, function (data, status, request) {
                trendingProductsVue.chartData = data;
                trendingProductsVue.drawChart();
            })

        },
        drawChart: function () {
            var trendingProductsChart = $('#trendingProductsChart');
            chart = trendingProductsChart.highcharts({
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
                        innerSize: '30%',
                        dataLabels: {
                            enabled: false
                        },
                        showInLegend: true
                    }
                },
                colors: trendingProductsVue.highColors,
                legend: {

                },
                series: [{
                    type: 'pie',
                    name: 'Sale',
                    data: trendingProductsVue.chartData
                }]
            });
        },
    },
});