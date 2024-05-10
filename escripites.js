const movimentacoes = document.getElementById("tipoMovimentacao");
const nomeFunci = document.getElementById("nomeFunci");
const formularioRegistro = document.getElementById("formulario");
const dataMov = document.getElementById("dataMov");

function verificaMov() {
    if (movimentacoes.value == "saida") {
        nomeFunci.removeAttribute("disabled");
        nomeFunci.setAttribute("required", true);
    } else {
        nomeFunci.value = "";
        nomeFunci.setAttribute("disabled", true);
        nomeFunci.setAttribute("required", false);
    }
}
/* function apagarHistorico() {
    if (window.history.replaceState) window.history.replaceState(null, null, window.location.href);
} */