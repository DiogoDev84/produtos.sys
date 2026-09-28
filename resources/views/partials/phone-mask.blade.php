<script>
  const phoneInput = document.getElementById('phone');

  phoneInput.addEventListener('input', function (e) {
    let digits = e.target.value.replace(/\D/g, ''); // remove tudo que não é número
    digits = digits.substring(0, 11); // limita a 11 dígitos (DDD + 9 dígitos)

    let formatted = '';

    if (digits.length > 0) {
      formatted += '(' + digits.substring(0, 2); // abre parêntese + DDD
    }
    if (digits.length > 2) {
      formatted += ') ' + digits.substring(2, 7); // fecha parêntese + espaço + primeiros dígitos
    }
    if (digits.length > 7) {
      formatted += '-' + digits.substring(7, 11); // traço + últimos dígitos
    }
    e.target.value = formatted;
  });
</script>
