// resources/js/dates.js


//string display date
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


