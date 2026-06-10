// Comentario Nova Tech: Arquivo resources/js/bootstrap.js. Origem: Scripts globais do frontend. Conteudo: Inicializa JavaScript global e dependencias usadas pelo frontend.
import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
