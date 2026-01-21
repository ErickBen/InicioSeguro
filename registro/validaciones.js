document.getElementById("registroForm").addEventListener("submit", function (e) {

    const nombre = document.getElementById("nombre").value.trim();
    const email = document.getElementById("email").value.trim();
    const telefono = document.getElementById("telefono").value.trim();
    const password = document.getElementById("password").value;
    const confirmar = document.getElementById("confirmar").value;

    if (nombre.length < 3) {
        alert("El nombre debe tener al menos 3 caracteres.");
        e.preventDefault();
        return;
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert("Correo electrónico no válido.");
        e.preventDefault();
        return;
    }

    if (!/^[0-9]{10}$/.test(telefono)) {
        alert("El teléfono debe tener 10 dígitos.");
        e.preventDefault();
        return;
    }

    if (password.length < 8) {
        alert("La contraseña debe tener mínimo 8 caracteres.");
        e.preventDefault();
        return;
    }

    if (password !== confirmar) {
        alert("Las contraseñas no coinciden.");
        e.preventDefault();
        return;
    }
});
