<template>
    <div id="map"></div>
  </template>

  <script>
  import mapboxgl from 'mapbox-gl';
  import 'mapbox-gl/dist/mapbox-gl.css';

  export default {
    name: 'Mapa',
    mounted() {
        // Token Mapbox
        mapboxgl.accessToken = 'pk.eyJ1IjoiY2FybGFjYXllcm8iLCJhIjoiY204eDZ3aWh1MDBnazJxcXgxeHl1dWg2aSJ9.EHGR1JHYwBI4fi9dwJCrJA';

        // Init del mapa
        const map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/carlacayero/cm8yl237n003q01qz6p8t3hmp',
            center: [2.1731, 41.38877], // Coordenadas del mapa
            zoom: 18,
            bearing: -50,
            hash: false,
            interactive: true,
            attributionControl: false
        });

        // Marcador
        new mapboxgl.Marker()
            .setLngLat([2.1731, 41.38877]) // Coordenades del marcador
            .addTo(map);

        // control de navegación (zoom i rotación)
        map.addControl(new mapboxgl.NavigationControl());
    }
  };
  </script>

  <style scoped>
  body {
    margin: 0;
    padding: 0;
  }
  #map {
    position: relative;
    top: 0;
    bottom: 0;
    width: 100%;
    height: 800px;
    right: 10px;
  }
  </style>
