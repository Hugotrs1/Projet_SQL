//PAS UTILE C'EST UN SUPPORT
document.getElementById('apply-filters').addEventListener('click', async () => {
    const speed = document.getElementById('filter-speed').value;
    const price = document.getElementById('filter-price').value;
    const capacity = document.getElementById('filter-capacity').value; 
    const year = document.getElementById('filter-year').value;  
    const category = document.getElementById('filter-category').value; 

    
    // Construire l'URL de l'API avec les filtres
    let apiUrl = 'http://localhost/gta-api/vehicules';

    // Ajouter les paramètres de filtre à l'URL
    const params = [];
    if (speed !== 'all') params.push(`speed=${speed}`);
    if (price !== 'all') params.push(`price=${price}`);
    if (capacity !== 'all') params.push(`capacity=${capacity}`); 
    if (year !== 'all') params.push(`year=${year}`);  
    if (category !== 'all') params.push(`category=${category}`);  

    if (params.length > 0) {
        apiUrl += `?${params.join('&')}`;
    }

    // Effectuer la requête à l'API
    try {
        const response = await fetch(apiUrl);
        const vehicles = await response.json();

        // Mettre à jour l'affichage des véhicules
        const container = document.getElementById('vehicles-container');
        container.innerHTML = '';

        if (vehicles.length === 0) {
            container.innerHTML = '<p>Aucun véhicule trouvé avec les filtres sélectionnés.</p>';
        } else {
            vehicles.forEach(vehicle => {
                const vehicleCard = document.createElement('div');
                vehicleCard.classList.add('item-card');
                vehicleCard.innerHTML = `
                    <img src="images/${vehicle.image}" alt="${vehicle.name}">
                    <div class="info">
                        <h3>${vehicle.name}</h3>
                        <p>Vitesse : ${vehicle.speed} km/h</p>
                        <p>Prix : ${vehicle.price} $</p>
                        <button>Acheter</button>
                    </div>
                `;
                container.appendChild(vehicleCard);
            });
        }
    } catch (error) {
        console.error('Erreur lors de la récupération des véhicules avec les filtres:', error);
    }
});
