import "./bootstrap";
import "flowbite";

const getChartOptions = () => {
    return {
        series: [20, 25, 55],
        colors: ["#1C64F2", "#16BDCA", "#9061F9"],
        chart: {
            height: 420,
            width: "100%",
            type: "pie",
        },
        stroke: {
            colors: ["white"],
            lineCap: "",
        },
        plotOptions: {
            pie: {
                labels: {
                    show: true,
                },
                size: "100%",
                dataLabels: {
                    offset: -25,
                },
            },
        },
        labels: ["Direct", "Organic search", "Referrals"],
        dataLabels: {
            enabled: true,
            style: {
                fontFamily: "Inter, sans-serif",
            },
        },
        legend: {
            position: "bottom",
            fontFamily: "Inter, sans-serif",
        },
        yaxis: {
            labels: {
                formatter: function (value) {
                    return value + "%";
                },
            },
        },
        xaxis: {
            labels: {
                formatter: function (value) {
                    return value + "%";
                },
            },
            axisTicks: {
                show: false,
            },
            axisBorder: {
                show: false,
            },
        },
    };
};

if (
    document.getElementById("pendapatan-chart") &&
    typeof ApexCharts !== "undefined"
) {
    const chart = new ApexCharts(
        document.getElementById("pendapatan-chart"),
        getChartOptions()
    );
    chart.render();
}

if (
    document.getElementById("belanja-chart") &&
    typeof ApexCharts !== "undefined"
) {
    const chart = new ApexCharts(
        document.getElementById("belanja-chart"),
        getChartOptions()
    );
    chart.render();
}

if (
    document.getElementById("pembiayaan-chart") &&
    typeof ApexCharts !== "undefined"
) {
    const chart = new ApexCharts(
        document.getElementById("pembiayaan-chart"),
        getChartOptions()
    );
    chart.render();
}

document
    .getElementById("photo-upload")
    .addEventListener("change", function (event) {
        const file = event.target.files[0];
        const preview = document.getElementById("image-preview");
        const noImageText = document.getElementById("no-image-text");

        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.classList.remove("hidden");
                if (noImageText) {
                    noImageText.classList.add("hidden");
                }
            };

            reader.readAsDataURL(file);
        }
    });
