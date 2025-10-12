


! function () {
    let o, e, r, t, s, i;
    i = (isDarkStyle ? (o = config.colors_dark.cardColor, e = config.colors_dark.headingColor, r = config.colors_dark.bodyColor, t = config.colors_dark.textMuted, config.colors_dark) : (o = config.colors.cardColor, e = config.colors.headingColor, r = config.colors.bodyColor, t = config.colors.textMuted, config.colors)).borderColor;

    function fetchCounts() {
        return fetch('admin/data/getCounts.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                return {
                    male: data.male_count,
                    female: data.female_count,
                    above_18: data.above_18_count,
                    under_18: data.under_18_count,
                    mfis_yes: data.mfis_count, 
                    mfis_no: data.not_mfis_count, 
                    studentInSchool: data.student_in_school_count, 
                    studentInCollege: data.student_in_college_count, 
                    parentCount: data.parent_count,
                    grade7: data.grade_7_count,
                    grade8: data.grade_8_count, 
                    grade9: data.grade_9_count,  
                    grade10: data.grade_10_count, 
                    grade11: data.grade_11_count, 
                    grade12: data.grade_12_count,
                    entered: data.entered_count,
                    notEntered: data.not_entered_count,
                    usedDinner: data.used_dinner_count,
                    notUsedDinner: data.not_used_dinner_count,
                    usedBreakfast: data.used_breakfast_count,
                    notUsedBreakfast: data.not_used_breakfast_count
                };
            })
            .catch(error => {
                console.error('Error fetching counts:', error);
                return {
                    male: 0,
                    female: 0,
                    above_18: 0,
                    under_18: 0,
                    mfis_yes: 0,
                    mfis_no: 0,
                    studentInSchool: 0,
                    studentInCollege: 0,
                    parentCount: 0,
                    grade7: 0,
                    grade8: 0,
                    grade9: 0,
                    grade10: 0,
                    grade11: 0,
                    grade12: 0,
                    entered: 0,
                    notEntered: 0,
                    usedDinner: 0,
                    notUsedDinner: 0,
                    usedBreakfast: 0,
                    notUsedBreakfast: 0
                };
            });
    }

    
    
//                                                  GENDERR CHARTTTTTTTTTTT              ////////////////
    function initGenderChart(genderData) {
        var genderChartElement = document.querySelector("#genderChart2");
        var genderChartOptions = {
            chart: {
                height: 95,
                type: "bar",
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    barHeight: "80%",
                    columnWidth: "75%",
                    startingShape: "rounded",
                    endingShape: "rounded",
                    borderRadius: 4,
                    distributed: true
                }
            },
            grid: {
                show: false,
                padding: {
                    top: -20,
                    bottom: -12,
                    left: -10,
                    right: 0
                }
            },
            colors: [config.colors.primary, config.colors_label.primary],
            dataLabels: {
                enabled: false
            },
            series: [{
                data: [genderData.male, genderData.female]
            }],
            legend: {
                show: false
            },
            xaxis: {
                categories: ["Male", "Female"],
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    style: {
                        colors: t,
                        fontSize: "13px"
                    }
                }
            },
            yaxis: {
                labels: {
                    show: false
                }
            },
            tooltip: {
                y: {
                    title: {
                        formatter: function(seriesName) {
                            return 'Total: ';
                        }
                    }
                }
            }
        };

        if (genderChartElement) {
            var genderChart = new ApexCharts(genderChartElement, genderChartOptions);
            genderChart.render();
        }
    }


                             //          TEST8ING  echart//
