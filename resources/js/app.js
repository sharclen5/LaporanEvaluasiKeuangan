import "./bootstrap";
import "flowbite";

const renderChart = (id, percentage) => {
    const options = {
        series: [percentage, 100 - percentage],
        colors: ["#1C64F2", "#16BDCA"],
        chart: {
            height: 420,
            width: "100%",
            type: "pie",
        },
        labels: ["Realisasi", "Sisa"],
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
    };

    const chartElement = document.getElementById(id);
    if (chartElement && typeof ApexCharts !== "undefined") {
        // Hapus chart lama sebelum render ulang
        while (chartElement.firstChild) {
            chartElement.removeChild(chartElement.firstChild);
        }
        const chart = new ApexCharts(chartElement, options);
        chart.render();
    }
};

document.querySelectorAll('[id$="-chart"]').forEach((chart) => {
    const percentage = parseFloat(chart.getAttribute("data-percentage"));
    if (!isNaN(percentage)) {
        renderChart(chart.id, percentage);
    }
});



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




