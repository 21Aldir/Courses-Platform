document.getElementById('signup-form')
  .addEventListener('submit', function(e) {
    e.preventDefault();

    var name     = document.getElementById('name').value.trim();
    var email    = document.getElementById('email').value.trim();
    var password = document.getElementById('password').value;
    var confirm  = document.getElementById('confirm').value;
    var msg      = document.getElementById('signup-msg');

    if (!name || !email || !password) {
      msg.innerHTML = '<span style="color:red">Por favor completa todos los campos.</span>';
      return;
    }

    if (password !== confirm) {
      msg.innerHTML = '<span style="color:red">Las contraseñas no coinciden.</span>';
      return;
    }

    msg.innerHTML = '<span style="color:green">Cuenta creada. Redirigiendo...</span>';

    setTimeout(function() {
      window.location.href = 'login.html';
    }, 1200);
  });