function initEventChart(eventData) {
    var eventChartElement = document.querySelector("#eChart22");
    var eventChartOptions = {
        chart: {
            height: 285,
            width: 250,
            type: "donut"
        },
        labels: ["Entered Event", "Ate Dinner", "Ate Breakfast"],
        series: [
            eventData.entered,
            eventData.usedDinner,
            eventData.usedBreakfast,
        ],
        colors: [config.colors.tedx, config.colors.success, config.colors.info, config.colors.secondary],
        stroke: {
            width: 5,
            colors: [o]
        },
        dataLabels: {
            enabled: false // false 3l4an showing percentage on chart deh kanet old system
        },
        legend: {
            show: false
        },
        grid: {
            padding: {
                top: 0,
                bottom: 0,
                right: 15
            }
        },
        plotOptions: {
            pie: {
                donut: {
                    size: "80%",
                    labels: {
                        show: true,
                        value: {
                            fontSize: "16px",
                            fontFamily: "Public Sans",
                            fontWeight: 500,
                            color: e,
                            offsetY: -17,
                            formatter: function (val) {
                                return parseInt(val);
                            }
                        },
                        name: {
                            offsetY: 17,
                            fontFamily: "Public Sans"
                        },
                        total: {
                            show: true,
                            fontSize: "13px",
                            color: r,
                            label: "Total",
                            formatter: function () {
                                return "Summary";
                            }
                        }
                    }
                }
            }
        }
    };

    if (eventChartElement) {
        var eventChart = new ApexCharts(eventChartElement, eventChartOptions);
        eventChart.render();
    }
}


    //                                                  AGE CHARTTTTTTTTTTT              ////////////////
    function initAgeChart(ageData) {
        var ageChartElement = document.querySelector("#ageChart2");
        var ageChartOptions = {
            chart: {
                height: 95,
                type: "bar",
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    barHeight: "80%",
                    columnWidth: "75%",
                    startingShape: "rounded",
                    endingShape: "rounded",
                    borderRadius: 4,
                    distributed: true
                }
            },
            grid: {
                show: false,
                padding: {
                    top: -20,
                    bottom: -12,
                    left: -10,
                    right: 0
                }
            },
            colors: [config.colors.info, config.colors_label.info],
            dataLabels: {
                enabled: false
            },
            series: [{
                data: [ageData.above_18, ageData.under_18]
            }],
            legend: {
                show: false
            },
            xaxis: {
                categories: ["18 or Above", "Under 18"],
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    style: {
                        colors: t,
                        fontSize: "13px"
                    }
                }
            },
            yaxis: {
                labels: {
                    show: false
                }
            },
            tooltip: {
                y: {
                    title: {
                        formatter: function(seriesName) {
                            return 'Total: ';
                        }
                    }
                }
            }
        };

        if (ageChartElement) {
            var ageChart = new ApexCharts(ageChartElement, ageChartOptions);
            ageChart.render();
        }
    }

    //                                                  MFIS CHARTTTTTTTTTTT              ////////////////
    function initMfisChart(mfisData) {
        var mfisChartElement = document.querySelector("#mfisChart222");
        var mfisChartOptions = {
            chart: {
                height: 95,
                type: "bar",
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    barHeight: "80%",
                    columnWidth: "75%",
                    startingShape: "rounded",
                    endingShape: "rounded",
                    borderRadius: 4,
                    distributed: true
                }
            },
            grid: {
                show: false,
                padding: {
                    top: -20,
                    bottom: -12,
                    left: -10,
                    right: 0
                }
            },
            colors: [config.colors.mfis, config.colors_label.mfis],
            dataLabels: {
                enabled: false
            },
            series: [{
                data: [mfisData.mfis_yes, mfisData.mfis_no]
            }],
            legend: {
                show: false
            },
            xaxis: {
                categories: ["Yes", "No"],
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    style: {
                        colors: t,
                        fontSize: "13px"
                    }
                }
            },
            yaxis: {
                labels: {
                    show: false
                }
            },
            tooltip: {
                y: {
                    title: {
                        formatter: function(seriesName) {
                            return 'Total: ';
                        }
                    }
                }
            }
        };

        if (mfisChartElement) {
            var mfisChart = new ApexCharts(mfisChartElement, mfisChartOptions);
            mfisChart.render();
        }
    }

