
const searchControl = new L.Control.Search({
    layer: hospitalsLayer, // Replace 'hospitalsLayer' with your actual layer variable
    propertyName: ['name', 'address'], // Array of properties to search
    marker: false,
    moveToLocation: function(latlng, title, map) {
        map.setView(latlng, 12);
    }
});

// Add the search control to the map
map.addControl(searchControl);

// Add a button click event to toggle the search control
document.getElementById('search-toggle-button').addEventListener('click', function() {
    searchControl._toggleContainer();
});








function onEachHospital(feature, layer) {
    let str_popup = '<h4>' + feature.properties.name + '</h4>';
    str_popup += '<b>Address:</b>' + feature.properties.address + '<br>';
    str_popup += '<b>Contact:</b>' + feature.properties.contact + '<br>';
    str_popup += '<b>type_of_hospital:</b>' + feature.properties.type_of_hospital + '<br>';
    layer.bindPopup(str_popup);
}

function setStyle(feature) {
    let color = '';
    if (feature.properties.type_of_hospital == 'Medical college hospital')
        color = '#ff4600';
    else if (feature.properties.type_of_hospital == 'Clinic')
        color = '#db85d6';
    else if (feature.properties.type_of_hospital == 'Diagnostic')
        color = '#d3e044';
    else
        color = '#ffff00';

    return L.divIcon({
        html: '<i class="fa fa-hospital-o" style="font-size:16px;color:' + color + '"></i>',
    });
}

function pointToLayer(feature, latlng) {
    let color = '';
    if (feature.properties.type_of_hospital == 'Medical college hospital')
        color = '#ff4600';
    else if (feature.properties.type_of_hospital == 'Clinic')
        color = '#db85d6';
    else if (feature.properties.type_of_hospital == 'Diagnostic')
        color = '#d3e044';
    else
        color = '#ffff00';

    return L.marker(latlng, {
        icon: L.divIcon({
            // className: 'font-awesome-icon',
            html: '<i class="fa fa-heartbeat" style="font-size:24px;color:' + color + '"></i>',
        }),
    });
}

function updateIndicators(hospitals) {
    let total_seats = document.getElementById('total_seats');
    let hospital_seats = document.getElementById('hospital_seats');
    let hospital_seats_no = 0;
    var sum_seats = _.reduce(hospitals.features, function (total, feature) {
        let seat = 0;
        if (feature.properties.avaleabale_bed == null || feature.properties.avaleabale_bed == undefined || feature.properties.avaleabale_bed == '' || feature.properties.avaleabale_bed == " ") {
            seat = 0
        } else {
            seat = parseInt(feature.properties.avaleabale_bed);
            hospital_seats_no++;
        }

        console.log(seat);
        return total + seat;
    }, 0);

    total_seats.innerHTML = sum_seats;
    hospital_seats.innerHTML = 'In <b>' + hospital_seats_no + '</b> Hospitals';

    let hospital_count = document.getElementById('hospital_count');
    hospital_count.innerHTML = hospitals.features.length;
}






