$(document).ready(function(){
    $('#gradeInput').on('input', function() {
        console.log('Input event triggered'); // This line is for debugging
        var grade = parseFloat($(this).val());
        if (grade >= 0.0 && grade <= 5.0) {
            $('#gradeButton').prop('disabled', false);
            $('#error-message-grade').text('');
        } else {
            $('#gradeButton').prop('disabled', true);
            $('#error-message-grade').text('La calificación debe ser un número entre 0.0 y 5.0').css('color', 'crimson');
        }
    });
});