//                                                  LOGIN CHARTTTTTTTTTTT              ////////////////
    function initLoginChart(loginData) {
        var loginChartElement = document.querySelector("#loginChart22");
        var loginChartOptions = {
            chart: {
                height: 95,
                type: "bar",
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    barHeight: "80%",
                    columnWidth: "75%",
                    startingShape: "rounded",
                    endingShape: "rounded",
                    borderRadius: 4,
                    distributed: true
                }
            },
            grid: {
                show: false,
                padding: {
                    top: -20,
                    bottom: -12,
                    left: -10,
                    right: 0
                }
            },
            colors: [config.colors.success, config.colors_label.success, config.colors_label.success],
            dataLabels: {
                enabled: false
            },
            series: [{
                data: [
                    loginData.studentInSchool, 
                    loginData.studentInCollege, 
                    loginData.parentCount
                ]
            }],
            legend: {
                show: false
            },
            xaxis: {
                categories: ["School", "College", "Parent"],
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    style: {
                        colors: t,
                        fontSize: "13px"
                    }
                }
            },
            yaxis: {
                labels: {
                    show: false
                }
            },
            tooltip: {
                y: {
                    title: {
                        formatter: function(seriesName) {
                            return 'Total: ';
                        }
                    }
                }
            }
        };
    
        if (loginChartElement) {
            var loginChart = new ApexCharts(loginChartElement, loginChartOptions);
            loginChart.render();
        }
    }


                                                         // GrADING SYSTEMMMMMMMM  ////////
   
    // FINAL FETCHING IMPORTANT 
    fetchCounts().then(data => {
        initGenderChart(data);
        initAgeChart(data);
        initEventChart(data);
        initMfisChart(data); 
        initLoginChart(data); 
    });


    //                                                  NOT WITH CHARTTTTTTTTTTT              ////////////////

    var 
        a = document.querySelector("#loginChart"),
        n = {
            chart: {
                height: 95,
                type: "bar",
                toolbar: {
                    show: !1
                }
            },
            plotOptions: {
                bar: {
                    barHeight: "80%",
                    columnWidth: "75%",
                    startingShape: "rounded",
                    endingShape: "rounded",
                    borderRadius: 4,
                    distributed: !0
                }
            },
            grid: {
                show: !1,
                padding: {
                    top: -20,
                    bottom: -12,
                    left: -10,
                    right: 0
                }
            },
            colors: [config.colors.success, config.colors_label.success, config.colors_label.success],
            dataLabels: {
                enabled: !1
            },
            series: [{
                data: [40, 20, 10]
            }],
            legend: {
                show: !1
            },
            xaxis: {
                categories: ["School", "College", "Parent"],
                axisBorder: {
                    show: !1
                },
                axisTicks: {
                    show: !1
                },
                labels: {
                    style: {
                        colors: t,
                        fontSize: "13px"
                    }
                }
            },
            yaxis: {
                labels: {
                    show: !1
                }
            },
            tooltip: {
                y: {
                    title: {
                        formatter: function(seriesName) {
                            return 'Total: ';
                        }
                    }
                }
            }
        },
        a = (null !== a && new ApexCharts(a, n).render(), document.querySelector("#genderChart")),
        n = {
            chart: {
                height: 95,
                type: "bar",
                toolbar: {
                    show: !1
                }
            },
            // labels: ["Male", "Female"],
            plotOptions: {
                bar: {
                    barHeight: "80%",
                    columnWidth: "75%",
                    startingShape: "rounded",
                    endingShape: "rounded",
                    borderRadius: 4,
                    distributed: !0
                }
            },
            grid: {
                show: !1,
                padding: {
                    top: -20,
                    bottom: -12,
                    left: -10,
                    right: 0
                }
            },
            colors: [config.colors.primary, config.colors_label.primary],
            dataLabels: {
                enabled: !1
            },
            series: [{
                data: [48, 20]
            }],
            legend: {
                show: !1
            },
            xaxis: {
                categories: ["Male", "Female"],
                axisBorder: {
                    show: !1
                },
                axisTicks: {
                    show: !1
                },
                labels:{
                    style: {
                        colors: t,
                        fontSize: "13px"
                    }
                }
            },
            yaxis: {
                labels: {
                    show: !1
                }
            },
            tooltip: {
                y: {
                    title: {
                        formatter: function(seriesName) {
                            return 'Total: ';
                        }
                    }
                }
            }
        },
        a = (null !== a && new ApexCharts(a, n).render(), document.querySelector("#ageChart")),
        n = {
            chart: {
                height: 95,
                type: "bar",
                toolbar: {
                    show: !1
                }
            },
            plotOptions: {
                bar: {
                    barHeight: "80%",
                    columnWidth: "75%",
                    startingShape: "rounded",
                    endingShape: "rounded",
                    borderRadius: 4,
                    distributed: !0
                }
            },
            grid: {
                show: !1,
                padding: {
                    top: -20,
                    bottom: -12,
                    left: -10,
                    right: 0
                }
            },
            colors: [config.colors.info, config.colors_label.info],
            dataLabels: {
                enabled: !1
            },
            series: [{
                data: [20, 50]
            }],
            legend: {
                show: !1
            },
            xaxis: {
                categories: ["Above 18", "Under 18"],
                axisBorder: {
                    show: !1
                },
                axisTicks: {
                    show: !1
                },
                labels: {
                    style: {
                        colors: t,
                        fontSize: "13px"
                    }
                }
            },
            yaxis: {
                labels: {
                    show: !1
                }
            },
            tooltip: {
                y: {
                    title: {
                        formatter: function(seriesName) {
                            return 'Total: ';
                        }
                    }
                }
            }
        },
        a = (null !== a && new ApexCharts(a, n).render(), document.querySelector("#mfisChart")),
        n = {
            chart: {
                height: 95,
                type: "bar",
                toolbar: {
                    show: !1
                }
            },
            plotOptions: {
                bar: {
                    barHeight: "80%",
                    columnWidth: "75%",
                    startingShape: "rounded",
                    endingShape: "rounded",
                    borderRadius: 4,
                    distributed: !0
                }
            },
            grid: {
                show: !1,
                padding: {
                    top: -20,
                    bottom: -12,
                    left: -10,
                    right: 0
                }
            },
            colors: [config.colors.mfis, config.colors_label.mfis],
            dataLabels: {
                enabled: !1
            },
            series: [{
                data: [30, 40]
            }],
            legend: {
                show: !1
            },
            xaxis: {
                categories: ["Yes", "No"],
                axisBorder: {
                    show: !1
                },
                axisTicks: {
                    show: !1
                },
                labels: {
                    style: {
                        colors: t,
                        fontSize: "13px"
                    }
                }
            },
            yaxis: {
                labels: {
                    show: !1
                }
            },
            tooltip: {
                y: {
                    title: {
                        formatter: function(seriesName) {
                            return 'Total: ';
                        }
                    }
                }
            }
        },
        a = (null !== a && new ApexCharts(a, n).render(), document.querySelector("#eChart")),
        n = {
            chart: {
                height: 285,
                width: 250,
                type: "donut"
            },
            labels: ["Entered Event", "Didn't Enter Event", "Ate Dinner", "Didn't Eat Dinner", "Ate Breakfast", "Didn't Ate Breakfast",],
            series: [100, 100, 100, 100, 100, 100],
            colors: [config.colors.tedx, config.colors.success, config.colors.info, config.colors.secondary],
            stroke: {
                width: 5,
                colors: [o]
            },
            dataLabels: {
                enabled: !1,
                formatter: function (o, e) {
                    return parseInt(o) + "%"
                }
            },
            legend: {
                show: !1
            },
            grid: {
                padding: {
                    top: 0,
                    bottom: 0,
                    right: 15
                }
            },
            states: {
                hover: {
                    filter: {
                        type: "none"
                    }
                },
                active: {
                    filter: {
                        type: "none"
                    }
                }
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: "80%",
                        labels: {
                            show: !0,
                            value: {
                                fontSize: "16px",
                                fontFamily: "Public Sans",
                                fontWeight: 500,
                                color: e,
                                offsetY: -17,
                                formatter: function (o) {
                                    return parseInt(o) + "%"
                                }
                            },
                            name: {
                                offsetY: 17,
                                fontFamily: "Public Sans"
                            },
                            total: {
                                show: !0,
                                fontSize: "13px",
                                color: r,
                                label: "Weekly",
                                formatter: function (o) {
                                    return "38%"
                                }
                            }
                        }
                    }
                }
            }
        };
    null !== a && new ApexCharts(a, n).render()
}();

