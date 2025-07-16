// resources/js/dates.js


//reset date format
export function resetFormattedDateInput(visibleSelector, hiddenSelector) {
    const rawDate = $(hiddenSelector).val();

    if (rawDate) {
        $(visibleSelector)
            .attr('type', 'date')
            .val(rawDate);
    } else {
        $(visibleSelector)
            .attr('type', 'date')
            .val('');
    }
}

//for input date

export function attachLongDateFormatter(visibleSelector, hiddenSelector) {
    const $visibleInput = $(visibleSelector);
    const $hiddenInput = $(hiddenSelector);

    // 🔁 Format initial value if present
    const initialVal = $visibleInput.val();
    if (initialVal) {
        $visibleInput.attr('type', 'text').val(formatToLongDate(initialVal));
        $hiddenInput.val(initialVal);
    }

    // 📆 On change: format and store
    $visibleInput.on('change', function () {
        const selectedDate = $(this).val();
        const formatted = formatToLongDate(selectedDate);
        $visibleInput.attr('type', 'text').val(formatted);
        $hiddenInput.val(selectedDate);
    });

    // 🖱 On focus: switch back to date picker
    $visibleInput.on('focus', function () {
        $visibleInput.attr('type', 'date');
    }).on('blur', function () {
        const raw = $hiddenInput.val();
        if (raw) {
            $visibleInput.attr('type', 'text').val(formatToLongDate(raw));
        }
    });
}


//string display date for datatable or specific inputs
export function formatToLongDate(dateInput) {
    if (!dateInput) return '';

    const date = new Date(dateInput);
    return date.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
}


//get only specific date
export function getDateOnly(dateStr) {
    if (!dateStr) return '';
    return dateStr.split('T')[0].split(' ')[0];
}


//current and past dates only
export function setMinToday(inputSelector) {
    const today = new Date();
    const yyyy = today.getFullYear();
    const mm = String(today.getMonth() + 1).padStart(2, '0');
    const dd = String(today.getDate()).padStart(2, '0');

    const minDate = `${yyyy}-${mm}-${dd}`;
    $(inputSelector).attr('min', minDate);

    const currentVal = $(inputSelector).val();
    if (currentVal && currentVal < minDate) {
        $(inputSelector).val('');
    }
}

//current and future date only
export function setMaxToday(inputSelector) {
    const today = new Date();
    const yyyy = today.getFullYear();
    const mm = String(today.getMonth() + 1).padStart(2, '0');
    const dd = String(today.getDate()).padStart(2, '0');

    const maxDate = `${yyyy}-${mm}-${dd}`;
    $(inputSelector).attr('max', maxDate);

    const currentVal = $(inputSelector).val();
    if (currentVal && currentVal > maxDate) {
        $(inputSelector).val('');
    }
}


