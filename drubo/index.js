const map = L.map("map", {
    minZoom: 2
  });
  map.setView([23.76014, 90.44020], 10);
  
  const apiKey = "AAPK8c068a102d1d4572b39ac901b02b1747YS3BeLTz8JwgNEep9MjKKTl-oM5hkmVZHh0C2lDuf7BkuA_8nw6BR_z6hu10hzSN";
  const basemapEnum = "arcgis/dark-gray";
  L.esri.Vector.vectorBasemapLayer(basemapEnum, {
    apiKey: apiKey
  }).addTo(map);
  
  let hospitals = {
    "type": "FeatureCollection",
    "features": []
  };
  
  d3.csv("/dataset.csv", function(data) {
    for (let i = 0; i < data.length; i++) {
      let feature = {
        "type": "Feature",
        "properties": {
          "name": data[i].name,
          "contact": data[i].contact,
          "Website_link": data[i].website_link,
          "avaleabale_bed": data[i].avaleabale_bed,
          "ownership": data[i].ownership,
          
          "service_ratings": data[i].service_ratings,
          "cost_ratings": data[i].cost_ratings,
          "online_survice": data[i].online_survice,
          "emergency_suppory": data[i].emergency_suppory,
          "nicu": data[i].nicu,
          "icu_iccu": data[i].icu_iccu,
          "ambulence_support": data[i].ambulence_support,
          "advanced_life_support_ambulance": data[i].advanced_life_support_ambulance,
          "neonatology_ambulence": data[i].neonatology_ambulence
        },
        "geometry": {
          "coordinates": [
            parseFloat(data[i].longitude),
            parseFloat(data[i].latitude)
          ],
          "type": "Point"
        }
      };
  
      hospitals.features.push(feature);
    }
  
    L.geoJSON(hospitals, {
      onEachFeature: onEachHospital,
      pointToLayer: pointToLayer
    }).addTo(map);
  
    updateIndicators(hospitals); // Update indicators with hospital data
  });



