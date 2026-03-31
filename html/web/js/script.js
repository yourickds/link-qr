$(document).on('pjax:send', function() {
    $('#btn-submit').addClass('d-none');
    $('#loading-spinner').removeClass('d-none'); // Show your loader
});

$(document).on('pjax:complete', function() {
    $('#loading-spinner').addClass('d-none'); // Hide your loader
    $('#btn-submit').removeClass('d-none');
});