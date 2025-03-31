<template>
    <div id="map"></div>
  </template>

  <script>
  import mapboxgl from 'mapbox-gl'; // Importa Mapbox GL JS
  import 'mapbox-gl/dist/mapbox-gl.css';

  export default {
    name: 'Mapa',
    mounted() {
      // Clau d'accés de Mapbox
      mapboxgl.accessToken = 'pk.eyJ1IjoiY2FybGFjYXllcm8iLCJhIjoiY204eDZ3aWh1MDBnazJxcXgxeHl1dWg2aSJ9.EHGR1JHYwBI4fi9dwJCrJA';

      // Inicialitza el mapa
      const map = new mapboxgl.Map({
        container: 'map', // ID del contenidor
        style: 'mapbox://styles/mapbox/streets-v11', // Estil del mapa
        center: [-0.126326, 51.533582], // Coordenades inicials
        zoom: 15.27, // Zoom inicial
        pitch: 42, // Inclinació
        bearing: -50 // Rotació
      });

      // Afegeix un marcador al mapa
      new mapboxgl.Marker()
        .setLngLat([-0.126326, 51.533582]) // Coordenades del marcador
        .addTo(map);

      // Afegeix un control de navegació (zoom i rotació)
      map.addControl(new mapboxgl.NavigationControl());
    }
  };
  </script>

  <style>
  body {
    margin: 0;
    padding: 0;
  }
  #map {
    position: absolute;
    top: 0;
    bottom: 0;
    width: 100%;
  }
  </style>
