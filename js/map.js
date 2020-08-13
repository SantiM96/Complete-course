(function () {
    'use strict';


    document.addEventListener('DOMContentLoaded', function () {

          var map = L.map('map').setView([-34.905572, -56.185498], 15.4);

          L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
          }).addTo(map);

          L.marker([-34.905572, -56.185498]).addTo(map)
            .bindPopup('GdlWebCamp')
            .openPopup();
        
    });
})();