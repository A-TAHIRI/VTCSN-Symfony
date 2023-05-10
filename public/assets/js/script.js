window.onload = function(){
    let macarte = L.map('carte').setView([48.852969, 2.349903], 13)
    L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
        attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
        minZoom: 1,
        maxZoom: 20
    }).addTo(macarte)
    L.Routing.control({
        lineOptions: {
            styles: [{color: '#ff8f00', opacity: 1, weight: 7}]
        },
        router: new L.Routing.osrmv1({
            language: 'fr',
            profile: 'car', // car, bike, foot
        }),
        geocoder: L.Control.Geocoder.nominatim()
    }).addTo(macarte)
    
}


	// info des vehicules dynamique
    document.querySelectorAll('#vehicle-list .list-group-item').forEach(item => {
        item.addEventListener('click', event => {
          // Afficher l'image du véhicule
          const vehicleImage = document.getElementById('vehicle-image');
          vehicleImage.src = event.target.dataset.vehicleImage;
          vehicleImage.style.display = 'block';
    
          // Afficher les informations du véhicule
          const vehicleInfo = document.getElementById('vehicle-info');
          vehicleInfo.innerHTML = event.target.dataset.vehicleInfo;
          vehicleInfo.style.display = 'block';
        });
      });
            