// Google Statistics Part

! function () {
    let e, t, o, r;
    r = (isDarkStyle ? (e = config.colors_dark.textMuted, t = config.colors_dark.headingColor, o = config.colors_dark.borderColor, config.colors_dark) : (e = config.colors.textMuted, t = config.colors.headingColor, o = config.colors.borderColor, config.colors)).bodyColor;
    var s = {
            donut: {
                series1: "#5AB12C",
                series2: "#66C732",
                series3: "#8DE45F",
                series4: "#C6F1AF"
            },
            line: {
                series1: config.colors.warning,
                series2: config.colors.primary,
                series3: "#7367f029"
            }
        },
        a = document.querySelector("#googleStatisticsChart"),
        i = {
            series: [ {
                name: "Shipment",
                type: "column",
                data: [37, 28, 23, 32, 28, 44, 32, 38, 26, 34]
            },],
            chart: {
                height: 320,
                type: "bar",
                stacked: !1,
                parentHeightOffset: 0,
                toolbar: {
                    show: !1
                },
                zoom: {
                    enabled: !1
                }
            },
            markers: {
                size: 5,
                colors: [config.colors.white],
                strokeColors: s.line.series2,
                hover: {
                    size: 6
                },
                borderRadius: 4
            },
            stroke: {
                curve: "smooth",
                width: [0],
                lineCap: "round"
            },
            legend: {
                show: !0,
                position: "bottom",
                markers: {
                    width: 8,
                    height: 8,
                    offsetX: -3
                },
                height: 40,
                itemMargin: {
                    horizontal: 10,
                    vertical: 0
                },
                fontSize: "15px",
                fontFamily: "Public Sans",
                fontWeight: 400,
                labels: {
                    colors: t,
                    useSeriesColors: !1
                },
                offsetY: 10
            },
            grid: {
                strokeDashArray: 8,
                borderColor: o
            },
            colors: [s.line.series1],
            fill: {
                opacity: [1, 1]
            },
            plotOptions: {
                bar: {
                    columnWidth: "30%",
                    startingShape: "rounded",
                    endingShape: "rounded",
                    borderRadius: 4
                }
            },
            dataLabels: {
                enabled: !1
            },
            xaxis: {
                tickAmount: 10,
                categories: ["1 Jan", "2 Jan", "3 Jan", "4 Jan", "5 Jan", "6 Jan", "7 Jan", "8 Jan", "9 Jan", "10 Jan"],
                labels: {
                    style: {
                        colors: e,
                        fontSize: "13px",
                        fontFamily: "Public Sans",
                        fontWeight: 400
                    }
                },
                axisBorder: {
                    show: !1
                },
                axisTicks: {
                    show: !1
                }
            },
            yaxis: {
                tickAmount: 4,
                min: 0,
                max: 50,
                labels: {
                    style: {
                        colors: e,
                        fontSize: "13px",
                        fontFamily: "Public Sans",
                        fontWeight: 400
                    },
                    formatter: function (e) {
                        return e + "%"
                    }
                }
            },
            responsive: [{
                breakpoint: 1400,
                options: {
                    chart: {
                        height: 320
                    },
                    xaxis: {
                        labels: {
                            style: {
                                fontSize: "10px"
                            }
                        }
                    },
                    legend: {
                        itemMargin: {
                            vertical: 0,
                            horizontal: 10
                        },
                        fontSize: "13px",
                        offsetY: 12
                    }
                }
            }, {
                breakpoint: 1025,
                options: {
                    chart: {
                        height: 415
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: "50%"
                        }
                    }
                }
            }, {
                breakpoint: 982,
                options: {
                    plotOptions: {
                        bar: {
                            columnWidth: "30%"
                        }
                    }
                }
            }, {
                breakpoint: 480,
                options: {
                    chart: {
                        height: 250
                    },
                    legend: {
                        offsetY: 7
                    }
                }
            }]
        };
    null !== a && new ApexCharts(a, i).render()
}(), $(function () {
    var e = $(".dt-route-vehicles");
    e.length && (e.DataTable({
        ajax: assetsPath + "json/logistics-dashboard.json",
        columns: [{
            data: "id"
        }, {
            data: "id"
        }, {
            data: "location"
        }, {
            data: "start_city"
        }, {
            data: "end_city"
        }, {
            data: "warnings"
        }, {
            data: "progress"
        }],
        columnDefs: [{
            className: "control",
            orderable: !1,
            searchable: !1,
            responsivePriority: 2,
            targets: 0,
            render: function (e, t, o, r) {
                return ""
            }
        }, {
            targets: 1,
            orderable: !1,
            searchable: !1,
            checkboxes: !0,
            checkboxes: {
                selectAllRender: '<input type="checkbox" class="form-check-input">'
            },
            responsivePriority: 3,
            render: function () {
                return '<input type="checkbox" class="dt-checkboxes form-check-input">'
            }
        }, {
            targets: 2,
            responsivePriority: 1,
            render: function (e, t, o, r) {
                return '<div class="d-flex justify-content-start align-items-center user-name"><div class="avatar-wrapper"><div class="avatar me-4"><span class="avatar-initial rounded-circle bg-label-secondary"><i class="bx bxs-truck bx-lg"></i></span></div></div><div class="d-flex flex-column"><a class="text-heading fw-medium" href="app-logistics-fleet.html">VOL-' + o.location + "</a></div></div>"
            }
        }, {
            targets: 3,
            render: function (e, t, o, r) {
                return '<div class="text-body">' + o.start_city + ", " + o.start_country + "</div >"
            }
        }, {
            targets: 4,
            render: function (e, t, o, r) {
                return '<div class="text-body">' + o.end_city + ", " + o.end_country + "</div >"
            }
        }, {
            targets: -2,
            render: function (e, t, o, r) {
                var o = o.warnings,
                    s = {
                        1: {
                            title: "No Warnings",
                            class: "bg-label-success"
                        },
                        2: {
                            title: "Temperature Not Optimal",
                            class: "bg-label-warning"
                        },
                        3: {
                            title: "Ecu Not Responding",
                            class: "bg-label-danger"
                        },
                        4: {
                            title: "Oil Leakage",
                            class: "bg-label-info"
                        },
                        5: {
                            title: "fuel problems",
                            class: "bg-label-primary"
                        }
                    };
                return void 0 === s[o] ? e : '<span class="badge rounded ' + s[o].class + '">' + s[o].title + "</span>"
            }
        }, {
            targets: -1,
            render: function (e, t, o, r) {
                o = o.progress;
                return '<div class="d-flex align-items-center"><div div class="progress w-100" style="height: 8px;"><div class="progress-bar" role="progressbar" style="width:' + o + '%;" aria-valuenow="' + o + '" aria-valuemin="0" aria-valuemax="100"></div></div><div class="text-body ms-3">' + o + "%</div></div>"
            }
        }],
        order: [2, "asc"],
        dom: '<"table-responsive"t><"row d-flex align-items-center"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        displayLength: 5,
        language: {
            paginate: {
                next: '<i class="bx bx-chevron-right bx-18px"></i>',
                previous: '<i class="bx bx-chevron-left bx-18px"></i>'
            }
        },
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal({
                    header: function (e) {
                        return "Details of " + e.data().location
                    }
                }),
                type: "column",
                renderer: function (e, t, o) {
                    o = $.map(o, function (e, t) {
                        return "" !== e.title ? '<tr data-dt-row="' + e.rowIndex + '" data-dt-column="' + e.columnIndex + '"><td>' + e.title + ":</td> <td>" + e.data + "</td></tr>" : ""
                    }).join("");
                    return !!o && $('<table class="table"/><tbody />').append(o)
                }
            }
        }
    }), $(".dataTables_info").addClass("pt-0"))
});

