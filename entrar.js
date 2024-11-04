// Seleciona o campo de senha e o ícone do "olhinho"
const togglePassword = document.querySelector("#togglePassword");
const password = document.querySelector("#password");
const icon = togglePassword.querySelector("i"); // Seleciona o ícone <i> dentro do span

// Adiciona o evento de clique no ícone
togglePassword.addEventListener("click", function () {
    // Alterna entre os tipos "password" e "text"
    const type = password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);

    // Alterna o ícone entre olho aberto e fechado
    icon.classList.toggle("fa-eye");
    icon.classList.toggle("fa-eye-slash");
});
