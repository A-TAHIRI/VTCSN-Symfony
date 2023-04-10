

window.onload =()=>{
    var carte = L.map('Map').setView([48.852969, 2.349903], 13);

    // On charge les "tuiles"
    L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
        // Il est toujours bien de laisser le lien vers la source des données
        attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
        minZoom: 1,
        maxZoom: 20
    }).addTo(carte);

    // On écoute le clic sur la carte et on lance la fonction "mapClickListen"
     carte.on('click', mapClickListen)


}
    /**
 * Cette fonction se déclenche au clic, crée un marqueur et remplit les champs latitude et longitude
 * @param {event} e 
 */
function mapClickListen(e) {

    console.log(e)
    // On récupère les coordonnées du clic
    pos = e.latlng

    // On crée un marqueur
    addMarker(pos)

    // On affiche les coordonnées dans le formulaire
    document.querySelector("#lat").value=pos.lat
   document.querySelector("#lon").value=pos.lng

}