// ChartJS Part

!function () {
    var o = "#836AF9",
        r = "#ffe800",
        t = "#28dac6",
        e = "#EDF1F4",
        a = "#2B9AFF",
        l = "#84D0FF";
    let i, n, d, s, c;
    s = (isDarkStyle ? (i = config.colors_dark.cardColor, n = config.colors_dark.headingColor, d = config.colors_dark.textMuted, c = config.colors_dark.bodyColor, config.colors_dark) : (i = config.colors.cardColor, n = config.colors.headingColor, d = config.colors.textMuted, c = config.colors.bodyColor, config.colors)).borderColor;
    
    document.querySelectorAll(".chartjs").forEach(function (o) {
        o.height = o.dataset.height
    });

    function fetchCounts2() {
        return fetch('admin/data/getCounts.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                return {
                    grade7: data.grade_7_count,
                    grade8: data.grade_8_count, 
                    grade9: data.grade_9_count,  
                    grade10: data.grade_10_count, 
                    grade11: data.grade_11_count, 
                    grade12: data.grade_12_count 
                };
            })
            .catch(error => {
                console.error('Error fetching counts:', error);
                return {
                    grade7: 0,
                    grade8: 0,
                    grade9: 0,
                    grade10: 0,
                    grade11: 0,
                    grade12: 0
                };
            });
    }


        //                              GRADING SYSTEMM          ////////
    
    fetchCounts2().then(gradeData => {
        var gradesChartElement = document.getElementById("gardesChart2222");
        
        if (gradesChartElement) {
            var gradesChart = new Chart(gradesChartElement, {
                type: "polarArea",
                data: {
                    labels: ["Grade 7", "Grade 8", "Grade 9", "Grade 10", "Grade 11", "Grade 12"],
                    datasets: [{
                        label: "Total Students",
                        backgroundColor: [o, r, "#FF8132", "#299AFF", "#4F5D70", t, "#333333"],
                        data: [
                            gradeData.grade7,
                            gradeData.grade8, 
                            gradeData.grade9, 
                            gradeData.grade10,
                            gradeData.grade11,
                            gradeData.grade12  
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        duration: 500
                    },
                    scales: {
                        r: {
                            ticks: {
                                display: false,
                                color: d
                            },
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            rtl: isRtl,
                            backgroundColor: i,
                            titleColor: n,
                            bodyColor: c,
                            borderWidth: 1,
                            borderColor: s
                        },
                        legend: {
                            rtl: isRtl,
                            position: "right",
                            labels: {
                                usePointStyle: true,
                                padding: 25,
                                boxWidth: 8,
                                boxHeight: 8,
                                color: c
                            }
                        }
                    }
                }
            });
        }

                //////STOOOOOOOPPPPPPPPPPPPP///////////////

        var staticGradesChartElement = document.getElementById("gardesChart");
        if (staticGradesChartElement) {
            var staticGradesChart = new Chart(staticGradesChartElement, {
                type: "polarArea",
                data: {
                    labels: ["Grade 7", "Grade 8", "Grade 9", "Grade 10", "Grade 11", "Grade 12"],
                    datasets: [{
                        label: "Total Students (Static)",
                        backgroundColor: [o, r, "#FF8132", "#299AFF", "#4F5D70", t, "#333333"],
                        data: [19, 17, 15, 13, 11, 9],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        duration: 500
                    },
                    scales: {
                        r: {
                            ticks: {
                                display: false,
                                color: d
                            },
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            rtl: isRtl,
                            backgroundColor: i,
                            titleColor: n,
                            bodyColor: c,
                            borderWidth: 1,
                            borderColor: s
                        },
                        legend: {
                            rtl: isRtl,
                            position: "right",
                            labels: {
                                usePointStyle: true,
                                padding: 25,
                                boxWidth: 8,
                                boxHeight: 8,
                                color: c
                            }
                        }
                    }
                }
            });
        }
    });

    var eventsChartElement = document.getElementById("eventsChart");
    if (eventsChartElement) {
        new Chart(eventsChartElement, {
            type: "bar",
            data: {
                labels: ["Meccano", "Lumnois", "Dimentions", "Secret Code", "Semi Colon"],
                datasets: [{
                    data: [250, 200, 130, 40, 10],
                    backgroundColor: t,
                    borderColor: "transparent",
                    maxBarThickness: 15,
                    borderRadius: {
                        topRight: 15,
                        topLeft: 15
                    }
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                    duration: 500
                },
                plugins: {
                    tooltip: {
                        rtl: isRtl,
                        backgroundColor: i,
                        titleColor: n,
                        bodyColor: c,
                        borderWidth: 1,
                        borderColor: s
                    },
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            color: s,
                            drawBorder: false,
                            borderColor: s
                        },
                        ticks: {
                            color: d
                        }
                    },
                    y: {
                        min: 0,
                        max: 400,
                        grid: {
                            color: s,
                            drawBorder: false,
                            borderColor: s
                        },
                        ticks: {
                            stepSize: 100,
                            color: d
                        }
                    }
                }
            }
        });
    }
}();
