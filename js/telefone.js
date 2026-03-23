const telefone = document.getElementById('telefone');

telefone.addEventListener('input', formatarTelefone);
telefone.addEventListener('keydown', controlarBackspace);

function formatarTelefone(e) {
    const input = e.target;
    let cursorPos = input.selectionStart;

    // Remove tudo que não é número
    let digits = input.value.replace(/\D/g, '');

    // Limita a 11 dígitos (DDD + 8 ou 9)
    if (digits.length > 11) digits = digits.slice(0, 11);

    let formatted = '';

    if (digits.length > 0) {
        formatted += '(' + digits.substring(0, 2) + ') ';
    }

    if (digits.length > 2) {
        if (digits.length <= 6) {
            // Parcial: 3 a 6 dígitos
            formatted += digits.substring(2);
        } else if (digits.length <= 10) {
            // Fixo 8 dígitos
            formatted += digits.substring(2, 6) + '-' + digits.substring(6);
        } else {
            // Celular 9 dígitos
            formatted += digits.substring(2, 7) + '-' + digits.substring(7);
        }
    }

    // Mantém cursor no lugar correto
    const diff = formatted.length - input.value.length;
    input.value = formatted;
    cursorPos += diff;
    if (cursorPos < 0) cursorPos = 0;
    input.selectionStart = input.selectionEnd = cursorPos;
}	

function controlarBackspace(e) {
    const input = e.target;
    const pos = input.selectionStart;

    // Se cursor estiver sobre parênteses ou espaço, move para apagar o dígito correto
    if (e.key === 'Backspace') {
        if (pos === 1 || pos === 4) {
            e.preventDefault();
            input.setSelectionRange(pos - 1, pos - 1);
        }
    }
}	