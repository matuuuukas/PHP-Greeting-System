
new Chart(document.getElementById("pie-chart"), {
    type: 'pie',
    data: {
      labels: ["Sausis", "Vasaris", "Kovas", "Balandis", "Gegužė", "Birželis", "Liepa", "Rugpjūtis", "Rugsėjis", "Spalis", "Lapkritis", "Gruodis"],
      datasets: [{
        label: "Population (millions)",
        backgroundColor: ["#B2D1FF", "#B2D1FF","#6D993E","#6D993E","#6D993E", "#FFF343", "#FFF343", "#FFF343", "#B8783D", "#B8783D", "#B8783D", "#B2D1FF"],
        data: [2,5,10,41,44,22,33,11,12,15,55,19]
      }]
    },
    options: {
      title: {
        display: true,
        text: ''
      }
    }
});