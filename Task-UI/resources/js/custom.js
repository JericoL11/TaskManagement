export function numericInput(selector, maxLength = 11) {
    $(document).on('input', selector, function () {
        // Keep only digits
        let val = $(this).val().replace(/\D/g, '');

        // Limit to maxLength digits
        if (val.length > maxLength) {
            val = val.slice(0, maxLength);
        }

        $(this).val(val);
    });
}
