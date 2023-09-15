require('./bootstrap');

// const { Dropzone } = require("dropzone/src/dropzone");
// const { Dropzone } = require("dropzone/dist/dropzone");

// Requerir dropzone en el proyecto
const { Dropzone } = require("dropzone");

window.Dropzone = Dropzone;
