
		// liste des véhicules

// info des vehicules dynamique
document.querySelectorAll('#vehicle-list .list-group-item').forEach(item => {
    item.addEventListener('click', event => { // Afficher l'image du véhicule
    const vehicleImage = document.getElementById('vehicle-image');
    vehicleImage.src = event.target.dataset.vehicleImage;
    vehicleImage.style.display = 'block';
    
    // Afficher les informations du véhicule
    const vehicleInfo = document.getElementById('vehicle-info');
    vehicleInfo.innerHTML = event.target.dataset.vehicleInfo;
    vehicleInfo.style.display = 'block';
    });
    });
    
    
    // Rating pagination
    
    
    let ratings = [{% for rating in rating %}{
    note: {{ rating.note }},
    commentary: "{{ rating.commentary }}"
    },{% endfor %}];
    
    let currentPage = 0;
    const reviewsPerPage = 5;
    
    function displayReviews() {
    let start = currentPage * reviewsPerPage;
    let end = start + reviewsPerPage;
    
    let reviewsHtml = `
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Note</th>
                        <th scope="col">Commentary</th>
                    </tr>
                </thead>
                <tbody>
            `;
    
    for (let i = start; i < end && i < ratings.length; i++) {
    let rating = ratings[i];
    reviewsHtml += `<tr>
                    <td>`;
    for (let j = 1; j <= 5; j++) {
    if (j <= rating.note) {
    reviewsHtml += '<span class="bi bi-star-fill text-warning"></span>';
    } else {
    reviewsHtml += '<span class="bi bi-star"></span>';
    }
    }
    reviewsHtml += `</td>
                    <td>${
    rating.commentary
    }</td>
                </tr>`;
    }
    
    reviewsHtml += `</tbody>
            </table>`;
    document.getElementById("reviews").innerHTML = reviewsHtml;
    updatePaginationButtons();
    }
    
    function updatePaginationButtons() {
    document.getElementById("previous").disabled = currentPage === 0;
    document.getElementById("next").disabled = (currentPage + 1) * reviewsPerPage >= ratings.length;
    }
    
    function changePage(direction) {
    currentPage += direction;
    displayReviews();
    }
    
    displayReviews();
    