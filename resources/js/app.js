import './bootstrap'; // Agora sim, está puxando algo real

import $ from 'jquery';
window.$ = window.jQuery = $;

// Se tiver scripts adicionais:
//import './vendor/easing';
import SmoothScroll from 'smooth-scroll'; // Agora importando o pacote correto
import 'owl.carousel/dist/owl.carousel.min.js';
import 'owl.carousel/dist/assets/owl.carousel.min.css';  // Se for necessário o CSS
import 'waypoints/lib/noframework.waypoints.min.js';


// Inicializando o SmoothScroll
const scroll = new SmoothScroll('a[href*="#"]', {
    speed: 800,  // A velocidade do scroll (milissegundos)
    speedAsDuration: true
});
