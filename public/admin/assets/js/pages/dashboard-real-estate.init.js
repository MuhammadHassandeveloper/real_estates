function getChartColorsArray(e) {
    var t = document.getElementById(e);
    if (t) {
        t = t.dataset.colors;
        if (t) return JSON.parse(t).map(e => {
            var t = e.replace(/\s/g, "");
            return t.includes(",") ? 2 === (e = e.split(",")).length ? `rgba(${getComputedStyle(document.documentElement).getPropertyValue(e[0])}, ${e[1]})` : t : getComputedStyle(document.documentElement).getPropertyValue(t) || t;
        });
        console.warn("data-colors attribute not found on: " + e);
    }
}

var pieChart, propertySaleChart = "", propertyRentChart = "", visitorsChart = "", residencyChart = "",
    totalRevenueChart = "", totalIncomeChart = "", propertySale2Chart = "", propetryRentChart = "",
    chartRadialbarMultipleChart = "", areachartmini6Chart = "", areachartmini7Chart = "", areachartmini8Chart = "",
    areachartmini9Chart = "";

// Use the dynamic monthlyPurchaseSums data here
const monthlyPurchaseSums = window.monthlyPurchaseSums;

function loadCharts() {
    let t, e;

    // RadialBar Chart for Property Sale
    if ((t = getChartColorsArray("property_sale"))) {
        e = {
            series: [80],
            chart: { width: 110, height: 110, type: "radialBar", sparkline: { enabled: !0 } },
            plotOptions: {
                radialBar: {
                    hollow: { margin: 0, size: "50%" },
                    track: { margin: 0, background: t, opacity: .2 },
                    dataLabels: { show: !1 }
                }
            },
            grid: { padding: { top: -15, bottom: -15 } },
            stroke: { lineCap: "round" },
            labels: ["Cricket"],
            colors: t
        };
        if (propertySaleChart != "") propertySaleChart.destroy();
        propertySaleChart = new ApexCharts(document.querySelector("#property_sale"), e);
        propertySaleChart.render();
    }

    // RadialBar Chart for Property Rent
    if ((t = getChartColorsArray("property_rent"))) {
        e = {
            series: [65],
            chart: { width: 110, height: 110, type: "radialBar", sparkline: { enabled: !0 } },
            plotOptions: {
                radialBar: {
                    hollow: { margin: 0, size: "50%" },
                    track: { margin: 0, background: t, opacity: .2 },
                    dataLabels: { show: !1 }
                }
            },
            grid: { padding: { top: -15, bottom: -15 } },
            stroke: { lineCap: "round" },
            labels: ["Cricket"],
            colors: t
        };
        if (propertyRentChart != "") propertyRentChart.destroy();
        propertyRentChart = new ApexCharts(document.querySelector("#property_rent"), e);
        propertyRentChart.render();
    }

    // RadialBar Chart for Visitors
    if ((t = getChartColorsArray("visitors_chart"))) {
        e = {
            series: [47],
            chart: { width: 110, height: 110, type: "radialBar", sparkline: { enabled: !0 } },
            plotOptions: {
                radialBar: {
                    hollow: { margin: 0, size: "50%" },
                    track: { margin: 0, background: t, opacity: .2 },
                    dataLabels: { show: !1 }
                }
            },
            grid: { padding: { top: -15, bottom: -15 } },
            stroke: { lineCap: "round" },
            labels: ["Cricket"],
            colors: t
        };
        if (visitorsChart != "") visitorsChart.destroy();
        visitorsChart = new ApexCharts(document.querySelector("#visitors_chart"), e);
        visitorsChart.render();
    }

    // RadialBar Chart for Residency Property
    if ((t = getChartColorsArray("residency_property"))) {
        e = {
            series: [43],
            chart: { width: 110, height: 110, type: "radialBar", sparkline: { enabled: !0 } },
            plotOptions: {
                radialBar: {
                    hollow: { margin: 0, size: "50%" },
                    track: { margin: 0, background: t, opacity: .2 },
                    dataLabels: { show: !1 }
                }
            },
            grid: { padding: { top: -15, bottom: -15 } },
            stroke: { lineCap: "round" },
            labels: ["Cricket"],
            colors: t
        };
        if (residencyChart != "") residencyChart.destroy();
        residencyChart = new ApexCharts(document.querySelector("#residency_property"), e);
        residencyChart.render();
    }

    // Bar Chart for Total Revenue with dynamic monthlyPurchaseSums
    if ((t = getChartColorsArray("total_revenue"))) {
        e = {
            series: [{
                name: "Income",
                data: monthlyPurchaseSums // Use the dynamic data here
            }],
            chart: { type: "bar", height: 328, stacked: !0, toolbar: { show: !1 } },
            plotOptions: { bar: { columnWidth: "30%", lineCap: "round", borderRadiusOnAllStackedSeries: !0 } },
            grid: { padding: { left: 0, right: 0, top: -15, bottom: -15 } },
            colors: t,
            fill: { opacity: 1 },
            dataLabels: { enabled: !1, textAnchor: "top" },
            yaxis: {
                labels: {
                    show: !0, formatter: function (e) {
                        return e.toFixed(0);
                    }
                }
            },
            legend: { show: !1, position: "top", horizontalAlign: "right" },
            xaxis: {
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                labels: { rotate: -90 },
                axisTicks: { show: !0 },
                axisBorder: { show: !0, stroke: { width: 1 } }
            }
        };
        if (totalRevenueChart != "") totalRevenueChart.destroy();
        totalRevenueChart = new ApexCharts(document.querySelector("#total_revenue"), e);
        totalRevenueChart.render();
    }

    // Line Chart for Total Income
    if ((t = getChartColorsArray("total_income"))) {
        e = {
            series: [{
                name: "Income",
                data: [32, 18, 13, 17, 26, 34, 47, 51, 59, 63, 44, 38, 53, 69, 72, 83, 90, 110, 130, 117, 103, 92, 95, 119, 80, 96, 116, 125]
            }],
            chart: { height: 328, type: "line", toolbar: { show: !1 } },
            grid: { yaxis: { lines: { show: !1 } } },
            markers: { size: 0, hover: { sizeOffset: 4 } },
            stroke: { curve: "smooth", width: 2 },
            colors: t,
            xaxis: {
                type: "datetime",
                categories: ["02/01/2023 GMT", "02/02/2023 GMT", "02/03/2023 GMT", "02/04/2023 GMT", "02/05/2023 GMT", "02/06/2023 GMT", "02/07/2023 GMT", "02/08/2023 GMT", "02/09/2023 GMT", "02/10/2023 GMT", "02/11/2023 GMT", "02/12/2023 GMT", "02/13/2023 GMT", "02/14/2023 GMT", "02/15/2023 GMT", "02/16/2023 GMT", "02/17/2023 GMT", "02/18/2023 GMT", "02/19/2023 GMT", "02/20/2023 GMT", "02/21/2023 GMT", "02/22/2023 GMT", "02/23/2023 GMT", "02/24/2023 GMT", "02/25/2023 GMT", "02/26/2023 GMT", "02/27/2023 GMT", "02/28/2023 GMT"]
            },
            yaxis: {
                labels: {
                    show: !0, formatter: function (e) {
                        return "$" + e.toFixed(0);
                    }
                }
            }
        };
        if (totalIncomeChart != "") totalIncomeChart.destroy();
        totalIncomeChart = new ApexCharts(document.querySelector("#total_income"), e);
        totalIncomeChart.render();
    }

    // Bar Chart for Property Sale 2
    if ((t = getChartColorsArray("property_sale_2"))) {
        e = {
            series: [{
                name: "Sales",
                data: [40, 80, 70, 90, 85, 95, 120, 110, 100, 80, 90, 70]
            }],
            chart: { type: "bar", height: 328, stacked: !0, toolbar: { show: !1 } },
            plotOptions: { bar: { columnWidth: "30%", borderRadiusOnAllStackedSeries: !0 } },
            colors: t,
            xaxis: {
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
            },
            yaxis: {
                labels: { formatter: function (e) { return e; } }
            },
            grid: { padding: { top: -15, bottom: -15 } },
            dataLabels: { enabled: !1 }
        };
        if (propertySale2Chart != "") propertySale2Chart.destroy();
        propertySale2Chart = new ApexCharts(document.querySelector("#property_sale_2"), e);
        propertySale2Chart.render();
    }

    // Donut Chart for Property Rent
    if ((t = getChartColorsArray("propetry_rent"))) {
        e = {
            series: [10, 20, 30],
            chart: { type: "donut", height: 160 },
            labels: ["Rent", "Sale", "Lease"],
            colors: t,
            legend: { show: !1 },
            plotOptions: { pie: { donut: { size: "60%" } } }
        };
        if (propetryRentChart != "") propetryRentChart.destroy();
        propetryRentChart = new ApexCharts(document.querySelector("#propetry_rent"), e);
        propetryRentChart.render();
    }

    // RadialBar Multiple Chart
    if ((t = getChartColorsArray("chart_radialbar_multiple"))) {
        e = {
            series: [70, 50, 60],
            chart: { height: 160, type: "radialBar" },
            plotOptions: { radialBar: { dataLabels: { show: !1 } } },
            colors: t,
            labels: ["Series 1", "Series 2", "Series 3"]
        };
        if (chartRadialbarMultipleChart != "") chartRadialbarMultipleChart.destroy();
        chartRadialbarMultipleChart = new ApexCharts(document.querySelector("#chart_radialbar_multiple"), e);
        chartRadialbarMultipleChart.render();
    }

    // Area Chart Mini 6
    if ((t = getChartColorsArray("areachartmini6"))) {
        e = {
            series: [{ name: "Revenue", data: [15, 20, 18, 28, 34, 42, 48, 56, 60, 68, 74, 80] }],
            chart: { type: "area", height: 110, sparkline: { enabled: !0 } },
            colors: t,
            xaxis: { crosshairs: { width: 1 }, labels: { show: !1 }, axisBorder: { show: !1 } },
            yaxis: { labels: { show: !1 } },
            grid: { padding: { top: -15, bottom: -15 } }
        };
        if (areachartmini6Chart != "") areachartmini6Chart.destroy();
        areachartmini6Chart = new ApexCharts(document.querySelector("#areachartmini6"), e);
        areachartmini6Chart.render();
    }

    // Area Chart Mini 7
    if ((t = getChartColorsArray("areachartmini7"))) {
        e = {
            series: [{ name: "Revenue", data: [20, 25, 22, 32, 38, 44, 50, 58, 62, 70, 76, 82] }],
            chart: { type: "area", height: 110, sparkline: { enabled: !0 } },
            colors: t,
            xaxis: { crosshairs: { width: 1 }, labels: { show: !1 }, axisBorder: { show: !1 } },
            yaxis: { labels: { show: !1 } },
            grid: { padding: { top: -15, bottom: -15 } }
        };
        if (areachartmini7Chart != "") areachartmini7Chart.destroy();
        areachartmini7Chart = new ApexCharts(document.querySelector("#areachartmini7"), e);
        areachartmini7Chart.render();
    }

    // Area Chart Mini 8
    if ((t = getChartColorsArray("areachartmini8"))) {
        e = {
            series: [{ name: "Revenue", data: [25, 30, 28, 38, 44, 50, 56, 64, 68, 76, 82, 90] }],
            chart: { type: "area", height: 110, sparkline: { enabled: !0 } },
            colors: t,
            xaxis: { crosshairs: { width: 1 }, labels: { show: !1 }, axisBorder: { show: !1 } },
            yaxis: { labels: { show: !1 } },
            grid: { padding: { top: -15, bottom: -15 } }
        };
        if (areachartmini8Chart != "") areachartmini8Chart.destroy();
        areachartmini8Chart = new ApexCharts(document.querySelector("#areachartmini8"), e);
        areachartmini8Chart.render();
    }

    // Area Chart Mini 9
    if ((t = getChartColorsArray("areachartmini9"))) {
        e = {
            series: [{ name: "Revenue", data: [30, 35, 32, 42, 48, 54, 60, 68, 72, 80, 86, 94] }],
            chart: { type: "area", height: 110, sparkline: { enabled: !0 } },
            colors: t,
            xaxis: { crosshairs: { width: 1 }, labels: { show: !1 }, axisBorder: { show: !1 } },
            yaxis: { labels: { show: !1 } },
            grid: { padding: { top: -15, bottom: -15 } }
        };
        if (areachartmini9Chart != "") areachartmini9Chart.destroy();
        areachartmini9Chart = new ApexCharts(document.querySelector("#areachartmini9"), e);
        areachartmini9Chart.render();
    }
}

document.addEventListener("DOMContentLoaded", function () {
    loadCharts();
});
