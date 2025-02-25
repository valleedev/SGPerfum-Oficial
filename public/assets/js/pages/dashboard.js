$(function() {
    "use strict";

    function initBarChart(elementId, data, xkey, ykeys, labels, barColors) {
        if ($(elementId).length) {
            Morris.Bar({
                element: elementId,
                barColors: barColors,
                data: data,
                xkey: xkey,
                ykeys: ykeys,
                labels: labels,
                hideHover: "auto",
                gridLineColor: "#eef0f2",
                resize: true,
                barSizeRatio: 0.4
            });
        }
    }

    function initDonutChart(elementId, data, colors) {
        if ($(elementId).length) {
            Morris.Donut({
                element: elementId,
                resize: true,
                colors: colors,
                data: data
            });
        }
    }

    function initLineChart(elementId, data, xkey, ykeys, labels, lineColors) {
        if ($(elementId).length) {
            Morris.Line({
                element: elementId,
                gridLineColor: "#eef0f2",
                lineColors: lineColors,
                data: data,
                xkey: xkey,
                ykeys: ykeys,
                labels: labels,
                hideHover: "auto",
                resize: true
            });
        }
    }

    function initSparkline(elementId, data, lineColor, fillColor) {
        if ($(elementId).length) {
            $(elementId).sparkline(data, {
                type: "line",
                width: "100%",
                height: "297",
                chartRangeMax: 35,
                lineColor: lineColor,
                fillColor: fillColor,
                highlightLineColor: "rgba(0,0,0,.1)",
                highlightSpotColor: "rgba(0,0,0,.2)",
                maxSpotColor: false,
                minSpotColor: false,
                spotColor: false,
                lineWidth: 1
            });
        }
    }

    // Initialize charts with example data
    initBarChart("#morris-bar-example", [
        { y: "2010", a: 80, b: 100 },
        { y: "2011", a: 110, b: 130 },
        { y: "2012", a: 90, b: 110 },
        { y: "2013", a: 80, b: 100 },
        { y: "2014", a: 110, b: 130 },
        { y: "2015", a: 90, b: 110 },
        { y: "2016", a: 120, b: 140 },
        { y: "2017", a: 110, b: 125 },
        { y: "2018", a: 170, b: 190 },
        { y: "2019", a: 120, b: 140 }
    ], "y", ["a", "b"], ["iPhone 8", "Samsung Galaxy"], ["#ebeef1", "#00c2b2"]);

    initDonutChart("#morris-donut-example", [
        { label: "Samsung Company", value: 12 },
        { label: "Apple Company", value: 30 },
        { label: "Vivo Mobiles", value: 20 }
    ], ["#7266bb", "#1d84c6", "#f85359"]);

    initLineChart("#morris-line-example", [
        { y: "2013", a: 80, b: 100 },
        { y: "2014", a: 110, b: 130 },
        { y: "2015", a: 90, b: 110 },
        { y: "2016", a: 120, b: 140 },
        { y: "2017", a: 110, b: 125 },
        { y: "2018", a: 170, b: 190 },
        { y: "2019", a: 120, b: 140 }
    ], "y", ["a", "b"], ["Series A", "Series B"], ["#f15050", "#e9ecef"]);

    $(document).ready(function() {
        function initSparklineCharts() {
            initSparkline("#sparkline1", [25, 23, 26, 24, 25, 32, 30, 24, 19], "#1991eb", "rgba(25,118,210,0.18)");
        }

        initSparklineCharts();
        var resizeTimeout;
        $(window).resize(function() {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(initSparklineCharts, 300);
        });
    });
});