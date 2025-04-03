document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("editModal");
    const closeModal = document.getElementById("closeModal");
    const editarForm = document.getElementById("editarForm");

    
    modal.style.display = "none"; 

    document.querySelectorAll(".editar-btn").forEach(button => {
        button.addEventListener("click", function () {
            let id = this.getAttribute("data-id");
            let cpf = this.getAttribute("data-cpf");
            let creci = this.getAttribute("data-creci");
            let nome = this.getAttribute("data-nome");

            editarForm.querySelector(".id").value = id;
            editarForm.querySelector(".cpf").value = cpf;
            editarForm.querySelector(".creci").value = creci;
            editarForm.querySelector(".nome").value = nome;

            modal.style.display = "block";
        });
    });

    closeModal.addEventListener("click", function () {
        modal.style.display = "none";
    });

    window.addEventListener("click", function (event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });
});


function validarFormulario(formId) {
    let form = document.getElementById(formId);
    let cpf = form.querySelector(".cpf").value;
    let creci = form.querySelector(".creci").value;
    let nome = form.querySelector(".nome").value;

    if (cpf.length !== 11) {
        alert("O CPF deve ter 11 caracteres.");
        return false;
    }
    if (creci.length < 2) {
        alert("O Creci deve ter pelo menos 2 caracteres.");
        return false;
    }
    if (nome.length < 2) {
        alert("O Nome deve ter pelo menos 2 caracteres.");
        return false;
    }
    return true;
}

document.addEventListener("DOMContentLoaded", function () {
    let mensagem = document.getElementById("mensagem");

    if (mensagem) {
        setTimeout(() => {
            mensagem.style.display = "none"; 
        }, 5000);
    }

    if (window.location.search.includes("mensagem")) {
        const newUrl = window.location.origin + window.location.pathname;
        window.history.replaceState({}, document.title, newUrl);
    }
});

