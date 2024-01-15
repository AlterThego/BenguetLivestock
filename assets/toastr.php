<?php
if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
    $toastType = 'success'; // Default to success

    // Check if the status message indicates an error
    if (strpos(strtolower($_SESSION['status']), 'failed') !== false || strpos(strtolower($_SESSION['status']), 'error') !== false) {
        $toastType = 'error';
    }

    echo "<script>
        // Display Toastr notification with custom options based on success or warning
        toastr.$toastType('{$_SESSION['status']}', 'Status', {
            closeButton: false,
            debug: false,
            newestOnTop: false,
            progressBar: true,
            positionClass: 'toast-top-center',
            preventDuplicates: false,
            onclick: null,
            showDuration: '300',
            hideDuration: '1000',
            timeOut: '5000',
            extendedTimeOut: '1000',
            showEasing: 'swing',
            hideEasing: 'linear',
            showMethod: 'fadeIn',
            hideMethod: 'fadeOut',
        });
    </script>";

    unset($_SESSION['status']);
}
?>