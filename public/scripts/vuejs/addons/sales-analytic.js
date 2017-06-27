var chart;
var salesAnalyticVue = new Vue({
    el: '#SalesAnalytic',
    data: {
        range: 'month',
        highColors: [bgWarning, bgPrimary, bgInfo, bgAlert,
            bgDanger, bgSuccess, bgSystem, bgDark
        ],
        sparkColors: {
            "primary": [bgPrimary, bgPrimaryLr, bgPrimaryDr],
            "info": [bgInfo, bgInfoLr, bgInfoDr],
            "warning": [bgWarning, bgWarningLr, bgWarningDr],
            "success": [bgSuccess, bgSuccessLr, bgSuccessDr],
            "alert": [bgAlert, bgAlertLr, bgAlertDr]
        },
        chartData: [
            {
                name: 'Phones',
                data: [5.0, 9, 17, 22, 19, 11.5, 5.2, 9.5, 11.3, 15.3, 19.9, 24.6]
            }],
        categories : ['Jan', 'Feb', 'Mar', 'Apr',
            'May', 'Jun', 'Jul', 'Aug',
            'Sep', 'Oct', 'Nov', 'Dec'
        ]
    },

    ready: function () {
        this.getSalesAnalytic();
    },

    methods: {
        changeRange: function (range) {
            this.range = range;
            this.getSalesAnalytic();
        },
        getSalesAnalytic: function () {
            var uri = '/dashboard/sales-analytic/' + this.range;
            this.$http.get(uri, function (data, status, request) {
                salesAnalyticVue.chartData = [
                    {
                        name: ('Previous ' + salesAnalyticVue.range).toUpperCase(),
                        data: data.previous
                    },
                    {
                        name: ('Current ' + salesAnalyticVue.range).toUpperCase(),
                        data: data.current
                    },
                ];
                salesAnalyticVue.categories = data.labels;
                salesAnalyticVue.drawChart();
            })

        },
        drawChart: function () {
            var salesAnalyticChart =$('#salesAnalyticChart');
            chart = salesAnalyticChart.highcharts({
                credits: false,
                colors: salesAnalyticVue.highColors,
                chart: {
                    backgroundColor: 'transparent',
                    className: 'br-r',
                    type: 'areaspline',
                    zoomType: 'x',
                    panning: true,
                    panKey: 'shift',
                    marginTop: 45,
                    marginRight: 1,
                },
                title: {
                    text: null
                },
                xAxis: {
                    gridLineColor: '#EEE',
                    lineColor: '#EEE',
                    tickColor: '#EEE',
                    categories: salesAnalyticVue.categories
                },
                yAxis: {
                    min: 0,
                    tickInterval: 5,
                    gridLineColor: 'transparent',
                    title: {
                        text: null,
                    }
                },
                plotOptions: {
                    areaspline: {
                        fillOpacity: 0.25,
                        marker: {
                            enabled: true,
                            symbol: 'circle',
                            radius: 5,
                            states: {
                                hover: {
                                    enabled: true
                                }
                            }
                        }
                    },
                },

                legend: {
                    enabled: true,
                    floating: false,
                    align: 'right',
                    verticalAlign: 'top'
                },
                series: salesAnalyticVue.chartData
            });
        },
    },
});